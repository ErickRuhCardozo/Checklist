<x-app title="Escanear Ambiente" :back="route('employee.checklists.index')">
    <x-slot name="rightBodySection"> @include('components.partials.employee.menu', ['selected' => 'scans.create']) </x-slot>

    <div id="scannerContainer">
        <div id="qr-reader" class="w-100"></div>
    </div>

    <form action="{{ route('employee.scans.store') }}" method="post">
        @csrf

        <div class="input-group mb-2">
            <x-input-field
                label="Ambiente"
                icon="geo-alt-fill"
                name="placeName"
                :readonly="true"
                :value="$place?->name" />


            <input type="hidden" name="checklist_id" value="{{ auth()->user()->current_checklist_id }}">
            <input type="hidden" name="place_id" value="{{ $place?->id }}">
            <button class="btn btn-primary" type="button" onclick="scanQrCode()">Escanear</button>
        </div>
        <span class="text-danger">{{ $errors->get('place_id')[0] ?? '' }}</span>

        <x-input-field
            class="mb-2"
            label="Responsável Pelas Atividades"
            icon="person-fill"
            name="worker"
            :error="$errors->get('worker')[0] ?? ''" />

        <div class="form-floating mb-2">
            <textarea class="form-control" placeholder="Observações" id="observationsField" name="observations" style="height: 100px"></textarea>
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
                    <li class="list-group-item text-nobreak" style="overflow-x: auto;">
                        <input class="form-check-input me-1" type="checkbox" name="tasks[]" value="{{ $task->id }}" id="task{{ $task->id }}">
                        <label class="form-check-label" for="task{{ $task->id }}">{{ $task->title }}</label>
                    </li>
                @endforeach
            </ul>
            <span class="text-danger">{{ $errors->get('tasks')[0] ?? '' }}</span>
        @endif

        @if ($place)
            <input class="btn btn-success w-100 mt-4" type="submit" value="Checar">
        @endif

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

