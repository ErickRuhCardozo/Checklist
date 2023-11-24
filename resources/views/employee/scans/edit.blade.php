<x-app title="Editar Checagem" :back="route('employee.scans.show', $scan->id)">
    <x-slot name="rightBodySection"> @include('components.partials.employee.menu', ['selected' => 'scans.create']) </x-slot>

    <form action="{{ route('employee.scans.update', $scan->id) }}" method="post">
        @csrf
        @method('PATCH')

        <x-input-field
            class="mb-2"
            label="Ambiente"
            icon="geo-alt-fill"
            name="placeName"
            :readonly="true"
            :value="$scan->place->name" />


        <input type="hidden" name="checklist_id" value="{{ $scan->checklist->id }}">
        <input type="hidden" name="place_id" value="{{ $scan->place->id }}">

        <x-input-field
            class="mb-2"
            label="Responsável Pelas Atividades"
            icon="person-fill"
            name="worker"
            :error="$errors->get('worker')[0] ?? ''"
            :value="old('worker') ?? $scan->worker" />

        <div class="form-floating mb-2">
            <textarea class="form-control" placeholder="Observações" id="observationsField" name="observations" style="height: 100px">{{ old('observations') ?? $scan->observations }}</textarea>
            <label for="observationsField">
                <i class="bi bi-sunglasses me-1"></i>
                <span>Observações</span>
            </label>
        </div>
        <span class="text-danger">{{ $errors->get('observations')[0] ?? '' }}</span>

        @if (count($tasks) > 0)
            <h5 class="mt-4 mb-2">Tarefas:</h5>
            <ul class="list-group">
                @foreach ($tasks as $task)
                    <li class="list-group-item text-nobreak d-flex" style="overflow-x: auto;">
                        <input class="form-check-input me-2 text-truncate" type="checkbox" name="tasks[]" value="{{ $task->id }}" id="task{{ $task->id }}" @if (in_array($task->id, $tasksDone)) checked @endif>
                        <label class="form-check-label flex-grow-1" for="task{{ $task->id }}">{{ $task->title }}</label>
                    </li>
                @endforeach
            </ul>
            <span class="text-danger">{{ $errors->get('tasks')[0] ?? '' }}</span>
        @endif

        <input class="btn btn-success w-100 mt-4" type="submit" value="Atualizar">

        @if ($errors->has('error'))
            <div class="alert alert-danger text-center" role="alert" onload="alert('loaded')">
                {{ $errors->get('error')[0] }}
            </div>
            <script>setTimeout(() => document.querySelector('.alert').animate({ opacity: [1, 0] }, { duration: 1500, fill: 'forwards' }), 3500);</script>
        @endif

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let lastResult;
        const scannerContainer = document.getElementById('scannerContainer');
        const form = document.forms[0];
        const scanner = new Html5Qrcode('qr-reader', { formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ] });
        const scannerConfig = {
            fps: 10,
            qrbox: (width, height) => {
                let qrboxSize = Math.floor(Math.min(width, height) * 0.9);
                return { width: qrboxSize, height: qrboxSize };
            }
        };

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                lastResult = decodedText;
                location.assign(`${location.href}?qrcode=${decodedText}`);
            }
        }


        function scanQrCode() {
            form.classList.add('d-none');
            scannerContainer.classList.remove('d-none');
            scanner.start({ facingMode: 'environment' }, scannerConfig, onScanSuccess);
        }
    </script>
</x-app>

