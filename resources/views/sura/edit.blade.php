@extends('layouts.app')
@section('title')
    <title>Quran City</title>
@endsection
@section('content')
    <style>
        .color-input-wrapper {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 60px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 2px solid #ddd;
            transition: border-color 0.3s ease;
        }

        .color-input-wrapper:hover {
            border-color: #777;
        }

        .color-input-wrapper input[type="color"] {
            width: 100%;
            height: 100%;
            border: none;
            padding: 0;
            cursor: pointer;
            background: none;
        }
    </style>
    <div class="dash-content">

        {{--        <div class="date-field  d-none d-xl-flex align-items-center mb-4 mb-md-5">--}}
        {{--            <span>Show:</span>--}}
        {{--            <input type="text" id="datepicker" placeholder="Today, 29 September 2023">--}}
        {{--        </div>--}}
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
        <form action="{{route('suraUpdate' , ['id' => $sura->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-6">
                        <label>Name in English</label>
                        <input type="text" class="form-control" value="{{$sura->name_en}}" name="name_en">
                    </div>
                    <div class="col-lg-6">
                        <label>Name in Arabic</label>
                        <input type="text" class="form-control" value="{{$sura->name_ar}}" name="name_ar">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Classification</label>
                        <input type="text" class="form-control" value="{{$sura->classification}}" name="classification">
                    </div>
                    <div class="col-lg-6">
                        <label>Sub Classification</label>
                        <input type="text" class="form-control" name="sub_classification" value="{{$sura->sub_classification}}">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Translation</label>
                        <input type="text" class="form-control" name="translation" value="{{$sura->translation}}">
                    </div>
                    <div class="col-lg-6">
                        <label>Verses Count</label>
                        <input type="text" class="form-control" value="{{$sura->verses_count}}" name="verses_count">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" value="{{$sura->description}}">
                    </div>
                    <div class="col-lg-6">
                        <label>Summary</label>
                        <input type="text" class="form-control" name="summary" value="{{$sura->summary}}">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Revelation Order</label>
                        <input type="text" class="form-control" name="revelation_order" value="{{$sura->revelation_order}}">
                    </div>
                    <div class="col-lg-6">
                        <label for="theme_color" class="form-label">Choose Sura Color</label>
                        <div class="d-flex align-items-center gap-3">
                            <div class="color-input-wrapper">
                                <input type="color" id="theme_color" name="sura_color" value="{{$sura->sura_color}}" onchange="updateColorCode(this)">
                            </div>
                            <span id="colorCode" style="font-family: monospace;">{{$sura->sura_color}}</span>
                        </div>

                        <script>
                            function updateColorCode(input) {
                                document.getElementById('colorCode').textContent = input.value.toUpperCase();
                            }
                        </script>

                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Sura Icon</label>
                        <input type="file" class="form-control" name="sura_icon">
                        <img src="{{asset('storage/' . $sura->sura_icon)}}" width="100">
                    </div>
                    <div class="col-lg-6">
                        <label>Theme</label>
                        <select class="form-control" name="theme_id">
                            <option value="0">Please Select Theme...!</option>
                            @foreach($themes as $theme)
                                <option value="{{ $theme->id }}" {{ isset($sura) && $sura->theme_id == $theme->id ? 'selected' : '' }}>
                                    {{ $theme->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <button class="btn btn-success mt-3" type="submit">Submit</button>
            </div>
        </form>

    </div>
@endsection
