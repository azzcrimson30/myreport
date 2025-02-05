@extends('layout')
@section('content')

    <div class="row">
        <div class="col-6 margin-tb">
            <div class="row">
                <h3 style="color:blueviolet" class="m-3"> Company Information</h3>
            </div>
        </div>
        <div class="col-6" style="text-align:right">
            <a class="btn btn-warning col-sm-2" href="{{ route('companies.index') }}">Back</a>
        </div>
    </div><hr>

    <div class="row">
        <div class="col-6 mb-3">
            <label for="inputText" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" value="{{ $company->name }}" disabled>
            </div>
        </div>

        <div class="col-6 mb-3">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" name="email" value="{{ $company->email }}" disabled>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6 mb-3">
            <label for="inputNumber" class="col-sm-2 col-form-label">Logo</label>
            <div class="col-sm-10">
                <img src="{{ asset('storage/'.$company->logo) }}" style="max-height: 500px; max-width: 500px;">
            </div>
        </div>

        <div class="col-6 mb-3">
            <label for="inputText" class="col-sm-4 col-form-label">Website link</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="wlink" value="{{ $company->website_link }}" disabled>
            </div>
        </div>
    </div>
@endsection
