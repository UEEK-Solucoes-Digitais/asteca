<?php

namespace App\Http\Controllers\Site;

use App\Models\PropertyInfo;
use App\Models\Gallery;
use App\Models\Property;
use App\Models\OurRelease;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PageProperties;
use App\Http\Controllers\Controller;
use App\Models\ReleaseDifferential;
use App\Models\ReleaseUnity;

class SitePropertyController extends Controller
{

    public function index($type = null, $filter = null)
    {
        $page_properties = PageProperties::find(1);

        $properties = Property::where('status', 1);
        $releases = OurRelease::where('status', 1);

        if(isset($type) && $type == 'locacao'){
            $properties->where('property_type_id', $filter);
        }

        $properties = $properties->orderBy('position', 'asc')->get();

        if(isset($type) && $type == 'lancamentos'){
            $releases->where('property_type_id', $filter);
        }
        $releases = $releases->orderBy('position', 'asc')->get();

        $property_types = PropertyType::where('status', 1)->orderBy('position', 'asc')->get();

        return view("site.properties.index", compact(['page_properties', 'properties', 'releases', 'property_types']));
    }

    public function details($property_url)
    {

        $property = Property::where('status', 1)->where('url', $property_url)->first();

        if ($property) {
            $related_properties = Property::where('status', 1)
                ->where('property_type_id', $property->property_type_id)
                ->where('id', '<>', $property->id)
                ->orderBy('position', 'asc')
                ->get();

            $images = Gallery::where('status', 1)
                ->where('type', 1)
                ->where('item_id', $property->id)
                ->orderBy('position', 'asc')
                ->get();

            $property_infos = PropertyInfo::where('property_id', $property->id)->get();

            $property_infos_sum = PropertyInfo::where('property_id', $property->id)->sum('info_value');

            return view("site.properties.rental", compact('property', 'related_properties', 'images', 'property_infos', 'property_infos_sum'));
        } else {
            return redirect()->route('site.properties');
        }
    }

    public function detailsRelease($property_url)
    {
        $release = OurRelease::where('status', 1)->where('url', $property_url)->first();

        if ($release) {
            $images = Gallery::where('status', 1)
                ->where('type', 2)
                ->where('item_id', $release->id)
                ->orderBy('position', 'asc')
                ->get();

            $release_differentials = ReleaseDifferential::where('release_id', $release->id)->where('status', 1)->get();

            $release_units = ReleaseUnity::where('release_id', $release->id)->where('status', 1)->get();

            return view("site.properties.release", compact(['release', 'images', 'release_differentials', 'release_units']));
        } else {
            return redirect()->route('site.properties');
        }
    }
}
