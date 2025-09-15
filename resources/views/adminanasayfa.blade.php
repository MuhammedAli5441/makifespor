<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Espor - Admin Anasayfa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        tbody tr.border-left-green td:first-child,
        tbody tr.border-left-orange td:first-child {
            position: relative;
            padding-left: 12px;
        }

        tbody tr.border-left-green td:first-child::before,
        tbody tr.border-left-orange td:first-child::before {
            content: "";
            position: absolute;
            left: 0;
            top: 4px;
            bottom: 4px;
            width: 6px;
            border-radius: 4px 0 0 4px;
        }

        tbody tr.border-left-green td:first-child::before {
            background-color: #28a745;
        }

        tbody tr.border-left-orange td:first-child::before {
            background-color: #fd7e14;
        }

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
            <!-- ☰ hamburger -->
            <button class="btn btn-dark me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('anasayfa') }}">Espor Admin</a>
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
                    <i class="fa-solid fa-bullseye me-2"></i> Valorant
                </a>
                <a class="nav-link text-white {{ request()->routeIs('LoL') ? 'active' : '' }}"
                    href="{{route('LoL')}}">
                    <i class="fa-solid fa-dragon me-2"></i> LoL
                </a>
            </div>
        </div>
    </div>

    <!-- SAYFA İÇERİĞİ -->
    <main class="container-fluid px-3 px-md-4 mt-5">
        @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <h1 class="mt-4 mb-3 text-center text-md-start">Admin Anasayfa</h1>

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
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <span><i class="fas fa-clock me-1"></i> Tüm Gelecek Maçlar</span>
                <a href="{{route('maclar.create')}}" class="btn btn-success btn-sm">Maç Oluştur</a>
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

        <!-- Takımlar Tablosu -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-table me-1"></i> Takımlar</span>
                <a class="btn btn-success btn-sm" href="{{route('takimlar.create')}}">Takım Ekle</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered table-striped text-center align-middle">
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
                        $rowClass = $sira<=4 ? 'border-left-green' : ($sira<=12 ? 'border-left-orange' : '' );
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <td>{{ $sira }}</td>
                            <td>{{ $takim->takimadi }}</td>
                            <td>{{ $takim->puan }}</td>
                            <td>{{ $takim->gecmis }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('takimlar.edit', $takim->id) }}">Düzenle</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Template/js/scripts.js') }}"></script>
</body>

</html>
