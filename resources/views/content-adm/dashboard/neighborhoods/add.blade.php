
        @extends("content-adm.dashboard.shared.layout")
        @section("content")
            <div class="loading-form"></div>

            <h1>Adicionar Bairros</h1>

            <form class="default-form geral-form">
                @csrf
                <div class="fields default-space-between form-space">

                    <div class="blue-background default-space-between">
                        
        <div class="default-input-group">
            <label>name</label>
            <input class="geral-input required" type="text" placeholder="Digite aqui" name="name" value="">
        </div>
       
                    </div>

                </div>

                <div class="actions d-flex">
                    <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
                    <input type="submit" class="btn-geral ms-2" value="Enviar">
                </div>

            </form>

            <script>
                var url = "{{ route('neighborhood.store') }}";
                var url_to_redirect = "{{ route('neighborhood.list') }}";
            </script>
        @endsection
        