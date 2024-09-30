
        @extends("content-adm.dashboard.shared.layout")
        @section("content")
            <div class="loading-form"></div>

            <h1>Adicionar Pagina De Construcoes</h1>

            <form class="default-form geral-form">
                @csrf
                <div class="fields default-space-between form-space">

                    <div class="blue-background default-space-between">
                        
        <div class="default-input-group">
            <label>title</label>
            <input class="geral-input required" type="text" placeholder="Digite aqui" name="title" value="">
        </div>
       
        <div class="default-input-group">
            <label>text</label>
            <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="text"
                name="text"></textarea>
        </div>
        
                    </div>

                </div>

                <div class="actions d-flex">
                    <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
                    <input type="submit" class="btn-geral ms-2" value="Enviar">
                </div>

            </form>

            <script>
                var url = "{{ route('page_construction.store') }}";
                var url_to_redirect = "{{ route('page_constructions.list') }}";
            </script>
        @endsection
        