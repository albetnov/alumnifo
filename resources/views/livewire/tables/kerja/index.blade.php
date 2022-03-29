@section('title', 'Table Kerja')
<div>
    <div class="card shadow">
        <div class="card-header">
            Table Kerja
            <div>
                <button class="btn btn-sm btn-primary"
                    onclick="location.href='{{ route('table.kerja.add') }}'">Create</button>
                @include('livewire.tables.filter')
                @include('livewire.tables.search')
                @include('livewire.tables.bulkdelete')
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
                            <th>Nama Perusahaan</th>
                            <th>Jabatan</th>
                            <th>Tahun Kerja</th>
                            <th>Dibuat oleh</th>
                            <td>Terdaftar</td>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kerjas as $kerja)
                            <tr>
                                <form wire:submit.prevent>
                                    <td class="text-center"><input type="checkbox" name="items" wire:model='items'
                                            value="{{ $kerja->id }}" wire:key='select-{{ $kerja->id }}'></td>
                                </form>
                                <td>{{ ($kerjas->currentpage() - 1) * $kerjas->perpage() + $loop->index + 1 }}</td>
                                <td>{{ $kerja->name }}</td>
                                <td>{{ $kerja->jenis_kelamin == 'l' ? 'Pria' : 'Perempuan' }}</td>
                                <td>{{ $kerja->nama_perusahaan }}</td>
                                <td>{{ $kerja->jabatan }}</td>
                                <td>{{ $kerja->tahun_kerja }}</td>
                                <td>{{ $kerja->dibuat }}</td>
                                <td>{{ $kerja->created_at }}</td>
                                @if ($kerja->gambar)
                                    <td class="text-center"><button class="btn btn-sm btn-info"
                                            wire:click='openImg({{ $kerja->id }})'
                                            wire:key='open-img-modal-{{ $kerja->id }}'><i
                                                class="fa-solid fa-image"></i></button></td>
                                @else
                                    <td class="text-center"> <button class="btn btn-sm btn-secondary" disabled><i
                                                class="fa-solid fa-image"></i></button>
                                    </td>
                                @endif
                                <td class="text-center"><button class="btn btn-sm btn-primary"
                                        onclick="location.href='{{ route('table.kerja.edit', $kerja->slug) }}'"><i
                                            class="fas fa-pen"></i></button></td>
                                <td class="text-center"><button class="btn btn-sm btn-danger"
                                        wire:click='openDelete({{ $kerja->id }})'
                                        wire:key='open-delete-modal-{{ $kerja->id }}'><i
                                            class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $kerjas->withQueryString()->links() }}
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
                                <img src="{{ asset('storage/kerja/' . $imgPreview) }}" class="img-fluid">
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
