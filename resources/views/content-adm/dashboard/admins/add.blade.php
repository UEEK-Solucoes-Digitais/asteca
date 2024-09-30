@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <h1>Adicionar gestor</h1>

    <form id="add-admin" class="default-form geral-form">
        @csrf
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">
                <div class="geral-grid-div column-3">
                    <!-- Nome -->
                    <div class="default-input-group">
                        <label>Nome*</label>
                        <input class="geral-input required" type="text" placeholder="Nome" name="name" maxlength="100">
                    </div>

                    <div class="default-input-group">
                        <label>E-mail*</label>
                        <input class="geral-input required" type="text" placeholder="E-mail" name="email" maxlength="100">
                    </div>
                </div>

                <div class="geral-grid-div column-3">
                    <div class="default-input-group">
                        <label>Senha</label>
                        <input class="geral-input required" type="password" readonly
                            onfocus="this.removeAttribute('readonly');" name="password" placeholder="Senha">
                    </div>

                    <div class="default-input-group">
                        <label>Confirme a Senha</label>
                        <input class="geral-input required" type="password" readonly
                            onfocus="this.removeAttribute('readonly');" name="confirm_password"
                            placeholder="Digite sua nova senha novamente">
                    </div>
                </div>
            </div>


            <div class="actions d-flex">
                <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
                <input type="submit" class="btn-geral ms-2" value="Enviar">
            </div>
        </div>

    </form>

    <script>
        var url = "{{ route('admin.store') }}";
        var url_to_redirect = "{{ route('admin.list') }}";
    </script>
@endsection
