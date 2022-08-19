<div>
    <main id="main" style="margin-top:10em">

        <section class="m-3 mb-3 vh-100 d-flex align-items-center justify-content-center">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="section-header">
                    <h4 class="text-center">Fomulir Alumni yang sedang mencari kerja</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        Edit Data Mencari Kerja
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent='update' enctype="multipart/form-data">
                            <div class="row row-cols-2">
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="nama">Nama: </label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @elseif($name != '') is-valid @enderror"
                                        name="name" {!! wireModel('name') !!}>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
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
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="alamat">Alamat: </label>
                                    <input type="text"
                                        class="form-control @error('alamat') is-invalid @elseif($alamat != '') is-valid @enderror"
                                        name="alamat" {!! wireModel('alamat') !!}>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="alasan_mencari_kerja">Alasan Mencari Kerja: </label>
                                    <input type="text"
                                        class="form-control @error('alasan_mencari_kerja') is-invalid @elseif($alasan_mencari_kerja != '') is-valid @enderror"
                                        name="alasan_mencari_kerja" {!! wireModel('alasan_mencari_kerja') !!}>
                                    @error('alasan_mencari_kerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="kontak">Nomor Kontak: </label>
                                    <input type="text"
                                        class="form-control @error('kontak') is-invalid @elseif($kontak != '') is-valid @enderror"
                                        name="kontak" {!! wireModel('kontak') !!}>
                                    @error('kontak')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" name="gambar"
                                        class="form-control @error('gambar') is-invalid @elseif($gambar != '') is-valid @enderror"
                                        {!! wireModel('gambar') !!} wire:loading.remove wire:target="gambar">
                                    <div class="alert alert-primary shadow text-light" wire:loading
                                        wire:target="gambar">Uploading...
                                    </div>
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    @if ($gambarUpdated)
                                        <p>Preview:</p>
                                        <img src="{{ $gambar->temporaryUrl() }}" width="300" alt="preview">
                                    @else
                                        <p>Current:</p>
                                        @if ($gambar)
                                            <img src="{{ asset('storage/mencarikerja/' . $gambar) }}" alt="preview"
                                                width="300">
                                        @else
                                            <p>Tidak ada gambar</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary" type="submit">Create</button>
                            <button class="btn btn-sm btn-secondary" type="button"
                                onclick="location.href='{{ route('user.mencarikerja') }}'">Back</button>
                        </form>
                    </div>
                </div>
        </section>

    </main>

    <!--End Body-->
</div>
