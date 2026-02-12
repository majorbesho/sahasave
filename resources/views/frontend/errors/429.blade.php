@extends('frontend.layouts.master')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-container">
                <div class="error-icon">
                    <i class="fas fa-clock fa-5x text-warning"></i>
                </div>
                
                <h1 class="error-title mt-4">429 - Too Many Requests</h1>
                
                <div class="error-message mt-3">
                    <h4>{{ $message ?? 'لقد تجاوزت الحد المسموح من الطلبات.' }}</h4>
                    
                    @if(isset($retry_after))
                    <p class="text-muted mt-3">
                        يمكنك المحاولة مرة أخرى بعد: 
                        <span class="badge bg-danger" id="countdown">{{ $retry_after }}</span> ثانية
                    </p>
                    @endif
                </div>
                
                <div class="error-actions mt-5">
                    <a href="{{ url()->previous() }}" class="btn btn-primary me-2">
                        <i class="fas fa-arrow-left"></i> العودة للخلف
                    </a>
                    
                    <a href="{{ route('home') }}" class="btn btn-outline-primary">
                        <i class="fas fa-home"></i> الصفحة الرئيسية
                    </a>
                </div>
                
                <div class="error-tips mt-5">
                    <h5>نصائح:</h5>
                    <ul class="list-unstyled">
                        <li>• انتظر بضع دقائق قبل المحاولة مرة أخرى</li>
                        <li>• تأكد من اتصال الإنترنت لديك</li>
                        <li>• جرب تحديث الصفحة (F5)</li>
                        <li>• امسح ذاكرة التخزين المؤقت للمتصفح إذا استمرت المشكلة</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@if(isset($retry_after))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let countdown = document.getElementById('countdown');
        let seconds = parseInt(countdown.textContent);
        
        const timer = setInterval(function() {
            seconds--;
            countdown.textContent = seconds;
            
            if (seconds <= 0) {
                clearInterval(timer);
                countdown.parentElement.innerHTML = 'يمكنك الآن المحاولة مرة أخرى.';
            }
        }, 1000);
    });
</script>
@endif
@endpush

@push('styles')
<style>
    .error-container {
        padding: 40px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    
    .error-icon {
        animation: pulse 2s infinite;
    }
    
    .error-title {
        color: #333;
        font-weight: 700;
    }
    
    .error-message {
        font-size: 1.2rem;
        color: #666;
    }
    
    .error-tips {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #007bff;
    }
    
    .error-tips li {
        padding: 5px 0;
        color: #555;
    }
    
    #countdown {
        font-size: 1.5rem;
        padding: 5px 15px;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
</style>
@endpush