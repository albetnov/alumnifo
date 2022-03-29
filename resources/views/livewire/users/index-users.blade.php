@section('title', 'Table Users')
<div>
    <div class="card shadow">
        <div class="card-header">
            Table Users
            <div>
                <button class="btn btn-sm btn-primary"
                    onclick="location.href='{{ route('admin.users.add') }}'">Create</button>
                @include('livewire.tables.filter')
                @include('livewire.tables.search')
                @include('livewire.tables.bulkdelete', [
                    'msg' => 'ANDA JUGA AKAN LOGOUT
                                SECARA OTOMATIS.
                                PEMULIHAN DATA SUPERUSER DAPAT DILAKUKAN DENGAN PROSES SEEDING MANUAL.',
                ])
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Select</th>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <td>Terdaftar</td>
                            <td>Terakhir diperbarui</td>
                            <th colspan="2" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <form wire:submit.prevent>
                                    <td class="text-center"><input type="checkbox" name="items" wire:model='items'
                                            value="{{ $user->id }}" wire:key='select-{{ $user->id }}'></td>
                                </form>
                                <td>{{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    @if ($user->getRoleNames()->get(0) == 'disabled')
                                        <button class="btn btn-success" wire:click="upLevel({{ $user->id }})"
                                            wire:key="level-up-{{ $user->id }}"><i class="fas fa-arrow-up"></i>
                                            Level
                                            Up to User</button>
                                    @else
                                        <span
                                            class="badge rounded-pill bg-info">{{ $user->getRoleNames()->get(0) }}</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td class="text-center"><button class="btn btn-sm btn-primary"
                                        onclick="location.href='{{ route('admin.users.edit', $user->slug) }}'"><i
                                            class="fas fa-pen"></i></button></td>
                                <td class="text-center"><button class="btn btn-sm btn-danger"
                                        wire:click='openDelete({{ $user->id }})'
                                        wire:key='open-delete-modal-{{ $user->id }}'><i
                                            class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->withQueryString()->links() }}
            </div>

            @if ($deleteOpened)
                <div class="modal fade" wire:key='open-delete-modal' id="deletePreview" tabindex="-1"
                    aria-labelledby="deletePreviewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deletePreviewLabel">Hapus Data?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Yakin hapus data, {{ $name }} ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form wire:submit.prevent='deleteData()'>
                                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"><i
                                            class="fa-solid fa-trash"></i> Delete It!</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
