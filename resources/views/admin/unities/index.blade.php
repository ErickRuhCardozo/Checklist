<x-app title="Unidades Cadastradas">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'unities.index']) </x-slot>

    @if ($unities->isEmpty())
        <p class="lead text-center">Nenhuma Unidade Cadastrada</p>
    @else
        <div class="table-responsive mb-2">
            <table class="table table-hover">
                <thead>
                    <th>@sortablelink('name', 'Nome')</th>
                    <th>@sortablelink('places', 'Ambientes')</th>
                    <th>@sortablelink('users', 'Usuários')</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($unities as $unity)
                        <tr onclick="location.assign('{{ route('admin.unities.show', $unity->id) }}')">
                            <td>{{ $unity->name }}</td>
                            <td>{{ $unity->places()->count() }}</td>
                            <td>{{ $unity->users()->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.unities.create') }}" style="width: 42px; height: 42px;">
            <i class="bi bi-plus-lg align-middle fs-5"></i>
        </a>
    </div>

    {{ $unities->links() }}
</x-app>

