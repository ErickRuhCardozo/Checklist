<x-app title="Checklist">
    <form action="{{ route('authenticate') }}" method="post">
        @csrf

        <x-select-field
            class="mb-2"
            name="unity"
            label="Unidade"
            icon="buildings-fill"
            placeholder="Selecione a Unidade em que você trabalha"
            :options="$unities" />

        <x-select-field
            class="mb-2"
            label="Usuário"
            icon="person-fill"
            name="user_id"
            placeholder="Selecione seu Usuário"
            :selectedValue="old('user_id')"
            :options="[]" />

        <x-input-field
            type="password"
            label="Senha"
            icon="key-fill"
            name="password"
            :error="$errors->get('password')[0] ?? ''" />

        <input class="btn btn-success w-100 mt-4" type="submit" value="Entrar">
    </form>

    <div id="loadingScreen" class="d-none position-absolute top-0 start-0 w-100 h-100 bg-dark d-flex align-items-center justify-content-center" style="z-index: 999; opacity: 0;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
    </div>

    <script>
        const unitySelect = document.getElementById('unityField');
        const userSelect = document.getElementById('user_idField');

        unitySelect.addEventListener('change', async (event) => {
            document.getElementById('loadingScreen').classList.remove('d-none');
            clearUserList();

            const unityId = unitySelect.value;
            const response = await fetch(`${location.origin}${location.pathname}api/unity-users/${unityId}`);
            const users = await response.json();

            for (const user of users) {
                const option = document.createElement('option');
                option.value = user.id;
                option.text = user.name;
                userSelect.appendChild(option);
            }

            document.getElementById('loadingScreen').classList.add('d-none');
        });

        function clearUserList() {
            Array.from(userSelect.children).forEach(o => {
                if (!o.classList.contains('d-none')) {
                    o.remove();
                }
            });
        }

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/checklist/sw.js');
        }
    </script>
</x-app>

