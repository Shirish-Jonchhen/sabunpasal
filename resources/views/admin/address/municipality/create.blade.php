@extends('admin.layouts.layout')
@section('admin_page_title', 'Add Municipality - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Add Municipality</h5>
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
                    <form action="{{ route('municipality.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <label for="attribute_value" class="form-label fw-bold mb-2">Municipality Name</label>
                        <input type="text" class="form-control mb-2" name="municipality_name" placeholder="Changunarayan">


                        <label for="attribute_value" class="form-label fw-bold mb-2">Delect District</label>
                        <select class="form-select mb-2" name="district_id">
                            <option value="" selected>Select District</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                            @endforeach
                        </select>

                        <label for="attribute_value" class="form-label fw-bold mb-2">Number of Wards</label>
                        <input type="number" class="form-control mb-2" name="number_of_wards" placeholder="32">

                        <button type="submit" class="btn btn-primary w-100">Add District</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection