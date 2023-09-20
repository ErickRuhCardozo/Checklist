<x-app title="Configurações" :back="route('employee.checklists.index')">
    <x-slot name="rightBodySection"> @include('components.partials.employee.menu', ['selected' => 'settings.index']) </x-slot>

    <form action="{{ route('employee.settings.update', $user->id) }}" method="post">
        @csrf
        @method('PATCH')

        <x-input-field
            type="password"
            label="Alterar Senha"
            icon="key-fill"
            name="password"
            :required="true"
            :error="$errors->get('password')[0] ?? ''" />

        <input class="btn btn-success w-100 mt-4" type="submit" value="Salvar">
    </form>
</x-app>

