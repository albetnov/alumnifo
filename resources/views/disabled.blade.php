@include('livewire.layouts.header')
@include('livewire.layouts.topbar')
<div class="container">
    <div class="card">
        <div class="card-header">
            Your account are waiting for approval from the administrator.   
        </div>
        <div class="card-footer">
            <form action="{{ route('logout') }}" method="post">
                @csrf 
                <button class="btn btn-sm btn-primary" type="submit">Logout</button>
            </form>
        </div>
    </div>
</div>
@include('livewire.layouts.footer')
