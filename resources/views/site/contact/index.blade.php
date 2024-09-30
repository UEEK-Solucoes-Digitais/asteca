@section('page_title')
    {{ $page_contact->seo_title }}
@endsection
@section('page_description')
    {!! $page_contact->seo_text !!}
@endsection

@extends('site.shared.layout')

@section('content')
    <section class="container-fluid first-section contact-section" id="page-contact">
        <div class="container">
            <div class="content">
                <div class="contact-info">
                    <h1>Fale conosco</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adiscipling.</p>

                    <div class="contacts">
                        <a class="contact"
                            href="https://wa.me/+55{{ preg_replace('/[\(|\)\-_\s+]/', '', $contact_info->whatsapp) }}"
                            title="Enviar mensagem pelo WhatsApp" target="_blank">
                            <div class="icon">
                                <iconify-icon icon="akar-icons:whatsapp-fill"></iconify-icon>WhatsApp
                            </div>
                            {{ $contact_info->whatsapp }}
                        </a>
                        <a class="contact" href="tel:{{ preg_replace('/[\(|\)\-_\s+]/', '', $contact_info->phone) }}"
                            title="Ligar para {{ $contact_info->phone }}" target="_blank">
                            <div class="icon">
                                <iconify-icon icon="carbon:phone"></iconify-icon>Telefone
                            </div>
                            {{ $contact_info->phone }}
                        </a>
                        <a class="contact" href="mailto: {{ $contact_info->email }}"
                            title="Enviar email para {{ $contact_info->email }}" target="_blank">
                            <div class="icon">
                                <iconify-icon icon="ic:outline-email"></iconify-icon>E-mail
                            </div>
                            {{ $contact_info->email }}
                        </a>
                    </div>
                </div>
                <form class="contact send-form" id="send-contact">
                    @csrf

                    <div>
                        <label>Nome completo</label>
                        <input class="name required" type="text" name="name" placeholder="Digite o seu nome">
                    </div>
                    <div>
                        <label>E-mail</label>
                        <input class="email required" type="email" name="email" placeholder="Digite o seu e-mail">
                    </div>
                    <div>
                        <label>Telefone</label>
                        <input class="phone required" type="text" name="phone" placeholder="Digite o seu telefone"
                            onkeydown="Mascara(this, Telefone)" maxlength="15">
                    </div>
                    <div>
                        <label>Mensagem</label>
                        <textarea class="message required ckeditor-text" type="text" name="message" placeholder="Digite a sua mensagem"></textarea>
                    </div>

                    <button class="btn-geral btn-submit" type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </section>
    <section class="map-section">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14116.5641229785!2d-50.285396!3d-27.8054295!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x544cf6614249d9fd!2sAsteca%20Constru%C3%A7%C3%A3o%20Civil%20Ltda.!5e0!3m2!1spt-BR!2sbr!4v1665773336753!5m2!1spt-BR!2sbr"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <script>
        var url = "{{ route('contact.send') }}"
    </script>
@endsection
