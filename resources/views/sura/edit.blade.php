@extends('layouts.app')
@section('title')
    <title>Edit Surah</title>
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Select2 Bootstrap form-control styling */
        .select2-container .select2-selection--single {
            height: calc(1.5em + .75rem + 2px) !important;
            border: 1px solid #ced4da !important;
            border-radius: .25rem !important;
            display: flex !important;
            align-items: center !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057 !important;
            line-height: normal !important;
            padding-left: .75rem !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            right: 10px !important;
        }
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #80bdff !important;
            outline: 0 !important;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25) !important;
        }
    </style>
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
        <form action="{{ route('surahUpdate',['id' => $surah->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="content-wrap box-content box-shadow p-4 p-md-5">
                <div class="row top-content">
                    <div class="col-lg-6">
                        <label>Surah Name</label>
                        <select class="form-control" name="name" id="surah_name_select">
                            <option value="">-- Select Surah --</option>
                            @foreach($quranSurahs as $qSurah)
                                <option value="{{ $qSurah->name_english ."-". $qSurah->name_transliteration}}" data-number="{{ $qSurah->id }}" data-verses="{{ $qSurah->total_verses }}" {{ (old('name', $surah->name) == $qSurah->name_english) ? 'selected' : '' }}>
                                    {{ $qSurah->name_english }} ({{ $qSurah->name_arabic }}) {{$qSurah->name_transliteration}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Surah Icon</label>
                        <input type="file" class="form-control" name="surah_icon">
                        @if($surah->surah_icon)
                            <img src="{{ asset('storage/' . $surah->surah_icon) }}" alt="Surah Icon" width="50" class="mt-2">
                        @endif
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Surah Number</label>
                        <input type="number" class="form-control" name="surah_number" value="{{ old('surah_number', $surah->surah_number) }}">
                    </div>
                    <div class="col-lg-6">
                        <label>Total Verses</label>
                        <input type="number" class="form-control" name="total_verses" value="{{ old('total_verses', $surah->total_verses) }}">
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Classification</label>
                        <select class="form-control" id="classification" name="classification">
                            <option value="">-- Select Classification --</option>
                            <option value="meccan" {{ $surah->classification == 'meccan' ? 'selected' : '' }}>Meccan</option>
                            <option value="medinan" {{ $surah->classification == 'medinan' ? 'selected' : '' }}>Medinan</option>
                        </select>
                    </div>
                    <div class="col-lg-6">
                        <label>Sub Classification</label>
                        <select class="form-control" id="sub_classification" name="sub_classification">
                            <option value="">-- Select Sub Classification --</option>
                            <option value="early makki" {{ $surah->sub_classification == 'early makki' ? 'selected' : '' }}>Early Makki</option>
                            <option value="middle makki" {{ $surah->sub_classification == 'middle makki' ? 'selected' : '' }}>Middle Makki</option>
                            <option value="late makki" {{ $surah->sub_classification == 'late makki' ? 'selected' : '' }}>Late Makki</option>
                            <option value="madani" {{ $surah->sub_classification == 'madani' ? 'selected' : '' }}>Madani</option>
                        </select>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Description</label>
                        <textarea id="description_editor" class="form-control ckeditor" name="description" rows="4">{{ old('description', $surah->description) }}</textarea>
                    </div>
                    <div class="col-lg-6">
                        <label>Summary</label>
                        <textarea id="summary_editor" class="form-control ckeditor" name="summary" rows="4">{{ old('summary', $surah->summary) }}</textarea>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Did You Know</label>&nbsp&nbsp&nbsp<a type="button" class="mb-3" onclick="addDidYouKnow()">+ Add</a>
                        <div id="did-you-know-group">
                            @foreach ($surah->did_you_know ?? [] as $fact)
                                <div class="row mb-2 did-you-know-item">
                                    <div class="col">
                                        <textarea name="did_you_know[]" class="form-control" rows="3">{{ $fact }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <label>Focus</label>&nbsp&nbsp&nbsp<a type="button" class="mb-3" onclick="addFocus()">+ Add</a>
                        <div id="focus-group">
                            @foreach ($surah->focus ?? [] as $item)
                                <div class="row mb-2 focus-item">
                                    <div class="col input-group">
                                        <input type="text" name="focus[]" class="form-control" value="{{ $item }}">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-secondary" onclick="formatTextCase(this)">Format Text</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row top-content mt-4">
                    <div class="col-lg-6">
                        <label>Benefits Of Recitation</label>&nbsp&nbsp&nbsp<a type="button" class="mb-3" onclick="addBenefit()">+ Add</a>
                        <div id="benefit-group">
                            @foreach ($surah->benefits_of_recitation ?? [] as $benefit)
                                <div class="row mb-2 benefit-item">
                                    <div class="col">
                                        <input type="text" name="benefits_of_recitation[]" class="form-control" value="{{ $benefit }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <label>Selected Ayat</label>&nbsp&nbsp&nbsp<a type="button" class="mb-3" onclick="addAyat()">+ Add Ayat</a>
                        <div id="ayat-group">
                            @foreach ($surah->selected_ayat as $ayat)
                                <div class="row mb-2 ayat-item">
                                    <div class="col">
                                        <input type="text" name="ayat_title[]" class="form-control" value="{{ $ayat['ayat'] ?? '' }}" placeholder="Ayat (e.g. 1 or 2-4)">
                                    </div>
                                    <div class="col">
                                        <input type="text" name="ayat_summary[]" class="form-control" value="{{ $ayat['summary'] ?? '' }}" placeholder="Summary">
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <button class="btn btn-success mt-3" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection

@section("scripts")
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            CKEDITOR.config.versionCheck = false;
            if (document.getElementById('description_editor')) {
                CKEDITOR.replace('description_editor');
            }
            if (document.getElementById('summary_editor')) {
                CKEDITOR.replace('summary_editor');
            }
        });

        function formatTextCase(btn) {
            const input = btn.parentElement.previousElementSibling;
            if (input && input.value) {
                // Convert to Title Case
                input.value = input.value.toLowerCase().replace(/\b\w/g, s => s.toUpperCase());
            }
        }
        document.getElementById("classification").addEventListener("change", function () {
            const subClassification = document.getElementById("sub_classification");
            const value = this.value;

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

        document.getElementById('surah_name_select').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const surahNumber = selectedOption.getAttribute('data-number');
            const totalVerses = selectedOption.getAttribute('data-verses');

            if(surahNumber && totalVerses) {
                document.querySelector('input[name="surah_number"]').value = surahNumber;
                document.querySelector('input[name="total_verses"]').value = totalVerses;
            } else {
                document.querySelector('input[name="surah_number"]').value = '';
                document.querySelector('input[name="total_verses"]').value = '';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#surah_name_select').select2({
                placeholder: "-- Select Surah --",
                allowClear: true
            });

            $('#surah_name_select').on('select2:select', function (e) {
                const selectedOption = e.params.data.element;
                const surahNumber = selectedOption.getAttribute('data-number');
                const totalVerses = selectedOption.getAttribute('data-verses');

                if(surahNumber && totalVerses) {
                    document.querySelector('input[name="surah_number"]').value = surahNumber;
                    document.querySelector('input[name="total_verses"]').value = totalVerses;
                } else {
                    document.querySelector('input[name="surah_number"]').value = '';
                    document.querySelector('input[name="total_verses"]').value = '';
                }
            });

            $('#surah_name_select').on('select2:unselect', function (e) {
                document.querySelector('input[name="surah_number"]').value = '';
                document.querySelector('input[name="total_verses"]').value = '';
            });

            $('#surah_name_select').on('select2:open', function () {
                setTimeout(function() {
                    document.querySelector('.select2-search__field').focus();
                }, 10);
            });
        });

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
                    <textarea name="did_you_know[]" class="form-control" rows="3"></textarea>
                </div>
            `;
            group.appendChild(newRow);
        }

        function addFocus() {
            const group = document.getElementById('focus-group');
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'mb-2', 'focus-item');
            newRow.innerHTML = `
                <div class="col input-group">
                    <input type="text" name="focus[]" class="form-control">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" onclick="formatTextCase(this)">Format Text</button>
                    </div>
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
