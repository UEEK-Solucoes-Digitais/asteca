
@extends("content-adm.dashboard.shared.layout")
@section("content")
    <div class="loading-form"></div>

    <h1>Editar Home</h1>

    <form class="default-form geral-form">
        @csrf
        <input type="hidden" name="id" value="{{$page_home->id}}">
        <div class="fields default-space-between form-space">

            <h3>Construções</h3>
            <div class="blue-background default-space-between">
                
                <div class="default-input-group">
                    <label>Título das construções</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="constructions_title" value="{{$page_home->constructions_title}}">
                </div>

                <div class="default-input-group">
                    <label>Texto das construções</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="constructions_text"
                        name="constructions_text">{{$page_home->constructions_text}}</textarea>
                </div>

            </div>

            <h3>Propriedades</h3>

            <div class="blue-background default-space-between">
                
                <div class="default-input-group">
                    <label>Título das propriedades</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="properties_title" value="{{$page_home->properties_title}}">
                </div>

                <div class="default-input-group">
                    <label>Texto das propriedades</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="properties_text"
                        name="properties_text">{{$page_home->properties_text}}</textarea>
                </div>

            </div>

            

            <h3>SEO</h3>

            <div class="blue-background default-space-between">
                
                <div class="default-input-group">
                    <label>Título</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="seo_title" value="{{$page_home->seo_title}}">
                </div>

                <div class="default-input-group">
                    <label>Texto</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="seo_text"
                        name="seo_text">{{$page_home->seo_text}}</textarea>
                </div>

            </div>

        </div>

        <div class="actions d-flex">
            <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
            <input type="submit" class="btn-geral ms-2" value="Enviar">
        </div>

    </form>

    <script>
        var url = "{{ route('page_home.update') }}";
        var url_to_redirect = "{{ route('page_home.edit') }}";
    </script>
@endsection
