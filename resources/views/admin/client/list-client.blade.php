@extends('layouts.default')
@section('content')
 @php
                $usersession = Session('user_data');
                $userdata = EmployeeDetailById($usersession->id);
                $permission = $userdata->permissions;
              
                @endphp
<style>
   
    .btn.btn-logo{
    border-radius: 2px;
    text-transform: capitalize;
    font-size: 15px;
    padding: 6px 5px;
    cursor: pointer;
    }
   .logo{
   margin-bottom:-16px;
}
.logo-empty{
   margin-bottom:-12px;
}
.display{
        display: all;
    }
    .nodisplay{
        display: none;
    }
</style>

<div class="main-body">
   <input type="hidden" id="table_name" value="clients">
   <div class="page-wrapper">
      @include('includes.breadcrumb')

<div class="row">
 <div class="col-lg-12 filter-bar">
            <nav class="navbar navbar-light bg-faded m-b-10 p-10">
              <ul class="nav navbar-nav sal">
                  <li class="nav-item m-r-25">
                    <input type="text" class="form-control" name="search" id="search-txt" placeholder="Search...">
                  </li>
                  <li class="nav-item m-r-25">
                    <select class="form-control" id="clientId" name="client_id" style="width:200px;">
                       <option value="id"> Select Country</option>
                          @foreach($data['client_country'] as $row)
                          <option value="{{$row->country}}">{{$row->country_name}}</option>
                          @endforeach
                      </select>
                  </li>
                  <li class="nav-item m-r-25">
                    <button class="btn btn-primary filterClient" data-type="1" title="">Filter</button>
                  </li>
                  <li class="nav-item m-r-25">
                    <button name="clear" class="btn btn-primary filterClient" data-type="0" title="">Reset</button>
                  </li>
              </ul>
              <div class="nav-item">
                   @if(getDepartment() == 1)
                  <a href=" {{URL::to('admin/add_client')}}" class="btn btn-primary  waves-effect waves-light waves-effect md-trigger" style="margin-right:2px;"
                     >Add Client
                  </a>
                   @elseif(isset($permission[8]->add) && $permission[8]->add == 1)
                   <a href=" {{URL::to('employee/add_client')}}" class="btn btn-primary  waves-effect waves-light waves-effect md-trigger" style="margin-right:2px;"
                     >Add Client
                  </a>
                   @endif
               </div>
            </nav>
          </div>
          </div>
      <div class="card-block table_data">
            @include('admin.client._client_pagination')
     </div>
      
   </div>
</div>
@stop