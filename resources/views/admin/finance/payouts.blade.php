@extends('admin.layouts.layout')
@section('admin_page_title', 'Collections - Admin Panel')
@section('admin_layout')

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
                                        <label for="delivery_person_id">Delivery Person:</label>
                                        <select name="delivery_person_id" id="delivery_person_id" class="form-control">
                                            <option value="">All Delivery Persons</option>
                                            @foreach($deliveryPersons as $person)
                                                <option value="{{ $person->id }}" {{ ($request->input('delivery_person_id') == $person->id) ? 'selected' : '' }}>
                                                    {{ $person->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="start_date">Delivered From:</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $request->input('start_date') }}">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="end_date">Delivered To:</label>
                                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $request->input('end_date') }}">
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
                                    <th>Paid Amount</th>
                                    <th>Paid by</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Paid At</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payouts as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->deliveryPerson->name ?? 'N/A' }}</td> {{-- Access delivery person's name --}}
                                        <td>NRs. {{ number_format($data->amount, 2) }}</td>
                                        <td>{{ $data->paidBy->name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->period_start_date)->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->period_end_date)->format('Y-m-d') }}</td>
                                        
                                        <td>{{ $data->payment_date }}</td>
                                        
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
                        {{ $payouts->links('vendor.pagination.default') }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
