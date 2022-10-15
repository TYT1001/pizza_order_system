@extends('admin.layouts.master')
@section('title','Pizza List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="d-flex justify-content-between">
                                <h2 class="title-1">Pizza List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('product#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                            {{-- <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button> --}}
                        </div>
                    </div>
                    @if(session('successPasswordChange'))
                        <div class="col-4 offset-8">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{session('successPasswordChange')}}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (session('createdSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('createdSuccess')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif
                    @if (session('updateSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('updateSuccess')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif



                        <div class=" d-flex justify-content-between algin-items-center mb-3">
                             {{-- for data searching --}}
                            <button class="btn btn-sm btn-success float-lg-right"><i class="fa-solid fa-database"></i>    {{count($pizzas)}}</button>
                            <form action="{{route('product#list')}}" method="get" class="d-flex">
                                <input type="text" class="form-control shadow-sm" name="key" value="{{request('key')}}" placeholder="Search...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>

                    @if (count($pizzas) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>View Count</th>
                                </tr>
                            </thead>


                            <tbody>

                                @foreach ($pizzas as $p)
                                <tr class="tr-shadow" style="margin-bottom:20px">
                                    <td class="col-3"><img src="{{asset('storage/'.$p->image)}}"alt="" class="img-thumbnail" style="height:100px"></td>
                                    <td class="col-3">{{$p->name}}</td>
                                    <td class="col-2">{{$p->price}}</td>
                                    <td class="col-2">{{$p->category_name}}</td>
                                    <td class="col-2"><i class="fa fa-eye"></i> {{$p->view_count}}</td>
                                    <td class="col-2">
                                        <div class="table-data-feature">
                                            <a href="{{route('product#details',$p->id)}}" >
                                            <button class="item"  title="View">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
                                            <a href="{{route('product#edit',$p->id)}}" class="mx-2">
                                                <button class="item"  title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{route("product#delete",$p->id)}}">

                                                <button class="item"  title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>

                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach



                            </tbody>

                        </table>
                        <div class="mt-3">
                            {{$pizzas->links()}}
                        </div>
                    </div>
                    @else
                    <div class="mt-5">
                        <h2 class="text-center title-1">There is no Pizza Here!</h2>
                    </div>
                    @endif



                    <!-- END DATA TABLE -->
                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
