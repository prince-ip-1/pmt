@extends('layouts.default')
@section('content')
<style type="text/css">
  .waves-light{
    float: right;
  }
  .media {
    padding-bottom: 10px;
    padding-right: 2px;
    margin-bottom: 10px;
  }
  .media-object {
    height: 30px;
    width: 30px;
    display: inline-block;
    object-fit: cover;
    border-radius: 50%;
  }
  .user-groups {
    padding-left: 20px;
    padding-bottom: 8px;
  }
  .media .chat-header {
    font-size: 12.5px;
    font-weight: 600;
    margin-top: 2px;
  }
  .media-left {
    padding-right: 10px;
  }
  .col-xl-l{
      position: relative;width:100%;min-height:1px;padding-right:8px;padding-left:10px;
  }
  .text-grey {
	color:#919594;
	font-weight: 500
  }
</style>
<div class="main-body">
   <div class="page-wrapper">
      <!-- Page-header start -->
      @include('includes.breadcrumb')
      <!-- Page-header end -->
      <!-- Page-body start -->   
      
      <div class="page-body">
        <div class="row">
            <div class="col col-xl-l">
                <div id="navigation">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card version">
                                <div class="card-header">
                                    <h5>Ideal Settings ({{count($data['ideal_settings'])}})</h5>
                                </div>
                                <div class="user-groups">
                                  @foreach($data['ideal_settings'] as $row)
                                  <div class="media">
                                    <div class="media-left">
                                      <img class="media-object" src="{{ getImagePath($row['image'],'users')}}" alt="image">
                                    </div>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">{{$row['full_name']}}</div>
                                    </div>
                                  </div>
                                  @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col col-xl-l">
                <div id="navigation">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card version">
                                <div class="card-header">
                                    <h5>In-Process ({{count($data['in_process'])}})</h5>
                                </div>
                                <div class="user-groups">
                                  @foreach($data['in_process'] as $row)
                                  <div class="media">
                                    <div class="media-left">
                                      <img class="media-object" src="{{ getImagePath($row['image'],'users')}}" alt="image">
                                    </div>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">{{$row['full_name']}}</div>
                                        <a href="{{URL::to('employee/tasks_list')}}"><div class="f-13" style="display: contents;font-weight: 600;">{{$row['project_name']}} : </div><span>#{{$row['task_project_id']}}</span></a>
                                        
                                    </div>
                                  </div>
                                  @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-xl-l">
                <div id="navigation">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card version">
                                <div class="card-header">
                                    <h5>In Testing ({{count($data['in_testing'])}})</h5>
                                </div>
                                <div class="user-groups">
                                  @foreach($data['in_testing'] as $row)
                                  <div class="media">
                                    <div class="media-left">
                                      <img class="media-object" src="{{ getImagePath($row['image'],'users')}}" alt="image">
                                    </div>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">{{$row['full_name']}}</div>
                                         <a href="{{URL::to('employee/tasks_list')}}"><div class="f-13" style="display: contents;font-weight: 600;">{{$row['project_name']}} : </div><span>#{{$row['task_project_id']}}</span></a>
                                       
                                    </div>
                                  </div>
                                  @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-xl-l">
                <div id="navigation">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card version">
                                <div class="card-header">
                                    <h5>Ready to Deploy ({{count($data['ready_deploy'])}})</h5>
                                </div>
                                <div class="user-groups">
                                  @foreach($data['ready_deploy'] as $row)
                                  <div class="media">
                                    <div class="media-left">
                                      <img class="media-object" src="{{ getImagePath($row['image'],'users')}}" alt="image">
                                    </div>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">{{$row['full_name']}}</div>
                                         <a href="{{URL::to('employee/tasks_list')}}"><div class="f-13" style="display: contents;font-weight: 600;">{{$row['project_name']}} : </div><span>#{{$row['task_project_id']}}</span></a>
                                       
                                    </div>
                                  </div>
                                  @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
          </div>
        </div>
      <!-- Page-body end -->
   </div>
</div>
<!-- Main-body end -->
@stop