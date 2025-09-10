{{-- <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Makif espor - Anasayfa</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <body class="sb-nav-fixed">

            <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark d-flex flex-column" id="sidenavAccordion">
            <!-- Menü Kısmı -->
            <div class="sb-sidenav-menu flex-grow-1">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                        Anasayfa
                    </a>
                </div>
            </div>

            <!-- En Alta Sabit Giriş Butonu -->
            <div class="p-3">
                <a href="{{ route('login') }}" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt"></i> Giriş Yap
                </a>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">
        <main>
              <div class="container-fluid px-4">
        <h1 class="mt-4">Anasayfa</h1>

        <!-- Devam Eden Maçlar -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <i class="fas fa-play-circle me-1"></i>
                Devam Eden Maç
            </div>
            <div class="card-body">
                <p><strong>A Takımı</strong> vs <strong>B Takımı</strong> - 12. Dakika (Skor: 1-0)</p>
            </div>
        </div>

        <!-- Sıradaki Maçlar (Yatay Kaydırılabilir) -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <i class="fas fa-clock me-1"></i>
                Sıradaki Maçlar
            </div>
            <div class="card-body overflow-auto">
                <div class="d-flex flex-row gap-3" style="min-width: max-content;">
                    <!-- Maç Kartı -->
                    <div class="card" style="min-width: 250px;">
                        <div class="card-body">
                            <h5 class="card-title">A Takımı vs C Takımı</h5>
                            <p class="card-text">Tarih: 12/09/2025 - Saat: 18:00</p>
                        </div>
                    </div>

                    <div class="card" style="min-width: 250px;">
                        <div class="card-body">
                            <h5 class="card-title">D Takımı vs E Takımı</h5>
                            <p class="card-text">Tarih: 13/09/2025 - Saat: 20:00</p>
                        </div>
                    </div>

                    <div class="card" style="min-width: 250px;">
                        <div class="card-body">
                            <h5 class="card-title">F Takımı vs G Takımı</h5>
                            <p class="card-text">Tarih: 14/09/2025 - Saat: 21:30</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Takımlar Tablosu -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Takımlar
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sıralama</th>
                            <th>Takım Adı</th>
                            <th>Puan</th>
                            <th>Maç Geçmişi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>A takımı</td>
                            <td>15</td>
                            <td>4G 3B 0K</td>
                        </tr>
                        <!-- Diğer takımlar buraya -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Kayıt Ol Bölümü -->
<div class="container-fluid px-4 mt-5">
    <div class="card mb-4">
        <div class="card-header bg-success text-white">
            <i class="fas fa-user-plus me-1"></i> Kayıt Ol
        </div>
        <div class="card-body">
            <form method="POST" action="{{route('kayit.gonder')}}">
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
                    <label for="message" class="form-label">Katılacak Üyeler Ve Sınıfları</label>
                    <textarea placeholder="Örn: Ad(Sınıf)" class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">
                    <i class="fas fa-paper-plane"></i> Gönder
                </button>
            </form>
        </div>
    </div>
</div>


        </main>
    </div>
</div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('Template/js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    </body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Makif espor - Anasayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">



    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark d-flex flex-column" id="sidenavAccordion">
                <!-- Menü Kısmı -->
                <div class="sb-sidenav-menu flex-grow-1">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                            Anasayfa
                        </a>
                    </div>
                </div>

                <!-- En Alta Sabit Giriş Butonu -->
                <div class="p-3">
                    <a href="{{ route('login') }}" class="btn btn-primary w-100">
                        <i class="fas fa-sign-in-alt"></i> Giriş Yap
                    </a>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                   @if(session('success'))
        <div class="alert alert-success m-3">
            {{ session('success') }}
        </div>
    @endif
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Anasayfa</h1>

                    <!-- Devam Eden Maçlar -->
                    <div class="card mb-4">
                        <div class="card-header bg-warning text-dark">
                            <i class="fas fa-play-circle me-1"></i>
                            Devam Eden Maç
                        </div>
                        <div class="card-body">
                            <p><strong>A Takımı</strong> vs <strong>B Takımı</strong> - 12. Dakika (Skor: 1-0)</p>
                        </div>
                    </div>

                    <!-- Sıradaki Maçlar (Yatay Kaydırılabilir) -->
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <i class="fas fa-clock me-1"></i>
                            Sıradaki Maçlar
                        </div>
                        <div class="card-body overflow-auto">
                            <div class="d-flex flex-row gap-3" style="min-width: max-content;">
                                <!-- Maç Kartı -->
                                <div class="card" style="min-width: 250px;">
                                    <div class="card-body">
                                        <h5 class="card-title">A Takımı vs C Takımı</h5>
                                        <p class="card-text">Tarih: 12/09/2025 - Saat: 18:00</p>
                                    </div>
                                </div>

                                <div class="card" style="min-width: 250px;">
                                    <div class="card-body">
                                        <h5 class="card-title">D Takımı vs E Takımı</h5>
                                        <p class="card-text">Tarih: 13/09/2025 - Saat: 20:00</p>
                                    </div>
                                </div>

                                <div class="card" style="min-width: 250px;">
                                    <div class="card-body">
                                        <h5 class="card-title">F Takımı vs G Takımı</h5>
                                        <p class="card-text">Tarih: 14/09/2025 - Saat: 21:30</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Takımlar Tablosu -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Takımlar
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sıralama</th>
                                        <th>Takım Adı</th>
                                        <th>Puan</th>
                                        <th>Maç Geçmişi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>A takımı</td>
                                        <td>15</td>
                                        <td>4G 3B 0K</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Kayıt Ol Bölümü -->
                <div class="container-fluid px-4 mt-5">
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
                                    <label for="message" class="form-label">Katılacak Üyeler Ve Sınıfları</label>
                                    <textarea placeholder="Örn: Ad(Sınıf)" class="form-control" id="message" name="message" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-paper-plane"></i> Gönder
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('Template/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
</body>
</html>
