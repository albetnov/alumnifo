@section('title', 'Table Edit Data Request')
<div>
    <div class="card shadow">
        <div class="card-header">
            Table Edit Data Request
            <div>
                @include('livewire.tables.filter', [
                    'custom' => 'livewire.request.filter',
                ])
                @include('livewire.tables.search')
                @include('livewire.tables.bulkdelete')

                <div class="alert alert-warning text-light m-2">Tindakan tidak dapat di kembalikan ke semula.</div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Select</th>
                            <th>No.</th>
                            <th>Tipe Tabel</th>
                            <th class="text-center">Status</th>
                            <th>Di buat oleh</th>
                            <th>Di urus oleh</th>
                            <th>Terdaftar</th>
                            <th>Terakhir diperbarui</th>
                            <th colspan="4" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <form wire:submit.prevent>
                                    <td class="text-center"><input type="checkbox" name="items" wire:model='items'
                                            value="{{ $request->id }}" wire:key='select-{{ $request->id }}'></td>
                                </form>
                                <td>{{ ($requests->currentpage() - 1) * $requests->perpage() + $loop->index + 1 }}
                                </td>
                                <td>{{ $request->table_type }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill bg-info"> {{ $request->status }}</span>
                                </td>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->handled_by ?? 'Belum Ada' }}</td>
                                <td>{{ $request->created_at->diffForHumans() }}</td>
                                <td>{{ $request->updated_at->diffForHumans() }}</td>
                                @if ($request->status == 'pending')
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm"
                                            wire:click="approve({{ $request->id }})"
                                            wire-key="approve-{{ $request->id }}"><i
                                                class="fa-solid fa-check"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-secondary btn-sm"
                                            wire:click="decline({{ $request->id }})"
                                            wire-key="decline-{{ $request->id }}"><i
                                                class="fa-solid fa-times"></i></button>
                                    </td>
                                    <td class="text-center"><button class="btn btn-info btn-sm"
                                            wire:click="openDetails({{ $request->id }})"
                                            wire:key='open-details-modal{{ $request->id }}'><i
                                                class="fa-solid fa-eye"></i></button></td>
                                @else
                                    <td class="text-center">
                                        <button class="btn btn-success btn-sm" disabled><i
                                                class="fa-solid fa-check"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-secondary btn-sm" disabled><i
                                                class="fa-solid fa-times"></i></button>
                                    </td>
                                    <td class="text-center"><button class="btn btn-info btn-sm" disabled><i
                                                class="fa-solid fa-eye"></i></button></td>
                                @endif
                                <td class="text-center"><button class="btn btn-sm btn-danger"
                                        wire:click='openDelete({{ $request->id }})'
                                        wire:key='open-delete-modal-{{ $request->id }}'><i
                                            class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $requests->withQueryString()->links() }}
            </div>

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
            @if ($detailsOpened)
                <div class="modal fade" wire:key='open-details-modal' id="detailsPreview" tabindex="-1"
                    aria-labelledby="detailsPreviewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePreviewLabel">Details, {{ $modelQuery->name }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-warning text-light">
                                    <strong>{{ strtoupper($tableType) }}</strong>
                                </div>
                                <div class="form-group">
                                    <label>Nama:</label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $modelQuery->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin:</label>
                                    <input type="text"
                                        value="{{ $modelQuery->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan' }}"
                                        disabled class="form-control">
                                    </select>
                                </div>
                                @if ($tableType == 'kerja')
                                    <div class="form-group">
                                        <label>Nama Perusahaan:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->nama_perusahaan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->jabatan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Kerja:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->tahun_kerja }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Dibuat:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->dibuat }}">
                                    </div>
                                    @if ($modelQuery->gambar)
                                        <div class="form-group">
                                            <img src="{{ asset('storage/kerja/' . $modelQuery->gambar) }}"
                                                style="max-width:300px;max-height:300px">
                                        </div>
                                    @endif
                                @elseif($tableType == 'kuliah')
                                    <div class="form-group">
                                        <label>Nama Universitas:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->nama_universitas }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jurusan:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->jurusan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Dibuat:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->dibuat }}">
                                    </div>
                                    @if ($modelQuery->gambar)
                                        <div class="form-group">
                                            <img src="{{ asset('storage/kerja/' . $modelQuery->gambar) }}"
                                                style="max-width:300px;max-height:300px">
                                        </div>
                                    @endif
                                @elseif($tableType == 'kerjakuliah')
                                    <div class="form-group">
                                        <label>Nama Universitas:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->nama_universitas }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jurusan:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->jurusan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Perusahaan:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->nama_perusahaan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->jabatan }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Kerja:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->tahun_kerja }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Dibuat:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->dibuat }}">
                                    </div>
                                    @if ($modelQuery->gambar)
                                        <div class="form-group">
                                            <img src="{{ asset('storage/kerja/' . $modelQuery->gambar) }}"
                                                style="max-width:300px;max-height:300px">
                                        </div>
                                    @endif
                                @elseif($tableType == 'mencarikerja')
                                    <div class="form-group">
                                        <label>Alasan mencari kerja:</label>
                                        <textarea class="form-control" cols="30" rows="10" disabled>{{ $modelQuery->alasan_mencari_kerja }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Kontak:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->kontak }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->alamat }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Dibuat:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->dibuat }}">
                                    </div>
                                    @if ($modelQuery->gambar)
                                        <div class="form-group">
                                            <img src="{{ asset('storage/kerja/' . $modelQuery->gambar) }}"
                                                style="max-width:300px;max-height:300px">
                                        </div>
                                    @endif
                                @else
                                    <div class="form-group">
                                        <label>Jenis Usaha:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->jenis_usaha }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat Usaha:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->alamat_usaha }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Usaha:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->tahun_usaha }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Dibuat:</label>
                                        <input type="text" class="form-control" disabled
                                            value="{{ $modelQuery->dibuat }}">
                                    </div>
                                    @if ($modelQuery->gambar)
                                        <div class="form-group">
                                            <img src="{{ asset('storage/kerja/' . $modelQuery->gambar) }}"
                                                style="max-width:300px;max-height:300px">
                                        </div>
                                    @endif
                                @endif
                                Didaftarkan saat: {{ $modelQuery->created_at->diffForHumans() }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
