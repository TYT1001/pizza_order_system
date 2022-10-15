@extends('user.layouts.master')
@section('title','History Page')
@section('content')
<!-- Cart Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5 offset-2">
            <table class="table table-light table-borderless table-hover mb-0 text-center" id="dataTable">
                <thead class="thead-dark text-center">
                    <div class="">
                        <th>Date</th>
                        <th>Order ID</th>
                        <th>Totla Price</th>
                        <th >Status</th>

                    </div>
                </thead>
                <tbody class="align-middle">
                    @foreach ($order as $o)
                    <tr>
                        <td class="align-middle">{{$o->created_at}}</td>
                        <td class="align-middle">{{$o->order_code}}</td>
                        <td class="align-middle">{{$o->total_price}}</td>
                        <td class="align-middle">
                            @if ($o->status == 0)
                                <button class="btn-sm btn-dark shadow-sm rounded">Pending..</button>
                            @elseif ($o->status == 1)
                                <button class="btn-sm btn-success shadow-sm rounded">Success..</button>
                            @elseif ($o->status == 2)
                                <button class="btn-sm btn-danger shadow-sm rounded">Rejected.</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">

                {{$order->links()}}
            </div>
        </div>

    </div>
</div>
<!-- Cart End -->
@endsection
