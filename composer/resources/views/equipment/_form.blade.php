@csrf
<div class="mb-3">
    <label class="form-label">Název</label>
    <input type="text" name="name" value="{{ old('name', $equipment->name) }}"
           class="form-control @error('name') is-invalid @enderror">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Evidenční číslo</label>
    <input type="text" name="inventory_number" value="{{ old('inventory_number', $equipment->inventory_number) }}"
           class="form-control @error('inventory_number') is-invalid @enderror">
    @error('inventory_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Stav</label>
    <select name="status" class="form-select @error('status') is-invalid @enderror">
        @foreach (\App\Enums\EquipmentStatus::cases() as $s)
            <option value="{{ $s->value }}"
                @selected(old('status', $equipment->status?->value) === $s->value)>{{ $s->label() }}</option>
        @endforeach
    </select>
    @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
    <label class="form-label">Datum nákupu</label>
    <input type="date" name="purchased_at" value="{{ old('purchased_at', $equipment->purchased_at?->format('Y-m-d')) }}"
           class="form-control @error('purchased_at') is-invalid @enderror">
    @error('purchased_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<button class="btn btn-primary">Uložit</button>
<a href="{{ route('equipment.index') }}" class="btn btn-link">Zpět</a>
