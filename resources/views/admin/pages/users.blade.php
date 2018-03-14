@extends('admin.master.master')
@section('content')

    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Inbox Design
                                <small>@yield('title',$title)</small>
                            </h2>
                            <div class="title_right">
                                <form action="{{route('user_search')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                        <div class="input-group">
                                            <input type="text" name="search_data" class="form-control"
                                                   placeholder="Search for...">
                                            <span class="input-group-btn">
                                     <button class="btn btn-default" type="button">Go!</button>
                                </form>

                                </span>
                            </div>
                        </div>
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12">
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{session('success')}}
                                </div>
                            @endif

                            <table class="table table-hover">
                                <tr>
                                    <th>s.n</th>
                                    <th>name</th>
                                    <th>user name</th>
                                    <th>email</th>
                                    <th>user type</th>
                                    <th>image</th>
                                    <th>action</th>
                                </tr>
                                @foreach($userData as $key=>$value)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->username}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>
                                            <form action="{{route('update_status')}}" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="user_id" value="{{$value->id}}">
                                            @if($value->user_type=='admin')
                                                <button name="admin" class="btn btn-success btn-xs">admin</button>
                                                @else
                                                <button name="user" class="btn btn-info btn-xs">user</button>

                                            @endif
                                            </form>


                                        </td>
                                        <td><img src="{{url('public/images/userimages/'.$value->image)}}"
                                                 alt="image not found" width="30"></td>
                                        <td>
                                            <a href="{{route('edit_user').'/'.$value->id}}"
                                               class="btn btn-primary btn-xs"><i
                                                        class="fa fa-pencil"></i> Edit</a>
                                            <a href="{{route('user_delete').'/'.$value->id}}"
                                               onclick="return confirm('are you sure delete')"
                                               class="btn btn-danger btn-xs"> <i
                                                        class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- /page content -->

@endsection