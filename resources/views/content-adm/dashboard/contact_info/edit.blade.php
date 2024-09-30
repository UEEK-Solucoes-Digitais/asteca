
        @extends("content-adm.dashboard.shared.layout")
        @section("content")
            <div class="loading-form"></div>

            <h1>Editar Informações de contato</h1>

            <form class="default-form geral-form">
                @csrf
                <input type="hidden" name="id" value="{{$contact_info->id}}">
                <div class="fields default-space-between form-space">

                    <div class="blue-background default-space-between">

                        <div class="geral-grid-div column-3">

                            <div class="default-input-group">
                                <label>Telefone</label>
                                <input class="geral-input required" type="text" placeholder="Digite aqui" name="phone" maxlength="15" onkeydown="Mascara(this, Telefone)" value="{{$contact_info->phone}}">
                            </div>
    
                            <div class="default-input-group">
                                <label>Whatsapp</label>
                                <input class="geral-input required" type="text" placeholder="Digite aqui" name="whatsapp" maxlength="15" onkeydown="Mascara(this, Telefone)" value="{{$contact_info->whatsapp}}">
                            </div>
                        
                            <div class="default-input-group">
                                <label>Facebook</label>
                                <input class="geral-input required" type="text" placeholder="Digite aqui" name="facebook" value="{{$contact_info->facebook}}">
                            </div>
                        
                            <div class="default-input-group">
                                <label>Instagram</label>
                                <input class="geral-input required" type="text" placeholder="Digite aqui" name="instagram" value="{{$contact_info->instagram}}">
                            </div>
                        
                            <div class="default-input-group">
                                <label>E-mail</label>
                                <input class="geral-input required" type="text" placeholder="Digite aqui" name="email" value="{{$contact_info->email}}">
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
                var url = "{{ route('contact_info.update') }}";
                var url_to_redirect = "{{ route('contact_info.edit') }}";
            </script>
        @endsection
        