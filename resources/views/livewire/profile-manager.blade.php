@section('title', 'Manage Profile')
<div>
    <div class="card shadow">
        <div class="card-header">
            Manage Profile
        </div>
        <div class="card-body">
            <form wire:submit.prevent='edit'>
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
                    <label for="name">Name:</label>
                    <input type="text"
                        class="form-control @error('name') is-invalid @elseif($name != '') is-valid @enderror"
                        name="name" {!! wireModel('name') !!}>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if ($passwordEdited == false)
                    <div class="alert alert-warning">
                        Leave empty if you don't want to change the passsword.
                    </div>
                @endif

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password"
                        class="form-control @error('password') is-invalid @elseif($password != '') is-valid @enderror"
                        name="password" {!! wireModel('password') !!} wire:key='password'>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="conpass">Confirm Password:</label>
                    <input type="password"
                        class="form-control @error('conpass') is-invalid @elseif($conpass != '') is-valid @enderror"
                        name="conpass" {!! wireModel('conpass') !!} wire:key='confirmPass'>
                    @error('conpass')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-sm btn-primary" type="submit">Edit</button>
            </form>
        </div>
    </div>
</div>
