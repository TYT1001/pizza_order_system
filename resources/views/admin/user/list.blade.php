@extends('admin.layouts.master')
@section('title','User List Page')
@section('content')
     <!-- MAIN CONTENT-->
     <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left w-100 d-flex justify-content-between">
                            <div class="overview-wrap ">
                                <h2 class="title-1">User List</h2>
                            </div>
                            @if(session('updateSuccess'))

                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>{{session('updateSuccess')}}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                            @endif
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2 mt-3">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>

                                <tbody>
                                    @foreach ($userList as $ul)
                                    <tr class="tr-shdow">
                                        @if ($ul->image == null)
                                                @if ($ul->gender == 'male')
                                                    <td class="col-2">
                                                        <img src="{{asset('image/default_image_male.png')}}" alt="" class="img-thumbnail shadow-sm">
                                                    </td>
                                                @else
                                                    <td class="col-2">
                                                        <img src="{{asset('image/default_image_female.jfif')}}" alt="" class="img-thumbnail shadow-sm">
                                                    </td>

                                                @endif
                                            @else
                                                <td class="col-2">
                                                    <img src="{{asset('storage/'.$ul->image)}}" alt="" class="img-thumbnail shadow-sm">
                                                </td>
                                            @endif
                                            <input type="hidden" name="" class="userID" value="{{$ul->id}}">
                                        <td>{{$ul->name}}</td>
                                        <td>{{$ul->email}}</td>
                                        <td>{{$ul->gender}}</td>
                                        <td>{{$ul->phone}}</td>
                                        <td>{{$ul->address}}</td>
                                        <td>
                                            <select name="" class="selectRole">
                                                <option value="user" @if ($ul->role == 'user')
                                                    selected
                                                @endif>User</option>
                                                <option value="admin" @if ($ul->role == 'admin')
                                                    selected
                                                @endif>Admin</option>
                                            </select>
                                        </td>
                                        <td>
                                            <a href="{{route('admin#userEditPage',$ul->id)}}">
                                                <button class="item mx-2" title="role change">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>

                                            <a href="{{route('admin#userDelete',$ul->id)}}">
                                                <button class="item" title="Delete">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>

                        </table>

                    </div>

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
            $('.selectRole').change(function(){

                $parentNode = $(this).parents('tr');
                $changedRole = $parentNode.find('.selectRole').val();
                $userID = $parentNode.find('.userID').val();
                $data = {
                    'userID' : $userID,
                    'role' : $changedRole
                }
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    data: $data,
                    url: 'http://localhost:8000/user/ajax/change/role'
                })

            })
    })
    </script>


@endsection

