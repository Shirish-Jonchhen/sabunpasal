@extends('admin.layouts.layout')
@section('admin_page_title', 'Manage Category - Admin Panel')
@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Category</h5>
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
                <div class = "table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                <td> {{$category->id}}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    <a href="{{ route('show.cat', $category->id ) }}" class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('delete.cat', $category->id) }}" method="POST" style="display: inline-block;">
                             
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
