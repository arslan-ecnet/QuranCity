@extends('layouts.app')
@section('title')
    <title>Create Surah</title>
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
        <form action="{{route('surahCreate')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-6">
                        <label>Surah Name</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-lg-6">
                        <label>Surah Icon</label>
                        <input type="file" class="form-control" name="surah_icon">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Surah Number</label>
                        <input type="number" class="form-control" name="surah_number">
                    </div>
                    <div class="col-lg-6">
                        <label>Total Verses</label>
                        <input type="number" class="form-control" name="total_verses">
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
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>Summary</label>
                        <input type="text" class="form-control" name="summary">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Did You Know</label>&nbsp&nbsp&nbsp<a type="button" class="mb-3"
                                                                     onclick="addDidYouKnow()">+ Add</a>
                        <div id="did-you-know-group">
                            <div class="row mb-2 did-you-know-item">
                                <div class="col">
                                    <input class="form-control" name="did_you_know[]">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>Focus</label>&nbsp&nbsp&nbsp<a type="button" class="mb-3" onclick="addFocus()">+ Add</a>
                        <div id="focus-group">
                            <div class="row mb-2 focus-item">
                                <div class="col">
                                    <input class="form-control" name="focus[]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Benefits Of Recitation</label>&nbsp&nbsp&nbsp<a type="button" class="mb-3"
                                                                               onclick="addBenefit()">+ Add</a>
                        <div id="benefit-group">
                            <div class="row mb-2 benefit-item">
                                <div class="col">
                                    <input class="form-control" name="benefits_of_recitation[]">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <label>Selected Ayat</label>&nbsp&nbsp&nbsp<a type="button" class="mb-3" onclick="addAyat()">+
                            Add Ayat</a>
                        <div id="ayat-group">
                            <div class="row mb-2 ayat-item">
                                <div class="col">
                                    <input type="text" name="ayat_title[]" class="form-control"
                                           placeholder="Ayat (e.g. 1 or 2-4)">
                                </div>
                                <div class="col">
                                    <input type="text" name="ayat_summary[]" class="form-control" placeholder="Summary">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    <script>
        function addAyat() {
            const group = document.getElementById('ayat-group');
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-2', 'ayat-item');
            newRow.innerHTML = `
                                <div class="col">
                                    <input type="text" name="ayat_title[]" class="form-control" placeholder="Ayat (e.g. 1 or 2-4)">
                                </div>
                                <div class="col">
                                    <input type="text" name="ayat_summary[]" class="form-control" placeholder="Summary">
                                </div>
                            `;
            group.appendChild(newRow);
        }

        function addDidYouKnow() {
            const group = document.getElementById('did-you-know-group');
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-2', 'did-you-know-item');
            newRow.innerHTML = `
                                <div class="col">
                                    <input type="text" name="did_you_know[]" class="form-control">
                                </div>
                            `;
            group.appendChild(newRow);
        }

        function addFocus() {
            const group = document.getElementById('focus-group');
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-2', 'focus-item');
            newRow.innerHTML = `
                                <div class="col">
                                    <input type="text" name="focus[]" class="form-control">
                                </div>
                            `;
            group.appendChild(newRow);
        }

        function addBenefit() {
            const group = document.getElementById('benefit-group');
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-2', 'benefit-item');
            newRow.innerHTML = `
                                <div class="col">
                                    <input type="text" name="benefits_of_recitation[]" class="form-control">
                                </div>
                            `;
            group.appendChild(newRow);
        }
    </script>
@endsection
