@push('styles')
    <style>
        .period-select {
            max-width: 35% !important;
        }

        @media (max-width: 575.98px) {
            .period-select {
                max-width: 50% !important;
            }
        }
    </style>
@endpush
<x-app title="Cadastrar Em Massa">
    <x-slot name="rightBodySection"> @include('components.partials.admin.menu', ['selected' => 'tasks.batch-create']) </x-slot>

    <template id="taskItemTemplate">
        <div class="input-group d-flex">
            <x-input-field
                label="Título"
                icon="check-circle"
                name="titles[]" />

            <x-select-field
                class="period-select"
                label="Turno"
                icon="clock-fill"
                name="periods[]"
                placeholder="Qual período essa tarefa deve ser checada"
                :options="$periodOptions" />
        </div>
    </template>

    <form action="{{ route('admin.tasks.batch-store') }}" method="post">
        @csrf
        <h5>Selecione os Ambientes em que deseja adicionar as Tarefas:</h5>
        <div class="card position-relative" style="max-width: 100%; overflow: hidden;">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs flex-nowrap align-items-end justify-content-md-center justify-content-start text-nowrap" style="overflow-x: auto; overflow-y: hidden;" id="myTab" role="tablist">
                    @foreach ($unities as $unity)
                        <li class="nav-item" role="presentation">
                            <button
                                class="nav-link @if ($loop->first) active @endif"
                                id="unity{{ $unity->id }}-tab"
                                data-bs-toggle="tab"
                                data-bs-target="#unity{{ $unity->id }}-tab-pane"
                                type="button"
                                role="tab">
                                {{ $unity->name }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="card-body p-0">
                <div class="tab-content" id="myTabContent">
                    @foreach ($unities as $unity)
                        <div
                            class="tab-pane fade @if ($loop->first) show active @endif"
                            id="unity{{ $unity->id }}-tab-pane"
                            role="tabpanel"
                            tabindex="0">
                            @if ($unity->places()->count() > 0)
                                <div class="ms-3 mt-2">
                                    <input class="form-check-input me-1" type="checkbox" id="select{{ $unity->id }}All" onchange="toggleChecks(this.parentElement, this.checked)">
                                    <label class="form-check-label" for="select{{ $unity->id }}All">Selecionar Todos</label>
                                </div>
                            @endif
                            <ul class="list-group list-group-flush" style="max-height: 20vh; overflow-x: auto;">
                                @forelse ($unity->places as $place)
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" name="places[]" value="{{ $place->id }}" id="place{{ $place->id }}Checkbox">
                                        <label class="form-check-label" for="place{{ $place->id }}Checkbox">{{ $place->name }}</label>
                                    </li>
                                @empty
                                    <p class="m-2 lead text-center">Nenhum Ambiente Cadastrado Nessa Unidade</p>
                                @endforelse
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <h5 class="mt-3">Informe as Tarefas e seus Turnos:</h5>
        <div id="taskList" class="d-flex flex-column gap-1" style="max-height: 30vh; overflow-y: auto; z-index: 99;">
        </div>

        <input class="mt-2 btn btn-success w-100" type="submit" value="Cadastrar Em Massa">
    </form>

    <div class="actions">
        <button class="btn btn-primary rounded-circle p-0" style="width: 40px; height: 40px;" onclick="addTaskItem()">
            <i class="bi bi-plus-lg fs-5"></i>
        </button>
    </div>

    <script>
        const taskItemTemplate = document.getElementById('taskItemTemplate');
        const taskList = document.getElementById('taskList');

        function addTaskItem() {
            const item = taskItemTemplate.content.firstElementChild.cloneNode(true);
            taskList.appendChild(item);
            item.querySelector('input').focus();
        }

        function toggleChecks(div, state) {
            const parent = div.parentElement;
            parent.querySelectorAll('input[type=checkbox]').forEach((input, index) => {
                if (index === 0) return true;
                input.checked = state;
            });
        }
    </script>
</x-app>

