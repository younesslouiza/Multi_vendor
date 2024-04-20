@if (session()->has('success'))
    <Div class="alert alert-success">
        {{session('success')}}
    </Div>
@endif
@if (session()->has('info'))
    <Div class="alert alert-info">
        {{session('info')}}
    </Div>
@endif