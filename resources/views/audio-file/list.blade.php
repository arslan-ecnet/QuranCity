@extends('layouts.app')
@section('title')
    <title>Audio Files</title>
@endsection
@section('content')
    <style>
        .dash-content { min-height: calc(100vh - 100px); }
        .content-table { height: 100%; overflow: hidden; }
        .table-responsive { max-height: 100vh; overflow-y: auto; }
        #dataTable thead { position: sticky; top: 0; background-color: #fff; z-index: 10; }
    </style>
    <div class="dash-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="content-table">
            <div class="mb-4"><h5>Audio Files</h5></div>
            <a href="{{route('audioFileCreate')}}" class="btn btn-info text-white mb-3"
               style="background-color: #CAAE78;border-color: #CAAE78">Create Audio File</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="dataTable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Verse ID</th>
                        <th>Reciter</th>
                        <th>URL</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            if (!$.fn.DataTable.isDataTable('#dataTable')) {
                $('#dataTable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ route('audioFileList') }}",
                        "type": "GET"
                    },
                    "pageLength": 50,
                    "order": [[0, "asc"]],
                    "columnDefs": [
                        { "orderable": false, "targets": [5] }
                    ]
                });
            }
        });
    </script>
@endsection
