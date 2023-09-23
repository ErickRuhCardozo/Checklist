<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ministério Melhor Viver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="manifest" href="/checklist/manifest.json" />
    @stack('styles')
  </head>
  <body>
    <header class="position-sticky top-0 bg-primary d-flex align-items-center justify-content-between w-100 px-2 py-1 mb-2" style="z-index: 100;">
        @if (!empty($back))
            <a href="{{ $back }}">
                <i class="bi bi-arrow-left fs-3 text-white align-middle" style="line-height: 1rem;"></i>
            </a>
        @else
            {{ $leftHeaderSection }}
        @endif

        <h4 class="m-0 mx-auto">{{ $title }}</h4>

        {{ $rightHeaderSection }}
    </header>

    <div class="container-fluid">
        <div class="row gx-0 gx-md-2">
            <div class="col">
                {{ $slot }}
            </div>
            <div class="col-auto">
                {{ $rightBodySection }}
            </div>
        </div>
    </div>

    <div id="loadingScreen" class="d-none position-absolute top-0 start-0 w-100 h-100 bg-dark d-flex align-items-center justify-content-center" style="z-index: 999; opacity: 0;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
    </div>

    @stack('scripts')
    <script>
        const loadingScreen = document.getElementById('loadingScreen');
        document.querySelectorAll('a, input[type=submit]').forEach(e => {
            e.addEventListener('click', () => {
                loadingScreen.classList.remove('d-none');
                loadingScreen.animate({ opacity: [0, 0.9] }, { duration: 500, fill: 'forwards' });
            });
        });
    </script>
  </body>
</html>

