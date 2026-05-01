@extends('layouts.app')
@section('title')
    <title>Edit Audio File</title>
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
        <form action="{{route('audioFileUpdate', ['id' => $audioFile->id])}}" method="POST">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-3">
                        <label>Verse ID</label>
                        <input type="number" class="form-control" name="verse_id" value="{{ $audioFile->verse_id }}" required>
                    </div>
                    <div class="col-lg-3">
                        <label>Reciter</label>
                        <select class="form-control" name="reciter_id" required>
                            <option value="">-- Select Reciter --</option>
                            @foreach($reciters as $reciter)
                                <option value="{{ $reciter->id }}" {{ $audioFile->reciter_id == $reciter->id ? 'selected' : '' }}>{{ $reciter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>URL</label>
                        <input type="text" class="form-control" name="url" value="{{ $audioFile->url }}" required>
                    </div>
                    <div class="col-lg-3">
                        <label>Duration</label>
                        <input type="number" class="form-control" name="duration" value="{{ $audioFile->duration }}">
                    </div>
                </div>
                <button class="btn btn-success mt-4" type="submit">Update</button>
                <a href="{{ route('audioFileList') }}" class="btn btn-secondary mt-4 ms-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
