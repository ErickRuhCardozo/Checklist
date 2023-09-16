@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function downloadQrCode() {
            let qrCode = new QRCode(document.getElementById('qrCodeContainer'), { width: 1000, height: 1000 });
            let link = document.createElement('a');
            link.download = '{{ $place->unity->name }} - {{ $place->name }}';
            qrCode.makeCode('{{ $place->qrcode }}');
            link.href = document.querySelector('canvas').toDataURL();
            link.click();
        }
    </script>
@endpush
<x-app title="Ambiente" :back="request()->get('back') ?? route('places.index')">
    <x-slot name="rightBodySection"> @include('components.partials.admin.menu') </x-slot>

    <x-input-field
        class="mb-2"
        label="Nome"
        icon="geo-alt-fill"
        :readonly="true"
        :value="$place->name" />

    <div class="input-group mb-2">
        <x-input-field
            label="QR Code"
            icon="qr-code"
            :readonly="true"
            :value="$place->qrcode" />

        <button class="btn btn-primary" onclick="downloadQrCode()">Baixar</button>
    </div>

    <div class="d-none" id="qrCodeContainer"></div>

    <x-input-field
        label="Unidade"
        icon="buildings-fill"
        :readonly="true"
        :value="$place->unity->name" />

    <h5 class="mt-3 mb-2">Tarefas:</h5>
    @if ($place->tasks->isEmpty())
        <p class="lead text-center">Nenhuma Tarefa Cadastrada Nesse Ambiente</p>
    @else
        <div class="list-group">
            @foreach ($place->tasks as $task)
                <button class="list-group-item list-group-item-action text-center" onclick="location.assign('{{ route('tasks.show', $task->id) }}?back={{ route('places.show', $place->id) }}')">{{ $task->title }}</button>
            @endforeach
        </div>
    @endif

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('places.edit', $place->id) }}" style="width: 42px; height: 42px;">
            <i class="bi bi-pencil-fill align-middle fs-5"></i>
        </a>
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('tasks.create') }}?place={{ $place->id }}&back={{ route('places.show', $place->id) }}" style="width: 42px; height: 42px;">
            <i class="bi bi-clipboard-plus-fill align-middle fs-5"></i>
        </a>
        <a class="btn btn-danger rounded-circle p-1" href="javascript:showDeleteDialog()" style="width: 42px; height: 42px;">
            <i class="bi bi-trash-fill align-middle fs-5"></i>
        </a>
    </div>

    <x-delete-dialog title="Excluir Ambiente" message="Deseja excluir esse Ambiente?" :route="route('places.destroy', $place->id)" />
</x-app>

