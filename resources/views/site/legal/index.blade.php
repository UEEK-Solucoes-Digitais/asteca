@extends('site.shared.layout')

@section('content')
    <section class="container-fluid geral-section first-section fadeIn" id="legal">
        <article class="container">
            <h1>Política de Cookies</h1>
            <div>{!! $cookie_policy->text !!}</div>
        </article>
    </section>
@endsection
