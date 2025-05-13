@extends('admin.layouts.layout')
@section('admin_page_title', 'Manage Municipalities - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Municipalities</h5>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable fade show">
                            {{-- <ul type="none"> --}}
                                @foreach ($errors->all() as $error)
                                    {{-- <li> --}}
                                        *{{ $error }} <br>
                                        {{-- </li> --}}
                                @endforeach
                                {{-- </ul> --}}
                        </div>
                    @endif
                    @if (session("success"))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session("success") }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">District</th>
                                    <th scope="col">Municipality</th>
                                    <th scope="col">No. of Wards</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($municipalities as $m)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td> {{$m->id}}</td>
                                        <td>{{ $m->district->district_name }}</td>
                                        <td>{{ $m->municipality_name }}</td>
                                        <td>{{ $m->wards->count() }}</td>
                                        <td>

                                            <form action="{{ route('delete.municipality', $m->id) }}" method="POST"
                                                style="display: inline-block;">

                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
                                            {{-- <a href="#" class="btn btn-danger btn-sm">Delete</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection