    <h1>Nova mensagem de contato - {{ date('d/m/Y') }} às {{ date('H:i') }}</h1>
    <p>Informações do usuário:</p>
    <br>
    <p><b>Nome:</b> {{ $user['name'] }}</p>
    <p><b>E-mail:</b> {{ $user['email'] }}</p>
    <p><b>Telefone:</b> {{ $user['phone'] }}</p>
    <p><b>Mensagem:</b> {{ $user['message'] }}</p>

    <h3>
        {{ config('app.name') }}<br>
    </h3>
