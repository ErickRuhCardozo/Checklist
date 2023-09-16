<x-app title="Usuário" :back="request()->get('back') ?? route('users.index')">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu') </x-slot>

     <x-input-field
        class="mb-2"
        label="Nome"
        icon="person-fill"
        :value="$user->name"
        :readonly="true" />

    <x-input-field
        class="mb-2"
        label="Tipo"
        icon="gear-fill"
        :value="$user->type->label()"
        :readonly="true" />

    <x-input-field
        class="mb-2"
        label="Turno"
        icon="clock-fill"
        :value="$user->work_period->label()"
        :readonly="true" />

    <x-input-field
        class="mb-2"
        label="Unidade"
        icon="buildings-fill"
        :value="$user->unity->name"
        :readonly="true" />

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('users.edit', $user->id) }}" style="width: 42px; height: 42px;">
            <i class="bi bi-pencil-fill align-middle fs-5"></i>
        </a>
        <a class="btn btn-danger rounded-circle p-1" href="javascript:showDeleteDialog()" style="width: 42px; height: 42px;">
            <i class="bi bi-trash-fill align-middle fs-5"></i>
        </a>
    </div>

    <x-delete-dialog title="Excluir Usuário" message="Deseja excluir esse Usuário?" :route="route('users.destroy', $user->id)"/>
</x-app>

