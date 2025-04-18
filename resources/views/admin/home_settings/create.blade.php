@extends('admin.layouts.layout')
@section('admin_page_title', 'Create Banner - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add Banner</h5>
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
                    <form action="{{ route('add.home.banner') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <label for="title" class="form-label fw-bold mb-2">Banner Title</label>
                        <input type="text" class="form-control mb-2" name="title" placeholder="Discount Sale">

                        <label for="image" class="form-label fw-bold mb-2">Banner Image (3:1 Ratio)</label>
                        <input type="file" class="form-control mb-2" name="image" placeholder="BannerImage/jpg" >

                        <livewire:banner-link />


                        <label for="position" class="form-label fw-bold mb-2">Banner Position</label>
                        <select name="position" class="form-select mb-2">
                            <option value="1">First</option>
                            <option value="2">Second</option>
                            <option value="3">Third</option>
                            <option value="4">Fourth</option>
                            <option value="5">Fifth</option>
                        </select>


                        <button type="submit" class="btn btn-primary w-100">Create Banner</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
