@extends('frontend.layouts.master')


@section('content')
    <style>
        .user-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .user-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .user-card i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .btn-register {
            margin-top: 10px;
        }
    </style>




    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="mb-4">Login / Sign Up</h1>
                <p class="lead mb-5" style="color: #Fabc3f"> Choose Membership Type </p>
                <div class="row g-4">
                    <!-- Shipper Card -->
                    <div class="col-md-3">
                        <div class="card user-card h-100 text-center p-4">
                            <i class="fas fa-box-open text-primary"></i>
                            <h3>Shipper</h3>
                            <p class="text-muted"> Shipper Users</p>
                            <a href="{{ route('shipper.login') }}" class="btn btn-primary"> Login</a>
                            <a href="{{ route('shipper.register') }}" class="btn btn-outline-primary btn-register">Sign
                                UP</a>


                            <a href="{{ route('google.login', ['userType' => 'shipper']) }}"
                                class="btn btn-outline-primary btn-google">
                                <i class="fab fa-google"></i> Google
                            </a>
                        </div>
                    </div>
                    <!-- Carrier Card -->
                    <div class="col-md-3">
                        <div class="card user-card h-100 text-center p-4">
                            <i class="fas fa-truck text-success"></i>
                            <h3>Carrier</h3>
                            <p class="text-muted"> Carrier Account</p>
                            <a href="{{ route('carrier.login') }}" class="btn btn-success">Login </a>
                            <a href="{{ route('carrier.register.post') }}" class="btn btn-outline-success btn-register">Sign
                                UP</a>
                            <a href="{{ route('google.login', ['userType' => 'carrier']) }}"
                                class="btn btn-outline-success btn-register btn-google">
                                <i class="fab fa-google"></i> Google
                            </a>

                        </div>
                    </div>
                    <!-- Broker Card -->
                    <div class="col-md-3">
                        <div class="card user-card h-100 text-center p-4">
                            <i class="fas fa-file-contract text-warning"></i>
                            <h3>Broker</h3>
                            <p class="text-muted">Broker Account</p>
                            <a href="{{ route('broker.login') }}" class="btn btn-warning">Login </a>
                            <a href="{{ route('broker.register.view') }}" class="btn btn-outline-warning btn-register">Sign
                                UP</a>


                            <a href="{{ route('google.login', ['userType' => 'broker']) }}"
                                class="btn btn-outline-warning btn-google">
                                <i class="fab fa-google"></i> Google
                            </a>

                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="card user-card h-100 text-center p-4">
                            <i class="fas fa-file-contract text-secondary"></i>
                            <h3>End User</h3>
                            <p class="text-muted"> End User</p>
                            <a href="{{ route('user.auth') }}" class="btn btn-secondary"> Login </a>
                            <a href="{{ route('newreg') }}" class="btn btn-outline-secondary btn-register">Sign UP</a>
                            <a href="{{ route('google.login', ['userType' => 'user']) }}"
                                class="btn btn-outline-secondary btn-google">
                                <i class="fab fa-google"></i> Google
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
@endsection
