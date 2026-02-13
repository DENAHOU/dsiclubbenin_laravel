@extends('layouts.guest')

@section('content')
<style>
:root{
  --dsi-blue:#0b3f7a; --dsi-green:#29963a; --bg:#f4f7fc; --muted:#5c6b81;
}
.contact-hero{padding:5.5rem 1.5rem;background:linear-gradient(120deg,var(--dsi-blue),var(--dsi-green));color:#fff;text-align:center; height:500px;}
.contact-hero h1{font-size:2.6rem;margin:4rem; font-weight:800; margin-bottom: 4rem; color: white;}
.contact-hero p{max-width:720px;margin:0 auto;opacity:.95}

.contact-section{padding:3.5rem 1.5rem;background:var(--bg)}
.contact-grid{display:grid;grid-template-columns:1fr 1.2fr;gap:2rem;align-items:start}
@media(max-width:992px){.contact-grid{grid-template-columns:1fr}}

.contact-info{background:#fff;padding:2rem;border-radius:14px;box-shadow:0 12px 30px rgba(11,63,122,.06)}
.contact-info h3{color:var(--dsi-blue);font-weight:800;margin-bottom:1.25rem}
.info-item{display:flex;gap:.9rem;margin-bottom:1rem;align-items:flex-start}
.info-item i{color:var(--dsi-green);font-size:1.25rem;width:30px}
.nowrap{white-space:nowrap}

.whatsapp-btn{display:inline-flex;align-items:center;gap:.6rem;padding:.75rem 1rem;border-radius:10px;background:#25D366;color:#fff;text-decoration:none;font-weight:700}
.whatsapp-btn i{font-size:1.2rem}

.contact-form-box{background:#fff;padding:2rem;border-radius:14px;box-shadow:0 12px 30px rgba(11,63,122,.04)}
.contact-form-box h3{color:var(--dsi-blue);font-weight:800;margin-bottom:1rem}
.form-group{margin-bottom:1rem}
.form-group label{display:block;font-weight:700;color:var(--dsi-blue);margin-bottom:.4rem}
.form-group input,.form-group textarea{width:100%;padding:.8rem;border-radius:10px;border:1px solid #e2e8f0;background:#fbfdff}

.btn-send{background:linear-gradient(95deg,var(--dsi-blue),var(--dsi-green));color:#fff;border:none;padding:.9rem 1rem;border-radius:10px;font-weight:800;width:100%}
.btn-send:hover{transform:translateY(-2px)}

.map-wrapper{margin-top:1.6rem;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,.08);height:420px}
.alert-success{background:#dff4e9;color:#0a7a3d;padding:.9rem;border-radius:8px;margin-bottom:1rem}
</style>

<section class="contact-hero">
  <h1>Contactez le Club DSI Bénin</h1>
  <p>Pour toute demande d'information, partenariat ou support — envoyez-nous un message. Nous répondons rapidement.</p>
</section>

<section class="contact-section">
  <div class="container contact-grid">

    <div class="contact-info">
      <h3>Nos coordonnées</h3>

      <div class="info-item">
        <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
        <div>
          <strong>Adresse</strong><br>
          Immeuble Maison des DSI,<br>St Michel C/510, 01 BP 1481, Cotonou, Bénin
          <div style="margin-top:.5rem"><a href="https://maps.app.goo.gl/f8KF4NBJSdGadydx5" target="_blank" rel="noopener">Voir sur Google Maps</a></div>
        </div>
      </div>

      <div class="info-item">
        <i class="fas fa-phone" aria-hidden="true"></i>
        <div><strong>Téléphone</strong><br><span class="nowrap">0191475555</span> &nbsp;|&nbsp; <span class="nowrap">0199200404</span></div>
      </div>

      <div class="info-item">
        <i class="fas fa-envelope" aria-hidden="true"></i>
        <div><strong>Email</strong><br><a href="mailto:contact@clubdsibenin.bj">contact@clubdsibenin.bj</a></div>
      </div>

      <a class="whatsapp-btn" href="https://wa.me/2290191475555" target="_blank" rel="noopener">
        <i class="fab fa-whatsapp"></i> Écrire sur WhatsApp
      </a>
    </div>

    <div class="contact-form-box">
      <h3>Envoyer un message</h3>

      @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Nom & Prénoms</label>
          <input id="name" name="name" type="text" required>
        </div>

        <div class="form-group">
          <label for="email">Adresse Email</label>
          <input id="email" name="email" type="email" required>
        </div>

        <div class="form-group">
          <label for="subject">Objet</label>
          <input id="subject" name="subject" type="text" required>
        </div>

        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="5" required></textarea>
        </div>

        <button class="btn-send" type="submit"><i class="fas fa-paper-plane"></i>&nbsp;Envoyer</button>
      </form>
    </div>

  </div>

  <div class="container mt-4">
    <div class="map-wrapper">
      <!-- embed fiable qui place le marqueur sur Maison des DSI -->
      <iframe
        src="https://www.google.com/maps?q=DSI%20des%20Club%20Bénin&z=16&output=embed"
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </div>
</section>
@endsection
