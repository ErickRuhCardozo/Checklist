<x-app title="Cadastrar Unidade" :back="route('unities.index')">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'unities.create']) </x-slot>

    <form action="{{ route('unities.store') }}" method="post">
        @csrf

         <x-input-field
            class="mb-2"
            label="Nome"
            icon="buildings-fill"
            name="name"
            :focus="true"
            :error="$errors->get('name')[0] ?? ''" />

        <input class="btn btn-success w-100 mt-4" type="submit" value="Cadastrar">
    </form>
</x-app>

