<div>
    <main id="main" style="margin-top:10em">

        <section class="m-3 mb-3 vh-100 d-flex align-items-center justify-content-center">
            <div class="container" wire:ignore.self data-aos="fade-up">
                <div class="section-header">
                    <h4 class="text-center">Daftar Request</h4>
                </div>
                <div class="card shadow">
                    <div class="card-header">
                        Daftar Request Anda
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jenis Tabel</th>
                                        <th>Status</th>
                                        <th>Di proses oleh</th>
                                        <th>Didaftarkan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($data != null)
                                        <tr>
                                            <td>{{ $data->table_type }}</td>
                                            <td>{{ $data->status }}</td>
                                            <td>{{ $data->handled_by ?? 'Belum Ada' }}</td>
                                            <td>{{ $data->created_at->diffForHumans() }}</td>
                                            <td class="text-center"><button class="btn btn-danger btn-sm"
                                                    wire:click="cancel()">Batalkan
                                                    Permintaan</button></td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">NO DATA</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card shadow mt-3">
                    <div class="card-header">
                        Daftar Request Anda (Buat)
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jenis Tabel</th>
                                        <th>Status</th>
                                        <th>Di proses oleh</th>
                                        <th>Didaftarkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($allAdd != null)
                                        @foreach ($allAdd as $data)
                                            <tr>
                                                <td>{{ $data->table_type }}</td>
                                                <td>{{ $data->status }}</td>
                                                <td>{{ $data->handled_by ?? 'Belum Ada' }}</td>
                                                <td>{{ $data->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No Data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card shadow mt-3">
                    <div class="card-header">
                        Daftar Request Anda (Edit)
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jenis Tabel</th>
                                        <th>Status</th>
                                        <th>Di proses oleh</th>
                                        <th>Didaftarkan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($allEdit != null)
                                        @foreach ($allEdit as $data)
                                            <tr>
                                                <td>{{ $data->table_type }}</td>
                                                <td>{{ $data->status }}</td>
                                                <td>{{ $data->handled_by ?? 'Belum Ada' }}</td>
                                                <td>{{ $data->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center">No Data</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>

    </main>
</div>
