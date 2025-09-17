<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Espor - Admin Anasayfa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    thead { background-color: #e9ecef; }
    .nav-link.active {
      background-color: #0d6efd !important; color: #fff !important; border-radius: 5px;
    }
    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1); border-radius: 5px;
    }
    tbody tr.top4 td:first-child, tbody tr.mid12 td:first-child {
      position: relative; padding-left: 12px;
    }
    tbody tr.top4 td:first-child::before {
      content: ""; position: absolute; left: 0; top: 4px; bottom: 4px;
      width: 6px; border-radius: 4px 0 0 4px; background-color: #0d6efd;
    }
    tbody tr.mid12 td:first-child::before {
      content: ""; position: absolute; left: 0; top: 4px; bottom: 4px;
      width: 6px; border-radius: 4px 0 0 4px; background-color: #fd7e14;
    }
    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }
  </style>
</head>
<body class="sb-nav-fixed">

  <!-- ÜST NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      <button class="btn btn-dark me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
        <i class="fas fa-bars"></i>
      </button>
      <a class="navbar-brand fw-bold fs-6" href="{{ route('anasayfa') }}">Espor Admin</a>
    </div>
  </nav>

  <!-- HAMBURGER MENÜ -->
  <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="menu">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Menü</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column">
      <div class="nav flex-column flex-grow-1">
        <a class="nav-link text-white {{ request()->routeIs('anasayfa') ? 'active' : '' }}" href="{{route('anasayfa')}}">
          <i class="fa-solid fa-house me-2"></i> Anasayfa
        </a>
        <a class="nav-link text-white {{ request()->routeIs('cs2') ? 'active' : '' }}" href="{{route('cs2')}}">
          <i class="fa-solid fa-crosshairs me-2"></i> CS2
        </a>
        <a class="nav-link text-white {{ request()->routeIs('Valorant') ? 'active' : '' }}" href="{{route('Valorant')}}">
          <i class="fa-solid fa-bullseye me-2"></i> Valorant
        </a>
        <a class="nav-link text-white {{ request()->routeIs('LoL') ? 'active' : '' }}" href="{{route('LoL')}}">
          <i class="fa-solid fa-dragon me-2"></i> LoL
        </a>
      </div>
    </div>
  </div>

  <main class="container-fluid px-3 px-md-4 mt-5">
    @if(session('success'))
      <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <h3 class="mt-4 mb-4 text-center text-md-start fw-bold">Admin Anasayfa</h3>

    <!-- 📌 Tüm Gelecek Maçlar -->
    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-info text-white d-flex justify-content-between align-items-center flex-wrap">
        <span><i class="fas fa-clock me-1"></i> Tüm Gelecek Maçlar</span>
        <a href="{{route('maclar.create')}}" class="btn btn-light btn-sm mt-2 mt-md-0">+ Maç Ekle</a>
      </div>
      <div class="card-body overflow-auto">
        <div class="d-flex flex-row flex-wrap gap-3">
          @forelse($upcomingMatches as $match)
          <div class="card shadow-sm flex-fill" style="min-width: 250px; max-width: 300px;">
            <div class="card-body text-center">
              <h6 class="card-title mb-2">{{ strtoupper($match->game) }}</h6>
              <p class="mb-1 fw-semibold">{{ $match->team_home }} vs {{ $match->team_away }}</p>
              <small class="text-muted">{{ $match->match_date->format('d/m/Y H:i') }}</small>
              <br>
              <button class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal"
                data-bs-target="#editFuture{{ $match->id }}">Düzenle</button>
            </div>
          </div>

          <!-- ✏️ Gelecek Maç Modal -->
          <div class="modal fade" id="editFuture{{ $match->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <form class="modal-content" method="POST" action="{{ route('maclar.update', $match->id) }}">
                @csrf @method('PUT')
                <div class="modal-header">
                  <h5 class="modal-title">Maçı Düzenle</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">
                  <div class="mb-3">
                    <label class="form-label">Oyun</label>
                    <select name="game" class="form-select">
                      <option value="cs2" @selected($match->game == 'cs2')>CS2</option>
                      <option value="lol" @selected($match->game == 'lol')>LoL</option>
                      <option value="valorant" @selected($match->game == 'valorant')>Valorant</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Ev Sahibi Takım</label>
                    <select name="team_home" class="form-select">
                      @foreach($takimlar as $takim)
                        <option value="{{ $takim->takimadi }}" @selected($match->team_home == $takim->takimadi)>{{ $takim->takimadi }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Deplasman Takım</label>
                    <select name="team_away" class="form-select">
                      @foreach($takimlar as $takim)
                        <option value="{{ $takim->takimadi }}" @selected($match->team_away == $takim->takimadi)>{{ $takim->takimadi }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Maç Tarihi</label>
                    <input type="datetime-local" name="match_date" value="{{ $match->match_date->format('Y-m-d\TH:i') }}" class="form-control">
                  </div>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Kapat</button>
                  <button class="btn btn-success" type="submit">Kaydet</button>
                </div>
              </form>
            </div>
          </div>
          @empty
            <div class="w-100 text-center text-muted">Yaklaşan maç yok.</div>
          @endforelse
        </div>
      </div>
    </div>

    <!-- 📌 Bitmiş Maçlar - CS2 / LoL / Valorant -->
    @foreach(['cs'=>'CS2','lol'=>'LoL','valorant'=>'Valorant'] as $gameKey => $gameLabel)
    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-secondary text-white">
        <i class="fas fa-flag-checkered me-1"></i> Bitmiş {{ $gameLabel }} Maçları
      </div>
      <div class="card-body table-responsive">
        <table class="table table-striped text-center align-middle">
          <thead class="table-secondary">
            <tr><th>Tarih</th><th>Ev Sahibi</th><th>Skor</th><th>Deplasman</th><th>Kazanan</th><th>İşlem</th></tr>
          </thead>
          <tbody>
            @forelse($finishedMatches->where('game',$gameKey) as $match)
            <tr>
              <td>{{ $match->match_date->format('d/m/Y H:i') }}</td>
              <td>{{ $match->team_home }}</td>
              <td>{{ $match->home_score }} - {{ $match->away_score }}</td>
              <td>{{ $match->team_away }}</td>
              <td>{{ $match->winner }}</td>
              <td>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                  data-bs-target="#editFinished{{ $match->id }}">Düzenle</button>
              </td>
            </tr>
            <!-- ✏️ Bitmiş Maç Modal -->
            <div class="modal fade" id="editFinished{{ $match->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog">
                <form class="modal-content" method="POST" action="{{ route('maclar.update', $match->id) }}">
                  @csrf @method('PUT')
                  <div class="modal-header">
                    <h5 class="modal-title">Skor Güncelle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body text-start">
                    <div class="mb-3">
                      <label class="form-label">{{ $match->team_home }} Skor</label>
                      <input type="number" name="home_score" class="form-control" value="{{ $match->home_score }}" min="0">
                    </div>
                    <div class="mb-3">
                      <label class="form-label">{{ $match->team_away }} Skor</label>
                      <input type="number" name="away_score" class="form-control" value="{{ $match->away_score }}" min="0">
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Kapat</button>
                    <button class="btn btn-success" type="submit">Kaydet</button>
                  </div>
                </form>
              </div>
            </div>
            @empty
            <tr><td colspan="6" class="text-muted">Henüz bitmiş {{ $gameLabel }} maçı yok.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    @endforeach

    <!-- 📌 Takım Tabloları -->
    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <span><i class="fa-solid fa-crosshairs me-1"></i> CS2 Takımları</span>
        <a href="{{route('takimlar.create')}}" class="btn btn-light btn-sm">+ Takım Ekle</a>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-striped text-center align-middle">
          <thead><tr><th>#</th><th>Takım Adı</th><th>Puan</th><th>Geçmiş</th><th>İşlemler</th></tr></thead>
          <tbody>
            @foreach ($cs2Teams as $index => $stat)
              @php $rowClass = $index < 4 ? 'top4' : ($index < 12 ? 'mid12' : ''); @endphp
              <tr class="{{ $rowClass }}">
                <td>{{ $index+1 }}</td>
                <td>{{ $stat->team->takimadi }}</td>
                <td>{{ $stat->puan }}</td>
                <td>{{ $stat->galibiyet }}✅ {{ $stat->maglubiyet }}❌</td>
                <td><a class="btn btn-primary btn-sm" href="{{ route('takimlar.edit', $stat->team->id) }}">Düzenle</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span><i class="fa-solid fa-dragon me-1"></i> League of Legends Takımları</span>
        <a href="{{route('takimlar.create')}}" class="btn btn-light btn-sm">+ Takım Ekle</a>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-striped text-center align-middle">
          <thead><tr><th>#</th><th>Takım Adı</th><th>Puan</th><th>Geçmiş</th><th>İşlemler</th></tr></thead>
          <tbody>
            @foreach ($lolTeams as $index => $stat)
              @php $rowClass = $index < 4 ? 'top4' : ($index < 12 ? 'mid12' : ''); @endphp
              <tr class="{{ $rowClass }}">
                <td>{{ $index+1 }}</td>
                <td>{{ $stat->team->takimadi }}</td>
                <td>{{ $stat->puan }}</td>
                <td>{{ $stat->galibiyet }}✅ {{ $stat->maglubiyet }}❌</td>
                <td><a class="btn btn-primary btn-sm" href="{{ route('takimlar.edit', $stat->team->id) }}">Düzenle</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
        <span><i class="fa-solid fa-bullseye me-1"></i> Valorant Takımları</span>
        <a href="{{route('takimlar.create')}}" class="btn btn-light btn-sm">+ Takım Ekle</a>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-striped text-center align-middle">
          <thead><tr><th>#</th><th>Takım Adı</th><th>Puan</th><th>Geçmiş</th><th>İşlemler</th></tr></thead>
          <tbody>
            @foreach ($valorantTeams as $index => $stat)
              @php $rowClass = $index < 4 ? 'top4' : ($index < 12 ? 'mid12' : ''); @endphp
              <tr class="{{ $rowClass }}">
                <td>{{ $index+1 }}</td>
                <td>{{ $stat->team->takimadi }}</td>
                <td>{{ $stat->puan }}</td>
                <td>{{ $stat->galibiyet }}✅ {{ $stat->maglubiyet }}❌</td>
                <td><a class="btn btn-primary btn-sm" href="{{ route('takimlar.edit', $stat->team->id) }}">Düzenle</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
