<div>
    <main id="main" style="margin-top:10em">

        <section class="m-3 mb-3 vh-100 d-flex align-items-center justify-content-center">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="section-header">
                    <h4 class="text-center">Fomulir Alumni Bekerja</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        Edit Data Kerja
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
                                    <label for="np">Nama Perusahaan: </label>
                                    <input type="text"
                                        class="form-control @error('nama_perusahaan') is-invalid @elseif($nama_perusahaan != '') is-valid @enderror"
                                        name="nama_perusahaan" {!! wireModel('nama_perusahaan') !!}>
                                    @error('nama_perusahaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="jabatan">Jabatan: </label>
                                    <input type="text"
                                        class="form-control @error('jabatan') is-invalid @elseif($jabatan != '') is-valid @enderror"
                                        name="jabatan" {!! wireModel('jabatan') !!}>
                                    @error('jabatan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="tk">Tahun Kerja: </label>
                                    <input type="number" min="2000" value="2000"
                                        class="form-control @error('tahun_kerja') is-invalid @elseif($tahun_kerja != '') is-valid @enderror"
                                        name="tahun_kerja" {!! wireModel('tahun_kerja') !!}>
                                    @error('tahun_kerja')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" name="gambar"
                                        class="form-control @error('gambar') is-invalid @elseif($gambar != '') is-valid @enderror"
                                        {!! wireModel('gambar') !!} wire:loading.remove wire:target="gambar">
                                    <div class="alert alert-primary shadow text-light" wire:loading
                                        wire:target="gambar">
                                        Uploading...
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
                                            <img src="{{ asset('storage/kerja/' . $gambar) }}" alt="preview"
                                                width="300">
                                        @else
                                            <p>Tidak ada gambar</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                            <button class="btn btn-sm btn-secondary" type="button"
                                onclick="location.href='{{ route('user.kerja') }}'">Back</button>
                        </form>
                    </div>
                </div>
        </section>

    </main>

    <!--End Body-->
</div>
