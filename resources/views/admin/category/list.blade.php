@extends('admin.layouts.master')
@section('title','Category List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('category#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add category
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

                    {{-- @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{session('deleteSuccess')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif --}}
                    <div class=" d-flex justify-content-between algin-items-center">
                        <div class="card bg-success px-3 py-2 title-1 ">
                            <h5 class="text-light">SearchKey: <span class="text-dark">{{Str::lower(request('key'))}}</span></h5>
                            <h5 class="text-light title-3">Total: {{$categories->total()}}</h5>
                        </div>
                        <div class="">
                            <form action="{{route('category#list')}}" method="get" class="d-flex">
                                <input type="text" class="form-control shadow-sm" name="key" value="{{request('key')}}" placeholder="Search...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @if (count($categories) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Created Date</th>

                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($categories as $cat)

                                <tr class="tr-shadow">
                                    <td>{{$cat->id}}</td>
                                    <td class="col-6">{{$cat->name}}</td>
                                    <td>{{$cat->created_at->format('j-F-Y')}}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" title="View">
                                                <i class="zmdi zmdi-mail-send"></i>
                                            </button>
                                            <a href="{{route('category#edit',$cat->id)}}" class="mx-2">
                                                <button class="item" title="Edit">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('category#delete',$cat->id)}}">
                                            <button class="item" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach


                            </tbody>

                        </table>
                    </div>
                    @else
                    <div class="mt-5">
                        <h2 class="text-center title-1">There is no Category Here!</h2>
                    </div>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
                <div class="container my-1">
                    {{$categories->links()}}
                    </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
