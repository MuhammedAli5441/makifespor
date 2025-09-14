<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Makif espor - Takım Oluştur</title>
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
                @if(session('error'))
                <div class="alert alert-danger m-3">
                    {{ session('error') }}
                </div>
                @endif

                <div class="container-fluid px-4">
                    <h1 class="mt-4">Anasayfa</h1>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('takimlar.store')}}" method="POST">
                                @csrf
                                <h5 class="card-title">Takım Oluştur</h5>
                                <a href="{{route('admin.anasayfa')}}" class="btn btn-success float-end">Geri Dön</a>
                                <br>
                                {{-- Takım Adı --}}
                                <label for="">Takım Adı Giriniz:</label>
                                <input type="text" class="form-control mb-1 @error('takimadi') is-invalid @enderror"
                                    name="takimadi" value="{{ old('takimadi') }}">
                                @error('takimadi')
                                <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror

                                {{-- Puan --}}
                                <label for="">Puan Giriniz:</label>
                                <input type="number" class="form-control mb-1 @error('puan') is-invalid @enderror"
                                    name="puan" value="{{ old('puan') }}">
                                @error('puan')
                                <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror

                                {{-- Geçmiş --}}
                                <label for="">Takım Geçmişi Giriniz:</label>
                                <input type="text" class="form-control mb-1 @error('gecmis') is-invalid @enderror"
                                    name="gecmis" value="{{ old('gecmis') }}">
                                @error('gecmis')
                                <div class="text-danger mb-3">{{ $message }}</div>
                                @enderror

                                {{-- Oyunlar --}}
                                <label class="d-block mb-2">Katılınacak Oyunlar:</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="oyunlar[]" value="CS2"
                                        id="game_cs2">
                                    <label class="form-check-label" for="game_cs2">CS2</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="oyunlar[]"
                                        value="League of Legends" id="game_lol">
                                    <label class="form-check-label" for="game_lol">League of Legends</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="oyunlar[]" value="Valorant"
                                        id="game_valorant">
                                    <label class="form-check-label" for="game_valorant">Valorant</label>
                                </div>
                                @error('oyunlar')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror

                                <button class="btn btn-success mt-3">Takım Ekle</button>
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

