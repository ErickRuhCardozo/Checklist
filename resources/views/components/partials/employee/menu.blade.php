@props(['selected' => ''])
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/user-menu.css') }}">
@endpush

<x-slot name="rightHeaderSection">
    <button class="btn d-md-none p-0 fs-5 ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
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
            <li>
                <strong>
                    <i class="bi bi-gear-fill fs-5 me-2"></i>
                    <span>Configurações</span>
                </strong>
                <ul class="list-unstyled">
                    <a href="{{ route('employee.settings.index') }}" @if ($selected == 'settings.index') style="background: var(--bs-blue);" @endif>
                        <i class="bi bi-gear-fill fs-5 me-1"></i>
                        <span>Suas Configurações</span>
                    </a>
                </ul>
            </li>
        </ul>
     </div>
</div>

