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
                        <tr>
                            @foreach ($kerjas as $kerja)
                                <td>{{ !isset($no) ? ($no = 0) : ++$no }}</td>
                                <td>{{ $kerja->name }}</td>
                                <td>{{ $kerja->jenis_kelamin == 'l' ? 'Pria' : 'Perempuan' }}</td>
                                <td>{{ $kerja->nama_perusahan }}</td>
                                <td>{{ $kerja->jabatan }}</td>
                                <td>{{ $kerja->tahun_kerja }}</td>
                                <td><button class="btn btn-sm btn-info"><i class="fa-solid fa-image"></i></button></td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
