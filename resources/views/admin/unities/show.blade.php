<x-app title="Unidade" :back="route('admin.unities.index')">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu') </x-slot>

    <x-input-field
        label="Nome"
        icon="buildings-fill"
        :readonly="true"
        :value="$unity->name" />

    <h5 class="mt-3 mb-1">Usuários:</h5>
    @if ($unity->users->isEmpty())
        <p class="lead text-center">Nenhum Usuário Nessa Unidade</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="fw-bold">
                    <th>Nome</th>
                    <th>Tipo</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($unity->users as $user)
                        <tr onclick="location.assign('{{ route('admin.users.show', $user->id) }}?back={{ route('admin.unities.show', $unity->id) }}')">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->type->label() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <h5 class="mt-3 mb-1">Ambientes:</h5>
    @if ($unity->places->isEmpty())
        <p class="lead text-center">Nenhum Ambiente Cadastrado Nessa Unidade</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="fw-bold">
                    <th>Nome</th>
                    <th>Tarefas</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($unity->places as $place)
                        <tr onclick="location.assign('{{ route('admin.places.show', $place->id) }}?back={{ route('admin.unities.show', $unity->id) }}')">
                            <td>{{ $place->name }}</td>
                            <td>{{ $place->tasks()->count() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.unities.edit', $unity->id) }}" style="width: 42px; height: 42px;">
            <i class="bi bi-pencil-fill align-middle fs-5"></i>
        </a>
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.users.create') }}?unity={{ $unity->id }}&back={{ route('admin.unities.show', $unity->id) }}" style="width: 42px; height: 42px;">
            <i class="bi bi-person-plus-fill align-middle fs-5"></i>
        </a>
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.places.create') }}?unity={{ $unity->id }}&back={{ route('admin.unities.show', $unity->id) }}" style="width: 42px; height: 42px;">
            <span class="material-symbols-outlined">add_location_alt</span>
        </a>
        <a class="btn btn-danger rounded-circle p-1" href="javascript:showDeleteDialog()" style="width: 42px; height: 42px;">
            <i class="bi bi-trash-fill align-middle fs-5"></i>
        </a>
    </div>

    <x-delete-dialog title="Excluir Unidade" message="Deseja excluir essa Unidade?" :route="route('admin.unities.destroy', $unity->id)"/>
</x-app>

