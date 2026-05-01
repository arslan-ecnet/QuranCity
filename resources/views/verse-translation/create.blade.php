@extends('layouts.app')
@section('title')
    <title>Create Verse Translation</title>
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
        <form action="{{route('verseTranslationCreate')}}" method="POST">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-6">
                        <label>Verse</label>
                        <select class="form-control" name="verse_id" required>
                            <option value="">-- Select Verse --</option>
                            @foreach($verses as $verse)
                                <option value="{{ $verse->id }}">{{$verse->id}} - {{$verse->text_arabic}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Translation</label>
                        <select class="form-control" name="translation_id" required>
                            <option value="">-- Select Translation --</option>
                            @foreach($translations as $trans)
                                <option value="{{ $trans->id }}">{{ $trans->name }} ({{ $trans->language }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-12">
                        <label>Text</label>
                        <textarea id="text_editor" class="form-control ckeditor" name="text" rows="5" required></textarea>
                    </div>
                </div>
                <button class="btn btn-success mt-4" type="submit">Submit</button>
                <a href="{{ route('verseTranslationList') }}" class="btn btn-secondary mt-4 ms-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.config.versionCheck = false;
            if (document.getElementById('text_editor')) {
                CKEDITOR.replace('text_editor');
            }


        });
    </script>
@endsection
