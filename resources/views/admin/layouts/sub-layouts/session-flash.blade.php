@if(session()->has('success'))
    <p class="alert alert-success text-center">{{ session()->get('success') }}</p>
@elseif(session()->has('warning'))
    <p class="alert alert-danger text-center">{{ session()->get('warning') }}</p>
@endif
