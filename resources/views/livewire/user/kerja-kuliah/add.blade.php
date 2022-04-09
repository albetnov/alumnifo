<div>
    <main id="main" style="margin-top:10em">

        <section class="m-3 mb-3 vh-100 d-flex align-items-center justify-content-center">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="section-header">
                    <h4 class="text-center">Fomulir Alumni Bekerja dan Kuliah</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        Add Data Kerja Kuliah
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent='store' enctype="multipart/form-data">
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
                                    <label for="np">Nama Universitas: </label>
                                    <input type="text"
                                        class="form-control @error('nama_universitas') is-invalid @elseif($nama_universitas != '') is-valid @enderror"
                                        name="nama_universitas" {!! wireModel('nama_universitas') !!}>
                                    @error('nama_universitas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6 mb-3">
                                    <label for="jurusan">Jurusan: </label>
                                    <input type="text"
                                        class="form-control @error('jurusan') is-invalid @elseif($jurusan != '') is-valid @enderror"
                                        name="jurusan" {!! wireModel('jurusan') !!}>
                                    @error('jurusan')
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

                                    @if ($gambar)
                                        <p>Preview:</p>
                                        <img src="{{ $gambar->temporaryUrl() }}"
                                            style="max-width:300px;max-height:300px" alt="preview">
                                    @endif
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary" type="submit">Create</button>
                            <button class="btn btn-sm btn-secondary" type="button"
                                onclick="location.href='{{ route('user.kerjakuliah') }}'">Back</button>
                        </form>
                    </div>
                </div>
        </section>

    </main>

    <!--End Body-->
</div>
