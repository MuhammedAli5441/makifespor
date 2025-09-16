<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Espor - CS2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <style>
        thead th {
            background-color: #f1f3f5;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        tbody tr.border-left-blue td:first-child::before,
        tbody tr.border-left-orange td:first-child::before {
            content: "";
            position: absolute;
            left: 0;
            top: 4px;
            bottom: 4px;
            width: 6px;
            border-radius: 4px 0 0 4px;
        }
        tbody tr.border-left-blue td:first-child::before {
            background-color: #0d6efd;
        }
        tbody tr.border-left-orange td:first-child::before {
            background-color: #fd7e14;
        }
        td.position-relative {
            position: relative;
            padding-left: 12px;
        }
        .nav-link.active {
            color: #fff !important;
            background-color: #0d6efd !important;
            border-radius: 6px;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 6px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body class="sb-nav-fixed bg-light">

    <!-- ÜST NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <button class="btn btn-dark me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
                <i class="fas fa-bars"></i>
            </button>
            <a class="navbar-brand fw-semibold" href="{{ route('anasayfa') }}">🎮 Espor</a>
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
    <main class="container px-3 px-md-4 mt-5">
        @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <h3 class="mt-4 mb-4 text-center text-md-start fw-bold">
            <i class="fa-solid fa-crosshairs me-2"></i> CS2
        </h3>

        <!-- Sıradaki CS2 Maçları -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <span><i class="fas fa-clock me-1"></i> Sıradaki Counter-Strike 2 Maçları</span>
                <a href="{{route('maclar.create')}}" class="btn btn-light btn-sm">
                    <i class="fa-solid fa-plus"></i> Maç Ekle
                </a>
            </div>
            <div class="card-body overflow-auto">
                <div class="d-flex flex-row flex-wrap gap-3">
                    @forelse($matches->where('game','cs2') as $match)
                    <div class="card flex-fill" style="min-width: 250px;">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $match->team_home }} vs {{ $match->team_away }}
                            </h5>
                            <p class="card-text text-muted">
                                {{ $match->match_date->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="w-100 text-center text-muted">
                        Yaklaşan CS2 maçı yok.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- CS2 Takımları Tablosu -->
       <div class="card mb-4 shadow-sm">
    <div class="card-header bg-dark text-white">
        <i class="fa-solid fa-crosshairs me-1"></i> CS2 Takımları
    </div>
    <div class="card-body table-responsive">
        <table class="table table-striped text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Takım Adı</th>
                    <th>Puan</th>
                    <th>Geçmiş</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cs2Teams = $takimlar->flatMap(function($takim){
                        return $takim->gameStats->where('game','cs2')->map(function($stat) use ($takim){
                            return (object)[
                                'takimadi'=>$takim->takimadi,
                                'puan'=>$stat->puan,
                                'galibiyet'=>$stat->galibiyet,
                                'maglubiyet'=>$stat->maglubiyet
                            ];
                        });
                    })->sortByDesc('puan')->values();
                @endphp

                @forelse ($cs2Teams as $index => $stat)
                    @php
                        $rowClass = $index < 4 ? 'border-left-blue' : ($index < 12 ? 'border-left-orange' : '');
                    @endphp
                    <tr class="{{ $rowClass }}">
                        <td class="position-relative">{{ $index+1 }}</td>
                        <td>{{ $stat->takimadi }}</td>
                        <td>{{ $stat->puan }}</td>
                        <td>{{ $stat->galibiyet }}✅ {{ $stat->maglubiyet }}❌</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted text-center">CS2 takımı yok</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Template/js/scripts.js') }}"></script>
</body>

</html>
