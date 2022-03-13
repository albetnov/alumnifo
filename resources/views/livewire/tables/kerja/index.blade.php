@section('title', 'Table Kerja')
<div>
    <div class="card shadow">
        <div class="card-header">
            Table Kerja
            <div>
                <button class="btn btn-sm btn-primary"
                    onclick="location.href='{{ route('table.kerja.add') }}'">Create</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Nama Perusahaan</th>
                            <th>Jabatan</th>
                            <th>Tahun Kerja</th>
                            <th colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kerjas as $kerja)
                            <tr>
                                <td>{{ !isset($no) ? ($no = 1) : ++$no }}</td>
                                <td>{{ $kerja->name }}</td>
                                <td>{{ $kerja->jenis_kelamin == 'l' ? 'Pria' : 'Perempuan' }}</td>
                                <td>{{ $kerja->nama_perusahaan }}</td>
                                <td>{{ $kerja->jabatan }}</td>
                                <td>{{ $kerja->tahun_kerja }}</td>
                                <td><button class="btn btn-sm btn-info" wire:click='openImg({{ $kerja->id }})'
                                        wire:key='open-img-modal-{{ $kerja->id }}'><i class="fa-solid fa-image"
                                            data-toggle="modal" data-target="#imgPreview"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
        </div>
    </div>
</div>
