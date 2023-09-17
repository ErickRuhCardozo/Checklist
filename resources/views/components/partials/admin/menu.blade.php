@props(['selected' => ''])
@push('styles')
    <style>
        .list-unstyled li { margin-bottom: 1em; }
        .col-auto { width: 260px; }

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
        <h5 class="offcanvas-title">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#menu" aria-label="Close"></button>
     </div>
     <div class="offcanvas-body">
        <ul class="list-unstyled menu-list">
            <li>
                <strong>
                    <i class="bi bi-person-fill fs-5 me-2"></i>
                    <span>Usuários</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('admin.users.index') }}" @if ($selected == 'users.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-person-check-fill fs-5 me-1"></i>
                        <span>Usuários Cadastrados</span>
                    </a>
                    <a href="{{ route('admin.users.create') }}" @if ($selected == 'users.create') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-person-plus-fill fs-5 me-1"></i>
                        <span>Cadastrar Usuário</span>
                    </a>
                </ul>
            </li>
            <li>
                <strong>
                    <i class="bi bi-buildings-fill fs-5 me-2"></i>
                    <span>Unidades</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('admin.unities.index') }}" @if ($selected == 'unities.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-building-fill-check fs-5 me-1"></i>
                        <span>Unidades Cadastradas</span>
                    </a>
                    <a href="{{ route('admin.unities.create') }}" @if ($selected == 'unities.create') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-building-fill-add fs-5 me-1"></i>
                        <span>Cadastrar Unidade</span>
                    </a>
                </ul>
            </li>
            <li>
                <strong>
                    <i class="bi bi-map-fill fs-5 me-2"></i>
                    <span>Ambientes</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('admin.places.index') }}" @if ($selected == 'places.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-pin-map-fill fs-5 me-1"></i>
                        <span>Ambientes Cadastrados</span>
                    </a>
                    <a href="{{ route('admin.places.create') }}" @if ($selected == 'places.create') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-bookmark-plus-fill fs-5 me-1"></i>
                        <span>Cadastrar Ambiente</span>
                    </a>
                </ul>
            </li>
            <li>
                <strong>
                    <i class="bi bi-clipboard2-check-fill fs-5 me-2"></i>
                    <span>Tarefas</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('admin.tasks.index') }}" @if ($selected == 'tasks.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-clipboard2-data-fill fs-5 me-1"></i>
                        <span>Tarefas Cadastradas</span>
                    </a>
                    <a href="{{ route('admin.tasks.create') }}" @if ($selected == 'tasks.create') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-clipboard-plus-fill fs-5 me-1"></i>
                        <span>Cadastrar Tarefa</span>
                    </a>
                </ul>
            </li>
            <li>
                <strong>
                    <i class="bi bi-card-checklist fs-5 me-2"></i>
                    <span>Checklists</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('admin.checklists.index') }}" @if ($selected == 'checklists.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-list-check fs-5 me-1"></i>
                        <span>Checklists Registrados</span>
                    </a>
                </ul>
            </li>

        </ul>
     </div>
</div>

