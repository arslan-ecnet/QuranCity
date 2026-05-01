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
                        <th>Surah Name</th>
                        <th>Ayah Number</th>
                        <th>Ayah Global Number</th>
                        <th>Text Arabic</th>
                        <th>Simple Text</th>
                        <th>Sajdah</th>
                        <th>Juz</th>
                        <th>Hizb</th>
                        <th>Rub Ul Hizb</th>
                        <th>Page Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($verses as $verse)
                        <tr>
                            <td>{{$verse->id}}</td>
                            <td>{{$verse->surah_id}}</td>
                            <td>{{$verse->ayah_number}}</td>
                            <td>{{$verse->ayah_global_number}}</td>
                            <td>{{$verse->text_arabic}}</td>
                            <td>{{$verse->text_simple}}</td>
                            <td>{{$verse->sajdah}}</td>
                            <td>{{$verse->juz}}</td>
                            <td>{{$verse->hizb}}</td>
                            <td>{{$verse->rub_ul_hizb}}</td>
                            <td>{{$verse->page_number}}</td>

                            <td>
                                <a href="{{route('surahEdit' , ['id' => $verse->id])}}" class="btn btn-info text-white"
                                   style="background-color: #CAAE78;border-color: #CAAE78">Edit</a><hr>
                                <a href="{{route('surahDelete' , ['id' => $verse->id])}}" class="btn btn-info text-white"
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
