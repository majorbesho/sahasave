@extends('frontend.layouts.master')


@section('content')
    <div class="quotes-weight">

        <div class="contaienr " style="padding: 5%; padding-bottom: 5%">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('chat.start') }}" method="POST" class="contact-form quote-one__form"
                        style=" display: flex;
                                flex-direction: column;
                                align-content: center;
                                justify-content: center;
                                align-items: center;">
                        @csrf
                        <div class="input-box">
                            <label for="shipment_owner_id"> Shipper Owner :</label>
                            <select name="shipment_owner_id" id="shipment_owner_id" required>
                                @foreach ($shipmentOwners as $owner)
                                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-box">
                            <label for="truck_owner_id"> Truck Owner:</label>
                            <select name="truck_owner_id" id="truck_owner_id" required>
                                @foreach ($truckOwners as $owner)
                                    <option value="{{ $owner->id }}">{{ $owner->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-12">
                            <div class="quote-two__btn">
                                {{-- <a href="{{ route('gaddyourload') }}" class="thm-btn"> --}}

                                <button type="submit" class="thm-btn">
                                    Start Chat
                                    <i class="icon-right-arrow21"></i>
                                    <span class="hover-btn hover-bx"></span>
                                    <span class="hover-btn hover-bx2"></span>
                                    <span class="hover-btn hover-bx3"></span>
                                    <span class="hover-btn hover-bx4"></span>
                                </button>
                                {{-- </a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
