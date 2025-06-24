@extends('admin.layouts.layout')
@section('admin_page_title', 'Remaining Payouts - Admin Panel')
@section('admin_layout')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Remaining Payouts</h5>
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

                    <livewire:admin.user-manager />


                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Google ID</th>
                                    <th>Email Varified At</th>
                                    <th>Registered</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role == 0 ? 'Admin' : ($user->role == 1 ? 'Vendor' : ($user->role == 3 ? 'Delivery' : 'Customer')) }}
                                        </td>
                                        <td>{{ $user->google_id ?? 'N/A' }}</td>
                                        <td>{{ $user->email_verified_at ?? 'N/A' }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit.user',$user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            {{-- <form action="{{ route('delete.cat', $category->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                            </form> --}}
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
                            {{ $users->links('vendor.pagination.default') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
