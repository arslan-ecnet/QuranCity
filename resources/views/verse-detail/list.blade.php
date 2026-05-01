@extends('layouts.app')
@section('title')
    <title>Surahs Detail</title>
@endsection
@section('content')
    <div class="dash-content">
        <div class="content-table">
            <div class="mb-4"><h5>Surah Details</h5></div>
            <a href="{{route('verseDetailCreate')}}" class="btn btn-info text-white mb-3"
               style="background-color: #CAAE78;border-color: #CAAE78">Create</a>
            <div class="table-responsive" style="max-height: 500px; overflow-x: auto;">
                <table class="table table-striped table-hover align-middle" id="dataTable" style="min-width: 1000px;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Summary</th>
                        <th>Surah</th>
                        <th>Theme</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($verseDetails as $verseDetail)
                        <tr>
                            <td>{{$verseDetail->id}}</td>
                            <td>{{$verseDetail->title}}</td>
                            <td style="max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                title="@foreach (json_decode($verseDetail->summary ?? '[]') as $item) {{ $item }} | @endforeach">
                                {{
                                    Str::limit(
                                        collect(json_decode($verseDetail->summary ?? '[]'))->implode(' | '),
                                        50
                                    )
                                }}
                            </td>

                            <td>{{$verseDetail->sura->name_english}} {{$verseDetail->sura->name_arabic}}</td>
                            <td>{{$verseDetail->theme->name}}</td>
                            <td>{{$verseDetail->from}}</td>
                            <td>{{$verseDetail->to}}</td>
                            <td>
                                <a href="{{route('verseDetailEdit' , ['id' => $verseDetail->id])}}"
                                   class="btn btn-info text-white"
                                   style="background-color: #CAAE78;border-color: #CAAE78">Edit</a><hr>
                                <a href="{{route('verseDetailDelete' , ['id' => $verseDetail->id])}}"
                                   class="btn btn-info text-white"
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
