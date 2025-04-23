@extends('layouts.app')
@section('title')
    <title>Quran City</title>
@endsection
@section('content')
    <div class="dash-content">
        <div class="content-table">
            <div class="mb-4"><h5>Sura</h5></div>
            <a href="{{route('suraCreate')}}" class="btn btn-info text-white mb-3"
               style="background-color: #CAAE78;border-color: #CAAE78">Create</a>
            <div class="table-responsive" style="max-height: 500px; overflow-x: auto;">
                <table class="table table-striped table-hover align-middle" id="dataTable" style="min-width: 1000px;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Name Arabic</th>
                        <th>Translation</th>
                        <th>Classification</th>
                        <th>Sub Classification</th>
                        <th>Verses Count</th>
                        <th>Description</th>
                        <th>Summary</th>
                        <th>Theme</th>
                        <th>Revelation Order</th>
                        <th>Sura Color</th>
                        <th>Sura Icon</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($suras as $sura)
                        <tr>
                            <td>{{$sura->id}}</td>
                            <td>{{$sura->name_en}}</td>
                            <td>{{$sura->name_ar}}</td>
                            <td>{{$sura->translation}}</td>
                            <td>{{$sura->classification}}</td>
                            <td>{{$sura->sub_classification}}</td>
                            <td>{{$sura->verses_count}}</td>
                            <td>{{$sura->description}}</td>
                            <td>{{$sura->summary}}</td>
                            <td>{{$sura->theme->name}}</td>
                            <td>{{$sura->revelation_order}}</td>
                            <td>    <div style="width: 30px; height: 30px; border-radius: 6px; background-color: {{ $sura->sura_color }}; border: 1px solid #ccc;"></div>

                            <td>
                                @if($sura->sura_icon)
                                    <img src="{{ asset('storage/' . $sura->sura_icon) }}" alt="Sura Icon" height="40">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <a href="{{route('suraEdit' , ['id' => $sura->id])}}" class="btn btn-info text-white"
                                   style="background-color: #CAAE78;border-color: #CAAE78">Edit</a>
                                <a href="{{route('suraDelete' , ['id' => $sura->id])}}" class="btn btn-info text-white"
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
