@extends('delivery.layouts.layout')
@section('delivery_page_title', 'Dashboard - Delivery')
@section('delivery_layout')


@php
use App\Models\StoreOrder;
use App\Models\Order;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;

@endphp

{{-- <div class="container-fluid p-0"> --}}

<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

<div class="row">
<div class="col-xl-6 col-xxl-5 d-flex">
    <div class="w-100">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Earnings</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="truck"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">NRs.
                            {{ Order::where('delivered_by', Auth::user()->id)
                            ->where('order_status', 'delivered')
                            ->whereNotNull('delivery_payout_id')
                            ->whereNotNull('delivery_guy_commission')
                            ->sum('delivery_guy_commission');}}
                        </h1>
                       
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Total Deliveries</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="users"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">
                            {{ Order::where('delivered_by', Auth::user()->id)
                            ->where('order_status', 'delivered')
                            // ->whereNotNull('delivery_payout_id')
                            ->whereNotNull('delivery_guy_commission')
                            ->count(); }}
                        </h1>

                       
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Remaining Collections</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="shopping-bag"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">
                            {{ Order::where('delivered_by', Auth::user()->id)
                            ->where('order_status', 'delivered')
                            ->whereNull('delivery_collection_id')
                            ->whereNotNull('delivery_guy_commission')
                            ->sum('total_amount'); }}
                        </h1>
        
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col mt-0">
                                <h5 class="card-title">Remaining Payouts</h5>
                            </div>

                            <div class="col-auto">
                                <div class="stat text-primary">
                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <h1 class="mt-1 mb-3">
                            {{ Order::where('delivered_by', Auth::user()->id)
                            ->where('order_status', 'delivered')
                            ->whereNotNull('delivery_collection_id')
                            ->whereNull('delivery_payout_id')
                            ->whereNotNull('delivery_guy_commission')
                            ->sum('delivery_guy_commission');  }}
                        </h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-xl-6 col-xxl-7">
    <div class="card flex-fill w-100">
        <div class="card-header">

            <h5 class="card-title mb-0">Monthly Earnings</h5>
        </div>
        <div class="card-body py-3">
            <div class="chart chart-sm">
                <canvas id="chartjs-dashboard-line"></canvas>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row">
<div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
    <div class="card flex-fill w-100">
        <div class="card-header">

            <h5 class="card-title mb-0">Delivery Municipality</h5>
        </div>
        <div class="card-body d-flex">
            <div class="align-self-center w-100">
                <div class="py-3">
                    <div class="chart chart-xs">
                        <canvas id="chartjs-dashboard-pie"></canvas>
                    </div>
                </div>

                <table class="table mb-0">
                    <tbody>
                        @for ($i = 0; $i < $deliveryLocationLabels->count(); $i++)
                            <tr>
                                <td>{{ $deliveryLocationLabels[$i] }}</td>
                                <td class="text-end">{{ $deliveryLocationCountsData[$i] }}</td>
                            </tr>
                        @endfor

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
    <div class="card flex-fill w-100">
        <div class="card-header">

            <h5 class="card-title mb-0">Real-Time</h5>
        </div>
        <div class="card-body px-4">
            <div id="world_map" style="height:350px;"></div>
        </div>
    </div>
</div>
<div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
    <div class="card flex-fill">
        <div class="card-header">

            <h5 class="card-title mb-0">Calendar</h5>
        </div>
        <div class="card-body d-flex">
            <div class="align-self-center w-100">
                <div class="chart">
                    <div id="datetimepicker-dashboard"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row">
<div class="col-12 col-lg-8 col-xxl-9 d-flex">
    <div class="card flex-fill">
        <div class="card-header">

            <h5 class="card-title mb-0">Active Orders</h5>
        </div>
        <table class="table table-hover my-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="d-none d-xl-table-cell">Order Date</th>
                    <th class="d-none d-xl-table-cell">SubTotal</th>
                    <th class="d-none d-xl-table-cell">Discount</th>
                    <th class="d-none d-xl-table-cell">Tax Amount</th>
                    <th class="d-none d-xl-table-cell">Delivery Charge</th>
                    <th class="d-none d-xl-table-cell">Total Amount</th>
                    <th class="d-none d-xl-table-cell">Shipping Method</th>
                    <th class="d-none d-md-table-cell">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Order::where('delivered_by', Auth::user()->id)->latest()->take(5)->get() as $order )
                <tr>
                    <td>{{$order->order_tracking_number}}</td>
                    <td class="d-none d-xl-table-cell">{{$order->created_at}}</td>
                    <td class="d-none d-xl-table-cell">{{$order->subtotal}}</td>
                    <td class="d-none d-xl-table-cell">{{$order->discount}}</td>
                    <td class="d-none d-xl-table-cell">{{$order->tax}}</td>
                    <td class="d-none d-xl-table-cell">{{$order->delivery_charge}}</td>
                    <td class="d-none d-xl-table-cell">{{$order->total_amount}}</td>
                    <td class="d-none d-xl-table-cell">{{$order->delivery_method}}</td>
                    @php
                        $statusClass = '';
                        if ($order->order_status == 'pending') {
                            $statusClass = 'bg-secondary';
                        } elseif ($order->order_status == 'processing') {
                            $statusClass = 'bg-warning';
                        } elseif ($order->order_status == 'shipped') {
                            $statusClass = 'bg-primary';
                        }elseif ($order->order_status == 'delivered') {
                            $statusClass = 'bg-success';
                        }elseif ($order->order_status == 'cancelled') {
                            $statusClass = 'bg-danger';
                        }elseif ($order->order_status == 'returned') {
                            $statusClass = 'bg-danger';
                        }
                    @endphp
                    <td><span class="badge {{ $statusClass }}">{{$order->order_status}}</span></td>

                </tr>
                @endforeach
                
                
            </tbody>
        </table>
    </div>
</div>
<div class="col-12 col-lg-4 col-xxl-3 d-flex">
    <div class="card flex-fill w-100">
        <div class="card-header">

            <h5 class="card-title mb-0">Monthly Deliveries</h5>
        </div>
        <div class="card-body d-flex w-100">
            <div class="align-self-center chart chart-lg">
                <canvas id="chartjs-dashboard-bar"></canvas>
            </div>
        </div>
    </div>
</div>
</div>

{{-- </div> --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
    var gradient = ctx.createLinearGradient(0, 0, 0, 225);
    gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
    gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
    // Line chart
    new Chart(document.getElementById("chartjs-dashboard-line"), {
        type: "line",
        data: {
            labels: @json($months),
            datasets: [{
                label: "Earnings",
                fill: true,
                backgroundColor: gradient,
                borderColor: window.theme.primary,
                data: @json($monthlyCommissionEarnings),
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            tooltips: {
                intersect: false
            },
            hover: {
                intersect: true
            },
            plugins: {
                filler: {
                    propagate: false
                }
            },
            scales: {
                xAxes: [{
                    reverse: true,
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }],
                yAxes: [{
                    ticks: {
                        stepSize: 1000
                    },
                    display: true,
                    borderDash: [3, 3],
                    gridLines: {
                        color: "rgba(0,0,0,0.0)"
                    }
                }]
            }
        }
    });
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: {!! json_encode($deliveryLocationLabels) !!},
                datasets: [{
                    data: {!! json_encode($deliveryLocationCountsData) !!},
                    // Use the dynamically generated colors here
                    backgroundColor: {!! json_encode($pieChartColors) !!},
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });
    });
    </script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Bar chart
    new Chart(document.getElementById("chartjs-dashboard-bar"), {
        type: "bar",
        data: {
            labels: @json($months),
            datasets: [{
                label: "This year",
                backgroundColor: window.theme.primary,
                borderColor: window.theme.primary,
                hoverBackgroundColor: window.theme.primary,
                hoverBorderColor: window.theme.primary,
                data: @json($monthlyDeliveredOrdersCount),
                barPercentage: .75,
                categoryPercentage: .5
            }]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    stacked: false,
                    ticks: {
                        stepSize: 25000
                    }
                }],
                xAxes: [{
                    stacked: false,
                    gridLines: {
                        color: "transparent"
                    }
                }]
            }
        }
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var markers = [{
            coords: [28.3949, 84.1240],
            name: "Nepal"
        },
    ];
    var map = new jsVectorMap({
        map: "world",
        selector: "#world_map",
        zoomButtons: true,
        markers: markers,
        markerStyle: {
            initial: {
                r: 9,
                strokeWidth: 7,
                stokeOpacity: .4,
                fill: window.theme.primary
            },
            hover: {
                fill: window.theme.primary,
                stroke: window.theme.primary
            }
        },
        zoomOnScroll: false
    });
    window.addEventListener("resize", () => {
        map.updateSize();
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var date = new Date(Date.now());
    var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
    document.getElementById("datetimepicker-dashboard").flatpickr({
        inline: true,
        prevArrow: "<span title=\"Previous month\">&laquo;</span>",
        nextArrow: "<span title=\"Next month\">&raquo;</span>",
        defaultDate: defaultDate
    });
});
</script>
@endsection
