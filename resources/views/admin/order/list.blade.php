@extends('admin.layouts.master')
@section('title','Order List Page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left w-100">
                            <div class="overview-wrap ">
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>

                    </div>
                        <div class="row container">

                            <form action="{{route('admin#orderStatus')}}" method="get" class="d-inline">
                                @csrf
                                <button class="btn btn-sm btn-success d-inline"><i class="fa-solid fa-database"></i>    {{count($order)}}</button>
                                <select id="selection" class="col-4 form-control w-25 shadow-sm d-inline" name="order_status">
                                    <option value="">All..</option>
                                    <option value="0">Pending..</option>
                                    <option value="1">Success..</option>
                                    <option value="2">Rejected..</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-dark">Search</button>
                            </form>
                        </div>


                    @if (count($order) != 0)
                    <div class="table-responsive table-responsive-data2 mt-3">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code <br> <i class="fa fa-exclamation-triangle text-warning"></i><small class="text-warning">Click for Order Details</small></th>
                                    <th>Total Amount <br> <i class="fa fa-exclamation-triangle text-warning"></i><small class="text-warning">Include Delivery Charges</small></th>
                                    <th>Status</th>

                                </tr>
                            </thead>

                                <tbody id="dataList">

                                    @foreach ($order as $o)

                                    <tr class="tr-shadow">
                                            <input type="hidden" value="{{$o->id}}" id="orderID">
                                            <td>{{$o->user_id}}</td>
                                            <td>{{$o->user_name}}</td>
                                            <td >{{$o->created_at->format('j-F-Y')}}</td>

                                                <td ><a href="{{route('order#orderInfo',$o->order_code)}}" class="text-primary text-decoration-none">{{$o->order_code}}</a></td>

                                            <td>{{$o->total_price}}</td>
                                            <td>
                                                <select name=""  class="form-control statusChange">
                                                    <option value="0" style="color:dark !important;"@if ($o->status==0)
                                                        selected
                                                    @endif>Pending..</option>
                                                    <option value="1" style="color:green !important;"@if ($o->status==1)
                                                        selected
                                                    @endif>Success..</option>
                                                    <option value="2"style="color:red !important;"@if ($o->status==2)
                                                        selected
                                                    @endif>Rejected..</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach



                                </tbody>

                        </table>

                    </div>
                    @else
                    <div class="my-5 text-center text-danger">No Data Here!</div>
                    @endif
                </div>
                    <!-- END DATA TABLE -->

                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')
<script>
    $(document).ready(function(){

        $('.statusChange').change(function(){

            $parentNode = $(this).parents('tr');
            $orderID = $parentNode.find('#orderID').val();
            $currentStatus = $(this).val();
            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/order/ajax/statusChange',
                data: {
                'status': $currentStatus,
                'orderID': $orderID
                 },
                dataType: 'json',
                success: function(res){
                    console.log(res);
                }
            })
        });

        });
</script>

@endsection
