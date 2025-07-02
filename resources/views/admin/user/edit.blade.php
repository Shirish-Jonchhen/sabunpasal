@extends('admin.layouts.layout')
@section('admin_page_title', 'Edit User - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit User</h5>
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
                    <form action="{{ route('admin.update.user', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <label for="name" class="form-label fw-bold mb-2">Name</label>
                        <input type="text" class="form-control mb-2" name="name" placeholder="Sabun Pasal"
                            value="{{ $user->name }}" readonly>

                        <label for="email" class="form-label fw-bold mb-2">Email</label>
                        <input readonly type="text" class="form-control mb-2" name="email" placeholder="sabunpasal@gmail.com"
                            value="{{ $user->email }}">

                        <label for="google_id" class="form-label fw-bold mb-2">Google ID</label>
                        <input readonly type="text" class="form-control mb-2" name="google_id" placeholder="0123456789011"
                            value="{{ $user->google_id ?? "N/A" }}">

                        <label class="form-label fw-bold mb-2">Role</label>
                        <select class="form-select mb-2" name="role">
                            <option value="" selected>Select Role</option>
                            <option value="0" {{ $user->role == '0' ? 'selected' : '' }}>Admin</option>
                            <option value="1" {{ $user->role == '1' ? 'selected' : '' }}>Vendor</option>
                            <option value="2" {{ $user->role == '2' ? 'selected' : '' }}>Customer</option>
                            <option value="3" {{ $user->role == '3' ? 'selected' : '' }}>Delivery</option>
                           
                        </select>

                        <label for="email_verified_at" class="form-label fw-bold mb-2">Email Verified At</label>
                        <input type="text" class="form-control mb-2" name="email_verified_at" placeholder="2023-25-20"
                            value="{{ $user->email_verified_at ?? "N/A" }}">

                        <label for="created_at" class="form-label fw-bold mb-2">Created At</label>
                        <input type="text" class="form-control mb-2" name="created_at" placeholder="Meta Descriptions"
                            value="{{ $user->created_at }}" readonly> 


                        <button type="submit" class="btn btn-primary w-100">Update User</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection