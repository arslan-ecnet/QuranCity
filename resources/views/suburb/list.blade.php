@extends('layouts.app')
@section('title')
    <title>Suburbs</title>
@endsection
@section('content')
    <div class="dash-content">
        <div class="content-table">
            <div class="mb-4"><h5>Suburbs</h5></div>
            <a href="{{route('suburbCreate')}}" class="btn btn-info text-white mb-3"
               style="background-color: #CAAE78;border-color: #CAAE78">Create</a>
            <div class="table-responsive" style="max-height: 500px; overflow-x: auto;">
                <table class="table table-striped table-hover align-middle" id="dataTable" style="min-width: 1000px;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($suburbs as $suburb)
                        <tr>
                            <td>{{$suburb->id}}</td>
                            <td>{{$suburb->name}}</td>
                            <td>{{$suburb->description}}</td>
                            <td>
                                <a href="{{route('suburbEdit' , ['id' => $suburb->id])}}" class="btn btn-info text-white"
                                   style="background-color: #CAAE78;border-color: #CAAE78">Edit</a>
                                <a href="{{route('suburbDelete' , ['id' => $suburb->id])}}" class="btn btn-info text-white"
                                   style="background-color: #561B06;border-color: #561B06">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
