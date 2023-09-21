<x-app title="Tarefa" :back="request()->get('back') ?? route('admin.tasks.index')">
    <x-slot name="rightBodySection"> @include('components.partials.admin.menu') </x-slot>
    <x-input-field
        class="mb-2"
        label="Título"
        icon="check-circle"
        :value="$task->title"
        :readonly="true" />

   <x-input-field
        class="mb-2"
        label="Turno"
        icon="clock-fill"
        :value="$task->period->label()"
        :readonly="true" />

    <x-input-field
        class="mb-2"
        label="Ambiente"
        icon="geo-alt-fill"
        value="{{ $task->place->name}} ({{ $task->place->unity->name }})"
        :readonly="true" />

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.tasks.edit', $task->id) }}" style="width: 42px; height: 42px;">
            <i class="bi bi-pencil-fill align-middle fs-5"></i>
        </a>
        <a class="btn btn-danger rounded-circle p-1" href="javascript:showDeleteDialog()" style="width: 42px; height: 42px;">
            <i class="bi bi-trash-fill align-middle fs-5"></i>
        </a>
    </div>

    <x-delete-dialog title="Excluir Tarefa" message="Deseja excluir essa Tarefa?" :route="route('admin.tasks.destroy', $task->id)" />
</x-app>

