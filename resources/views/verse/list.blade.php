@extends('layouts.app')
@section('title')
    <title>Verses List</title>
@endsection
@section('content')
    <style>

    </style>
    <div class="dash-content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="content-table">
            <div class="mb-4"><h5>Verses</h5></div>
            <a href="{{route('verseCreate')}}" class="btn btn-info text-white mb-3"
               style="background-color: #CAAE78;border-color: #CAAE78">Create</a>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle" id="dataTable" style="min-width: 1000px;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Surah</th>
                        <th>Ayah Number</th>
                        <th>Ayah Global Number</th>
                        <th>Text Arabic</th>
                        <th>Simple Text</th>
                        <th>Sajdah</th>
                        <th>Juz</th>
                        <th>Hizb</th>
                        <th>Rub El Hizb</th>
                        <th>Page Number</th>
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
    <!-- DataTables CSS and JS -->
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
                        "url": "{{ route('verseList') }}",
                        "type": "GET"
                    },
                    "pageLength": 10,
                    "order": [[0, "asc"]],
                    "columnDefs": [
                        { "orderable": false, "targets": [11] } // disable sorting for Action column
                    ]
                });
            }
        });
    </script>
@endsection
