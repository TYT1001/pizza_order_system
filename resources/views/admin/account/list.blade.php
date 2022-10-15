@extends('admin.layouts.master')
@section('title','Admin List Page')
@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap ">
                                <div class="d-flex justify-content-between" style="width:74vw">
                                    <h2 class="title-1">Admin List</h2><button class="btn btn-sm btn-success float-lg-right"><i class="fa-solid fa-database"></i>{{count($admin)}}</button>
                                </div>
                            </div>
                        </div>

                    </div>
                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{session('deleteSuccess')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif
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
                    <div class="d-flex justify-content-end w-100 d-block">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('createdSuccess')}}</strong>
                            <button type="button" class="btn btn-dark" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif
                    @if (session('changeRoleSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{session('changeRoleSuccess')}}</strong>
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
                    <div class=" d-flex justify-content-end algin-items-center mb-3">

                            <form action="" class="d-flex">
                                <input type="text" class="form-control shadow-sm" name="key" value="{{request('key')}}" >
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </form>

                    </div>
                    @if (count($admin) != 0)
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead >
                                <tr>
                                    <th class="text-dark">Image</th>
                                    <th class="text-dark">Name</th>
                                    <th class="text-dark">Email</th>
                                    <th class="text-dark">Phone</th>
                                    <th class="text-dark">Address</th>
                                    <th class="text-dark">Gender</th>
                                    <th class="text-dark">Role</th>
                                    <th class="text-dark"></th>

                                </tr>
                            </thead>


                            <tbody>

                                        @foreach ($admin as $a)
                                        <tr class="tr-shadow">
                                            @if ($a->image == null)
                                                @if ($a->gender == 'male')
                                                    <td class="col-2">
                                                        <img src="{{asset('image/default_image_male.png')}}" alt="" class="img-thumbnail shadow-sm">
                                                    </td>
                                                @else
                                                    <td class="col-2">
                                                        <img src="{{asset('image/default_image_female.jfif')}}" alt="" class="img-thumbnail shadow-sm">
                                                    </td>

                                                @endif
                                            @else
                                                <td>
                                                    <img src="{{asset('storage/'.$a->image)}}" alt="" class="img-thumbnail shadow-sm">
                                                </td>
                                            @endif

                                            <td>{{$a->name}}</td>
                                            <td>{{$a->email}}</td>
                                            <td>{{$a->phone}}</td>
                                            <td>{{$a->address}}</td>
                                            <td>{{$a->gender}}</td>
                                            <input type="hidden" value="{{$a->id}}" class="adminID">
                                            <td>
                                                <select name="" class="adminSelect" class="form-control rounded-3">
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                            </td>
                                            <td>


                                                @if (Auth::user()->id != $a->id )
                                                <a href="{{route('admin#changePage',$a->id)}}">
                                                    <button class="item mx-2" data-toggle="tooltip" data-placement="top" title="role change">
                                                        <i class="fa-solid fa-user-minus"></i>
                                                    </button>
                                                </a>
                                                <a href="{{route('admin#delete',$a->id)}}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                                @endif

                                            </td>
                                        </tr>

                                    @endforeach



                            </tbody>

                        </table>
                    </div>

                    @else
                    <div class="mt-5">
                        <h2 class="text-center title-1">There is no users here!</h2>
                    </div>
                    @endif

                    <!-- END DATA TABLE -->
                </div>
                <div class="container my-1">
                    {{$admin->links()}}
                    </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
@section('scriptSection')
<script>
    $(document).ready(function(){
        $('.adminSelect').change(function(){
            $parentNode = $(this).parents('tr');
            $adminID = $parentNode.find('.adminID').val();
            $role = $('.adminSelect').val();
            $.ajax({
                type: 'get',
                url: 'http://localhost:8000/adminn/ajax/change/role',
                data:{
                    'adminID':$adminID,
                    'role':$role
                        },
                dataType: 'json',
                success: function(res){
                    console.log(res)
                }
            })
        })
    })
</script>
@endsection
