<x-app title="Checklist" :back="route('employee.checklists.index')">
    <x-slot name="rightBodySection"> @include('components.partials.employee.menu') </x-slot>

    <x-input-field
        class="mb-2"
        label="Criado Em"
        icon="calendar-fill"
        :readonly="true"
        :value="$checklist->created_at->diffForHumans()" />

    @if ($checklist->wasUpdated())
        <x-input-field
           label="Última Atualização"
           icon="calendar-check-fill"
           :readonly="true"
           :value="$checklist->updated_at->diffForHumans()" />
    @endif

    <h5 class="mt-3 mb-1">Ambientes Checados:</h5>
    @if ($checklist->checkedPlaces()->isEmpty())
        <p class="lead text-center">Nenhum Ambiente Checado Ainda</p>
    @else
        <div class="list-group">
            @foreach ($checklist->scans as $scan)
                <button class="list-group-item list-group-item-action text-center" type="button" onclick="location.assign('{{ route('employee.scans.show', $scan->id) }}?back={{ route('employee.checklists.show', $checklist->id) }}')">{{ $scan->place->name }}</button>
            @endforeach
        </div>
    @endif

    @if ($notScannedPlaces->count() > 0)
        <h5 class="mt-3 mb-1">Ambientes Não Checados</h5>
        <div class="list-group">
            @foreach ($notScannedPlaces as $place)
                <button class="list-group-item list-group-item-action text-center" type="button">{{ $place->name }}</button>
            @endforeach
        </div>
    @endif


    <div class="actions">
        @if (!$checklist->is_done)
            <a class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center" href="{{ route('employee.checklists.continue', ['checklist' => $checklist->id]) }}" style="width: 42px; height: 42px;">
                <i class="bi bi-arrow-repeat align-middle fs-5" style="line-height: 16px;"></i>
            </a>
        @endif
    </div>
</x-app>

