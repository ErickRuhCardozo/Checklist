<x-app title="Checklist">
    <form action="{{ route('login') }}" method="post">
        @csrf

        <x-select-field
            class="mb-2"
            label="Usuário"
            icon="person-fill"
            name="user"
            placeholder="Selecione seu Usuário"
            :options="$userOptions" />

        <x-input-field
            type="password"
            label="Senha"
            icon="key-fill"
            name="password" />

        <input class="btn btn-success w-100 mt-4" type="submit" value="Entrar">
    </form>
</x-app>

