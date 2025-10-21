@extends('frontend.layouts.master')


@section('content')
    <h1>My Documents</h1>

    <h1>Upload Documents</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="documents[]" multiple> <--- The crucial change here <button type="submit">Upload</button>
    </form>
@endsection
