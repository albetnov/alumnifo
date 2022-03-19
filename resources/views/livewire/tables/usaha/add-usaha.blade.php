@section('title', 'Add Data Usaha')
<div>
    <div class="card">
        <div class="card-header">
            Add Data Usaha
        </div>
        <div class="card-body">
            <form wire:submit.prevent='store' enctype="multipart/form-data">
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
                    <label for="jenis_usaha">Jenis Usaha: </label>
                    <input type="text"
                        class="form-control @error('jenis_usaha') is-invalid @elseif($jenis_usaha != '') is-valid @enderror"
                        name="jenis_usaha" {!! wireModel('jenis_usaha') !!}>
                    @error('jenis_usaha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="alamat_usaha">Alamat Usaha: </label>
                    <input type="text"
                        class="form-control @error('alamat_usaha') is-invalid @elseif($alamat_usaha != '') is-valid @enderror"
                        name="alamat_usaha" {!! wireModel('alamat_usaha') !!}>
                    @error('alamat_usaha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tahun_usaha">Tahun Usaha: </label>
                    <input type="text"
                        class="form-control @error('tahun_usaha') is-invalid @elseif($tahun_usaha != '') is-valid @enderror"
                        name="tahun_usaha" {!! wireModel('tahun_usaha') !!}>
                    @error('tahun_usaha')
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

                    @if ($gambar)
                        <p>Preview:</p>
                        <img src="{{ $gambar->temporaryUrl() }}" alt="preview" width="300">
                    @endif
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Create</button>
                <button class="btn btn-sm btn-secondary" type="button"
                    onclick="location.href='{{ route('table.usaha.index') }}'">Back</button>
            </form>
        </div>
    </div>
</div>
