<x-app title="Cadastrar Tarefa" :back="request()->get('back') ?? route('tasks.index')">
    <x-slot name="rightBodySection"> @include('components.partials.admin.menu', ['selected' => 'tasks.create']) </x-slot>
    <form action="{{ route('tasks.store') }}" method="post">
        @csrf

        <x-input-field
            class="mb-2"
            label="Título"
            icon="check-circle"
            name="title"
            :value="old('title')"
            :error="$errors->get('title')[0] ?? ''"
            :focus="true" />

        <x-select-field
            class="mb-2"
            label="Turno"
            icon="clock-fill"
            name="period"
            placeholder="Selecione durante qual turno essa tarefa deve ser checada"
            :selectedValue="old('period')"
            :options="$workPeriodOptions" />

        <div class="form-floating">
            <select class="form-select" name="place_id" id="placeField" required>
                <option class="d-none" value="">Selecione a qual Ambiente essa Tarefa pertence</option>
                @foreach ($unities as $unity)
                    <optgroup label="{{ $unity->name }}">
                        @forelse ($unity->places as $place)
                            <option value="{{ $place->id }}" @if (old('place_id') == $place->id || request()->get('place') == $place->id) selected @endif>{{ $place->name }}</option>
                        @empty
                            <option value="" disabled>Unidade Sem Ambientes</option>
                        @endforelse
                    </optgroup>
                @endforeach
            </select>
            <label for="placeField">
                <i class="bi bi-geo-alt-fill me-1"></i>
                <span>Ambiente</span>
            </label>
        </div>

        <input class="btn btn-success w-100 mt-4" type="submit" value="Cadastrar">
    </form>
</x-app>

