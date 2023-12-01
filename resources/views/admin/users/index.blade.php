<x-app title="Usuários Cadastrados">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'users.index']) </x-slot>

    @if ($users->isEmpty())
        <p class="lead text-center mb-2">Nenhum Usuário Cadastrado</p>
    @else
        <div id="usersContainer" class="d-flex flex-wrap justify-content-center gap-2 mb-2">
            @foreach ($users as $user)
                <div class="card hoverable-card" style="width: 12rem;" onclick="location.assign('{{ route('admin.users.show', $user->id) }}')">
                    <div class="d-flex flex-column" style="width: fit-content; max-width: 100%;">
                        <span class="badge text-bg-primary text-start d-flex align-items-center" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;">
                            <i class="bi bi-buildings-fill me-1"></i>
                            <span class="text-truncate" style="font-size: 0.6rem;">{{ $user->unity->name }}</span>
                        </span>
                        <span class="badge text-bg-info text-start d-flex align-items-center" style="border-top-left-radius: 0; border-bottom-left-radius: 0; border-top-right-radius: 0;">
                            <i class="bi bi-wrench-adjustable-circle me-1"></i>
                            <span style="font-size: 0.6rem;">{{ $user->type->label() }}</span>
                        </span>
                    </div>

                    <div class="card-img-top text-center">
                        <i class="bi bi-person-fill" style="font-size: 4rem;"></i>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h5 class="m-0 text-center hoverable-card-title">{{ $user->name }}</h5>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $users->links() }}
    @endif
    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.users.create') }}" style="width: 42px; height: 42px;">
            <i class="bi bi-plus-lg align-middle fs-5"></i>
        </a>
    </div>
</x-app>

