@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">Zařízení</h1>
        <a href="{{ route('equipment.create') }}" class="btn btn-primary">+ Nové zařízení</a>
    </div>

    <div class="btn-group mb-3">
        <a href="{{ route('equipment.index') }}" class="btn btn-outline-dark {{ $status ? '' : 'active' }}">Vše</a>
        @foreach (\App\Enums\EquipmentStatus::cases() as $s)
            <a href="{{ route('equipment.index', ['status' => $s->value]) }}"
               class="btn btn-outline-{{ $s->color() }} {{ $status === $s ? 'active' : '' }}">{{ $s->label() }}</a>
        @endforeach
    </div>

    <div class="card">
        <table class="table table-hover m-0 align-middle">
            <thead>
            <tr>
                <th>Ev. číslo</th><th>Název</th><th>Stav</th><th>Nákup</th>
                <th class="text-end">Náklady na servis</th><th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($equipment as $item)
                <tr>
                    <td>{{ $item->inventory_number }}</td>
                    <td><a href="{{ route('equipment.show', $item) }}">{{ $item->name }}</a></td>
                    <td>@include('equipment._status-badge', ['status' => $item->status])</td>
                    <td>{{ $item->purchased_at->format('d.m.Y') }}</td>
                    <td class="text-end">{{ number_format($item->total_cost ?? 0, 2, ',', ' ') }} Kč</td>
                    <td class="text-end">
                        <a href="{{ route('equipment.edit', $item) }}" class="btn btn-sm btn-outline-secondary">Upravit</a>
                        <form action="{{ route('equipment.destroy', $item) }}" method="post" class="d-inline"
                              onsubmit="return confirm('Opravdu smazat?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Smazat</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-muted py-4">Žádná zařízení.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $equipment->links() }}</div>
@endsection
