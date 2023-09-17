<x-app title="Seus Checklists">
    <x-slot name="rightBodySection"> @include('components.partials.employee.menu', ['selected' => 'checklists.index']) </x-slot>

    @if ($checklists->isEmpty())
        <p class="lead text-center">Você não fez nenhum Checklist ainda</p>
    @else
        <div class="list-group">
            @foreach ($checklists as $checklist)
                <button class="list-group-item list-group-item-action d-flex align-items-center justify-content-between @if ($checklist->id === auth()->user()->current_checklist_id) list-group-item-primary @endif" onclick="location.assign('{{ route('employee.checklists.show', $checklist->id) }}')">
                    <span>{{ $checklist->created_at->translatedFormat('l, d/m/Y') }}</span>
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
</x-app>

