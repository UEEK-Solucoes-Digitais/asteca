@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <h1>Editar Tipo de imóvel</h1>

    <form class="default-form geral-form">
        @csrf
        <input type="hidden" name="id" value="{{ $property_type->id }}">
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">

                <div class="default-input-group">
                    <label>Nome</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="name"
                        value="{{ $property_type->name }}">
                </div>

            </div>

        </div>

        <div class="actions d-flex">
            <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
            <input type="submit" class="btn-geral ms-2" value="Enviar">
        </div>

    </form>

    <script>
        var url = "{{ route('property_type.update') }}";
        var url_to_redirect = "{{ route('property_type.list') }}";
    </script>
@endsection
