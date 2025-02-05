@extends('layout')
@section('content')
<div class="pagetitle">
    <h2>Reports</h2>
    <nav>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active">Reports Index</li>
        </ol>
    </nav>
</div>
<!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-outline-primary m-3" href="{{ route('reports.create') }}"> Add New report</a>
                </div>
            </div>
        </div>

        @include('alert')

        <table class="table">
            <tr>
                <th scope="col" style="color: grey">Name</th>
                <th scope="col" style="color: grey">Owner</th>
                <th scope="col" style="color: grey">Date Created</th>
                <th scope="col" style="color: grey">Last Updated</th>
                <th scope="col" style="color: grey" width="280px">Action</th>
            </tr>

            @foreach ($reports as $report)
            <tr>
                <td>
                    <a href="{{ route('reports.show',$report->id) }}" style="color: black">
                        {{-- <img src="{{ asset('storage/'.$report->logo) }}" alt="" width="50" height="50" style="border-radius: 10px;"> --}}
                        {{ $report->name.' ('.$report->id.')' }}
                    </a>
                </td>
                <td>{{ $report->owner->name }}</td>
                <td>{{ $report->created_at}}</td>
                <td>{{ $report->updated_at}}</td>
                <td>
                    <form action="{{ route('reports.destroy',$report->id) }}" method="POST">
                        <a class="btn btn-outline-warning" href="{{ route('reports.edit',$report->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger" onclick="verify()">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        {!! $reports->links() !!}

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
