@extends('admin.layouts.layout')
@section('admin_page_title', 'Create SubCategory - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create Sub Category</h5>
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


                    <form action="{{ route("store.subcat") }}" method="POST">
                        @csrf
                        @method('POST')

                        <label for="subcategory_name" class="form-label fw-bold mb-2">Sub Category Name</label>
                        <input type="text" class="form-control mb-2" name="subcategory_name" placeholder="Television">

                        <label for="category_id" class="form-label fw-bold mb-2">Category Name</label>
                        <select name="category_id" id="category_id" class="form-control mb-2">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-primary w-100">Create Sub Category</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection