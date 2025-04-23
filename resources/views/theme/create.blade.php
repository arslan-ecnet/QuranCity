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
        <form action="{{route('createTheme')}}" method="POST">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-6">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-lg-6">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label for="theme_color" class="form-label">Choose Theme Color</label>
                        <div class="d-flex align-items-center gap-3">
                            <div class="color-input-wrapper">
                                <input type="color" id="theme_color" name="theme_color" onchange="updateColorCode(this)">
                            </div>
                            <span id="colorCode" style="font-family: monospace;">#000000</span>
                        </div>

                        <script>
                            function updateColorCode(input) {
                                document.getElementById('colorCode').textContent = input.value.toUpperCase();
                            }
                        </script>

                    </div>
                    <div class="col-lg-6">
                        <label>Sort Order</label>
                        <input type="text" class="form-control" name="sort_order">
                    </div>
                </div>
                <button class="btn btn-success mt-3" type="submit">Submit</button>
            </div>
        </form>

    </div>
@endsection
