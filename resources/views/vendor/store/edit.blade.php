@extends('vendor.layouts.layout')
@section('vendor_page_title', 'Create Store - Vendor')

@section('vendor_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Store</h5>
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
                    <form action="{{ route('update.store', $store->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="store_name" class="form-label fw-bold mb-2">Category Name</label>
                        <input type="text" class="form-control mb-2" name="store_name" placeholder="xyz store"
                            value="{{ $store->store_name }}">

                        <label for="slug" class="form-label fw-bold mb-2">Slug</label>
                        <input type="text" class="form-control mb-2" name="slug" placeholder="xyz"
                            value="{{ $store->slug }}">

                        <label for="details" class="form-label fw-bold mb-2">Store Description</label>
                        <textarea class="form-control mb-2" name="details" placeholder="xyz store description"
                            rows="10">{{ $store->details }}</textarea>
                        {{-- <input type="text" class="form-control mb-2" name="store_name" placeholder="xyz store"> --}}


                        <button type="submit" class="btn btn-primary w-100">Edit Store</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection