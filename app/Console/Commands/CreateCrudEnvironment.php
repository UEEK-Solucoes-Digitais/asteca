<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CreateCrudEnvironment extends Command
{
    protected $signature = 'make:crud';

    protected $description = 'Este comando irá criar um model, controller, migration e views';

    public function handle()
    {

        $class_name = $this->ask('Insira o nome da classe (ex: Client)');
        $migration_name = $this->ask('Insira o nome da tabela (ex: clients)');
        $instance_name_views = $this->ask('Insira o nome da instância para utilizar nas views. (ex: Clientes)');

        $controller_type = $this->ask('Insira o tipo do controller (1 -> Admin / 2 -> Site/ 3 -> Api)');

        switch ($controller_type) {
            case 1:
                $controller_folder = "Admin";
                break;
            case 2:
                $controller_folder = "Site";
                break;
            case 3:
                $controller_folder = "Api";
                break;
            default:
                $this->info('Opção inválida');
                exit;
                break;
        }

        if ($controller_type != 2) {
            $columns = $this->ask('Insira as colunas da tabela separadas por vírgula. (exceto id, created_at, updated_at)');
            $instance_name = explode(",", $this->ask('Insira o nome da instância, primeiro em plural e depois em singular. (ex: clients, client)'));

            $this->createMigration($migration_name, $columns);
            $this->createModel($class_name, $migration_name);
            $this->createController($controller_folder, $class_name, $instance_name, $columns);
            $this->createViews($instance_name, $instance_name_views, $columns);
        }
    }

    public function createMigration($migration_name, $columns)
    {
        $file_name = date('Y_m_d') . '_' . date('H') . date('i') . date('s') . '_create_' . $migration_name . '_table.php';

        $file_path = base_path() . DIRECTORY_SEPARATOR . "database" . DIRECTORY_SEPARATOR . "migrations" . DIRECTORY_SEPARATOR . $file_name;

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $migration_file = fopen($file_path, "w");

        $column_types = '';

        foreach (explode(",", $columns) as $column) {
            $column = trim($column);

            switch (true) {
                case (stripos($column, 'text') !== false || stripos($column, 'description') !== false) && stripos($column, 'btn') === false:
                    $column_types .= '
                    $table->text("' . $column . '");';
                    break;
                case stripos($column, 'position') !== false:
                    $column_types .= '
                    $table->integer("position");';
                    break;
                case stripos($column, 'status') !== false:
                    $column_types .= '
                    $table->tinyInteger("status");';
                    break;
                default:
                    $column_types .= '
                    $table->string("' . $column . '", 255);';
                    break;
            }
        }

        $text = '<?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;
        
        return new class extends Migration
        {
            public function up()
            {
                Schema::create("' . $migration_name . '", function (Blueprint $table) {
                    $table->id();' . $column_types . '
                    $table->timestamps();
                });
            }
        
            public function down()
            {
                Schema::dropIfExists("' . $migration_name . '");
            }
        };
        ';

        fwrite($migration_file, $text);
    }

    public function createModel($class_name, $migration_name)
    {
        $file_path = base_path() . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Models" . DIRECTORY_SEPARATOR . "{$class_name}.php";

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Criamos o arquivo com a permissão de write
        $model_file = fopen($file_path, "w");

        $text = '<?php

        namespace App\Models;

        use App\Models\BaseModel;

        class ' . $class_name . ' extends BaseModel
        {
            protected $table = "' . $migration_name . '";
        }
        ';

        fwrite($model_file, $text);
    }

    public function createController($controller_folder, $class_name, $instance_name, $columns)
    {

        // Verificando se a pasta que o controller vai ser armazenado já existe
        // Caso não exista, a pasta é criada utilizando a função mkdir()
        $path = base_path() . DIRECTORY_SEPARATOR . "app" . DIRECTORY_SEPARATOR . "Http" . DIRECTORY_SEPARATOR . "Controllers" . DIRECTORY_SEPARATOR . $controller_folder;

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $file_path = $path . DIRECTORY_SEPARATOR . "{$class_name}Controller.php";

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Criamos o arquivo com a permissão de write
        $controller_file = fopen($file_path, "w");

        // Aqui iremos fazer dinamicamente funções e variáveis de acordo com o tipo de controller que foi passado
        $store_functions = "";
        $last_functions = "";
        $read_variables = "";

        $store_variables = "";
        $update_variables = "";

        foreach (explode(",", $columns) as $column) {
            $column = trim($column);

            // Caso tenha uma coluna de image, iremos prever um upload na função de store e um upload na função update, já com a função de webp
            if (stripos($column, "image") !== false && stripos($column, "webp") === false) {
                $store_variables .=
                    '
                list($data["' . $column . '"], $data["' . $column . '_webp"]) = UploadImageWithWebp($request->' . $column . ', "img/uploads/' . trim($instance_name[0]) . '/");
                ';

                $update_variables .=
                    '
                if ($request->hasFile("' . $column . '") && $request->file("' . $column . '")->isValid()) {
                    list($data["' . $column . '"], $data["' . $column . '_webp"]) = UploadImageWithWebp($request->' . $column . ', "img/uploads/' . trim($instance_name[0]) . '/");
                }
                ';
            }

            // Caso tenha uma coluna de icon, iremos prever um upload na função de store e um upload na função update, contando q o ícone seja apenas SVG
            if (stripos($column, "icon") !== false) {
                $store_variables .=
                    '
                if($request->' . $column . '->extension() == "svg"){
                    $data["' . $column . '"] = UploadFile($request->' . $column . ', "img/uploads/' . trim($instance_name[0]) . '/");
                }else{
                    return response()->json([
                        "status" => 0,
                        "msg" => "Insira apenas SVG para o ícone!",
                    ], 200);
                    exit;
                }
                ';

                $update_variables .=
                    '
                if ($request->hasFile("' . $column . '") && $request->file("' . $column . '")->isValid()) {
                    if($request->' . $column . '->extension() === "svg"){
                        $data["' . $column . '"] = UploadFile($request->' . $column . ', "img/uploads/' . trim($instance_name[0]) . '/");
                    }else{
                        return response()->json([
                            "status" => 0,
                            "msg" => "Insira apenas SVG para o ícone!",
                        ], 200);
                        exit;
                    }
                }
                ';
            }
        }

        // Caso tenha uma coluna de position, prevemos a função de organize da classe
        if (stripos($columns, "position") !== false) {
            $store_variables .=
                '
            $data["position"] = 999;
            ';

            $read_variables =
                '$' . trim($instance_name[0]) . ' = ' . $class_name . '::where("status", 1)->orderBy("position", "ASC")->get();';

            $last_functions .=
                '
            public function organize' . $class_name . '(Request $request)
            {
                $new_position = 0;

                foreach ($request->item as $id) {
                    ' . $class_name . '::findOrFail($id)->update(["position" => $new_position]);
                    $new_position++;
                }
            }
            ';
        } else {
            $read_variables =
                '$' . trim($instance_name[0]) . ' = ' . $class_name . '::where("status", 1)->get();';
        }

        // Por último, identificamos se o controller é um CRUD completo ou apenas um edit (de páginas, configurações, etc)
        if (stripos($columns, "status") !== false) {
            $store_variables .=
                '
            $data["status"] = 1;
            ';

            $store_functions .=
                '
            public function index()
            {
                ' . $read_variables . '

                return view("content-adm.dashboard.' . trim($instance_name[0]) . '.index", compact(["' . trim($instance_name[0]) . '"]));
            }

            public function create()
            {
                return view("content-adm.dashboard.' . trim($instance_name[0]) . '.add");
            }

            public function store(Request $request)
            {
                try {
                    $data = $request->all();
                    ' . $store_variables . '

                    ' . $class_name . '::create($data);

                    return response()->json([
                        "status" => 1,
                        "msg" => "Operação realizada com sucesso!",
                    ], 200);
                } catch (\Throwable $e) {
                    return response()->json([
                        "status" => 0,
                        "msg" => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                        "error" => $e->getMessage(),
                    ], 500);
                }
            }
            ';

            $last_functions .=
                '
            public function updateStatus(Request $request)
            {
                try {
                    ' . $class_name . '::findOrFail($request->id)->update(["status" => 0]);

                    return response()->json([
                        "status" => 1,
                        "msg" => "Removido com sucesso!",
                    ], 200);
                } catch (\Throwable $e) {
                    return response()->json([
                        "status" => 0,
                        "msg" => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                        "error" => $e->getMessage(),
                    ], 500);
                }
            }

            public function updateMultipleStatus(Request $request)
            {

                $validated = true;

                foreach ($request->inputs as $id) {
                    if (!' . $class_name . '::findOrFail($id)->update(["status" => 0])) {
                        $validated = false;
                    }
                }

                if ($validated) {
                    return response()->json([
                        "status" => 1,
                        "msg"    => "Removidos com sucesso!",
                    ], 200);
                } else {
                    return response()->json([
                        "status" => 0,
                        "msg"    => "Ocorreu um erro ao remover. Tente novamente mais tarde.",
                    ], 500);
                }
            }

            public function copy(Request $request)
            {
        
                try {
                    foreach ($request->inputs as $id) {
                        $instance = ' . $class_name . '::find($id);
        
                        $new_instance = $instance->replicate();
                        $new_instance->created_at = date("Y-m-d H:i:s");
                        $new_instance->updated_at = date("Y-m-d H:i:s");
                        $new_instance->save();
                    }
        
                    return response()->json([
                        "status" => 1,
                        "msg"    => "Duplicados com sucesso!",
                    ], 200);
                } catch (\Throwable $e) {
                    return response()->json([
                        "status" => 0,
                        "msg"    => "Ocorreu um erro ao duplicar. Tente novamente mais tarde.",
                        "error"    => $e->getMessage(),
                    ], 500);
                }
            }
            ';
        }

        $text =
            '<?php
        namespace App\Http\Controllers\Admin;

        use App\Models\\' . $class_name . ';

        use App\Http\Controllers\Controller;
        use Illuminate\Http\Request;

        class ' . $class_name . 'Controller extends Controller
        {

            ' . $store_functions . '

            public function edit($id)
            {
                $' . trim($instance_name[1]) . ' = ' . $class_name . '::find($id);

                if ($' . trim($instance_name[1]) . ') {
                    return view("content-adm.dashboard.' . trim($instance_name[0]) . '.edit", compact(["' . trim($instance_name[1]) . '"]));
                } else {
                    return redirect()->route("dashboard");
                }
            }

            public function update(Request $request)
            {
                try {

                    $data = $request->all();
                    ' . $update_variables . '

                    ' . $class_name . '::findOrFail($request->id)->update($data);

                    return response()->json([
                        "status" => 1,
                        "msg" => "Operação realizada com sucesso!",
                    ], 200);
                } catch (\Throwable $e) {
                    return response()->json([
                        "status" => 0,
                        "msg" => "Ocorreu um erro ao realizar a operação. Tente novamente mais tarde.",
                        "error" => $e->getMessage(),
                    ], 500);
                }
            }

            ' . $last_functions . '
        }
        ';

        fwrite($controller_file, $text);
    }

    public function createViews($instance_name, $instance_name_views, $columns)
    {
        $this->createIndexView($instance_name, $instance_name_views, explode(",", $columns));
        $this->createAddView($instance_name, $instance_name_views, $columns);
        $this->createEditView($instance_name, $instance_name_views, $columns);
    }

    public function createIndexView($instance_name, $instance_name_views, $columns)
    {
        // Verificando se a pasta que o controller vai ser armazenado já existe
        // Caso não exista, a pasta é criada utilizando a função mkdir()
        $path = base_path() . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "content-adm" . DIRECTORY_SEPARATOR . "dashboard" . DIRECTORY_SEPARATOR . $instance_name[0];

        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $file_path = $path . DIRECTORY_SEPARATOR . "index.blade.php";

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Criamos o arquivo com a permissão de write
        $index_file = fopen($file_path, "w");

        $instance_name[0] = trim($instance_name[0]);
        $instance_name[1] = trim($instance_name[1]);

        $columns[0] = trim($columns[0]);

        $text =
            '
        @extends("content-adm.dashboard.shared.layout")
        @section("content")
            @php $instance_name = "' . $instance_name_views . '" @endphp
            @csrf
            <div class="default-space-between">

                <h1>' . $instance_name_views . '</h1>

                <p><b>Todos os dados cadastrados pelo gestor são exibidos aqui.</b> Para editar as informações, clique no botão
                    amarelo. Para remover, clique no botão vermelho</p>

                <div class="d-flex">
                    <a class="btn-geral btn-green" href="{{ route("' . $instance_name[1] . '.add") }}">
                        <iconify-icon icon="akar-icons:plus"></iconify-icon>
                        Adicionar {{ $instance_name }}
                    </a>
                    <button class="btn-geral btn-blue btn-multiple-actions copy-multiple-itens ms-2">
                        <iconify-icon icon="akar-icons:copy"></iconify-icon>
                        Copiar
                    </button>
                    <button class="btn-geral btn-red btn-multiple-actions remove-multiple-itens ms-2">
                        <iconify-icon icon="ci:trash-empty"></iconify-icon>
                        Excluir
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table nowrap" id="dataTable" data-order=\'[[0, "desc"]]\' width="100%" cellspacing="0">

                        <thead>
                            <tr>
                                <th>
                                    <div class="option-table-area">
                                        <input type="checkbox" name="select-all" class="multiple-delete">
                                        <div class="checkbox-area">
                                            <iconify-icon icon="bi:check"></iconify-icon>
                                        </div>
                                    </div>
                                </th>
                                <th><b>ID</b></th>
                                <th>' . $columns[0] . '</th>
                                <th>Criado em</th>
                                <th>Ações</th>
                            </tr>
                        </thead>

                        <tbody class="tdbody-to-sortable">

                            @foreach ($' . $instance_name[0] . ' as $' . $instance_name[1] . ')
                                <tr id="item-{{ $' . $instance_name[1] . '->id }}">
                                    <td>
                                        <div class="option-table-area">
                                            <input type="checkbox" name="delete-itens[]" class="multiple-delete"
                                                value="{{ $' . $instance_name[1] . '->id }}">
                                            <div class="checkbox-area">
                                                <iconify-icon icon="bi:check"></iconify-icon>
                                            </div>
                                        </div>
                                    </td>
                                    <td><b>{{ $' . $instance_name[1] . '->id }}<b></td>
                                    <td>{{ $' . $instance_name[1] . '->' . $columns[0] . ' }}</td>
                                    <td>{{ date("d/m/Y H:i:s", strtotime($' . $instance_name[1] . '->created_at)) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route("' . $instance_name[1] . '.edit", ["id" => $' . $instance_name[1] . '->id]) }}"
                                                class="btn-yellow btn-action" title="Editar {{ $instance_name }}">
                                                {!! $pen_iconify !!}
                                            </a>
                                            <button class="btn-red btn-action remove-item" data-value="{{ $' . $instance_name[1] . '->id }}"
                                                title="Excluir {{ $instance_name }}">
                                                {!! $trash_iconify !!}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            </div>

            <script>
                var url_organize = "{{ route(\'' . $instance_name[1] . '.organize\') }}";
                var url_delete = "{{ route(\'' . $instance_name[1] . '.delete\') }}";
                var url_delete_multiple = "{{ route(\'' . $instance_name[1] . '.delete_multiple\') }}";
                var url_to_redirect = "{{ route(\'' . $instance_name[1] . '.list\') }}"
            </script>
        @endsection
        ';

        fwrite($index_file, $text);
    }

    public function createAddView($instance_name, $instance_name_views, $columns)
    {

        // Criamos o arquivo com a permissão de write
        $file_path = base_path() . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "content-adm" . DIRECTORY_SEPARATOR . "dashboard" . DIRECTORY_SEPARATOR . $instance_name[0] . DIRECTORY_SEPARATOR . "add.blade.php";

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $add_file = fopen($file_path, "w");

        $html_inputs = "";

        $instance_name[0] = trim($instance_name[0]);
        $instance_name[1] = trim($instance_name[1]);

        foreach (explode(",", $columns) as $column) {
            $column = trim($column);

            switch (true) {
                case (stripos($column, 'text') !== false || stripos($column, 'description') !== false) && stripos($column, 'btn') === false:
                    $html_inputs .= $this->getTextarea($column);
                    break;
                case stripos($column, 'position') !== false || stripos($column, 'status') !== false || stripos($column, 'webp') !== false:
                    $html_inputs .= '';
                    break;
                case stripos($column, 'image') !== false && stripos($column, "webp") === false:
                    $html_inputs .= $this->getImageInput($column);
                    break;
                case stripos($column, 'icon') !== false:
                    $html_inputs .= $this->getImageInput($column);
                    break;
                default:
                    $html_inputs .= $this->getInput($column);
                    break;
            }
        }

        $text =
            '
        @extends("content-adm.dashboard.shared.layout")
        @section("content")
            <div class="loading-form"></div>

            <h1>Adicionar ' . $instance_name_views . '</h1>

            <form class="default-form geral-form">
                @csrf
                <div class="fields default-space-between form-space">

                    <div class="blue-background default-space-between">
                        ' . $html_inputs . '
                    </div>

                </div>

                <div class="actions d-flex">
                    <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
                    <input type="submit" class="btn-geral ms-2" value="Enviar">
                </div>

            </form>

            <script>
                var url = "{{ route(\'' . $instance_name[1] . '.store\') }}";
                var url_to_redirect = "{{ route(\'' . $instance_name[1] . '.list\') }}";
            </script>
        @endsection
        ';
        fwrite($add_file, $text);
    }

    public function createEditView($instance_name, $instance_name_views, $columns)
    {

        // Criamos o arquivo com a permissão de write
        $file_path = base_path() . DIRECTORY_SEPARATOR . "resources" . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "content-adm" . DIRECTORY_SEPARATOR . "dashboard" . DIRECTORY_SEPARATOR . $instance_name[0] . DIRECTORY_SEPARATOR . "edit.blade.php";

        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $edit_file = fopen($file_path, "w");

        $html_inputs = "";

        $instance_name[0] = trim($instance_name[0]);
        $instance_name[1] = trim($instance_name[1]);

        foreach (explode(",", $columns) as $column) {
            $column = trim($column);

            switch (true) {
                case (stripos($column, 'text') !== false || stripos($column, 'description') !== false) && stripos($column, 'btn') === false:
                    $html_inputs .= $this->getTextarea($column, '{{$' . $instance_name[1] . '->' . $column . '}}');
                    break;
                case stripos($column, 'position') !== false || stripos($column, 'status') !== false || stripos($column, 'webp') !== false:
                    $html_inputs .= '';
                    break;
                case stripos($column, 'image') !== false && stripos($column, "webp") === false:
                    $html_inputs .= $this->getImageInput($column, $instance_name[1], $instance_name[0]);
                    break;
                case stripos($column, 'icon') !== false:
                    $html_inputs .= $this->getImageInput($column, $instance_name[1], $instance_name[0]);
                    break;
                default:
                    $html_inputs .= $this->getInput($column, '{{$' . $instance_name[1] . '->' . $column . '}}');
                    break;
            }
        }

        $text =
            '
        @extends("content-adm.dashboard.shared.layout")
        @section("content")
            <div class="loading-form"></div>

            <h1>Editar ' . $instance_name_views . '</h1>

            <form class="default-form geral-form">
                @csrf
                <input type="hidden" name="id" value="{{$' . $instance_name[1] . '->id}}">
                <div class="fields default-space-between form-space">

                    <div class="blue-background default-space-between">
                        ' . $html_inputs . '
                    </div>

                </div>

                <div class="actions d-flex">
                    <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
                    <input type="submit" class="btn-geral ms-2" value="Enviar">
                </div>

            </form>

            <script>
                var url = "{{ route(\'' . $instance_name[1] . '.update\') }}";
                var url_to_redirect = "{{ route(\'' . $instance_name[1] . '.list\') }}";
            </script>
        @endsection
        ';
        fwrite($edit_file, $text);
    }

    public function getInput($name, $value = "")
    {
        return
            '
        <div class="default-input-group">
            <label>' . $name . '</label>
            <input class="geral-input required" type="text" placeholder="Digite aqui" name="' . $name . '" value="' . $value . '">
        </div>
       ';
    }

    public function getTextarea($name, $value = "")
    {
        return
            '
        <div class="default-input-group">
            <label>' . $name . '</label>
            <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="' . $name . '"
                name="' . $name . '">' . $value . '</textarea>
        </div>
        ';
    }

    public function getImageInput($name, $value = "", $folder = "")
    {
        if ($value != "") {
            $file_area = '
            @php
                $class_background = $' . $value . '->' . $name . ' != "" ? "w-background" : "";
                $style_background = $' . $value . '->' . $name . ' != "" ? "style=\'background-image: url(" . url("/img/uploads/' . $folder . '/{$' . $value . '->' . $name . '}") . ")\'" : "";
            @endphp

            <div class="preview-img {{ $class_background }}" {!! $style_background !!}>
                <iconify-icon icon="akar-icons:plus"></iconify-icon>
            </div>
            ';
            $required = "";
        } else {
            $file_area = '
            <div class="preview-img">
                <iconify-icon icon="akar-icons:plus"></iconify-icon>
            </div>';
            $required = "required";
        }

        return
            '
        <div class="default-input-group">
            <label>' . $name . '</label>
            <div class="image-preview">
                <input type="file" class="input-image-hidden ' . $required . '" name="' . $name . '" id="' . $name . '">
                ' . $file_area . '
            </div>
        </div>
        ';
    }
}
