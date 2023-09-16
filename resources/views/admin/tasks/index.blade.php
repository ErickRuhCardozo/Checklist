<x-app title="Tarefas Cadastradas">
    <x-slot name="rightBodySection"> @include('components.partials.admin.menu', ['selected' => 'tasks.index']) </x-slot>
    @if ($tasks->isEmpty())
        <p class="lead text-center">Nenhuma Tarefa Cadastrada</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="fw-bold">
                    <th>Título</th>
                    <th>Turno</th>
                    <th>Ambiente</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($tasks as $task)
                        <tr onclick="location.assign('{{ route('tasks.show', $task->id) }}')">
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->period->label() }}</td>
                            <td>{{ $task->place->name }} ({{ $task->place->unity->name }})</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('tasks.create') }}" style="width: 42px; height: 42px;">
            <i class="bi bi-plus-lg align-middle fs-5"></i>
        </a>
    </div>
</x-app>

