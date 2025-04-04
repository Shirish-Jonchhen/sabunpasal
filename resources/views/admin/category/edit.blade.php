@extends('admin.layouts.layout')
@section('admin_page_title', 'Edit Category - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Category</h5>
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
                    <form action="{{ route('update.cat', $category_info->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="category_name" class="form-label fw-bold mb-2">Category Name</label>
                        <input type="text" class="form-control mb-2" name="category_name" placeholder="Eelctronics" value="{{ $category_info->category_name }}">
                        <button type="submit" class="btn btn-primary w-100">Update Category</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
