@extends('layouts.app')
@section('title')
    <title>Create Sura</title>
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
        <form action="{{route('suraCreate')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-6">
                        <label>Name in English</label>
                        <input type="text" class="form-control" name="name_en">
                    </div>
                    <div class="col-lg-6">
                        <label>Name in Arabic</label>
                        <input type="text" class="form-control" name="name_ar">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Sura Name Translation</label>
                        <input type="text" class="form-control" name="translation">
                    </div>
                    <div class="col-lg-6">
                        <label>Verses Count</label>
                        <input type="number" class="form-control" name="verses_count">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Classification</label>
                        <select class="form-control" id="classification" name="classification">
                            <option value="">-- Select Classification --</option>
                            <option value="meccan">Meccan</option>
                            <option value="medinan">Medinan</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Sub Classification</label>
                        <select class="form-control" id="sub_classification" name="sub_classification">
                            <option value="">-- Select Sub Classification --</option>
                        </select>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Theme</label>
                        <select class="form-control" name="theme_id">
                            <option value="">Please Select Theme...!</option>
                            @foreach($themes as $theme)
                                <option value="{{$theme->id}}">{{$theme->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Suburb</label>
                        <select class="form-control" name="suburb_id">
                            <option value="">Please Select Theme...!</option>
                            @foreach($suburbs as $suburb)
                                <option value="{{$suburb->id}}">{{$suburb->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-12">
                        <label>Description</label>
                        <textarea class="form-control summernote" name="description"></textarea>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-12">
                        <label>Summary</label>
                        <textarea type="text" class="form-control summernote" name="summary"></textarea>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-4">
                        <label>Revelation Order</label>
                        <input type="number" class="form-control" name="revelation_order">
                    </div>
                    <div class="col-lg-4">
                        <label for="theme_color" class="form-label">Choose Sura Color</label>
                        <div class="d-flex align-items-center gap-3">
                            <div class="color-input-wrapper">
                                <input type="color" id="theme_color" name="sura_color" onchange="updateColorCode(this)">
                            </div>
                            <span id="colorCode" style="font-family: monospace;">#000000</span>
                        </div>

                        <script>
                            function updateColorCode(input) {
                                document.getElementById('colorCode').textContent = input.value.toUpperCase();
                            }
                        </script>

                    </div>
                    <div class="col-lg-4">
                        <label>Sura Icon</label>
                        <input type="file" class="form-control" name="sura_icon">
                    </div>
                </div>
                <div id="sura-theme-wrapper">
                    <div class="row top-content mt-4 sura-theme-group">
                        <div class="col-lg-4">
                            <label>Resource Title</label>
                            <input type="text" class="form-control" name="title[]">
                        </div>
                        <div class="col-lg-4">
                            <label>Resource Type</label>
                            <input type="text" class="form-control" name="type[]">
                        </div>
                        <div class="col-lg-4">
                            <label>Resource URL</label>
                            <input type="url" class="form-control" name="url[]">
                        </div>
                    </div>
                </div>

                <!-- Add button -->
                <div class="mt-3">
                    <button type="button" class="btn btn-info text-white" onclick="addSuraThemeRow()"
                            style="background-color: black;border: black">+ Add Resource
                    </button>
                </div>
                <script>
                    function addSuraThemeRow() {
                        let wrapper = document.getElementById('sura-theme-wrapper');
                        let groups = document.querySelectorAll('.sura-theme-group');
                        let lastGroup = groups[groups.length - 1];
                        let clone = lastGroup.cloneNode(true);

                        // Clear the input values in the cloned group
                        clone.querySelectorAll('input').forEach(input => input.value = '');

                        wrapper.appendChild(clone);
                    }
                </script>


                <button class="btn btn-success mt-3" type="submit">Submit</button>
            </div>
        </form>

    </div>
@endsection
@section("scripts")
    <script>
        document.getElementById("classification").addEventListener("change", function () {
            const subClassification = document.getElementById("sub_classification");
            const value = this.value;

            // Clear previous options
            subClassification.innerHTML = '<option value="">-- Select Sub Classification --</option>';

            if (value === "meccan") {
                ["Early Makki", "Middle Makki", "Late Makki"].forEach(function (item) {
                    let option = document.createElement("option");
                    option.value = item.toLowerCase();
                    option.textContent = item;
                    subClassification.appendChild(option);
                });
            } else if (value === "medinan") {
                let option = document.createElement("option");
                option.value = "madani";
                option.textContent = "Madani";
                subClassification.appendChild(option);
            }
        });
    </script>
@endsection
