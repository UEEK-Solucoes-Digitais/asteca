<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiConfig;
use App\Models\Gallery;
use App\Models\Property;
use App\Models\PropertyType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Si9Controller extends Controller
{

    public static function refreshToken()
    {
        $apiUsername = env('SI9_USERNAME');
        $apiPassword = env('SI9_PASSWORD');
        $apiAuth = env('SI9_AUTH');


        $response = Http::withoutVerifying()->withHeaders([
            'Authorization' => "basic {$apiAuth}"
        ])->post("https://api.si9sistemas.com.br/imobilsi9-api/oauth/token?grant_type=password&username={$apiUsername}&password={$apiPassword}");

        if($response->ok()){
            $body = $response->json();
            $apiConfig = ApiConfig::firstOrNew();
            $apiConfig->token = $body['access_token'];
            $apiConfig->last_retrieved = Carbon::now();
            $apiConfig->save();
        }
    }

    public function getApiProperties()
    {
        try {
            $apiConfig = ApiConfig::first();

            $response = Http::withoutVerifying()->withToken($apiConfig->token)->get("https://api.si9sistemas.com.br/imobilsi9-api/property");

            if($response->ok()){

                $body = $response->json();

                function getPropertyType($apiCategory) {
                    static $propertyTypeCache = [];

                    $category = strtolower($apiCategory);

                    if (isset($propertyTypeCache[$category])) {
                        return $propertyTypeCache[$category];
                    }

                    $type = PropertyType::whereRaw('LOWER(name) = ?', [$category])->first();

                    if (!$type) {
                        $type = PropertyType::create(['name' => $apiCategory, 'position' => 999, 'status' => 1]);
                    }

                    $propertyTypeCache[$category] = $type->id;

                    return $type->id;
                }

                function formatPhoneNumber($phoneNumber) {
                    $digits = preg_replace('/\D/', '', $phoneNumber);
                
                    if (strlen($digits) !== 11) {
                        return $phoneNumber;
                    }
                
                    $areaCode = substr($digits, 0, 2);
                    $firstPart = substr($digits, 2, 5);
                    $secondPart = substr($digits, 7, 4);
                
                    return "($areaCode) $firstPart-$secondPart";
                }

                function getPropertyValue($values) {
                    $positiveValues = array_filter($values, function($value) {
                        return $value > 0;
                    });

                    if (!empty($positiveValues)) {
                        return min($positiveValues);
                    }

                    return 0;
                }

                $apiIds = [];

                foreach($body as $property){
                    $apiIds[] = $property['id'];

                    $model = Property::firstOrNew(['api_id' => $property['id']]);

                    $model->image = $property['images'][0]['url'] ?? '';
                    $model->image_webp = $property['images'][0]['url'] ?? '';

                    $model->title = $property['generalData']['title'];
                    $model->description = $property['generalData']['description'];
                    $model->url = friendlyUrl($property['generalData']['title']);
                    $model->address = "{$property['location']['address']} - {$property['location']['number']}, {$property['location']['district']['name']}, {$property['location']['city']['name']}";
                    $model->area = $property['dimensions']['privateArea'] ?? $property['dimensions']['landArea'] ?? $property['dimensions']['usefulArea'] ?? $property['dimensions']['buildingArea'] ?? $property['dimensions']['totalArea'];

                    $model->price = getPropertyValue($property['values']);

                    $model->property_type_id = getPropertyType($property['generalData']['category']['name']);

                    $model->whatsapp = formatPhoneNumber($property['company']['phoneNumber']);

                    $model->position = 999;
                    $model->status = 1;
                    $model->api_id = $property['id'];
                    $model->is_from_api = 1;

                    $model->save();

                    Gallery::where('item_id', $model->id)
                        ->where('type', 1)
                        ->where('is_from_api', 1)
                        ->delete();

                    foreach($property['images'] as $key => $image){
                        if($key == 0){
                            continue;
                        }

                        $gallery = new Gallery();
                        $gallery->is_from_api = 1;
                        $gallery->image = $image['url'];
                        $gallery->image_webp = $image['url'];
                        $gallery->alt_text = $image['subtitle'];
                        $gallery->type = 1;
                        $gallery->item_id = $model->id;
                        $gallery->position = 0;
                        $gallery->status = 1;

                        $gallery->save();
                    }
                }

                Property::where('is_from_api', 1)
                    ->whereNotIn('api_id', $apiIds)
                    ->update(['status' => 0]);

                $apiConfig->last_sync = Carbon::now();
                $apiConfig->save();

                return response()->json([
                    "status" => 1,
                    "msg" => "Propriedades sincronizadas com sucesso!",
                ], 200);

            } else {
                return response()->json([
                    "status" => 0,
                    "msg" => "Ocorreu um erro ao realizar a sincronização. Tente novamente mais tarde.",
                ], 200);
            }
            
        } catch (\Throwable $e) {
            return response()->json([
                "status" => 0,
                "msg" => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                "error" => $e->getMessage(),
            ], 500);
        }
    }

    public static function registerLead(Array $user)
    {
        try {
            $apiConfig = ApiConfig::first();

            $cellNumber = preg_replace('/\D/', '', $user['phone']);

            $body = [
                'classification' => 'medium',
                'name' => $user['name'],
                'email'  => $user['email'],
                'interestedIn' => 'buy',
                'cellNumber' => $cellNumber,
                'message' => $user['message'],
                'source' => 'SITE'
            ];

            $response = Http::withoutVerifying()->withToken($apiConfig->token)->post("https://api.si9sistemas.com.br/imobilsi9-api/lead", $body);

            return $response->ok();
            
        } catch (\Throwable $e) {
            return false;
        }
    }
}
