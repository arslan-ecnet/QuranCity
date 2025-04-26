@extends('layouts.app')
@section('title')
    <title>Edit Resource</title>
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
        <form action="{{route('resourceUpdate' , ['id' => $resource->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-6">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" value="{{$resource->title}}">
                    </div>
                    <div class="col-lg-6">
                        <label>Type</label>
                        <input type="text" class="form-control" name="type" value="{{$resource->type}}">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Url</label>
                        <input type="url" class="form-control" name="url" value="{{$resource->url}}">
                    </div>
                    <div class="col-lg-6">
                        <label>Sura</label>
                        <select class="form-control" name="sura_id">
                            <option value="">Please Select Sura...!</option>
                            @foreach($suras as $sura)
                                <option value="{{ $sura->id }}" {{ isset($resource) && $resource->sura_id == $sura->id ? 'selected' : '' }}>
                                    {{ $sura->name_en }}
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
