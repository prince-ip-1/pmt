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
                                    <h5>On the Way ({{count($data['pending'])}})</h5>
                                </div>
                                <div class="user-groups">
                                  @foreach($data['pending'] as $row)
                                  <div class="media">
                                    <div class="media-left">
                                      <img class="media-object" src="{{ getImagePath($row['image'],'users')}}" alt="image">
                                    </div>
                                    <div class="media-body">
                                        <div class="f-13 chat-header {{$row['isAbsent'] == 1 ? 'text-c-pink' : ''}}">{{$row['full_name']}}</div>
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
                                    <h5>CheckIn ({{count($data['checkIn'])}})</h5>
                                </div>
                                <div class="user-groups">
                                  @foreach($data['checkIn'] as $row)
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
                                    <h5>BreakIn ({{count($data['breakIn'])}})</h5>
                                </div>
                                <div class="user-groups">
                                  @foreach($data['breakIn'] as $row)
                                  <div class="media">
                                    <div class="media-left">
                                      <img class="media-object" src="{{ getImagePath($row['image'],'users')}}" alt="image">
                                    </div>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">{{$row['full_name']}} <span class="text-grey">({{$row['duration']}})</span></div>
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
                                    <h5>BreakOut ({{count($data['breakOut'])}})</h5>
                                </div>
                                <div class="user-groups">
                                  @foreach($data['breakOut'] as $row)
                                  <div class="media">
                                    <div class="media-left">
                                      <img class="media-object" src="{{ getImagePath($row['image'],'users')}}" alt="image">
                                    </div>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">{{$row['full_name']}} <span class="text-grey">({{$row['duration']}})</span></div>
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
                                    <h5>CheckOut ({{count($data['checkOut'])}})</h5>
                                </div>
                                <div class="user-groups">
                                  @foreach($data['checkOut'] as $row)
                                  <div class="media">
                                    <div class="media-left">
                                      <img class="media-object" src="{{ getImagePath($row['image'],'users')}}" alt="image">
                                    </div>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">{{$row['full_name']}} <span class="text-grey">({{$row['duration']}})</span></div>
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