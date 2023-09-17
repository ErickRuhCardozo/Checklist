<x-app title="Editar Unidade" :back="route('admin.unities.show', $unity->id)">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu') </x-slot>

    <form action="{{ route('admin.unities.update', $unity->id) }}" method="post">
        @csrf
        @method('PATCH')

         <x-input-field
            class="mb-2"
            label="Nome"
            icon="person-fill"
            name="name"
            :focus="true"
            :value="$unity->name"
            :error="$errors->get('name')[0] ?? ''" />

        <input class="btn btn-success w-100 mt-4" type="submit" value="Alterar">
    </form>
</x-app>

