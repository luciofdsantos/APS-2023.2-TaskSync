@if (session()->has('danger'))
    <div class="alert alert-danger" role="alert">
        {{session('danger')}}
    </div>
@endif

@if (session()->has('warning'))
    <div class="alert alert-warning" role="alert">
        {{session('warning')}}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif

@if (session()->has('info'))
    <div class="alert alert-info" role="alert">
        {{session('info')}}
    </div>
@endif
