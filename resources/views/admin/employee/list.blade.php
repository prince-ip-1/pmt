@extends('layouts.default')

@section('content')
<style type="text/css">
    .display{
        display: all;
    }
    .nodisplay{
        display: none;
    }

.top-menu {
   /* background: #01a9ac;*/
   margin: 5px;
    border-radius: 5px;
    height: 100px;


}.top-menu-left {
    text-align: left;
    color: #fff;
}.top-menu-right {
     margin-left: 43px;
    /*text-align: right;
    color: #fff;
        padding: 5px;
        
   
    padding-left: 4px;
    border-radius: 36px;
    text-align: right;
    color: #000;
    padding: 3px 1px 3px 3px;*/
}  
</style>
<div class="main-body">
<input type="hidden" id="table_name" value="employee">
<input type="hidden" id="pagination_url" value="{{URL::to('admin/employee_pagination')}}">
    <div class="page-wrapper">

        @include('includes.breadcrumb')

<div class="row simple-cards">
 <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="search" class="form-control" id="search" placeholder="Enter First Name">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control show-tick chosen" name="department_id"  id="department_id">
                            <option value="">Select Department</option>
                            @foreach($department as $user)
                            <option value="{{$user->id}}">{{$user->department_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-control show-tick chosen" name="search_status"  id="search_status">
                            <!--<option value="1">All</option>-->
                            <option value="1">Active</option>
                            <option value="0" {{isset($_GET['status']) ? "selected" : ""}}>Inactive</option>
                        </select>
                        <!-- <button  id="search" name="search" class="search btn btn-primary btn-block" title="">Search</button> -->
                    </div>
                   <div class="col-md-3">
                        <button  id="filterBtn" class="btn btn-primary" style="width:40%;margin-left: 40px;" title="">Filter</button>
                        <button  id="clear" name="clear" class="btn btn-primary" style="width:40%;float: right;" title="">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card-block table_data">
        
</div>

</div>

@stop