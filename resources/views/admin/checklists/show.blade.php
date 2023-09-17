<x-app title="Checklist" :back="route('admin.checklists.index')">
    <x-slot name="rightBodySection"> @include('components.partials.admin.menu') </x-slot>

    <x-input-field
        class="mb-2"
        label="Criado Em"
        icon="calendar-fill"
        :readonly="true"
        :value="$checklist->created_at->diffForHumans()" />

    @if ($checklist->wasUpdated())
        <x-input-field
            class="mb-2"
            label="Última Atualização"
            icon="calendar-check-fill"
            :readonly="true"
            :value="$checklist->updated_at->diffForHumans()" />
    @endif

    <x-input-field
        label="Concluído"
        icon="check-circle-fill"
        :readonly="true"
        :value="$checklist->is_done ? 'Sim' : 'Não'" />

    <h5 class="mt-3 mb-1">Ambientes Checados:</h5>
    @if ($checklist->checkedPlaces()->isEmpty())
        <p class="lead text-center">Nenhum Ambiente Checado Ainda</p>
    @else
        <div class="list-group">
            @foreach ($checklist->scans as $scan)
                <button class="list-group-item list-group-item-action text-center" type="button" onclick="location.assign('{{ route('admin.scans.show', $scan->id) }}?back={{ route('admin.checklists.show', $checklist->id) }}')">{{ $scan->place->name }}</button>
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
</x-app>
