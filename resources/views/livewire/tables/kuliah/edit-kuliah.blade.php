@section('title', 'Edit Data Kuliah')
<div>
    <div class="card">
        <div class="card-header">
            Edit Data Kuliah
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
                    <label for="np">Nama Universitas: </label>
                    <input type="text"
                        class="form-control @error('nama_universitas') is-invalid @elseif($nama_universitas != '') is-valid @enderror"
                        name="nama_universitas" {!! wireModel('nama_universitas') !!}>
                    @error('nama_universitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jurusan">Jurusan: </label>
                    <input type="text"
                        class="form-control @error('jurusan') is-invalid @elseif($jurusan != '') is-valid @enderror"
                        name="jurusan" {!! wireModel('jurusan') !!}>
                    @error('jurusan')
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
                        <img src="{{ $gambar->temporaryUrl() }}" alt="preview" width="300">
                    @else
                        <p>Current:</p>
                        @if ($gambar)
                            <img src="{{ asset('storage/kuliah/' . $gambar) }}" alt="current">
                        @else
                            <p>Tidak ada gambar</p>
                        @endif
                    @endif
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                <button class="btn btn-sm btn-secondary" type="button"
                    onclick="location.href='{{ route('table.kuliah.index') }}'">Back</button>
            </form>
        </div>
    </div>
</div>
