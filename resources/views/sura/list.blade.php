@extends('layouts.app')
@section('title')
    <title>Surahs</title>
@endsection
@section('content')
    <style>
        .scroll-cell {
            max-width: 300px;
            max-height: 300px;
            overflow: auto;
            white-space: pre-wrap;
            padding: 5px;
            border: 1px solid #eee;
            background-color: #f9f9f9;
            font-size: 13px;
            line-height: 1.4;
        }

        .dash-content {
            min-height: calc(100vh - 100px);
        }

        .content-table {
            height: 100%; /* Fill the available space */
            overflow: hidden; /* Hide overflow content from the card */
        }

        /* Set the max-height of the table's container and enable scrolling */
        .table-responsive {
            max-height: 100vh; /* Adjust the max height to control the scrolling area */
            overflow-y: auto; /* Ensure vertical scrolling */
        }

        /* Sticky table header */
        #dataTable thead {
            position: sticky;
            top: 0;
            background-color: #fff; /* Optional: Adjust background color for readability */
            z-index: 10; /* Ensure header stays on top of other content */
        }
    </style>
    <div class="dash-content">
        <div class="content-table">
            <div class="mb-4"><h5>Surahs</h5></div>
            <a href="{{route('surahCreate')}}" class="btn btn-info text-white mb-3"
               style="background-color: #CAAE78;border-color: #CAAE78">Create</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="dataTable" style="min-width: 1000px;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surah Number</th>
                        <th>Total Verse</th>
                        <th>Classification</th>
                        <th>Sub Classification</th>
                        <th>Description</th>
                        <th>Summary</th>
                        <th>Focus</th>
                        <th>Did You Know</th>
                        <th>Benefits of Recitation</th>
                        <th>Selected Ayat</th>
                        <th>Sura Icon</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($suras as $sura)
                        <tr>
                            <td>{{$sura->id}}</td>
                            <td>{{$sura->name}}</td>
                            <td>{{$sura->surah_number}}</td>
                            <td>{{$sura->total_verses}}</td>
                            <td>{{$sura->classification}}</td>
                            <td>{{$sura->sub_classification}}</td>
                            <td class="text-truncate" style="max-width: 200px;" title="{{ $sura->description }}">
                                {{ Str::limit($sura->description, 50) }}
                            </td>

                            <td class="text-truncate" style="max-width: 200px;" title="{{ $sura->summary }}">
                                {{ Str::limit($sura->summary, 50) }}
                            </td>

                            <td class="text-truncate" style="max-width: 200px;" title="{{ implode(', ', json_decode($sura->focus ?? '[]')) }}">
                                {{ Str::limit(implode(', ', json_decode($sura->focus ?? '[]')), 50) }}
                            </td>

                            <td class="text-truncate" style="max-width: 200px;" title="{{ implode(', ', json_decode($sura->did_you_know ?? '[]')) }}">
                                {{ Str::limit(implode(', ', json_decode($sura->did_you_know ?? '[]')), 50) }}
                            </td>

                            <td class="text-truncate" style="max-width: 200px;" title="{{ implode(', ', json_decode($sura->benefits_of_recitation ?? '[]')) }}">
                                {{ Str::limit(implode(', ', json_decode($sura->benefits_of_recitation ?? '[]')), 50) }}
                            </td>

                            <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                title="@foreach (json_decode($sura->selected_ayat ?? '[]') as $item)
        @if (is_object($item))
            Ayat: {{ $item->ayat ?? '' }} - Summary: {{ $item->summary ?? '' }} |
        @else
            {{ $item }} |
        @endif
    @endforeach">
                                {{
                                    Str::limit(
                                        collect(json_decode($sura->selected_ayat ?? '[]'))->map(function($item) {
                                            if (is_object($item)) {
                                                return 'Ayat: ' . ($item->ayat ?? '') . ' - Summary: ' . ($item->summary ?? '');
                                            } else {
                                                return $item;
                                            }
                                        })->implode(' | '), 50
                                    )
                                }}
                            </td>



                            <td>
                                @if($sura->surah_icon)
                                    <img src="{{ asset('storage/' . $sura->surah_icon) }}" alt="Sura Icon" height="40">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{route('surahEdit' , ['id' => $sura->id])}}" class="btn btn-info text-white"
                                   style="background-color: #CAAE78;border-color: #CAAE78">Edit</a><hr>
                                <a href="{{route('surahDelete' , ['id' => $sura->id])}}" class="btn btn-info text-white"
                                   style="background-color: #561B06;border-color: #561B06">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
