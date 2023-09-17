<x-app title="Ambientes Cadastrados">
    <x-slot name="rightBodySection"> @include ('components.partials.admin.menu', ['selected' => 'places.index']) </x-slot>

    @if ($places->isEmpty())
        <p class="lead text-center">Nenhum Ambiente Cadastrado</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="fw-bold">
                    <th>Nome</th>
                    <th>Unidade</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($places as $place)
                        <tr onclick="location.assign('{{ route('admin.places.show', $place->id) }}')">
                            <td>{{ $place->name }}</td>
                            <td>{{ $place->unity->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="actions">
        <a class="btn btn-primary rounded-circle p-1" href="{{ route('admin.places.create') }}" style="width: 42px; height: 42px;">
            <i class="bi bi-plus-lg align-middle fs-5"></i>
        </a>
    </div>
</x-app>

