@section('title', 'Edit Data Kerja')
<div>
    <div class="card">
        <div class="card-header">
            Edit Data Kerja
        </div>
        <div class="card-body">
            <form wire:submit.prevent='update' enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama: </label>
                    <input type="text"
                        class="form-control @error('name') is-invalid @elseif($name != '') is-valid @enderror"
                        name="name" {!! wireModel('name') !!}>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jk">Jenis Kelamin: </label>
                    <select
                        class="form-control @error('jenis_kelamin') is-invalid @elseif($jenis_kelamin != '') is-valid @enderror"
                        name="jenis_kelamin" {!! wireModel('jenis_kelamin') !!}>
                        <option value="">-</option>
                        <option value="l">Pria</option>
                        <option value="p">Wanita</option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="np">Nama Perusahaan: </label>
                    <input type="text"
                        class="form-control @error('nama_perusahaan') is-invalid @elseif($nama_perusahaan != '') is-valid @enderror"
                        name="nama_perusahaan" {!! wireModel('nama_perusahaan') !!}>
                    @error('nama_perusahaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan: </label>
                    <input type="text"
                        class="form-control @error('jabatan') is-invalid @elseif($jabatan != '') is-valid @enderror"
                        name="jabatan" {!! wireModel('jabatan') !!}>
                    @error('jabatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tk">Tahun Kerja: </label>
                    <input type="number" min="2000" value="2000"
                        class="form-control @error('tahun_kerja') is-invalid @elseif($tahun_kerja != '') is-valid @enderror"
                        name="tahun_kerja" {!! wireModel('tahun_kerja') !!}>
                    @error('tahun_kerja')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" name="gambar"
                        class="form-control @error('gambar') is-invalid @elseif($gambar != '') is-valid @enderror"
                        {!! wireModel('gambar') !!} wire:loading.remove wire:target="gambar">
                    <div class="alert alert-primary shadow text-light" wire:loading wire:target="gambar">Uploading...
                    </div>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if ($gambarUpdated)
                        <p>Preview:</p>
                        <img src="{{ $gambar->temporaryUrl() }}" alt="preview">
                    @else
                        <p>Current:</p>
                        <img src="{{ asset('storage/kerja/' . $gambar) }}" alt="current">
                    @endif
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                <button class="btn btn-sm btn-secondary" type="button"
                    onclick="location.href='{{ route('table.kerja.index') }}'">Back</button>
            </form>
        </div>
    </div>
</div>
