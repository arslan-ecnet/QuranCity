@extends('layouts.app')
@section('title')
    <title>Edit Reciter</title>
@endsection
@section('content')
    <div class="dash-content">
        <div class="mb-3">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <form action="{{route('reciterUpdate', ['id' => $reciter->id])}}" method="POST">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-6">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $reciter->name }}" required>
                    </div>
                    <div class="col-lg-6">
                        <label>Style</label>
                        <input type="text" class="form-control" name="style" value="{{ $reciter->style }}">
                    </div>
                </div>
                <button class="btn btn-success mt-4" type="submit">Update</button>
                <a href="{{ route('reciterList') }}" class="btn btn-secondary mt-4 ms-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
