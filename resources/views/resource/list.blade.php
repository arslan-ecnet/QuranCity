@extends('layouts.app')
@section('title')
    <title>Resources</title>
@endsection
@section('content')
    <div class="dash-content">
        <div class="content-table">
            <div class="mb-4"><h5>Resources</h5></div>
            <a href="{{route('resourceCreate')}}" class="btn btn-info text-white mb-3"
               style="background-color: #CAAE78;border-color: #CAAE78">Create</a>
            <div class="table-responsive" style="max-height: 500px; overflow-x: auto;">
                <table class="table table-striped table-hover align-middle" id="dataTable" style="min-width: 1000px;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Sura</th>
                        <th>Url</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($resources as $resource)
                        <tr>
                            <td>{{$resource->id}}</td>
                            <td>{{$resource->title}}</td>
                            <td>{{$resource->type}}</td>
                            <td>{{$resource->sura->id}}</td>
                            <td>{{$resource->url}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
