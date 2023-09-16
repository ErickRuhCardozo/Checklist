@props(['selected' => ''])
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/side-menu.css') }}">
    <style> .list-unstyled li { margin-bottom: 1em; } </style>
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
                    <a href="{{ route('users.create') }}" @if ($selected == 'users.create') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-person-plus-fill fs-5 me-1"></i>
                        <span>Cadastrar Usuário</span>
                    </a>
                    <a href="{{ route('users.index') }}" @if ($selected == 'users.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-person-check-fill fs-5 me-1"></i>
                        <span>Usuários Cadastrados</span>
                    </a>
                </ul>
            </li>
            <li>
                <strong>
                    <i class="bi bi-buildings-fill fs-5 me-2"></i>
                    <span>Unidades</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('unities.create') }}" @if ($selected == 'unities.create') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-building-fill-add fs-5 me-1"></i>
                        <span>Cadastrar Unidade</span>
                    </a>
                    <a href="{{ route('unities.index') }}" @if ($selected == 'unities.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-building-fill-check fs-5 me-1"></i>
                        <span>Unidades Cadastradas</span>
                    </a>

                </ul>
            </li>
            <li>
                <strong>
                    <i class="bi bi-map-fill fs-5 me-2"></i>
                    <span>Ambientes</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('places.create') }}" @if ($selected == 'places.create') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-bookmark-plus-fill fs-5 me-1"></i>
                        <span>Cadastrar Ambiente</span>
                    </a>
                    <a href="{{ route('places.index') }}" @if ($selected == 'places.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-pin-map-fill fs-5 me-1"></i>
                        <span>Ambientes Cadastrados</span>
                    </a>

                </ul>
            </li>
            <li>
                <strong>
                    <i class="bi bi-clipboard2-check-fill fs-5 me-2"></i>
                    <span>Tarefas</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('tasks.create') }}" @if ($selected == 'tasks.create') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-clipboard-plus-fill fs-5 me-1"></i>
                        <span>Cadastrar Tarefa</span>
                    </a>
                    <a href="{{ route('tasks.index') }}" @if ($selected == 'tasks.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-clipboard2-data-fill fs-5 me-1"></i>
                        <span>Tarefas Cadastradas</span>
                    </a>

                </ul>
            </li>

        </ul>
     </div>
</div>

