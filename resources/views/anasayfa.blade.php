<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Makif espor - Anasayfa</title>
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
    </style>
</head>

<body class="sb-nav-fixed">
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark d-flex flex-column" id="sidenavAccordion">
                <!-- Menü -->
                <div class="sb-sidenav-menu flex-grow-1">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{route('anasayfa')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div> Anasayfa
                        </a>
                        <a class="nav-link" href="{{route('cs2')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-crosshairs"></i></div> CS2
                        </a>
                        <a class="nav-link" href="{{route('Valorant')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-crosshairs"></i></div> Valorant
                        </a>
                        <a class="nav-link" href="{{route('LoL')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-crosshairs"></i></div> LoL
                        </a>
                    </div>
                </div>

                <!-- Giriş Butonu -->
                <div class="p-3">
                    <a href="{{ route('admin.anasayfa') }}" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt"></i> Giriş Yap
                    </a>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main class="container-fluid px-3 px-md-4">
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
                        <i class="fas fa-clock me-1"></i> Sıradaki Maçlar
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-row flex-wrap gap-3">
                            <div class="card flex-fill" style="min-width: 250px;">
                                <div class="card-body">
                                    <h5 class="card-title">A Takımı vs C Takımı</h5>
                                    <p class="card-text">Tarih: 12/09/2025 - Saat: 18:00</p>
                                </div>
                            </div>
                            <div class="card flex-fill" style="min-width: 250px;">
                                <div class="card-body">
                                    <h5 class="card-title">D Takımı vs E Takımı</h5>
                                    <p class="card-text">Tarih: 13/09/2025 - Saat: 20:00</p>
                                </div>
                            </div>
                            <div class="card flex-fill" style="min-width: 250px;">
                                <div class="card-body">
                                    <h5 class="card-title">F Takımı vs G Takımı</h5>
                                    <p class="card-text">Tarih: 14/09/2025 - Saat: 21:30</p>
                                </div>
                            </div>
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
                                <textarea placeholder="Örn: Ad(Sınıf)" class="form-control" id="message" name="message" rows="3" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-paper-plane"></i> Gönder
                            </button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Template/js/scripts.js') }}"></script>
</body>

</html>
