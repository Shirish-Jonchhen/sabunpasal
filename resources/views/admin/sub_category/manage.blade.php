@extends('admin.layouts.layout')
@section('admin_page_title', 'Manage Subcategory - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Sub Category</h5>
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
                                    <th scope="col">Sub Category Name</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Is Featured</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subcategories as $subcategory)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td> {{$subcategory->id}}</td>
                                        <td>{{ $subcategory->subcategory_name }}</td>
                                        <td>{{ $subcategory->category->category_name }}</td>
                                        <td>
                                            @if ($subcategory->icon_path)
                                                <img src="{{ asset('storage/' . $subcategory->icon_path) }}" alt="Category Icon"
                                                    width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $subcategory->slug }}</td>
                                        <td>
                                            {{ $subcategory->is_featured }}

                                        </td>
                                        <td>
                                            <a href="{{ route("show.subcat", $subcategory->id)   }}"
                                                class="btn btn-primary btn-sm">Edit</a>

                                            <form action="{{ route("delete.subcat", $subcategory->id)   }}" method="POST"
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