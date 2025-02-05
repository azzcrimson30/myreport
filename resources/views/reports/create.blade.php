@extends('layout')
@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h3>Add New Report</h3>
        </div>
    </div>
</div>

@include('alert')

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6" style="text-align: left">
            <h4 class="m-3" style="color:blueviolet">Report Information</h4>
        </div>
        <div class="col-6" style="text-align:right">
            <a class="btn btn-warning mb-2" href="{{ route('reports.index') }}">Back</a>
            <button type="submit" class="btn btn-primary mb-2">Submit</button>
        </div>
    </div><hr>

    <div class="row">
        <div class="col-6 mb-3">
            <label for="owner" class="col-sm-4 col-form-label">Owner</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" name="owner">
                  <option selected disabled>Select Owner</option>
                  @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                  @endforeach
                </select>
            </div>
        </div>

        <div class="col-6 mb-3">
            <label for="inputText" class="col-sm-4 col-form-label"> Report Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6 mb-3">
            <label for="inputNumber" class="col-sm-2 col-form-label">Format</label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example" name="format">
                  <option selected disabled>Select Format</option>
                  @foreach ($formats as $format)
                    <option value="{{$format->id}}">{{$format->name.'('.$format->format.')'}}</option>
                  @endforeach
                </select>
            </div>
        </div>
    </div>
</form>


<script>
    // const fileInput = document.getElementById('imageUpload');
    // const form = document.querySelector('form');
    // let isImageValid = true;

    // fileInput.addEventListener('change', function(event) {
    //     const file = event.target.files[0]; // Get the selected file
    //     if (file) {
    //         validateImage(file).then(validationMessage => {
    //             isImageValid = validationMessage;
    //         });
    //     }
    // });

    // form.addEventListener('submit', function(event) {
    //     if (!isImageValid) {
    //         alert('Image is not valid for upload.'); // Show error message
    //         event.preventDefault(); // Prevent form submission if image is not valid
    //     }
    // });

    // function validateImage(file) {
    //     const allowedFormats = ['image/png', 'image/jpeg', 'image/jpg'];
    //     const minWidth = 100;
    //     const minHeight = 100;

    //     return new Promise((resolve) => {
    //         let flag = true;

    //         if (!allowedFormats.includes(file.type)) {
    //             alert('Invalid file format. Only PNG, JPG, and JPEG are allowed.');
    //             flag = false;
    //         }

    //         const img = new Image();
    //         img.src = URL.createObjectURL(file);

    //         img.onload = function() {
    //             if (img.width < minWidth || img.height < minHeight) {
    //                 alert('Image must be at least 100x100 pixels.');
    //                 flag = false;
    //             }
    //             resolve(flag);
    //         };
    //     });
    // }
</script>

@endsection
