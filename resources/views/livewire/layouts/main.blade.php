@include('livewire.layouts.header')
@if (Auth::user()->hasRole('SuperAdmin'))
    @include('livewire.layouts.navbar')
@else
    @include('livewire.layouts.navbar-user')
@endif
@include('livewire.layouts.topbar')
{{ $slot }}
@include('livewire.layouts.footer')
