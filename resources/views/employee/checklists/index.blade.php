<x-app title="Seus Checklists">
    <x-slot name="rightBodySection"> @include('components.partials.employee.menu', ['selected' => 'checklists.index']) </x-slot>

    @if ($checklists->isEmpty())
        <p class="lead text-center">Você não fez nenhum Checklist ainda</p>
    @else
        <div class="list-group">
            @foreach ($checklists as $checklist)
                <button class="list-group-item list-group-item-action d-flex align-items-center justify-content-between @if ($checklist->id === auth()->user()->current_checklist_id) list-group-item-primary @endif" onclick="location.assign('{{ route('employee.checklists.show', $checklist->id) }}')">
                    <span>{{ Str::title($checklist->created_at->translatedFormat('l, d/m/Y')) }}</span>
                    <i class="bi fs-5
                            @if ($checklist->is_done)
                                bi-patch-check-fill text-success
                            @else
                                bi-exclamation-triangle-fill text-warning
                            @endif"></i>
                </button>
            @endforeach
        </div>
    @endif

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('employee.checklists.create') }}" style="width: 42px; height: 42px;">
            <i class="bi bi-plus-lg align-middle fs-5"></i>
        </a>
        <a class="btn btn-success rounded-circle p-1" href="{{ route('employee.checklists.continue') }}" style="width: 42px; height: 42px;">
            <i class="bi bi-arrow-repeat align-middle fs-5"></i>
        </a>
    </div>
</x-app>

