@extends('layouts.app')
@section('title')
    <title>Create Verse</title>
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
        <form action="{{route('verseCreate')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-6">
                        <label>Surah</label>
                        <select class="form-control" name="surah_id" required>
                            <option value="">-- Select Surah --</option>
                            @foreach($quranSurahs as $qSurah)
                                <option value="{{ $qSurah->id }}">{{ $qSurah->name_english }} ({{ $qSurah->name_arabic }}) {{$qSurah->name_transliteration}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label>Ayah Number</label>
                        <input type="number" class="form-control" name="ayah_number" required>
                    </div>
                    <div class="col-lg-3">
                        <label>Ayah Global Number</label>
                        <input type="number" class="form-control" name="ayah_global_number">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Text Arabic</label>
                        <textarea id="text_arabic_editor" class="form-control ckeditor" name="text_arabic" rows="4"></textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>Simple Text</label>
                        <textarea id="text_simple_editor" class="form-control ckeditor" name="text_simple" rows="4"></textarea>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-3">
                        <label>Sajdah</label>
                        <input type="text" class="form-control" name="sajdah">
                    </div>
                    <div class="col-lg-3">
                        <label>Juz</label>
                        <input type="number" class="form-control" name="juz">
                    </div>
                    <div class="col-lg-3">
                        <label>Hizb</label>
                        <input type="number" step="any" class="form-control" name="hizb">
                    </div>
                    <div class="col-lg-3">
                        <label>Rub El Hizb</label>
                        <input type="number" step="any" class="form-control" name="rub_el_hizb">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-3">
                        <label>Page Number</label>
                        <input type="number" class="form-control" name="page_number">
                    </div>
                </div>

                <button class="btn btn-success mt-4" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.config.versionCheck = false;
            if (document.getElementById('text_arabic_editor')) {
                CKEDITOR.replace('text_arabic_editor');
            }
            if (document.getElementById('text_simple_editor')) {
                CKEDITOR.replace('text_simple_editor');
            }
        });
    </script>
@endsection
