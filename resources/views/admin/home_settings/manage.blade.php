@extends('admin.layouts.layout')
@section('admin_page_title', 'Manage Brand - Admin Panel')
@section('admin_layout')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">All Banners</h5>
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
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissable fade show">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class = "table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Banner title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Link Type</th>
                                    <th scope="col">Link Item/Group</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($banners as $banner)
                                    <tr>
                                        {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                        <td> {{ $banner->id }}</td>
                                        <td>{{ $banner->title }}</td>
                                        <td>
                                            @if ($banner->image_path)
                                                <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner Image"
                                                    width="150">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $banner->link_type }}</td>
                                        <td>
                                            @if ($banner->link_type == 'product')
                                                {{ $banner->link->product_name ?? 'N/AA' }}
                                                @elseif ($banner->link_type == 'brand')
                                                {{ $banner->link->name ?? 'N/AAA' }}
                                                @elseif ($banner->link_type == 'subcategory')
                                                {{ $banner->link->subcategory_name ?? 'N/AAAA' }}
                                            @endif
                                           
                                            {{-- {{ $banner->link_type == 'item' ? $banner->item->name : $banner->group->name }} --}}
                                            
                                        </td>
                                        <td>{{ $banner->position }}</td>

                                        <td>
                                            {{-- <a href="" class="btn btn-primary btn-sm">Edit</a> --}}

                                            <form action="{{ route('delete.home.banner', $banner->id) }}" method="POST" style="display: inline-block;">

                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger btn-sm">
                                            </form>
                                            {{-- <a href="#" class="btn btn-danger btn-sm">Delete</a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
