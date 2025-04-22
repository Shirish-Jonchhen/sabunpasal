@extends('admin.layouts.layout')
@section('admin_page_title', 'Manage Category - Admin Panel')
@section('admin_layout')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Manage Categories</h5>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable fade show">
                        @foreach ($errors->all() as $error)
                            *{{ $error }} <br>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissable fade show">
                        {{ session('success') }}
                    </div>
                @endif

                <livewire:admin.category-manager />


                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Image</th>
                                <th>Slug</th>
                                <th>Is Featured</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>
                                        @if ($category->icon_path)
                                            <img src="{{ asset('storage/' . $category->icon_path) }}" alt="Icon" width="50">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->is_featured }}</td>
                                    <td>
                                        <a href="{{ route('show.cat', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('delete.cat', $category->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end mt-3"> 
                        {{ $categories->links("vendor.pagination.default") }}
                     </div> 
                    
            </div>
        </div>
    </div>
</div>

@endsection
