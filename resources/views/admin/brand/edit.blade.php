@extends('admin.layouts.layout')
@section('admin_page_title', 'Edit Brand - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Brand</h5>
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
                    <form action="" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <label for="name" class="form-label fw-bold mb-2">Brand Name</label>
                        <input type="text" class="form-control mb-2" name="name" placeholder="Dabur" value="{{ $brand_info->name }}">

                        <label for="description" class="form-label fw-bold mb-2">Brand Description</label>
                        <textarea class="form-control mb-2" name="description" placeholder="Describe your Brand"
                            rows="10"> {{ $brand_info->description }}</textarea>

                            <label class="form-label fw-bold mb-2">Brand Logo</label>
                            <div class="mb-3">
                                <!-- Show existing images -->
                                @if($brand_info->logo_path)
                                    <div class="d-flex flex-wrap gap-3">
                                    
                                            <div class="position-relative h-200 justify-center item-center" style="width: 150px;">
                                                <img src="{{ asset('storage/' . $brand_info->logo_path) }}" alt="Product Image"
                                                    class="img-thumbnail w-100 h-auto object-fit ">
                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                    onclick="deleteImage('{{ $brand_info->logo_path }}')"> ✖ </button>
                                            </div>
                                 
                                    </div>
                                @endif
                            </div>

                            <label for="slug" class="form-label fw-bold mb-2">Slug</label>
                            <input type="text" class="form-control mb-2" name="slug" placeholder="demo" value="{{ $brand_info->slug }}">

                            <label for="meta_title" class="form-label fw-bold mb-2">Meta Title</label>
                            <input type="text" class="form-control mb-2" name="meta_title" placeholder="Meta Titles" value="{{ $brand_info->meta_title }}">
    
                            <label for="meta_description" class="form-label fw-bold mb-2">Meta Description</label>
                            <input type="text" class="form-control mb-2" name="meta_description"
                                placeholder="Meta Descriptions" value="{{ $brand_info->meta_description }}">

                                <label for="website_url" class="form-label fw-bold mb-2">Website Url</label>
                            <input type="text" class="form-control mb-2" name="website_url"
                                placeholder="https://www.example.com" value="{{ $brand_info->website_url }}">


                        <button type="submit" class="btn btn-primary w-100">Update Brand</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
