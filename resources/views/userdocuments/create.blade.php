@extends('frontend.layouts.master')


@section('content')

    <h1>Upload Document</h1>

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
        <input type="file" name="document">
        <button type="submit">Upload</button>
    </form>
@endsection
