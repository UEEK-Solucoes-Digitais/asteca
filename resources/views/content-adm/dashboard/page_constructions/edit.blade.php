
@extends("content-adm.dashboard.shared.layout")
@section("content")
    <div class="loading-form"></div>

    <h1>Editar Página de Construções</h1>

    <form class="default-form geral-form">
        @csrf
        <input type="hidden" name="id" value="{{$page_construction->id}}">
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">
                
                <div class="default-input-group">
                    <label>Título</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="title" value="{{$page_construction->title}}">
                </div>

                <div class="default-input-group">
                    <label>Texto</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="text"
                        name="text">{{$page_construction->text}}</textarea>
                </div>

            </div>

            <h3>SEO</h3>

            <div class="blue-background default-space-between">
                
                <div class="default-input-group">
                    <label>Título</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="seo_title" value="{{$page_construction->seo_title}}">
                </div>

                <div class="default-input-group">
                    <label>Texto</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="seo_text"
                        name="seo_text">{{$page_construction->seo_text}}</textarea>
                </div>

            </div>

        </div>

        <div class="actions d-flex">
            <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
            <input type="submit" class="btn-geral ms-2" value="Enviar">
        </div>

    </form>

    <script>
        var url = "{{ route('page_construction.update') }}";
        var url_to_redirect = "{{ route('page_construction.edit') }}";
    </script>
@endsection