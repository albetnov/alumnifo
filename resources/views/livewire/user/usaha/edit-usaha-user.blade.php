<div>
    <main id="main" style="margin-top:10em">

        <section class="m-3 mb-3 vh-100 d-flex align-items-center justify-content-center">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="section-header">
                    <h4 class="text-center">Fomulir Alumni yang sedang membuka usaha</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        Edit Data Membuka Usaha
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
                                    <label for="jenis_usaha">Jenis Usaha: </label>
                                    <input type="text"
                                        class="form-control @error('jenis_usaha') is-invalid @elseif($jenis_usaha != '') is-valid @enderror"
                                        name="jenis_usaha" {!! wireModel('jenis_usaha') !!}>
                                    @error('jenis_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="alamat_usaha">Alamat Usaha: </label>
                                    <input type="text"
                                        class="form-control @error('alamat_usaha') is-invalid @elseif($alamat_usaha != '') is-valid @enderror"
                                        name="alamat_usaha" {!! wireModel('alamat_usaha') !!}>
                                    @error('alamat_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="tahun_usaha">Tahun Usaha: </label>
                                    <input type="text"
                                        class="form-control @error('tahun_usaha') is-invalid @elseif($tahun_usaha != '') is-valid @enderror"
                                        name="tahun_usaha" {!! wireModel('tahun_usaha') !!}>
                                    @error('tahun_usaha')
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
                                            <img src="{{ asset('storage/usaha/' . $gambar) }}" alt="preview"
                                                width="300">
                                        @else
                                            <p>Tidak ada gambar</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary" type="submit">Create</button>
                            <button class="btn btn-sm btn-secondary" type="button"
                                onclick="location.href='{{ route('user.usaha') }}'">Back</button>
                        </form>
                    </div>
                </div>
        </section>

    </main>

    <!--End Body-->
</div>
