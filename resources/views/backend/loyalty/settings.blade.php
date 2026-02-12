@extends('backend.layouts.master')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Loyalty & Wallet Settings</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('backend.layouts.notification')
                    <div class="card">
                        <form action="{{ route('admin.loyalty.settings.update') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @foreach($settings as $group => $groupSettings)
                                    <h5 class="mt-4 mb-3 text-primary">{{ ucfirst($group) }} Settings</h5>
                                    @foreach($groupSettings as $setting)
                                        <div class="form-group">
                                            <label for="setting_{{ $setting->key }}">{{ $setting->display_name }}</label>
                                            @if($setting->type == 'integer' || $setting->type == 'decimal')
                                                <input type="number" step="{{ $setting->type == 'decimal' ? '0.01' : '1' }}" name="settings[{{ $setting->key }}]" class="form-control" id="setting_{{ $setting->key }}" value="{{ $setting->value }}">
                                            @else
                                                <input type="text" name="settings[{{ $setting->key }}]" class="form-control" id="setting_{{ $setting->key }}" value="{{ $setting->value }}">
                                            @endif
                                            <small class="form-text text-muted">{{ $setting->description }}</small>
                                        </div>
                                    @endforeach
                                    <hr>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
