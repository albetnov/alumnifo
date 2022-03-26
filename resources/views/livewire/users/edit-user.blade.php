@section('title', 'Edit Data User')
<div>
    <div class="card">
        <div class="card-header">
            Edit Data User
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
                    <label for="password">Password: </label>
                    <input type="password"
                        class="form-control @error('password') is-invalid @elseif($password != '') is-valid @enderror"
                        name="password" {!! wireModel('password') !!}>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="conpass">Confirm Password: </label>
                    <input type="password"
                        class="form-control @error('conpass') is-invalid @elseif($conpass != '') is-valid @enderror"
                        name="conpass" {!! wireModel('conpass') !!}>
                    @error('conpass')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-sm btn-primary" type="submit">Edit</button>
                <button class="btn btn-sm btn-secondary" type="button"
                    onclick="location.href='{{ route('admin.users') }}'">Back</button>
            </form>
        </div>
    </div>
</div>
