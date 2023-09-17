@push('scripts')
    <script>
        function generateQrCode() {
            document.getElementById('qrcodeField').value = (Math.random() + 1).toString(36).substring(2);
        }
    </script>
@endpush
<x-app title="Cadastrar Ambiente" :back="request()->get('back') ?? route('admin.places.index')">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'places.create']) </x-slot>

    <form action="{{ route('admin.places.store') }}" method="post">
        @csrf

        <x-input-field
            class="mb-2"
            label="Nome"
            icon="geo-alt-fill"
            name="name"
            :focus="true"
            :value="old('name')"
            :error="$errors->get('name')[0] ?? ''" />

        <div class="input-group mb-2">
            <x-input-field
                label="QR Code"
                icon="qr-code"
                name="qrcode"
                :value="old('qrcode')" />

            <button class="btn btn-primary" type="button" onclick="generateQrCode()">Gerar</button>
        </div>

        <x-select-field
            class="mb-3"
            label="Unidade"
            icon="buildings-fill"
            placeholder="Selecione em qual Unidade este Ambiente está"
            name="unity_id"
            :selectedValue="old('unity_id') ?? request()->get('unity')"
            :options="$unityOptions" />

        <h5 class="text-center">Quais usuários podem checar esse Ambiente:</h5>
        <div class="d-flex align-items-center justify-content-center">
            <div class="btn-group" role="group">
                @foreach ($userTypeOptions as $option)
                    <input type="checkbox" class="btn-check" id="btncheck{{ $option['value'] }}" name="allowedUserTypes[]" autocomplete="off" value="{{ $option['value'] }}" @if (in_array($option['value'], old('allowedUserTypes') ?? [])) checked @endif>
                    <label class="btn btn-outline-primary" for="btncheck{{ $option['value'] }}">{{ $option['label'] }}</label>
                @endforeach
            </div>
        </div>
        <span class="text-danger">{{ $errors->get('allowedUserTypes')[0] ?? '' }}</span>

        <input class="btn btn-success w-100 mt-4" type="submit" value="Cadastrar">

        <script>
            if (window.innerWidth < 576) {
                document.querySelector('.btn-group').classList.replace('btn-group', 'btn-group-vertical');
            }
        </script>
    </form>
</x-app>

