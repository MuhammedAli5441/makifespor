<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Espor - Takım Oluştur</title>
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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="container-fluid px-4">
                    <h1 class="mt-4">Maçlar</h1>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title mb-0">Maç Oluştur</h5>
                                <a href="{{ route('admin.anasayfa') }}" class="btn btn-danger">Geri Dön</a>
                            </div>

                            <form action="{{route('maclar.store')}}" method="POST">
                                @csrf
                                <label>Oyun</label>
                                <select name="game" id="" class="form-control">
                                    <option value="valorant">Valorant</option>
                                    <option value="lol">LoL</option>
                                    <option value="cs2">CS2</option>
                                </select>
                                <label>Takım 1</label>
                                <input type="text" name="team_home" class="form-control">
                                <label>Takım 2</label>
                                <input type="text" name="team_away" class="form-control">
                                <label>Maç tarihi</label>
                                <input name="match_date" type="datetime-local" class="form-control">
                                <button class="btn btn-success mt-3">Maç Oluştur</button>
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
