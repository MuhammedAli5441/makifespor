<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Espor - Anasayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        @media (max-width: 768px) {
            .card .card-body {
                padding: 1rem;
            }
        }

        .nav-link.active {
            color: #fff !important;
            background-color: #0d6efd !important;
            border-radius: 5px;
        }

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <!-- ÜST NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- ☰ hamburger butonu -->
            <button class="btn btn-dark me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('anasayfa') }}">Espor</a>
        </div>
    </nav>

    <!-- HAMBURGER MENÜ (offcanvas) -->
    <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="menu">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Menü</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div class="nav flex-column flex-grow-1">
                <a class="nav-link text-white {{ request()->routeIs('anasayfa') ? 'active' : '' }}"
                    href="{{route('anasayfa')}}">
                    <i class="fa-solid fa-house me-2"></i> Anasayfa
                </a>

                <a class="nav-link text-white {{ request()->routeIs('cs2') ? 'active' : '' }}"
                    href="{{route('cs2')}}">
                    <i class="fa-solid fa-crosshairs me-2"></i> CS2
                </a>

                <a class="nav-link text-white {{ request()->routeIs('Valorant') ? 'active' : '' }}"
                    href="{{route('Valorant')}}">
                    <i class="fa-solid fa-crosshairs me-2"></i> Valorant
                </a>

                <a class="nav-link text-white {{ request()->routeIs('LoL') ? 'active' : '' }}"
                    href="{{route('LoL')}}">
                    <i class="fa-solid fa-crosshairs me-2"></i> LoL
                </a>
            </div>

            <div class="p-3 mt-auto">
                <a href="{{ route('admin.anasayfa') }}" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt"></i> Giriş Yap
                </a>
            </div>
        </div>
    </div>

    <!-- SAYFA İÇERİĞİ -->
    <main class="container-fluid px-3 px-md-4 mt-5">
        @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        <h1 class="mt-4 text-center text-md-start">Anasayfa</h1>

        <!-- Devam Eden Maçlar -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <i class="fas fa-play-circle me-1"></i> Devam Eden Maç
            </div>
            <div class="card-body">
                <p class="mb-0"><strong>A Takımı</strong> vs <strong>B Takımı</strong> - 12. Dakika (Skor: 1-0)</p>
            </div>
        </div>

        <!-- Sıradaki Maçlar -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <i class="fas fa-clock me-1"></i>
                Tüm Gelecek Maçlar
            </div>
            <div class="card-body overflow-auto">
                <div class="d-flex flex-row flex-wrap gap-3">
                    @forelse($matches as $match)
                    <div class="card flex-fill" style="min-width: 250px;">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ strtoupper($match->game) }} — {{ $match->team_home }} vs {{ $match->team_away }}
                            </h5>
                            <p class="card-text">
                                Tarih: {{ $match->match_date->format('d/m/Y') }} -
                                Saat: {{ $match->match_date->format('H:i') }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="w-100 text-center text-muted">
                        Yaklaşan maç yok.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Kayıt Ol Bölümü -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <i class="fas fa-user-plus me-1"></i> Kayıt Ol
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kayit.gonder') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Ad Soyad</label>
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Posta</label>
                        <input type="email" class="form-control" id="email" name="_replyto" required />
                    </div>
                    <div class="mb-3">
                        <label for="team" class="form-label">Takım Adı</label>
                        <input type="text" class="form-control" id="team" name="team" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Oyunlar</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="game_cs2" name="game[]" value="CS2">
                            <label class="form-check-label" for="game_cs2">CS2</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="game_lol" name="game[]" value="League of Legends">
                            <label class="form-check-label" for="game_lol">League of Legends</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="game_valorant" name="game[]" value="Valorant">
                            <label class="form-check-label" for="game_valorant">Valorant</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label">Katılacak Üyeler ve Sınıfları</label>
                        <textarea placeholder="Örn: Ad(Sınıf)" class="form-control" id="message" name="message"
                            rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">
                        <i class="fas fa-paper-plane"></i> Gönder
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Template/js/scripts.js') }}"></script>
</body>

</html>
