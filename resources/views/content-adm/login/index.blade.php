@extends('content-adm.dashboard.shared.layout')

<section class="container-fluid" id="login-page">

    <div class="login-form">

        <img class="form-logo" alt="Logo" src="{{ url('/img/site/brand/logo.svg') }}">

        <form id="form-login">
            @csrf
            <div class="form-fields">
                <div class="input-group">

                    <iconify-icon icon="feather:mail"></iconify-icon>
                    <input type="email" name="email" id="email" placeholder="Digite seu e-mail"
                        class="input-control required">

                </div>

                <div class="input-group">
                    <iconify-icon icon="feather:lock"></iconify-icon>
                    <input type="password" name="password" id="password" placeholder="Digite sua senha"
                        class="input-control required">

                </div>
            </div>

            <p class="error-text geral-text">
                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L16.5 16.5" stroke="currentcolor" stroke-width="2" />
                    <path d="M16.5 1L1 16.5" stroke="currentcolor" stroke-width="2" />
                </svg>
                E-mail ou senha incorreta. Tente novamente
            </p>

            <input type="submit" class="btn-geral" title="Fazer login" value="Entrar">

        </form>
    </div>

    <script>
        let url_login = "{{ route('admin.login') }}";
        let url_to_redirect = "{{ route('dashboard') }}";
    </script>

</section>
