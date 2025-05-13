@extends('admin.layouts.layout')
@section('admin_page_title', 'Edit Default Attribute - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Default Attribute</h5>
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
                    <form action="{{ route('update.attribute', $attribute_info->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="attribute_value" class="form-label fw-bold mb-2">Default Attribute Name</label>
                        <input type="text" class="form-control mb-2" name="attribute_value" placeholder="XL"
                            value="{{ $attribute_info->attribute_value }}">
                        <button type="submit" class="btn btn-primary w-100">Edit Attribute</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection