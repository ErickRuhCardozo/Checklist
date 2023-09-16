@push('scripts')
    <script>
        function generateQrCode() {
            document.getElementById('qrcodeField').value = (Math.random() + 1).toString(36).substring(2);
        }
    </script>
@endpush
<x-app title="Cadastrar Ambiente" :back="request()->get('back') ?? route('places.index')">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'places.create']) </x-slot>

    <form action="{{ route('places.store') }}" method="post">
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
            label="Unidade"
            icon="buildings-fill"
            placeholder="Selecione em qual Unidade este Ambiente está"
            name="unity_id"
            :selectedValue="old('unity_id') ?? request()->get('unity')"
            :options="$unityOptions" />

        <input class="btn btn-success w-100 mt-4" type="submit" value="Cadastrar">
    </form>
</x-app>

