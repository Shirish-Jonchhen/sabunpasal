@extends('admin.layouts.layout')
@section('admin_page_title', 'Manage Brand - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Brands</h5>
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
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class = "table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Is Featured</th>
                                    <th scope="col">Website Url</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td> {{ $brand->id }}</td>
                                        <td>{{ $brand->name }}</td>
                                        <td>
                                            @if ($brand->logo_path)
                                                <img src="{{ asset('storage/' . $brand->logo_path) }}" alt="Product Image"
                                                    width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $brand->slug }}</td>
                                        <td>
                                            {{ $brand->is_featured }}
                                            
                                        </td>
                                        <td>{{ $brand->website_url }}</td>

                                        <td>
                                            <a href="{{ route('show.brand', $brand->id) }}" class="btn btn-primary btn-sm">Edit</a>

                                            <form action="{{ route('delete.brand', $brand->id) }}" method="POST" style="display: inline-block;">

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
