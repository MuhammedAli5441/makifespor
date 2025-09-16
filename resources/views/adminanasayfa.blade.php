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
        thead {
            background-color: #e9ecef;
        }
        .nav-link.active {
            background-color: #0d6efd !important;
            color: #fff !important;
            border-radius: 5px;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }
        /* ilk 4 mavi şerit, 5-12 turuncu şerit */
        tbody tr.top4 td:first-child,
        tbody tr.mid12 td:first-child {
            position: relative;
            padding-left: 12px;
        }
        tbody tr.top4 td:first-child::before {
            content: "";
            position: absolute;
            left: 0;
            top: 4px;
            bottom: 4px;
            width: 6px;
            border-radius: 4px 0 0 4px;
            background-color: #0d6efd;
        }
        tbody tr.mid12 td:first-child::before {
            content: "";
            position: absolute;
            left: 0;
            top: 4px;
            bottom: 4px;
            width: 6px;
            border-radius: 4px 0 0 4px;
            background-color: #fd7e14;
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
            <a class="navbar-brand fw-bold" href="{{ route('anasayfa') }}">Espor Admin</a>
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

        <!-- Tüm Gelecek Maçlar -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <span><i class="fas fa-clock me-1"></i> Tüm Gelecek Maçlar</span>
                <a href="{{route('maclar.create')}}" class="btn btn-light btn-sm">+ Maç Ekle</a>
            </div>
            <div class="card-body overflow-auto">
                <div class="d-flex flex-row flex-wrap gap-3">
                    @forelse($matches as $match)
                    <div class="card flex-fill shadow-sm" style="min-width: 250px;">
                        <div class="card-body text-center">
                            <h6 class="card-title mb-2">
                                {{ strtoupper($match->game) }}
                            </h6>
                            <p class="mb-1 fw-semibold">{{ $match->team_home }} vs {{ $match->team_away }}</p>
                            <small class="text-muted">
                                {{ $match->match_date->format('d/m/Y H:i') }}
                            </small>
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

        <!-- CS2 Takımları -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-crosshairs me-1"></i> CS2 Takımları</span>
                <a href="{{route('takimlar.create')}}" class="btn btn-light btn-sm">+ Takım Ekle</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Takım Adı</th>
                            <th>Puan</th>
                            <th>Geçmiş</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cs2Teams as $index => $stat)
                        @php
                            $rowClass = $index < 4 ? 'top4' : ($index < 12 ? 'mid12' : '');
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $stat->team->takimadi }}</td>
                            <td>{{ $stat->puan }}</td>
                            <td>{{ $stat->galibiyet }}✅ {{ $stat->maglubiyet }}❌</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('takimlar.edit', $stat->team->id) }}">Düzenle</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- LoL Takımları -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-dragon me-1"></i> League of Legends Takımları</span>
                <a href="{{route('takimlar.create')}}" class="btn btn-light btn-sm">+ Takım Ekle</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Takım Adı</th>
                            <th>Puan</th>
                            <th>Geçmiş</th>
                            <th>İşlemler</th>
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
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('takimlar.edit', $stat->team->id) }}">Düzenle</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Valorant Takımları -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                <span><i class="fa-solid fa-bullseye me-1"></i> Valorant Takımları</span>
                <a href="{{route('takimlar.create')}}" class="btn btn-light btn-sm">+ Takım Ekle</a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped text-center align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Takım Adı</th>
                            <th>Puan</th>
                            <th>Geçmiş</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valorantTeams as $index => $stat)
                        @php
                            $rowClass = $index < 4 ? 'top4' : ($index < 12 ? 'mid12' : '');
                        @endphp
                        <tr class="{{ $rowClass }}">
                            <td>{{ $index+1 }}</td>
                            <td>{{ $stat->team->takimadi }}</td>
                            <td>{{ $stat->puan }}</td>
                            <td>{{ $stat->galibiyet }}✅ {{ $stat->maglubiyet }}❌</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('takimlar.edit', $stat->team->id) }}">Düzenle</a>
                            </td>
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
