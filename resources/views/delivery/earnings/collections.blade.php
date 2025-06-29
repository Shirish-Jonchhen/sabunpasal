@extends('delivery.layouts.layout')
@section('delivery_page_title', 'Collection - Delivery Panel')
@section('delivery_layout')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Payouts</h5>
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

                    {{-- <livewire:admin.user-manager /> --}}
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Filter Payouts</h6>
                        </div>
                        <div class="card-body">
                            <form method="GET"> {{-- Ensure this route matches your actual route name --}}
                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="sort">Sort By:</label>
                                        <select name="sort" id="sort" class="form-control">
                                            <option value="">Sory By</option>
                                            <option value="amount_asc"
                                                {{ $request->input('sort') == 'amount_asc' ? 'selected' : '' }}>Amount
                                                Ascending</option>
                                            <option value="amount_desc"
                                                {{ $request->input('sort') == 'amount_desc' ? 'selected' : '' }}>Amount
                                                Descending</option>
                                            <option value="date_asc"
                                                {{ $request->input('sort') == 'date_asc' ? 'selected' : '' }}>Date
                                                Ascending</option>
                                            <option value="date_desc"
                                                {{ $request->input('sort') == 'date_desc' ? 'selected' : '' }}>Date
                                                Descending</option>

                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="start_date">Delivered From:</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            value="{{ $request->input('start_date') }}">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="end_date">Delivered To:</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control"
                                            value="{{ $request->input('end_date') }}">
                                    </div>
                                    <div class="col-md-2 form-group d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Delivery User</th>
                                    <th>Collected Amount</th>
                                    <th>Collected by</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Paid At</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($collections as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->deliveryPerson->name ?? 'N/A' }}</td> {{-- Access delivery person's name --}}
                                        <td>NRs. {{ number_format($data->amount_collected, 2) }}</td>
                                        <td>{{ $data->collectedBy->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->period_start_date)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->period_end_date)->format('Y-m-d') }}</td>

                                        <td>{{ $data->collection_date }}</td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No delivery
                                            collections found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        {{ $collections->links('vendor.pagination.default') }}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
