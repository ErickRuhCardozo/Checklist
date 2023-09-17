<x-app title="Checklist">
    <form action="{{ route('authenticate') }}" method="post">
        @csrf

        <x-select-field
            class="mb-2"
            label="Usuário"
            icon="person-fill"
            name="user_id"
            placeholder="Selecione seu Usuário"
            :selectedValue="old('user_id')"
            :options="$userOptions" />

        <x-input-field
            type="password"
            label="Senha"
            icon="key-fill"
            name="password"
            :error="$errors->get('password')[0] ?? ''" />

        <input class="btn btn-success w-100 mt-4" type="submit" value="Entrar">
    </form>
</x-app>

