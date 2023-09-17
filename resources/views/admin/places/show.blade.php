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
<x-app title="Ambiente" :back="request()->get('back') ?? route('admin.places.index')">
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

    <h5 class="mt-3 text-center">Usuários que podem checar esse Ambiente:</h5>
    <div class="d-flex align-items-center justify-content-center">
        <div class="btn-group" role="group" aria-label="Basic example">
            @foreach ($allowedUserTypes as $userType)
                <button type="button" class="btn btn-primary">{{ $userType->label() }}</button>
            @endforeach
        </div>
    </div>

    <h5 class="mt-3 mb-2">Tarefas:</h5>
    @if ($place->tasks->isEmpty())
        <p class="lead text-center">Nenhuma Tarefa Cadastrada Nesse Ambiente</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="fw-bold">
                    <th>Título</th>
                    <th>Período</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($place->tasks as $task)
                        <tr onclick="location.assign('{{ route('admin.tasks.show', $task->id) }}?back={{ route('admin.places.show', $place->id) }}')">
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->period->label() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.places.edit', $place->id) }}" style="width: 42px; height: 42px;">
            <i class="bi bi-pencil-fill align-middle fs-5"></i>
        </a>
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.tasks.create') }}?place={{ $place->id }}&back={{ route('admin.places.show', $place->id) }}" style="width: 42px; height: 42px;">
            <i class="bi bi-clipboard-plus-fill align-middle fs-5"></i>
        </a>
        <a class="btn btn-danger rounded-circle p-1" href="javascript:showDeleteDialog()" style="width: 42px; height: 42px;">
            <i class="bi bi-trash-fill align-middle fs-5"></i>
        </a>
    </div>

    <x-delete-dialog title="Excluir Ambiente" message="Deseja excluir esse Ambiente?" :route="route('admin.places.destroy', $place->id)" />
</x-app>

