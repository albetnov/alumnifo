@if ($bulkAction)
    <button class="btn btn-danger mt-2" wire:click='bulkDelete()'>Bulk Delete</button>
    <button class="btn btn-danger mt-2" wire:click="$emit('openModal', 'delAll')">Delete All
        Data</button>
    <div class="modal fade" wire:ignore.self wire:key='open-delall-modal' id="delAll" tabindex="-1"
        aria-labelledby="delAllLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delAllLabel">Delete All Data
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger shadow text-light">SEMUA DATA TABEL USERS AKAN
                        DIHAPUS. DATA
                        TIDAK AKAN BISA DIPULIHKAN KEMBALI BILA KAMU MENGHAPUSNYA. {{ $msg ?? '' }}
                    </div>
                    <p>Konfirmasi Sudo:</p>
                    <form wire:submit.prevent='enterSudo'>
                        <input type="password" name="password"
                            class="form-control @error('password') is-invalid @elseif($password != '') is-valid @enderror"
                            {!! wireModel('password') !!}>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button class="btn btn-sm btn-primary mt-1">Kirim</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif
