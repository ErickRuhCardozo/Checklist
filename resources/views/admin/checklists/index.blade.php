<x-app title="Checklists">
     <x-slot name="rightBodySection"> @include('components.partials.admin.menu', ['selected' => 'checklists.index']) </x-slot>

    @if ($checklists->isEmpty())
        <p class="lead text-center">Nenhum Checklist Feito Ainda</p>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="fw-bold">
                    <th>@sortablelink('user.name', 'Usuário')</th>
                    <th>@sortablelink('created_at', 'Data')</th>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($checklists as $checklist)
                        <tr onclick="location.assign('{{ route('admin.checklists.show', $checklist->id) }}')">
                            <td>{{ $checklist->user->name }}</td>
                            <td>{{ Str::title($checklist->created_at->translatedFormat('l, d/m/Y')) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-app>

