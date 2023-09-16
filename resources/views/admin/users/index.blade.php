<x-app title="Usuários Cadastrados">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'users.index']) </x-slot>

    @if ($users->isEmpty())
        <p class="lead text-center">Nenhum Usuário Cadastrado</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Unidade</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($users as $user)
                        <tr onclick="location.assign('{{ route('users.show', $user->id) }}')">
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
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('users.create') }}" style="width: 42px; height: 42px;">
            <i class="bi bi-plus-lg align-middle fs-5"></i>
        </a>
    </div>
</x-app>

