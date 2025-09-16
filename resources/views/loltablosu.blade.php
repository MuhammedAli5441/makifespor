<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Espor - LoL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        /* Sıralamaya göre renk çizgileri */
        tbody tr.top4 td:first-child::before,
        tbody tr.mid12 td:first-child::before {
            content: "";
            position: absolute;
            left: 0;
            top: 4px;
            bottom: 4px;
            width: 6px;
            border-radius: 4px 0 0 4px;
        }
        tbody tr.top4 td:first-child::before { background-color: #0d6efd; }
        tbody tr.mid12 td:first-child::before { background-color: #fd7e14; }
        tbody tr td:first-child { position: relative; padding-left: 12px; }

        .nav-link.active {
            color: #fff !important;
            background-color: #0d6efd !important;
            border-radius: 5px;
        }
        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }
    </style>
</head>

<body class="sb-nav-fixed">

    <!-- ÜST NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="btn btn-dark me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{ route('anasayfa') }}">Espor</a>
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

    <!-- SAYFA İÇERİĞİ -->
    <main class="container-fluid px-3 px-md-4 mt-5">

        <h1 class="mt-4 mb-3 text-center text-md-start">LoL Takımları</h1>

        <!-- Sıradaki Maçlar -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-info text-white">
                <i class="fas fa-clock me-1"></i> Sıradaki League of Legends Maçları
            </div>
            <div class="card-body overflow-auto">
                <div class="d-flex flex-row flex-wrap gap-3">
                    @forelse($matches as $match)
                        <div class="card flex-fill" style="min-width: 250px;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $match->team_home }} vs {{ $match->team_away }}
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

        <!-- LoL Takımları Tablosu -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-dragon me-1"></i> LoL Takımları</span>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped text-center align-middle">
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>Takım Adı</th>
                            <th>Puan</th>
                            <th>Geçmiş</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lolTeams as $index => $stat)
                            @php
                                $rowClass = $index < 4 ? 'top4' : ($index < 12 ? 'mid12' : '');
                            @endphp
                            <tr class="{{ $rowClass }}">
                                <td>{{ $index+1 }}</td>
                                <td>{{ $stat->team->takimadi }}</td>
                                <td>{{ $stat->puan }}</td>
                                <td>{{ $stat->galibiyet }}✅ {{ $stat->maglubiyet }}❌</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
