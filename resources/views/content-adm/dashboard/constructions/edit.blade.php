
        @extends("content-adm.dashboard.shared.layout")
        @section("content")
            <div class="loading-form"></div>

            <h1>Editar Obras</h1>

            <form class="default-form geral-form">
                @csrf
                <input type="hidden" name="id" value="{{$construction->id}}">
                <div class="fields default-space-between form-space">

                    <div class="blue-background default-space-between">
                        
        <div class="default-input-group">
            <label>Título</label>
            <input class="geral-input required" type="text" placeholder="Digite aqui" name="title" value="{{$construction->title}}">
        </div>
       
        <div class="default-input-group">
            <label>Texto</label>
            <textarea class="geral-input ckeditor-text" type="text" placeholder="Digite aqui" id="text"
                name="text">{{$construction->text}}</textarea>
        </div>
        
        <div class="default-input-group">
            <label>Imagem</label>
            <div class="image-preview">
                <input type="file" class="input-image-hidden " name="image" id="image">
                
            @php
                $class_background = $construction->image != "" ? "w-background" : "";
                $style_background = $construction->image != "" ? "style='background-image: url(" . url("/img/uploads/constructions/{$construction->image}") . ")'" : "";
            @endphp

            <div class="preview-img {{ $class_background }}" {!! $style_background !!}>
                <iconify-icon icon="akar-icons:plus"></iconify-icon>
            </div>
            
            </div>
        </div>
        
                    </div>

                </div>

                <div class="actions d-flex">
                    <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
                    <input type="submit" class="btn-geral ms-2" value="Enviar">
                </div>

            </form>

            <script>
                var url = "{{ route('construction.update') }}";
                var url_to_redirect = "{{ route('constructions.list') }}";
            </script>
        @endsection
        