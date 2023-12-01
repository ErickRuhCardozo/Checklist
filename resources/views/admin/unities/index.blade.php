@push('styles')
<style>
    @media (max-width: 575.98px) {
        .hoverable-card { width: 11rem !important; }
    }
</style>
@endpush
<x-app title="Unidades Cadastradas">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'unities.index']) </x-slot>

    @if ($unities->isEmpty())
        <p class="lead text-center">Nenhuma Unidade Cadastrada</p>
    @else
        <div class="d-flex justify-content-center gap-2 flex-wrap">
            @foreach ($unities as $unity)
                <div class="card hoverable-card" style="width: 14rem;" onclick="location.assign('{{ route('admin.unities.show', $unity->id) }}')">
                    <div class="d-flex flex-column" style="width: fit-content; max-width: 100%;">
                        <span class="badge text-bg-primary text-start d-flex align-items-center" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                            <i class="bi bi-person-fill me-1"></i>
                            <span class="text-truncate" style="font-size: 0.6rem;">{{ $unity->users()->count() }} Usuários</span>
                        </span>
                        <span class="badge text-bg-info text-start d-flex align-items-center" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 0;">
                            <i class="bi bi-geo-alt-fill me-1"></i>
                            <span style="font-size: 0.6rem;">{{ $unity->places()->count() }} Ambientes</span>
                        </span>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center"><i class="bi bi-buildings-fill" style="font-size: 4rem;"></i></div>
                    <div class="card-footer d-flex justify-content-center align-items-center" style="min-height: 73px;">
                        <h5 class="hoverable-card-title text-center">{{ $unity->name }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.unities.create') }}" style="width: 42px; height: 42px;">
            <i class="bi bi-plus-lg align-middle fs-5"></i>
        </a>
    </div>

    {{ $unities->links() }}
</x-app>

