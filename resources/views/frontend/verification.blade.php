@extends('frontend.layouts.master')


@section('content')








<div class="inner-hero-section style--six login">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mt-150">
                <div class="row wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.3s" style="
                background-color: #fff;padding: 10px;border-radius: 25px;">
                    <div class="col-lg-12">


                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <div class="row mb-none-30">


        <form method="post" id="verificationForm" action="javascript: void(0)" class="otp-form" name="otp-form">
            @csrf

            <div class="container otp">
                <div class="row">
                <div class="center">
                    <p class="info" style="color: #000;">An OTP Has Been Sent To Your Email</p>
                    <p class="msg" style="color: #000; padding-bottom: 10px">Please enter OTP to verify</p>
                </div>

            <div class="otp-input-fields">
                <input type="number" class="otp__digit otp__field__1">
                <input type="number" class="otp__digit otp__field__2">
                <input type="number" class="otp__digit otp__field__3">
                <input type="number" class="otp__digit otp__field__4">
                <input type="number" class="otp__digit otp__field__5">
                <input type="number" class="otp__digit otp__field__6">
            </div>
            <div class="center mt-10" style="padding: 1.5rem;">
                <button id="resendOtpVerification" class="pt-10">Resend Verification OTP</button>
                <p class="time mt-10"></p>
            </div>
            <div class="result">
                <input type="number" name="otp" id="_otpx" class="d-none" >
                <p id="_otp" class="_notok"></p>

            </div>
            <div class="otpinput">
                <input type="hidden" name="email" value="{{ $email }}">

            </div>
            {{-- <input type="number" name="otp" placeholder="Enter OTP" required> --}}
            <div class="sub ">
                <button type="submit" value="Verify" class="btn col-12 " style="background-color: #0f56d1;">Verify

                </button>

            </div>


        </div>
        </div>

        </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>




{{--
<div class="hero-otp">






        <form method="post" id="verificationForm" action="javascript: void(0)" class="otp-form" name="otp-form">
            @csrf

            <div class="container otp">
                <div class="row">
                <div class="center">
                    <p class="info">An OTP Has Been Sent To Your Email</p>
                    <p class="msg">Please enter OTP to verify</p>
                </div>

            <div class="otp-input-fields">
                <input type="number" class="otp__digit otp__field__1">
                <input type="number" class="otp__digit otp__field__2">
                <input type="number" class="otp__digit otp__field__3">
                <input type="number" class="otp__digit otp__field__4">
                <input type="number" class="otp__digit otp__field__5">
                <input type="number" class="otp__digit otp__field__6">
            </div>
            <div class="center mt-10">
                <button id="resendOtpVerification" class="pt-10">Resend Verification OTP</button>
                <p class="time mt-10"></p>
            </div>
            <div class="result">
               <input type="number" name="otp" id="_otpx" class="_notok"  >
                <p id="_otp" class="_notok"></p>

            </div>
            <input type="hidden" name="email" value="{{ $email }}">
            {{-- <input type="number" name="otp" placeholder="Enter OTP" required>
            <input type="submit" value="Verify">


        </div>
        </div>

        </form>

</div> --}}




{{--<div class="container otp">
    <div class="row">

        <p id="message_error" style="color:red;"></p>
        <p id="message_success" style="color:green;"></p>



         <form method="post" id="verificationForm">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="number" name="otp" placeholder="Enter OTP" required>
            <br><br>
            <input type="submit" value="Verify">

        </form>

        <p class="time"></p>

    </div>
</div>
--}}

{{-- <button id="resendOtpVerification">Resend Verification OTP</button> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        $('#verificationForm').submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('verifiedOtp') }}",
                type:"POST",
                data: formData,
                success:function(res){
                    if(res.success){
                        alert(res.msg);
                        window.open("/","_self");
                    }
                    else{
                        $('#message_error').text(res.msg);
                        setTimeout(() => {
                            $('#message_error').text('');
                        }, 3000);
                    }
                }
            });

        });

        $('#resendOtpVerification').click(function(){
            $(this).text('Wait...');
            var userMail = @json($email);

            $.ajax({
                url:"{{ route('resendOtp') }}",
                type:"GET",
                data: {email:userMail },
                success:function(res){
                    $('#resendOtpVerification').text('Resend Verification OTP');
                    if(res.success){
                        timer();
                        $('#message_success').text(res.msg);
                        setTimeout(() => {
                            $('#message_success').text('');
                        }, 3000);
                    }
                    else{
                        $('#message_error').text(res.msg);
                        setTimeout(() => {
                            $('#message_error').text('');
                        }, 3000);
                    }
                }
            });

        });
    });

    function timer()
    {
        var seconds = 30;
        var minutes = 1;

        var timer = setInterval(() => {

            if(minutes < 0){
                $('.time').text('');
                clearInterval(timer);
            }
            else{
                let tempMinutes = minutes.toString().length > 1? minutes:'0'+minutes;
                let tempSeconds = seconds.toString().length > 1? seconds:'0'+seconds;

                $('.time').text(tempMinutes+':'+tempSeconds);
            }

            if(seconds <= 0){
                minutes--;
                seconds = 59;
            }

            seconds--;

        }, 1000);
    }

    timer();

</script>


<script>


var otp_inputs = document.querySelectorAll(".otp__digit")
var otp_input = document.querySelectorAll(".otp__digit")
var mykey = "0123456789".split("")
otp_inputs.forEach((_)=>{
  _.addEventListener("keyup", handle_next_input)
})
function handle_next_input(event){
  let current = event.target
  let index = parseInt(current.classList[1].split("__")[2])
  current.value = event.key

  if(event.keyCode == 8 && index > 1){
    current.previousElementSibling.focus()
  }
  if(index < 6 && mykey.indexOf(""+event.key+"") != -1){
    var next = current.nextElementSibling;
    next.focus()
  }
  var _finalKey = ""
  for(let {value} of otp_inputs){
      _finalKey += value
  }
  if(_finalKey.length == 6){
    document.querySelector("#_otp").classList.replace("_notok", "_ok")
    document.querySelector("#_otp").innerText = _finalKey
    // document.querySelector("#_otpx").value = _finalKey
    //document.querySelector("#_otp").innerText = _finalKey
    //_otp

    document.getElementById('_otpx').value= _finalKey;


  }else{
    document.querySelector("#_otp").classList.replace("_ok", "_notok")
    document.querySelector("#_otp").innerText = _finalKey

  }

}

</script>
@endsection
