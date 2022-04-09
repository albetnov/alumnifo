<div class="form-group">
    <label>Dari</label>
    <input type="number" placeholder="2000" name="from" wire:model.lazy='from'
        class="form-control @error('from') is-invalid @enderror">
    @error('from')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label>Ke</label>
    <input type="number" placeholder="2001" name="to" wire:model.lazy='to'
        class="form-control @error('to') is-invalid @enderror">
    @error('to')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
