@section('title', 'Table Kuliah')
<div>
    <div class="card shadow">
        <div class="card-header">
            Table Kuliah
            <div>
                <button class="btn btn-sm btn-primary"
                    onclick="location.href='{{ route('table.kuliah.add') }}'">Create</button>
                @include('livewire.tables.filter')
                @include('livewire.tables.search')
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
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger shadow text-light">SEMUA DATA TABEL KULIAH AKAN
                                        DIHAPUS. DATA
                                        TIDAK AKAN BISA DIPULIHKAN KEMBALI BILA KAMU MENGHAPUSNYA.</div>
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
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Select</th>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Universitas</th>
                            <th>Jurusan</th>
                            <th>Dibuat oleh</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kuliahs as $kuliah)
                            <tr>
                                <form wire:submit.prevent>
                                    <td class="text-center"><input type="checkbox" name="items" wire:model='items'
                                            value="{{ $kuliah->id }}" wire:key='select-{{ $kuliah->id }}'></td>
                                </form>
                                <td>{{ ($kuliahs->currentpage() - 1) * $kuliahs->perpage() + $loop->index + 1 }}</td>
                                <td>{{ $kuliah->name }}</td>
                                <td>{{ $kuliah->jenis_kelamin == 'l' ? 'Pria' : 'Wanita' }}</td>
                                <td>{{ $kuliah->nama_universitas }}</td>
                                <td>{{ $kuliah->jurusan }}</td>
                                <td>{{ $kuliah->dibuat }}</td>
                                <td>{{ $kuliah->created_at }}</td>
                                @if ($kuliah->gambar)
                                    <td class="text-center"><button class="btn btn-sm btn-info"
                                            wire:click='openImg({{ $kuliah->id }})'
                                            wire:key='open-img-modal-{{ $kuliah->id }}'><i
                                                class="fa-solid fa-image"></i></button></td>
                                @else
                                    <td class="text-center"> <button class="btn btn-sm btn-secondary" disabled><i
                                                class="fa-solid fa-image"></i></button>
                                    </td>
                                @endif
                                <td class="text-center"><button class="btn btn-sm btn-primary"
                                        onclick="location.href='{{ route('table.kuliah.edit', $kuliah->slug) }}'"><i
                                            class="fas fa-pen"></i></button></td>
                                <td class="text-center"><button class="btn btn-sm btn-danger"
                                        wire:click='openDelete({{ $kuliah->id }})'
                                        wire:key='open-delete-modal-{{ $kuliah->id }}'><i
                                            class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kuliahs->withQueryString()->links() }}
            </div>

            @if ($imgPreview)
                <div class="modal fade" wire:key='open-img-modal' id="imgPreview" tabindex="-1"
                    aria-labelledby="imgPreviewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imgPreviewLabel">Image Preview, {{ $name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset('storage/kuliah/' . $imgPreview) }}" class="img-fluid">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($deleteOpened)
                <div class="modal fade" wire:key='open-delete-modal' id="deletePreview" tabindex="-1"
                    aria-labelledby="deletePreviewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePreviewLabel">Hapus Data?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Yakin hapus data, {{ $name }} ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form wire:submit.prevent='deleteData()'>
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"><i
                                            class="fa-solid fa-trash"></i> Delete It!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
