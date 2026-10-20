@extends('layouts.app')

@section('title', 'Zařízení | Evidence techniky')

@section('content')
    @php
        $icons = [
            'active' => 'bi-check-circle',
            'service' => 'bi-wrench-adjustable',
            'retired' => 'bi-archive',
        ];
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 page-title mb-1">Zařízení</h1>
            <div class="text-muted small">Přehled firemního nářadí a techniky</div>
        </div>
        <a href="{{ route('equipment.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-1">
            <i class="bi bi-plus-lg"></i> Nové zařízení
        </a>
    </div>

    {{-- Přehledové karty = filtr --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <a href="{{ route('equipment.index') }}" class="stat-card {{ $status ? '' : 'active' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="stat-label">Vše</div>
                        <div class="stat-value">{{ $totalCount }}</div>
                    </div>
                    <span class="stat-icon bg-primary-subtle text-primary-emphasis"><i class="bi bi-boxes"></i></span>
                </div>
            </a>
        </div>

        @foreach (\App\Enums\EquipmentStatus::cases() as $s)
            <div class="col-6 col-lg-3">
                <a href="{{ route('equipment.index', ['status' => $s->value]) }}"
                   class="stat-card {{ $status === $s ? 'active' : '' }}">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">{{ $s->label() }}</div>
                            <div class="stat-value">{{ $counts[$s->value] ?? 0 }}</div>
                        </div>
                        <span class="stat-icon bg-{{ $s->color() }}-subtle text-{{ $s->color() }}-emphasis">
                        <i class="bi {{ $icons[$s->value] }}"></i>
                    </span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead>
                <tr>
                    <th>Zařízení</th>
                    <th>Ev. číslo</th>
                    <th>Stav</th>
                    <th>Nákup</th>
                    <th class="text-end">Náklady na servis</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @forelse ($equipment as $item)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <span class="item-icon"><i class="bi bi-tools"></i></span>
                                <a href="{{ route('equipment.show', $item) }}"
                                   class="fw-semibold text-decoration-none text-dark stretched-link-none">
                                    {{ $item->name }}
                                </a>
                            </div>
                        </td>
                        <td><code class="text-body-secondary">{{ $item->inventory_number }}</code></td>
                        <td>@include('equipment._status-badge', ['status' => $item->status])</td>
                        <td class="text-muted">{{ $item->purchased_at->format('d.m.Y') }}</td>
                        <td class="text-end fw-semibold">{{ number_format($item->total_cost ?? 0, 2, ',', ' ') }} Kč</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('equipment.show', $item) }}" class="btn btn-icon btn-outline-secondary" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('equipment.edit', $item) }}" class="btn btn-icon btn-outline-secondary" title="Upravit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('equipment.destroy', $item) }}" method="post" class="d-inline"
                                  onsubmit="return confirm('Opravdu smazat zařízení včetně servisní historie?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-icon btn-outline-danger" title="Smazat">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <div class="mt-2">Žádná zařízení k zobrazení.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $equipment->links('pagination::bootstrap-5') }}
    </div>
@endsection
