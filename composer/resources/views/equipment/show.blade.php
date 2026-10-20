@extends('layouts.app')

@section('title', $equipment->name . ' | Evidence techniky')

@section('content')
    <a href="{{ route('equipment.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left"></i> Zpět na seznam
    </a>

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mt-2 mb-4">
        <div class="d-flex align-items-center gap-3">
            <span class="item-icon" style="width:52px;height:52px;font-size:1.4rem"><i class="bi bi-tools"></i></span>
            <div>
                <h1 class="h3 page-title mb-1">{{ $equipment->name }}</h1>
                @include('equipment._status-badge', ['status' => $equipment->status])
            </div>
        </div>
        <a href="{{ route('equipment.edit', $equipment) }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
            <i class="bi bi-pencil"></i> Upravit
        </a>
    </div>

    {{-- Základní informace --}}
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card card-body info-tile h-100">
                <div class="info-label">Evidenční číslo</div>
                <div class="info-value"><code class="fs-6">{{ $equipment->inventory_number }}</code></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body info-tile h-100">
                <div class="info-label">Datum nákupu</div>
                <div class="info-value">{{ $equipment->purchased_at->format('d.m.Y') }}</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-body info-tile h-100 bg-primary-subtle">
                <div class="info-label text-primary-emphasis">Náklady na servis celkem</div>
                <div class="info-value text-primary-emphasis">{{ number_format($totalCost, 2, ',', ' ') }} Kč</div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Servisní historie --}}
        <div class="col-lg-7">
            <div class="card overflow-hidden">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-clock-history me-1"></i> Servisní historie</span>
                    <span class="badge text-bg-light">{{ $equipment->serviceRecords->count() }}</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Popis</th>
                            <th class="text-end">Cena</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($equipment->serviceRecords as $record)
                            <tr>
                                <td class="text-muted text-nowrap">{{ $record->serviced_at->format('d.m.Y') }}</td>
                                <td>{{ $record->description }}</td>
                                <td class="text-end fw-semibold text-nowrap">{{ number_format($record->cost, 2, ',', ' ') }} Kč</td>
                                <td class="text-end">
                                    <form action="{{ route('service-records.destroy', $record) }}" method="post"
                                          onsubmit="return confirm('Smazat servisní záznam?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-icon btn-outline-danger" title="Smazat záznam">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="bi bi-wrench-adjustable"></i>
                                        <div class="mt-2">Zatím žádný servisní zásah.</div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Formulář pro nový servis --}}
        <div class="col-lg-5">
            <div class="card sticky-form">
                <div class="card-header"><i class="bi bi-plus-circle me-1"></i> Přidat servisní záznam</div>
                <form method="post" action="{{ route('equipment.service-records.store', $equipment) }}" class="card-body">
                    @csrf

                    <div class="mb-3">
                        <label for="description" class="form-label">Popis zásahu</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                            <input type="text" id="description" name="description" value="{{ old('description') }}"
                                   placeholder="např. Výměna uhlíků"
                                   class="form-control @error('description') is-invalid @enderror">
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="serviced_at" class="form-label">Datum servisu</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                            <input type="date" id="serviced_at" name="serviced_at"
                                   value="{{ old('serviced_at', now()->format('Y-m-d')) }}"
                                   class="form-control @error('serviced_at') is-invalid @enderror">
                            @error('serviced_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="cost" class="form-label">Cena</label>
                        <div class="input-group has-validation">
                            <input type="number" step="0.01" min="0" id="cost" name="cost" value="{{ old('cost', '0.00') }}"
                                   class="form-control @error('cost') is-invalid @enderror">
                            <span class="input-group-text">Kč</span>
                            @error('cost')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <button class="btn btn-primary w-100 d-inline-flex justify-content-center align-items-center gap-1">
                        <i class="bi bi-plus-lg"></i> Přidat záznam
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
