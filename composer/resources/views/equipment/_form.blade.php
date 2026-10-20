@csrf

<div class="mb-3">
    <label for="name" class="form-label">Název</label>
    <div class="input-group has-validation">
        <span class="input-group-text"><i class="bi bi-tag"></i></span>
        <input type="text" id="name" name="name" value="{{ old('name', $equipment->name) }}"
               placeholder="např. Vrtačka Bosch GSB 18V"
               class="form-control @error('name') is-invalid @enderror">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mb-3">
    <label for="inventory_number" class="form-label">Evidenční číslo</label>
    <div class="input-group has-validation">
        <span class="input-group-text"><i class="bi bi-hash"></i></span>
        <input type="text" id="inventory_number" name="inventory_number"
               value="{{ old('inventory_number', $equipment->inventory_number) }}"
               placeholder="např. NAR-005"
               class="form-control @error('inventory_number') is-invalid @enderror">
        @error('inventory_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="status" class="form-label">Stav</label>
        <div class="input-group has-validation">
            <span class="input-group-text"><i class="bi bi-activity"></i></span>
            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                @foreach (\App\Enums\EquipmentStatus::cases() as $s)
                    <option value="{{ $s->value }}"
                        @selected(old('status', $equipment->status?->value) === $s->value)>{{ $s->label() }}</option>
                @endforeach
            </select>
            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label for="purchased_at" class="form-label">Datum nákupu</label>
        <div class="input-group has-validation">
            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
            <input type="date" id="purchased_at" name="purchased_at"
                   value="{{ old('purchased_at', $equipment->purchased_at?->format('Y-m-d')) }}"
                   class="form-control @error('purchased_at') is-invalid @enderror">
            @error('purchased_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

<div class="d-flex gap-2 mt-2">
    <button class="btn btn-primary d-inline-flex align-items-center gap-1">
        <i class="bi bi-check-lg"></i> Uložit
    </button>
    <a href="{{ route('equipment.index') }}" class="btn btn-outline-secondary">Zrušit</a>
</div>
