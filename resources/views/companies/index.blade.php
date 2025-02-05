@extends('layout')
@section('content')
    <div class="pagetitle">
        <h2 style="color: blue">COMPANIES</h2>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-outline-primary m-3" href="{{ route('companies.create') }}"> Add New Company</a>
                </div>
            </div>
        </div>

        @include('companies.alert')

        <table class="table">
            <tr>
                <th scope="col" style="color: grey">Name</th>
                <th scope="col" style="color: grey">Email</th>
                <th scope="col" style="color: grey">Website</th>
                <th scope="col" style="color: grey" width="280px">Action</th>
            </tr>

            @foreach ($companies as $company)
            <tr>
                <td>
                    <a href="{{ route('companies.show',$company->id) }}" style="color: black">
                        <img src="{{ asset('storage/'.$company->logo) }}" alt="" width="50" height="50" style="border-radius: 10px;">
                        {{ $company->name }}
                    </a>
                </td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->website_link }}</td>
                <td>
                    <form action="{{ route('companies.destroy',$company->id) }}" method="POST">
                        <a class="btn btn-outline-warning" href="{{ route('companies.edit',$company->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="verify()">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $companies->links() !!}

        <script>
            function verify() {
                let text = "Are you sure to delete?";
                if (confirm(text) == false) {
                    event.preventDefault();
                }
            }
        </script>
    </section>
@endsection
