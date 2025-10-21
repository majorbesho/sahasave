@if ($message = Session::get('success'))
    <div class="alert alert-primary rounded-0 fixed-bottom m-0" data-animate="fadeInUp faster">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-auto">
                    <strong><i class="icon-gift"></i> Done </strong> {{ $message }} <a href="#"
                        class="alert-link"><u>SahaSave.com .com</u></a>
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
                    <strong><i class="icon-gift"></i> Sorry </strong> {{ $message }} <a href="#"
                        class="alert-link"><u>SahaSave.com .com</u></a>
                </div>
                <div class="col-lg-auto mt-3 mt-lg-0">
                    <a href="#" class="btn btn-primary d-none">Active Now </a>
                    <button type="button" class="btn-close btn btn-link float-lg-none text-dark ms-md-3"
                        data-bs-dismiss="alert" aria-hidden="true"></button>
                </div>
            </div>
        </div>
    </div>
@endif
