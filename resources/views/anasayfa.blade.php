<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Espor - Anasayfa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    .nav-link.active { color:#fff!important; background-color:#0d6efd!important; border-radius:6px; }
    .nav-link:hover { background-color:rgba(255,255,255,0.15); border-radius:6px; }
    .card { border-radius:10px; box-shadow:0 3px 8px rgba(0,0,0,0.1); }
    .card-header { font-weight:600; }
  </style>
</head>

<body class="sb-nav-fixed bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
  <div class="container-fluid">
    <button class="btn btn-dark me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
      <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand fw-semibold" href="{{ route('anasayfa') }}">🎮 Espor</a>
  </div>
</nav>

<!-- MENÜ -->
<div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="menu">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title">Menü</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body d-flex flex-column">
    <div class="nav flex-column flex-grow-1">
      <a class="nav-link text-white {{ request()->routeIs('anasayfa') ? 'active' : '' }}" href="{{route('anasayfa')}}"><i class="fa-solid fa-house me-2"></i> Anasayfa</a>
      <a class="nav-link text-white {{ request()->routeIs('cs2') ? 'active' : '' }}" href="{{route('cs2')}}"><i class="fa-solid fa-crosshairs me-2"></i> CS2</a>
      <a class="nav-link text-white {{ request()->routeIs('Valorant') ? 'active' : '' }}" href="{{route('Valorant')}}"><i class="fa-solid fa-bullseye me-2"></i> Valorant</a>
      <a class="nav-link text-white {{ request()->routeIs('LoL') ? 'active' : '' }}" href="{{route('LoL')}}"><i class="fa-solid fa-dragon me-2"></i> LoL</a>
    </div>
    <div class="p-3 mt-auto">
      <a href="{{ route('admin.anasayfa') }}" class="btn btn-primary w-100"><i class="fas fa-lock me-1"></i> Giriş Yap</a>
    </div>
  </div>
</div>

<!-- İÇERİK -->
<main class="container px-3 px-md-4 mt-5">

  {{-- ✅ Başarı & Hata Mesajları --}}
  @if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
  @endif

  <h3 class="mt-4 mb-4 text-center text-md-start fw-bold">Anasayfa</h3>

  @foreach(['cs'=>'CS2','lol'=>'LoL','valorant'=>'Valorant'] as $gameKey => $gameLabel)
    <!-- 🟢 {{ $gameLabel }} Gelecek Maçlar -->
    <div class="card mb-4">
      <div class="card-header bg-info text-white">
        <i class="fas fa-clock me-1"></i> Yaklaşan {{ $gameLabel }} Maçları
      </div>
      <div class="card-body overflow-auto">
        <div class="d-flex flex-row flex-wrap gap-3">
          @forelse($matches->where('game',$gameKey) as $match)
            <div class="card flex-fill shadow-sm" style="min-width:250px;">
              <div class="card-body text-center">
                <p class="fw-semibold mb-1">{{ $match->team_home }} vs {{ $match->team_away }}</p>
                <small class="text-muted">{{ $match->match_date->format('d/m/Y H:i') }}</small>
              </div>
            </div>
          @empty
            <div class="w-100 text-center text-muted">Yaklaşan maç yok.</div>
          @endforelse
        </div>
      </div>
    </div>

    <!-- 🔴 {{ $gameLabel }} Bitmiş Maçlar -->
    <div class="card mb-4">
      <div class="card-header bg-secondary text-white">
        <i class="fas fa-flag-checkered me-1"></i> Bitmiş {{ $gameLabel }} Maçları
      </div>
      <div class="card-body table-responsive">
        <table class="table table-striped text-center align-middle">
          <thead class="table-secondary">
            <tr>
              <th>Tarih</th>
              <th>Ev Sahibi</th>
              <th>Skor</th>
              <th>Deplasman</th>
              <th>Kazanan</th>
            </tr>
          </thead>
          <tbody>
            @forelse($finishedMatches->where('game',$gameKey) as $match)
            <tr>
              <td>{{ $match->match_date->format('d/m/Y H:i') }}</td>
              <td>{{ $match->team_home }}</td>
              <td>{{ $match->home_score }} - {{ $match->away_score }}</td>
              <td>{{ $match->team_away }}</td>
              <td><span class="badge bg-success">{{ $match->winner }}</span></td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-muted">Henüz bitmiş maç yok.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  @endforeach

  <!-- 📝 Kayıt Formu -->
  <div class="card mb-5">
    <div class="card-header bg-success text-white">
      <i class="fas fa-user-plus me-1"></i> Kayıt Ol
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('kayit.gonder') }}">
        @csrf
        <div class="mb-3">
          <label class="form-label">Takım Lideri Ad Soyad</label>
          <input type="text" class="form-control" name="name" required />
        </div>
        <div class="mb-3">
          <label class="form-label">E-Posta</label>
          <input type="email" class="form-control" name="_replyto" required />
        </div>
        <div class="mb-3">
          <label class="form-label">Takım Adı</label>
          <input type="text" class="form-control" name="team" required />
        </div>
        <div class="mb-3">
          <label class="form-label d-block">Oyunlar</label>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="game[]" value="CS2"> CS2</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="game[]" value="League of Legends"> League of Legends</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="game[]" value="Valorant"> Valorant</div>
        </div>
        <div class="mb-3">
          <label class="form-label">Katılacak Üyeler ve Sınıfları</label>
          <textarea placeholder="Örn: Ad(Sınıf)" class="form-control" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success w-100">
          <i class="fas fa-paper-plane"></i> Gönder
        </button>
      </form>
    </div>
  </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
