<x-app title="Checagem" :back="request()->get('back') ?? route('admin.checklists.index')">
    <x-slot name="rightBodySection"> @include('components.partials.admin.menu') </x-slot>

    <x-input-field
        class="mb-2"
        label="Ambiente"
        icon="geo-alt-fill"
        name="placeName"
        :readonly="true"
        :value="$scan->place->name" />

    <x-input-field
        class="mb-2"
        label="Responsável Pelas Atividades"
        icon="person-fill"
        :readonly="true"
        :value="$scan->worker" />

    @if (!empty($scan->observations))
        <div class="form-floating mb-2">
            <textarea class="form-control" placeholder="Observações" id="observationsField" name="observations" style="height: 100px" readonly>{{ $scan->observations }}</textarea>
            <label for="observationsField">
                <i class="bi bi-sunglasses me-1"></i>
                <span>Observações</span>
            </label>
        </div>
    @endif

    <h5 class="mt-4 mb-2">Tarefas:</h5>
    <ul class="list-group">
        @forelse ($tasks as $task)
            <li class="list-group-item text-nobreak" style="overflow-x: auto;">
                <input class="form-check-input me-1" type="checkbox" @if (in_array($task->id, $tasksDone)) checked @endif onchange="this.checked = !this.checked">
                <label class="form-check-label">{{ $task->title }}</label>
            </li>
        @empty
            <li class="text-center">Esse Ambiente Não Possuí Tarefas</li>
        @endforelse
    </ul>
</x-app>

