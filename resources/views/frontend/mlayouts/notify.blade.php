

@if ($message = Session::get('success'))

<div class="alert alert-primary rounded-0 fixed-bottom m-0" data-animate="fadeInUp faster">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-auto">
                <strong><i class="icon-gift"></i> Done </strong> {{ $message }} <a href="#" class="alert-link"><u>Smart</u></a> Box
            </div>
            {{-- <div class="col-lg-auto mt-3 mt-lg-0">
                <a href="#" class="btn btn-primary">Shopping now  </a>
                <button type="button" class="btn-close btn btn-link float-lg-none text-dark ms-md-3" data-bs-dismiss="alert" aria-hidden="true"></button>
            </div> --}}
        </div>
    </div>
</div>
@endif
@if ($message = Session::get('error'))

<div class="alert alert-danger rounded-0 fixed-bottom m-0" data-animate="fadeInUp faster">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-auto">
                <strong><i class="icon-gift"></i> Sorry </strong> {{ $message }} <a href="#" class="alert-link"><u>Smart</u></a> Box
            </div>
            <div class="col-lg-auto mt-3 mt-lg-0">
                <a href="#" class="btn btn-primary">Active Now   </a>
                <button type="button" class="btn-close btn btn-link float-lg-none text-dark ms-md-3" data-bs-dismiss="alert" aria-hidden="true"></button>
            </div>
        </div>
    </div>
</div>


@endif

{{-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            @if ($message = Session::get('success'))

    <div class="alert  rounded-0 fixed-bottom m-0 alert alert-success alert-dismissible fade show"
    role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif



    @if ($message = Session::get('warning'))

    <div class="alert alert-warning alert-dismissible fade show" role="alert">

    <strong>{{ $message }}</strong>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

    @endif
    @if ($message = Session::get('info'))

    <div class="alert alert-info alert-dismissible fade show" role="alert">

    <strong>{{ $message }}</strong>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

    @endif



    @if ($errors->any())

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

    <strong>Please check the form below for errors</strong>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

@endif
@if(Auth::check())
    @if (auth()->user()->is_verified==0)
    <div class="alert alert-danger rounded-0 fixed-bottom m-0" data-animate="fadeInUp faster">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-auto">
                    <strong><i class="icon-gift"></i> plz confirm your email {{auth()->user()->email}}!</strong> {{ $message }}
                </div>

            </div>
        </div>
    </div>
    @endif
    @endif


        </div>
    </div>
</div> --}}

{{-- @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ $message }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif




    @if ($message = Session::get('warning'))

    <div class="alert alert-warning alert-dismissible fade show" role="alert">

    <strong>{{ $message }}</strong>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

    @endif



    @if ($message = Session::get('info'))

    <div class="alert alert-info alert-dismissible fade show" role="alert">

    <strong>{{ $message }}</strong>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

    @endif



    @if ($errors->any())

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

    <strong>Please check the form below for errors</strong>

    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    </div>

@endif --}}




