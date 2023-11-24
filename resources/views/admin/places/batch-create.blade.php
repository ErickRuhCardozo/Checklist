<x-app title="Cadastrar Em Massa">
    <x-slot name="rightBodySection"> @include('components.partials.admin.menu', ['selected' => 'places.batch-create']) </x-slot>

    <template id="placeItemTemplate">
        <div class="input-group">
            <x-input-field
                label="Nome"
                icon="geo-alt-fill"
                name="places[]" />

            <div class="input-group-text">
                <div class="btn-group d-none d-md-flex" role="group">
                    @foreach ($userTypeOptions as $option)
                        <input type="checkbox" class="btn-check" autocomplete="off" value="{{ $option['value'] }}">
                        <label class="btn btn-outline-primary">{{ $option['label'] }}</label>
                    @endforeach
                </div>
                <div class="dropdown d-block d-md-none">
                    <button class="btn btn-secondary dropdown-toggle" data-bs-auto-close="outside" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuários
                    </button>
                    <ul class="dropdown-menu p-0">
                        <div class="btn-group-vertical w-100" role="group">
                            @foreach ($userTypeOptions as $option)
                                <input type="checkbox" class="btn-check" autocomplete="off" value="{{ $option['value'] }}">
                                <label class="btn btn-outline-primary">{{ $option['label'] }}</label>
                            @endforeach
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </template>

    <form action="{{ route('admin.places.batch-store') }}" method="post">
        @csrf
        <h5 class="text-center">Selecione as Unidades em que deseja cadastrar os Ambientes:</h5>
        <div class="btn-group position-relative start-50 translate-middle-x text-nowrap" role="group" style="max-width: 100%; overflow-x: auto;">
            @foreach ($unities as $unity)
                <input type="checkbox" class="btn-check" name="unities[]" value="{{ $unity->id }}" id="unity{{ $unity->id }}Check" autocomplete="off">
                <label class="btn btn-outline-primary" for="unity{{ $unity->id }}Check">{{ $unity->name }}</label>
            @endforeach
        </div>

        <h5 class="mt-3 text-center">Informe os Ambientes que deseja cadastrar</h5>
        <div id="placesList" class="d-flex flex-column gap-1" style="height: 45vh; overflow-y: auto;">
        </div>

        <input class="btn btn-success w-100 mt-4" type="submit" value="Cadastrar Em Massa">
    </form>

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" style="width: 42px; height: 42px;" onclick="addPlaceItem()">
            <i class="bi bi-plus-lg align-middle fs-5"></i>
        </a>
    </div>

    @if ($errors->has('error'))
        <div class="alert alert-danger mt-2 mb-2" role="alert">
            {{ $errors->get('error')[0] }}
        </div>
    @endif

    <script>
        const placeItemTemplate = document.getElementById('placeItemTemplate');
        const placesList = document.getElementById('placesList');
        let placeCount = 0;

        function addPlaceItem() {
            const item = placeItemTemplate.content.firstElementChild.cloneNode(true);
            let horizontalCount = 0;
            let verticalCount = 0;

            item.querySelectorAll('.btn-group [type=checkbox]').forEach(input => {
                input.name = `place${placeCount}_users[]`;
                input.id = `horizontal${horizontalCount++}${placeCount}`;
            });

            horizontalCount = 0;
            item.querySelectorAll('.btn-group label').forEach(label => label.htmlFor = `horizontal${horizontalCount++}${placeCount}`);

            item.querySelectorAll('.btn-group-vertical [type=checkbox]').forEach(input => {
                input.name = `place${placeCount}_users[]`;
                input.id = `vertical${verticalCount++}${placeCount}`;
            });

            verticalCount = 0;
            item.querySelectorAll('.btn-group-vertical label').forEach(label => label.htmlFor = `vertical${verticalCount++}${placeCount}`);

            placeCount++;
            placesList.appendChild(item);
            item.querySelector('input').focus();
        }
    </script>
</x-app>

