@extends('layouts.app')
@section('title')
    <title>Edit Surah</title>
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
        <form action="{{route('surahUpdate', ['id' => $surah->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-4">
                        <label>Name English</label>
                        <input type="text" class="form-control" name="name_english" value="{{ $surah->name_english }}" required>
                    </div>
                    <div class="col-lg-4">
                        <label>Name Arabic</label>
                        <input type="text" class="form-control" name="name_arabic" value="{{ $surah->name_arabic }}" required>
                    </div>
                    <div class="col-lg-4">
                        <label>Name Transliteration</label>
                        <input type="text" class="form-control" name="name_transliteration" value="{{ $surah->name_transliteration }}">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-4">
                        <label>Revelation Type</label>
                        <select class="form-control" name="revelation_type">
                            <option value="">-- Select --</option>
                            <option value="makki" {{ $surah->revelation_type == 'makki' ? 'selected' : '' }}>Makki</option>
                            <option value="madani" {{ $surah->revelation_type == 'madani' ? 'selected' : '' }}>Madani</option>
                        </select>
                    </div>
                    <div class="col-lg-4">
                        <label>Revelation Order</label>
                        <input type="number" class="form-control" name="revelation_order" value="{{ $surah->revelation_order }}">
                    </div>
                    <div class="col-lg-4">
                        <label>Total Verses</label>
                        <input type="number" class="form-control" name="total_verses" value="{{ $surah->total_verses }}">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-3">
                        <label>Rukus</label>
                        <input type="number" class="form-control" name="rukus" value="{{ $surah->rukus }}">
                    </div>
                    <div class="col-lg-3">
                        <label>Hizb Number</label>
                        <input type="number" class="form-control" name="hizb_number" value="{{ $surah->hizb_number }}">
                    </div>
                    <div class="col-lg-3">
                        <label>Juz Start</label>
                        <input type="number" class="form-control" name="juz_start" value="{{ $surah->juz_start }}">
                    </div>
                    <div class="col-lg-3">
                        <label>Juz End</label>
                        <input type="number" class="form-control" name="juz_end" value="{{ $surah->juz_end }}">
                    </div>
                </div>
                
                <button class="btn btn-success mt-4" type="submit">Update</button>
                <a href="{{ route('surahList') }}" class="btn btn-secondary mt-4 ms-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
