@section('title', 'Table Usaha')
<div>
    <div class="card shadow">
        <div class="card-header">
            Table Usaha
            <div>
                <button class="btn btn-sm btn-primary"
                    onclick="location.href='{{ route('table.usaha.add') }}'">Create</button>
                @include('livewire.tables.filter')
                @include('livewire.tables.search')
                @include('livewire.tables.bulkdelete')
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-center">
                        <tr>
                            <th>Select</th>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Jenis Usaha</th>
                            <th>Alamat Usaha</th>
                            <th>Tahun Mulai Usaha</th>
                            <th>Dibuat oleh</th>
                            <th>Terdaftar</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($dataUsaha as $usaha)
                            <tr>
                                <form wire:submit.prevent>
                                    <td class="text-center"><input type="checkbox" name="items" wire:model='items'
                                            value="{{ $usaha->id }}" wire:key='select-{{ $usaha->id }}'></td>
                                </form>
                                <td>{{ ($dataUsaha->currentpage() - 1) * $dataUsaha->perpage() + $loop->index + 1 }}
                                </td>
                                <td>{{ $usaha->name }}</td>
                                <td>{{ $usaha->jenis_kelamin == 'l' ? 'Pria' : 'Wanita' }}</td>
                                <td>{{ $usaha->jenis_usaha }}</td>
                                <td>{{ $usaha->alamat_usaha }}</td>
                                <td>{{ $usaha->tahun_usaha }}</td>
                                <td>{{ $usaha->dibuat }}</td>
                                <td>{{ $usaha->created_at->diffForHumans() }}</td>
                                @if ($usaha->gambar)
                                    <td class="text-center"><button class="btn btn-sm btn-info"
                                            wire:click='openImg({{ $usaha->id }})'
                                            wire:key='open-img-modal-{{ $usaha->id }}'><i
                                                class="fa-solid fa-image"></i></button></td>
                                @else
                                    <td class="text-center"> <button class="btn btn-sm btn-secondary" disabled><i
                                                class="fa-solid fa-image"></i></button>
                                    </td>
                                @endif
                                <td class="text-center"><button class="btn btn-sm btn-primary"
                                        onclick="location.href='{{ route('table.usaha.edit', $usaha->slug) }}'"><i
                                            class="fas fa-pen"></i></button></td>
                                <td class="text-center"><button class="btn btn-sm btn-danger"
                                        wire:click='openDelete({{ $usaha->id }})'
                                        wire:key='open-delete-modal-{{ $usaha->id }}'><i
                                            class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $dataUsaha->withQueryString()->links() }}
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
                                <img src="{{ asset('storage/usaha/' . $imgPreview) }}" class="img-fluid">
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
