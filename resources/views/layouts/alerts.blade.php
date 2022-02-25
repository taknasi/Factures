@if (session()->has('success'))
    <div class="alert alert-success text-center" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong class="text-center">{{ session()->get('success') }}</strong>
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger mg-b-0" role="alert">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ Session::get('error') }}
    </div>
@endif