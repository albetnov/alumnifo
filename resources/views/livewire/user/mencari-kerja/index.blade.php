<div>
    <!--Body-->
    <section wire:ignore id="hero">
        <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
            <h1 class="mb-4 pb-0">Alumni Berstatus<span> Mencari Kerja</span></h1>
            <p class="text-muted">Daftar dari Alumni yang berstatus sedang mencari kerja</p>
        </div>
    </section>


    <main id="main">

        <section class="m-3 mb-3">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="section-header">
                    <h2>Daftar Alumni yang sedang mencari kerja</h2>
                    @include('livewire.tables.filter', [
                        'btnContent' => 'Filter by Date',
                        'class' => 'btn btn-danger mb-1',
                    ])
                    <input type="search" class="form-control" placeholder="Search" name="search" id="search"
                        {!! wireModel('search') !!}>
                </div>

                <div class="row row-cols-3">
                    @foreach ($findJobs as $findjob)
                        <div class="col">
                            <div class="card shadow m-3" style="width: 18rem;">
                                @if ($findjob->gambar)
                                    <img src="{{ asset('storage/mencarikerja/' . $findjob->gambar) }}"
                                        style="max-height:12rem" class="card-img-top" alt="placeholder">
                                @else
                                    <img src="https://via.placeholder.com/150/000000/FFFFFF/?text=No Image"
                                        style="max-height:12rem" alt="no-image">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $findjob->name }}</h5>
                                    <p class="card-text">
                                    <ul>
                                        <li>Jenis Kelamin:
                                            {{ $findjob->jenis_kelamin == 'l' ? 'Laki-Laki' : 'Perempuan' }}</li>
                                        <li>Alamat:
                                            <a target="_blank" data-bs-toggle="tooltip" data-placement="top"
                                                title="Find on GMaps"
                                                href="https://maps.google.com/maps/search/{{ $findjob->alamat }}">
                                                {{ $findjob->alamat }}</a>
                                        </li>
                                        <li>Alasan Mencari Kerja: {{ $findjob->alasan_mencari_kerja }}</li>
                                        <li>Kontak:
                                            <input type="text" class="form-control form-control-sm"
                                                id="kontak{{ $findjob->id }}" value="{{ $findjob->kontak }}"
                                                title="Click to copy">
                                            <script>
                                                document.getElementById("kontak{{ $findjob->id }}").onclick = function() {
                                                    this.select();
                                                    document.execCommand('copy');
                                                    Livewire.emit('showAlert', 'success', 'Copied successfully.');
                                                }
                                            </script>
                                        </li>
                                        <li>Didaftarkan: {{ $findjob->created_at }}</li>
                                        <li>Di daftarkan oleh: {{ $findjob->dibuat }}</li>
                                    </ul>
                                    </p>
                                    <div class="btn-group dropup">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="visually-hidden">Toggle Action</span> Action
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('user.edit.mencarikerja', $findjob->slug) }}">Request
                                                    Edit</a></li>
                                            <li><a class="dropdown-item" href="{{ route('user.delete') }}">Request Delete</a></li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $findJobs->withQueryString()->links() }}
            </div>

        </section>

    </main>

    <!--End Body-->
</div>
