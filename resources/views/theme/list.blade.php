@extends('layouts.app')
@section('title')
    <title>Themes</title>
@endsection
@section('content')
    <div class="dash-content">
        <div class="content-table">
            <div class="mb-4"><h5>Themes</h5></div>
            <a href="{{route('createTheme')}}" class="btn btn-info text-white mb-3"
               style="background-color: #CAAE78;border-color: #CAAE78">Create</a>
            <table class="table" id="dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Theme Color</th>
                    <th>Theme Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($themes as $theme)
                    <tr>
                        <td>{{$theme->id}}</td>
                        <td>{{$theme->name}}</td>
                        <td>    <div style="width: 30px; height: 30px; border-radius: 6px; background-color: {{ $theme->theme_color }}; border: 1px solid #ccc;"></div>
                        </td>
                        <td>
                            @if($theme->theme_image)
                                <img src="{{ asset('storage/' . $theme->theme_image) }}" alt="Theme Image" style="height: 50px; width: auto;">
                            @else
                                N/A
                            @endif
                        </td>

                        <td>
                            <a href="{{route('editTheme' , ['id' => $theme->id])}}" class="btn btn-info text-white"
                               style="background-color: #CAAE78;border-color: #CAAE78">Edit</a>
                            <a href="{{route('deleteTheme' , ['id' => $theme->id])}}" class="btn btn-info text-white"
                               style="background-color: #561B06;border-color: #561B06">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
