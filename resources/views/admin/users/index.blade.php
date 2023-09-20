<x-app title="Usuários Cadastrados">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'users.index']) </x-slot>

    @if ($users->isEmpty())
        <p class="lead text-center mb-2">Nenhum Usuário Cadastrado</p>
    @else
        <div class="table-responsive mb-2">
            <table class="table table-hover">
                <thead>
                    <th>@sortablelink('name', 'Nome')</th>
                    <th>@sortablelink('type', 'Tipo')</th>
                    <th>@sortablelink('unity.name', 'Unidade')</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($users as $user)
                        <tr onclick="location.assign('{{ route('admin.users.show', $user->id) }}')">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->type->label() }}</td>
                            <td>{{ $user->unity->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.users.create') }}" style="width: 42px; height: 42px;">
            <i class="bi bi-plus-lg align-middle fs-5"></i>
        </a>
    </div>

    {{ $users->links() }}
</x-app>

