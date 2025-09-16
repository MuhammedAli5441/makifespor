<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Espor - Takım Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="{{ asset('Template/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark d-flex flex-column" id="sidenavAccordion">
                <div class="sb-sidenav-menu flex-grow-1">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="{{route('anasayfa')}}">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                            Anasayfa
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
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                @if(session('success'))
                <div class="alert alert-success m-3">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger m-3">
                    {{ session('error') }}
                </div>
                @endif

                <div class="container-fluid px-4">
                    <h1 class="mt-4">Anasayfa</h1>
               <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title mb-0">Takım Düzenle</h5>
            <a href="{{ route('admin.anasayfa') }}" class="btn btn-danger">Geri Dön</a>
        </div>

        {{-- Hata mesajları --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('takimlar.update', $takim->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Takım Adı --}}
            <div class="mb-3">
                <label for="takimadi" class="form-label">Takım Adı</label>
                <input type="text" id="takimadi"
                       class="form-control @error('takimadi') is-invalid @enderror"
                       name="takimadi" value="{{ old('takimadi', $takim->takimadi) }}">
                @error('takimadi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Katılınacak Oyunlar --}}
            <div class="mb-3">
                <label class="form-label d-block">Katılınacak Oyunlar</label>
                @php $secili = $takim->oyunlar ?? []; @endphp
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="oyunlar[]" value="cs2" id="game_cs2"
                        {{ in_array('cs2', $secili) ? 'checked' : '' }}>
                    <label class="form-check-label" for="game_cs2">CS2</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="oyunlar[]" value="lol" id="game_lol"
                        {{ in_array('lol', $secili) ? 'checked' : '' }}>
                    <label class="form-check-label" for="game_lol">League of Legends</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="oyunlar[]" value="valorant" id="game_valorant"
                        {{ in_array('valorant', $secili) ? 'checked' : '' }}>
                    <label class="form-check-label" for="game_valorant">Valorant</label>
                </div>
            </div>

            {{-- Oyun İstatistikleri --}}
            <div class="mb-3">
                <label class="form-label d-block">Oyun İstatistikleri</label>
                @foreach ($takim->gameStats as $stat)
                    <div class="border rounded p-2 mb-2">
                        <strong>{{ strtoupper($stat->game) }}</strong>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="form-label">Galibiyet</label>
                                <input type="number" min="0" class="form-control"
                                    name="stats[{{ $stat->id }}][galibiyet]"
                                    value="{{ old('stats.'.$stat->id.'.galibiyet', $stat->galibiyet) }}">
                            </div>
                            <div class="col">
                                <label class="form-label">Mağlubiyet</label>
                                <input type="number" min="0" class="form-control"
                                    name="stats[{{ $stat->id }}][maglubiyet]"
                                    value="{{ old('stats.'.$stat->id.'.maglubiyet', $stat->maglubiyet) }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary mt-3">Takımı Güncelle</button>
        </form>
    </div>
</div>

                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('Template/js/scripts.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
</body>

</html>
