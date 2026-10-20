@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 m-0">
            {{ $equipment->name }}
            @include('equipment._status-badge', ['status' => $equipment->status])
        </h1>
        <a href="{{ route('equipment.edit', $equipment) }}" class="btn btn-outline-secondary">Upravit</a>
    </div>

    <div class="card card-body mb-4">
        <div class="row">
            <div class="col-md-4"><strong>Ev. číslo:</strong> {{ $equipment->inventory_number }}</div>
            <div class="col-md-4"><strong>Nákup:</strong> {{ $equipment->purchased_at->format('d.m.Y') }}</div>
            <div class="col-md-4"><strong>Náklady na servis celkem:</strong>
                {{ number_format($totalCost, 2, ',', ' ') }} Kč</div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <h2 class="h5">Servisní historie</h2>
            <div class="card">
                <table class="table m-0 align-middle">
                    <thead><tr><th>Datum</th><th>Popis</th><th class="text-end">Cena</th><th></th></tr></thead>
                    <tbody>
                    @forelse ($equipment->serviceRecords as $record)
                        <tr>
                            <td>{{ $record->serviced_at->format('d.m.Y') }}</td>
                            <td>{{ $record->description }}</td>
                            <td class="text-end">{{ number_format($record->cost, 2, ',', ' ') }} Kč</td>
                            <td class="text-end">
                                <form action="{{ route('service-records.destroy', $record) }}" method="post"
                                      onsubmit="return confirm('Smazat záznam?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">×</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-4">Zatím žádný servis.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-5">
            <h2 class="h5">Přidat servisní záznam</h2>
            <form method="post" action="{{ route('equipment.service-records.store', $equipment) }}" class="card card-body">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Popis</label>
                    <input type="text" name="description" value="{{ old('description') }}"
                           class="form-control @error('description') is-invalid @enderror">
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Datum servisu</label>
                    <input type="date" name="serviced_at" value="{{ old('serviced_at', now()->format('Y-m-d')) }}"
                           class="form-control @error('serviced_at') is-invalid @enderror">
                    @error('serviced_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Cena (Kč)</label>
                    <input type="number" step="0.01" min="0" name="cost" value="{{ old('cost', '0.00') }}"
                           class="form-control @error('cost') is-invalid @enderror">
                    @error('cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button class="btn btn-primary">Přidat</button>
            </form>
        </div>
    </div>

    <a href="{{ route('equipment.index') }}" class="btn btn-link mt-3">← Zpět na seznam</a>
@endsection
