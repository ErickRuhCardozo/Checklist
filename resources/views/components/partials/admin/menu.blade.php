@props(['selected' => ''])
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user-menu.css') }}">
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
            @can('create', App\Models\Unity::class)
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
            @endcan
            <li>
                <strong>
                    <i class="bi bi-map-fill fs-5 me-2"></i>
                    <span>Ambientes</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('admin.places.index') }}" @if ($selected == 'places.index') style="background: var(--bs-blue);" @endif>
                        <span class="material-symbols-outlined">where_to_vote</span>
                        <span>Ambientes Cadastrados</span>
                    </a>
                    <a href="{{ route('admin.places.create') }}" @if ($selected == 'places.create') style="background: var(--bs-blue);" @endif>
                        <span class="material-symbols-outlined">add_location</span>
                        <span>Cadastrar Ambiente</span>
                    </a>
                    @can('batchCreate', \App\Models\Place::class)
                        <a href="{{ route('admin.places.batch-create') }}" @if ($selected == 'places.batch-create') style="background: var(--bs-blue);" @endif>
                            <span class="material-symbols-outlined fs-3 me- align-text-bottom" style="margin-left: -0.2rem;">batch_prediction</span>
                            <span>Cadastrar Em Massa</span>
                        </a>
                    @endcan
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
                    <a href="{{ route('admin.tasks.batch-create') }}" @if ($selected == 'tasks.batch-create') style="background: var(--bs-blue);" @endif>
                        <span class="material-symbols-outlined fs-3 me- align-text-bottom" style="margin-left: -0.2rem;">batch_prediction</span>
                        <span>Cadastrar Em Massa</span>
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
            <li>
                <strong>
                    <i class="bi bi-gear-fill fs-5 me-2"></i>
                    <span>Configurações</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('admin.settings.index') }}" @if ($selected == 'settings.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-gear-fill fs-5 me-1"></i>
                        <span>Suas Configurações</span>
                    </a>
                </ul>
            </li>
        </ul>
     </div>
</div>

