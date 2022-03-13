<button class="btn btn-sm btn-secondary inline" data-bs-toggle="collapse" data-bs-target="#toggleFilter"
    aria-expanded="false" aria-controls="toggleFilter"><i class="fas fa-filter"></i></button>
<div wire:ignore.self class="collapse" id="toggleFilter">
    <div class="card card-body">
        @if ($filter)
            <button class="btn btn-sm btn-primary" wire:click='clearFilter()'><i class="fas fa-times"></i>
                Clear</button>
        @endif
        <form wire:submit.prevent class="inline">
            @if (isset($custom))
                @include($custom)
            @endif
            <div class="form-group">
                <label>Dari</label>
                <input type="date" name="from" wire:model.lazy='from'
                    class="form-control @error('from') is-invalid @enderror">
                @error('from')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label>Ke</label>
                <input type="date" name="to" wire:model.lazy='to'
                    class="form-control @error('to') is-invalid @enderror">
                @error('to')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </form>
    </div>
</div>
