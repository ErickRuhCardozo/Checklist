<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ministério Melhor Viver</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <style>
        :root {
            --bs-body-color: white !important;
        }

        .actions {
            position: fixed;
            bottom: 0;
            right: 260px;
            padding: 1em;
            display: flex;
            flex-direction: column;
            gap: 0.5em;
        }

        .table {
            table-layout: fixed;
            white-space: nowrap;
        }

        .table-hover tbody td {
            cursor: pointer;
        }

        @media (max-width: 576px) {
            .actions {
                right: 0;
            }

            .table {
                table-layout: auto;
            }
        }

    </style>
    @stack('styles')
    @stack('scripts')
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
  </body>
</html>

