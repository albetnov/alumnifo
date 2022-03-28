<div>
    <!--Body-->
    <section wire:ignore id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1 class="mb-4 pb-0">Table<span> Kerja</span></h1>
        </div>
    </section>


    <main id="main">

        <section class="m-3 mb-3">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="section-header">
                    <h2>Daftar Alumni yang sedang berkerja</h2>
                    <input type="search" class="form-control" placeholder="Search" name="search" id="search"
                        {!! wireModel('search') !!}>
                </div>

                <div class="row row-cols-3">
                    @foreach ($kerjas as $kerja)
                        <div class="col">
                            <div class="card shadow m-3" style="width: 18rem;">
                                @if ($kerja->gambar)
                                    <img src="{{ asset('storage/kerja/' . $kerja->gambar) }}" style="max-height:12rem"
                                        class="card-img-top" alt="placeholder">
                                @else
                                    <img src="https://via.placeholder.com/150/000000/FFFFFF/?text=No Image"
                                        style="max-height:12rem" alt="no-image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $kerja->name }}</h5>
                                    <p class="card-text">
                                    <ul>
                                        <li>Jenis Kelamin:
                                            {{ $kerja->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan' }}</li>
                                        <li>Nama Perusahaan: {{ $kerja->nama_perusahaan }}</li>
                                        <li>Jabatan: {{ $kerja->jabatan }}</li>
                                        <li>Tahun Kerja: {{ $kerja->tahun_kerja }}</li>
                                        <li>Di tambahkan oleh: {{ $kerja->dibuat }}</li>
                                    </ul>
                                    </p>
                                    <div class="btn-group dropup">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="visually-hidden">Toggle Action</span> Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">Request Edit</a></li>
                                            <li><a class="dropdown-item" href="#">Request Delete</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $kerjas->withQueryString()->links() }}
            </div>

        </section>

        <section wire:ignore id="about">
            <div class="container" data-aos="fade-up">
                <div class="row">
                    <div class="col-lg-6">
                        <h2>About SisinfoAlumni</h2>
                        <p>SMK Multistudi High School is a vocational education institution that was founded in 2007
                            with a focus on innovation, achievement and noble character. Through innovation, MHS
                            Vocational High School implements and mixes a vocational
                            education system that best suits the needs of today's world of work, requiring students
                            to
                            be proactive and become pioneers for development. SMK MHS also focuses on the learning
                            process on the mental and spiritual formation
                            of its students so that they have noble character and behavior. With a vision to become
                            a
                            modern school with a global perspective and personality supported by Human Resources and
                            complete infrastructure, MHS is ready to give
                            birth to a generation that is reliable and capable of facing a better future.
                        </p>
                    </div>
                    <div class="col-lg-3">
                        <h3>Where</h3>
                        <p>Gedong Gapuro JL. Kuda Laut Kav.121 Batuampar Batam 2945</p>
                    </div>
                    <div class="col-lg-3">
                        <h3>When</h3>
                        <p>Monday to Wednesday<br>10-12 December</p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!--End Body-->
</div>
