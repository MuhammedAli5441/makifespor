<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Makif espor - AdminAnasayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
<style>
    /* Sıralamaya göre satır renk çizgileri */
    tbody tr.border-left-green td:first-child,
    tbody tr.border-left-orange td:first-child {
        position: relative;
        padding-left: 12px; /* Yazı ile çizgi arası boşluk */
    }

    tbody tr.border-left-green td:first-child::before,
    tbody tr.border-left-orange td:first-child::before {
        content: "";
        position: absolute;
        left: 0;
        top: 4px;    /* Çizgi yukardan biraz içeride başlar */
        bottom: 4px; /* Çizgi alttan biraz içeride biter */
        width: 6px;  /* Çizgi kalınlığı */
        border-radius: 4px 0 0 4px;
    }

    tbody tr.border-left-green td:first-child::before {
        background-color: #28a745; /* Yeşil */
    }

    tbody tr.border-left-orange td:first-child::before {
        background-color: #fd7e14; /* Turuncu */
    }
</style>

</head>
<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark d-flex flex-column" id="sidenavAccordion">
                <!-- Menü Kısmı -->
                <div class="sb-sidenav-menu flex-grow-1">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{route('anasayfa')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                            Anasayfa
                        </a>
                    </div>
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

                    <!-- Sıradaki Maçlar -->
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
                            <a class="btn btn-success float-end" href="{{route('takimlar.create')}}">Takım Ekle</a>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Takım Adı</th>
                                        <th>Puan</th>
                                        <th>Maç Geçmişi</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($takimlar as $takim)
                                        @php
                                            $sira = $loop->iteration;
                                            $rowClass = '';

                                            if ($sira <= 4) {
                                                $rowClass = 'border-left-green';
                                            } elseif ($sira >= 5 && $sira <= 12) {
                                                $rowClass = 'border-left-orange';
                                            }
                                        @endphp

                                        <tr class="{{ $rowClass }}">
                                            <td>{{ $sira }}</td>
                                            <td>{{ $takim->takimadi }}</td>
                                            <td>{{ $takim->puan }}</td>
                                            <td>{{ $takim->gecmis }}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{ route('takimlar.edit', $takim->id) }}">Düzenle</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

