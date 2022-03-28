@section('title', 'Edit Data Contact')
<div>
    <div class="card">
        <div class="card-header">
            Edit Data Contact
        </div>
        <div class="card-body">
            <form wire:submit.prevent='update' enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama: </label>
                    <input type="text"
                        class="form-control @error('name') is-invalid @elseif($name != '') is-valid @enderror"
                        name="name" {!! wireModel('name') !!}>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email"
                        class="form-control @error('email') is-invalid @elseif($email != '') is-valid @enderror"
                        name="email" {!! wireModel('email') !!}>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subject">Subject: </label>
                    <input type="text"
                        class="form-control @error('subject') is-invalid @elseif($subject != '') is-valid @enderror"
                        name="subject" {!! wireModel('subject') !!}>
                    @error('subject')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="contact_message">Message: </label>
                    <textarea class="form-control @error('contact_message') is-invalid @elseif($contact_message != '') is-valid @enderror"
                        name="contact_message" {!! wireModel('contact_message') !!} rows="10" cols="30"></textarea>
                    @error('contact_message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                <button class="btn btn-sm btn-secondary" type="button"
                    onclick="location.href='{{ route('admin.contact') }}'">Back</button>
            </form>
        </div>
    </div>
</div>
