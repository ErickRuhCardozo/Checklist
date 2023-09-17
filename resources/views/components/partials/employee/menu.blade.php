@props(['selected' => ''])
@push('styles')
    <style>
        .col-auto { width: 260px; }
        .list-unstyled li { margin-bottom: 1em; }

        .menu-list {
            position: fixed;
            top: 37px;
            right: 0;
            height: calc(100vh - 37px);
            width: 260px;
            background: var(--bs-gray-800);
            padding: 1rem;
        }

        .menu-list a {
            text-decoration: none;;
            padding: 0.2em 0.2em 0.2em 1.5em;
            margin-bottom: 0.1em;
            color: var(--bs-body-color);
            border-radius: 0.5em;
            display: block;
        }

        .menu-list a:hover { background: var(--bs-blue); }

        @media (max-width: 575.98px) {
            .col-auto { width: 0; }
            .menu-list {
                position: relative;
                top: 0;
                height: auto;
                background: none;
                width: 100%;
                padding: 0;
            }
        }
    </style>

@endpush

<x-slot name="rightHeaderSection">
    <button class="btn d-md-none p-0 fs-5" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
        <i class="bi bi-list"></i>
    </button>
</x-slot>

<div class="offcanvas-md offcanvas-end" tabindex="-1" id="menu">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Olá {{ auth()->user()->name }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#menu" aria-label="Close"></button>
     </div>
     <div class="offcanvas-body">
        <ul class="list-unstyled menu-list">
            <li>
                <strong>
                    <i class="bi bi-clipboard-check-fill fs-5 me-2"></i>
                    <span>Checklists</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('employee.checklists.create') }}" @if ($selected == 'checklists.create') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-clipboard-plus-fill fs-5 me-1"></i>
                        <span>Novo Checklist</span>
                    </a>
                    <a href="{{ route('employee.checklists.continue') }}">
                        <i class="bi bi-repeat fs-5 me-1"></i>
                        <span>Continuar Checklist</span>
                    </a>
                    <a href="{{ route('employee.checklists.index') }}" @if ($selected == 'checklists.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-clipboard2-pulse-fill fs-5 me-1"></i>
                        <span>Seus Checklists</span>
                    </a>
                </ul>
            </li>
        </ul>
     </div>
</div>

