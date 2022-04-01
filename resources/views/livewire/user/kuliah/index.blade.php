<div>
    <!--Body-->
    <section wire:ignore id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1 class="mb-4 pb-0">Alumni Berstatus<span> Kuliah</span></h1>
            <p class="text-muted">Daftar dari Alumni yang berstatus sedang kuliah</p>
        </div>
    </section>


    <main id="main">

        <section class="m-3 mb-3">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="section-header">
                    <h2>Daftar Alumni yang sedang kuliah</h2>
                    @include('livewire.tables.filter', [
                        'btnContent' => 'Filter by Date',
                        'class' => 'btn btn-danger mb-1',
                    ])
                    <input type="search" class="form-control" placeholder="Search" name="search" id="search"
                        {!! wireModel('search') !!}>
                </div>

                <div class="row row-cols-3">
                    @foreach ($collages as $collage)
                        <div class="col">
                            <div class="card shadow m-3" style="width: 18rem;">
                                @if ($collage->gambar)
                                    <img src="{{ asset('storage/kuliah/' . $collage->gambar) }}"
                                        style="max-height:12rem" class="card-img-top" alt="placeholder">
                                @else
                                    <img src="https://via.placeholder.com/150/000000/FFFFFF/?text=No Image"
                                        style="max-height:12rem" alt="no-image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $collage->name }}</h5>
                                    <p class="card-text">
                                    <ul>
                                        <li>Jenis Kelamin:
                                            {{ $collage->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan' }}</li>
                                        <li>Nama Universitas: {{ $collage->nama_universitas }}</li>
                                        <li>Jurusan: {{ $collage->jurusan }}</li>
                                        <li>Didaftarkan: {{ $collage->created_at }}</li>
                                        <li>Di daftarkan oleh: {{ $collage->dibuat }}</li>
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
                {{ $collages->withQueryString()->links() }}
            </div>

        </section>

    </main>

    <!--End Body-->
</div>
