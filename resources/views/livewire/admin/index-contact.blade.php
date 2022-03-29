@section('title', 'Table Contact')
<div>
    <div class="card shadow">
        <div class="card-header">
            Table Contact
            <div>
                @include('livewire.tables.filter')
                @include('livewire.tables.search')
                @include('livewire.tables.bulkdelete')
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
                            <th>Subject</th>
                            <td>Terdaftar</td>
                            <td>Terakhir diperbarui</td>
                            <th colspan="3" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <form wire:submit.prevent>
                                    <td class="text-center"><input type="checkbox" name="items" wire:model='items'
                                            value="{{ $contact->id }}" wire:key='select-{{ $contact->id }}'></td>
                                </form>
                                <td>{{ ($contacts->currentpage() - 1) * $contacts->perpage() + $loop->index + 1 }}
                                </td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>{{ $contact->created_at }}</td>
                                <td>{{ $contact->updated_at }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-info" wire:click="openMessage({{ $contact->id }})"
                                        wire:key="open-message{{ $contact->id }}"><i
                                            class="fas fa-envelope"></i></button>
                                </td>
                                <td class="text-center"><button class="btn btn-sm btn-primary"
                                        onclick="location.href='{{ route('admin.contact.edit', $contact->id) }}'"><i
                                            class="fas fa-pen"></i></button></td>
                                <td class="text-center"><button class="btn btn-sm btn-danger"
                                        wire:click='openDelete({{ $contact->id }})'
                                        wire:key='open-delete-modal-{{ $contact->id }}'><i
                                            class="fa-solid fa-trash"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $contacts->withQueryString()->links() }}
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

            @if ($messagePreview)
                <div class="modal fade" wire:key='open-message-modal' id="messagePreview" tabindex="-1"
                    aria-labelledby="messagePreviewLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="messagePreviewLabel">Preview Pesan {{ $name }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">
                                    <input type="text" disabled="disabled" class="form-control"
                                        {!! wireModel('email') !!}>
                                </div>
                                <div class="mb-2">
                                    <textarea disabled cols="30" rows="10" class="form-control" {!! wireModel('message') !!}></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
