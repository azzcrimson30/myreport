@extends('layout')
@section('content')

    <div class="row">
        <div class="col-6 margin-tb">
            <div class="row">
                <h3 style="color:blueviolet" class="m-3"> Report Information</h3>
            </div>
        </div>
        <div class="col-6" style="text-align:right">
            <a class="btn btn-warning col-sm-2" href="{{ route('reports.index') }}">Back</a>
        </div>
    </div><hr>

    <div class="row">
        <div class="col-6 mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ $report->name }}" disabled>
            </div>
        </div>

        <div class="col-6 mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Owner</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="owner" value="{{ $report->user_id }}" disabled>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6 mb-3">
            <label for="inputNumber" class="col-sm-2 col-form-label">Format</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="format" value="{{ $report->format }}" disabled>
            </div>
        </div>

        <div class="col-6 mb-3">
            <label for="inputText" class="col-sm-4 col-form-label">Location</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="location" value="{{ $report->location }}" disabled>
            </div>
        </div>
    </div>
@endsection
