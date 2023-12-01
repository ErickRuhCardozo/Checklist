@push('styles')
    <style>
        #unitiesContainer .card {
            transition: all 200ms ease-in-out;
            cursor: pointer;
        }

        #unitiesContainer .card:hover {
            background: var(--bs-gray-800);
            box-shadow: 0 0 8px 2.5px rgb(7, 126, 230);
        }

        #unitiesContainer .card:active {
            background: var(--bs-gray-700) !important;
        }

        @media (max-width: 578px) {
            #unitiesContainer { gap: 2rem !important; }
            #unitiesContainer .card { width: 8rem !important; }
            #unitiesContainer .card i { font-size: 4rem !important; }
            #unitiesContainer .card h5 { font-size: 1.25rem !important; }
        }
    </style>
@endpush
<x-app title="Checklist Melhor Viver">
    @if ($errors->count() > 0)
        <div class="position-relative mt-4 mb-0 start-50 translate-middle toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body flex-grow-1 text-center">Usuário ou Senha Inválidos</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
             </div>
        </div>
    @endif

    <div id="unitiesContainer">
        <h3 class="text-center mb-3">Selecione Sua Unidade:</h3>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            @foreach ($unities as $unity)
                    <div class="card" style="width: 12rem;" data-unity-id="{{ $unity['value'] }}" onclick="onUnitySelected(this)">
                    <div class="card-img-top text-center">
                        <i class="bi bi-buildings-fill" style="font-size: 6rem;"></i>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <h5 class="m-0 text-center">{{ $unity['label'] }}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="userContainer" class="d-flex justify-content-center" style="opacity: 0;">
        <div class="card" style="width: 24rem;">
            <button class="mt-1 text-muted btn btn-sm align-self-start" style="font-size: 0.75rem; border: none;" onclick="selectUnity()">
                <i class="bi bi-arrow-left"></i>
                <span>Selecionar Unidade</span>
            </button>

            <div class="card-body">
                <form action="{{ route('authenticate') }}" method="post">
                    @csrf
                    <div class="input-group mb-2">
                        <label class="input-group-text bi bi-person-fill fs-5" for="usersSelect"></label>
                        <select class="form-select" id="userSelect" name="user_id">
                            <option class="d-none" value="">Selecione Seu Usuário</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <label class="bi bi-key-fill fs-5 input-group-text" for="password"></label>
                        <input class="form-control" type="password" name="password" placeholder="Senha" />
                    </div>

                    <input class="btn btn-success mt-4 w-100" type="submit" value="Entrar" />
                </form>
            </div>
        </div>
    </div>

    <div id="loadingScreen" class="d-none position-absolute top-0 start-0 w-100 h-100 bg-dark d-flex align-items-center justify-content-center" style="z-index: 999; opacity: 0;">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
    </div>

    <script>
        const unityContainer = document.getElementById('unitiesContainer');
        const userContainer = document.getElementById('userContainer');
        const userSelect = document.getElementById('userSelect');
        const animationProps = { duration: 500, fill: 'forwards', easing: 'ease' };

        async function onUnitySelected(card) {
            const unityId = card.dataset.unityId;
            const response = await fetch(`${location.origin}${location.pathname}api/unity-users/${unityId}`);
            const users = await response.json();

            for (const opt of Array.from(userSelect.children))
                if (!opt.textContent.startsWith('Selecione'))
                    opt.remove()

            for (const user of users) {
                const option = document.createElement('option');
                option.value = user.id;
                option.textContent = user.name;
                userSelect.appendChild(option);
            }

            let anim = unityContainer.animate({ opacity: [1, 0] }, animationProps);
            anim.onfinish = () => {
                unityContainer.classList.add('d-none');
                userContainer.animate({ opacity: [0, 1] }, animationProps);
            };
        }

        function selectUnity() {
            let anim = userContainer.animate({ opacity: [1, 0] }, animationProps);
            anim.onfinish = () => {
                unityContainer.classList.remove('d-none');
                unityContainer.animate({ opacity: [0, 1] }, animationProps);
            };
        }

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/checklist/sw.js');
        }
    </script>
</x-app>

