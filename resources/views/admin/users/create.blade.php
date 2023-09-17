<x-app title="Cadastrar Usuário" :back="request()->get('back') ?? route('admin.users.index')">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'users.create']) </x-slot>

    <form action="{{ route('admin.users.store') }}" method="post">
        @csrf

         <x-input-field
            class="mb-2"
            label="Nome"
            icon="person-fill"
            name="name"
            :focus="true"
            :value="old('name')"
            :error="$errors->get('name')[0] ?? ''" />

        <x-input-field
            class="mb-2"
            type="password"
            label="Senha"
            icon="key-fill"
            name="password"
            :error="$errors->get('password')[0] ?? ''" />

        <x-select-field
            class="mb-2"
            label="Tipo"
            icon="gear-fill"
            name="type"
            placeholder="Selecione o Tipo desse Usuário"
            :selectedValue="old('type')"
            :options="$userTypeOptions" />

        <x-select-field
            class="mb-2"
            label="Turno"
            icon="clock-fill"
            name="work_period"
            placeholder="Selecione o turno de trabalho desse usuário"
            :selectedValue="old('work_period')"
            :options="$workPeriodOptions" />

        <x-select-field
            class="mb-2"
            label="Unidade"
            icon="buildings-fill"
            name="unity_id"
            placeholder="Selecione a Unidade desse usuário"
            :selectedValue="old('unity_id') ?? request()->get('unity')"
            :options="$unityOptions" />

        <input class="btn btn-success w-100 mt-4" type="submit" value="Cadastrar">
    </form>
</x-app>

