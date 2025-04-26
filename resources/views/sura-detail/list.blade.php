@extends('layouts.app')
@section('title')
    <title>Suras Detail</title>
@endsection
@section('content')
    <div class="dash-content">
        <div class="content-table">
            <div class="mb-4"><h5>Sura Details</h5></div>
            <a href="{{route('surahDetailCreate')}}" class="btn btn-info text-white mb-3"
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
                    @foreach($suraDetails as $suraDetail)
                        <tr>
                            <td>{{$suraDetail->id}}</td>
                            <td>{{$suraDetail->title}}</td>
                            <td>
                                @foreach (json_decode($suraDetail->summary ?? '[]') as $item)
                                    {{ $item }}<br>
                                @endforeach
                            </td>
                            <td>{{$suraDetail->sura->name}}</td>
                            <td>{{$suraDetail->theme->name}}</td>
                            <td>{{$suraDetail->from}}</td>
                            <td>{{$suraDetail->to}}</td>
                            <td>
                                <a href="{{route('surahDetailEdit' , ['id' => $suraDetail->id])}}"
                                   class="btn btn-info text-white"
                                   style="background-color: #CAAE78;border-color: #CAAE78">Edit</a>
                                <a href="{{route('surahDetailDelete' , ['id' => $suraDetail->id])}}"
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
