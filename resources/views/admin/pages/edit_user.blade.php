@extends('admin.master.master')
@section('content')


    <div class="right_col" role="main">
        <div class="">

            <div class="page-title">
                <

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Inbox Design<small>@yield('title',$title)</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
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

                                        <div class="col-md-8">
                                            <form method="post" action="{{route('edit_user_action')}}" enctype="multipart/form-data">
                                                <input type="hidden" name="user_id" value="{{$userData->id}}">
                                                {{csrf_field()}}
                                        <div class="form-group">
                                            <input type="text" name="name" value="{{$userData->name}}" class="form-control" placeholder="name"  />
                                            {{$errors->first('name')}}
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="username" value="{{$userData->username}}" class="form-control" placeholder="Username"  />
                                            {{$errors->first('username')}}
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="email" value="{{$userData->email}}" class="form-control" placeholder="email" />
                                            {{$errors->first('email')}}
                                        </div>

                                        <div class="form-group">
                                            <input type="file" name="upload" class="btn btn-default"/>
                                            {{$errors->first('upload')}}
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary pull-left"> Update </button>

                                        </div>

                                        <div class="clearfix"></div>
                                    </form>
                                        </div>
                                <div class="col-md-4">
                                    <img src="{{url('public/images/userimages/'.$userData->image)}}" alt="image not found" class="img-responsive thumbnail">
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection