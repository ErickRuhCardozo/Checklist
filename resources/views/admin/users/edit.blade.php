<x-app title="Editar Usuário" :back="route('users.show', $user->id)">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu') </x-slot>

    <form action="{{ route('users.update', $user->id) }}" method="post">
        @csrf
        @method('PATCH')

         <x-input-field
            class="mb-2"
            label="Nome"
            icon="person-fill"
            name="name"
            :focus="true"
            :value="$user->name"
            :error="$errors->get('name')[0] ?? ''" />

        <x-input-field
            class="mb-2"
            type="password"
            label="Senha"
            icon="key-fill"
            name="password"
            :required="false"
            :error="$errors->get('password')[0] ?? ''" />

        <x-select-field
            class="mb-2"
            label="Tipo"
            icon="gear-fill"
            name="type"
            placeholder="Selecione o Tipo desse Usuário"
            :selectedLabel="$user->type->label()"
            :options="$userTypeOptions" />

        <x-select-field
            class="mb-2"
            label="Turno"
            icon="clock-fill"
            name="work_period"
            :selectedLabel="$user->work_period->label()"
            placeholder="Selecione o turno de trabalho desse usuário"
            :options="$workPeriodOptions" />

        <x-select-field
            class="mb-2"
            label="Unidade"
            icon="buildings-fill"
            name="unity_id"
            placeholder="Selecione a Unidade desse usuário"
            :selectedLabel="$user->unity->name"
            :options="$unityOptions" />

        <input class="btn btn-success w-100 mt-4" type="submit" value="Atualizar">
    </form>


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

