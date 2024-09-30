
        @extends("content-adm.dashboard.shared.layout")
        @section("content")
            <div class="loading-form"></div>

            <h1>Editar Politica de cookies</h1>

            <form class="default-form geral-form">
                @csrf
                <input type="hidden" name="id" value="{{$cookie_policy->id}}">
                <div class="fields default-space-between form-space">

                    <div class="blue-background default-space-between">
                        
        <div class="default-input-group">
            <label>text</label>
            <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="text"
                name="text">{{$cookie_policy->text}}</textarea>
        </div>
        
                    </div>

                </div>

                <div class="actions d-flex">
                    <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
                    <input type="submit" class="btn-geral ms-2" value="Enviar">
                </div>

            </form>

            <script>
                var url = "{{ route('cookie_policy.update') }}";
                var url_to_redirect = "{{ route('cookie_policy.edit') }}";
            </script>
        @endsection
        