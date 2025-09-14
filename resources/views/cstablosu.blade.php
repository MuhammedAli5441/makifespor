<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Makif espor - CS2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        /* Sıralamaya göre satır renk çizgileri */
        tbody tr.border-left-green td:first-child,
        tbody tr.border-left-orange td:first-child {
            position: relative;
            padding-left: 12px;
        }
        tbody tr.border-left-green td:first-child::before,
        tbody tr.border-left-orange td:first-child::before {
            content: "";
            position: absolute;
            left: 0; top: 4px; bottom: 4px;
            width: 6px; border-radius: 4px 0 0 4px;
        }
        tbody tr.border-left-green td:first-child::before { background-color: #28a745; }
        tbody tr.border-left-orange td:first-child::before { background-color: #fd7e14; }
    </style>
</head>
<body class="sb-nav-fixed">

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark d-flex flex-column" id="sidenavAccordion">
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
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-bullseye"></i></div> Valorant
                    </a>
                    <a class="nav-link" href="{{route('LoL')}}">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-dragon"></i></div> LoL
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <div id="layoutSidenav_content">
        <main class="container-fluid px-3 px-md-4">
            @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            <h1 class="mt-4 mb-3 text-center text-md-start">CS2</h1>

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
                <div class="card-body overflow-auto">
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

            <!-- CS2 Takımları Tablosu -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fa-solid fa-crosshairs me-1"></i> CS2 Takımları
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Takım Adı</th>
                                <th>Puan</th>
                                <th>Maç Geçmişi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $siraliCs2 = $takimlar->filter(fn($t)=>in_array('CS2',$t->oyunlar??[]))
                                                     ->sortByDesc('puan')
                                                     ->values();
                            @endphp
                            @forelse ($siraliCs2 as $index => $takim)
                                <tr class="{{ $index<4?'border-left-green':($index<12?'border-left-orange':'') }}">
                                    <td>{{ $index+1 }}</td>
                                    <td>{{ $takim->takimadi }}</td>
                                    <td>{{ $takim->puan }}</td>
                                    <td>{{ $takim->gecmis }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">CS2 takım kaydı yok</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('Template/js/scripts.js') }}"></script>
</body>
</html>
