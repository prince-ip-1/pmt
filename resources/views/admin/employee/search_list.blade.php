
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
}  
</style>

   @forelse($data as $user)

   <div class="col-md-12 col-xl-3">

      <div class="card user-card" style="padding: 0px 0;">
        <div class="">
        <div class="top-menu top-color">
            <img class="profile-bg-img img-fluid" style="height: 90px;" src="{{ URL::to('dist/assets/images/profile_bg.jpg')}}" alt="bg-img">
            <div class="row">
                <!-- <div class="col-md-12 text-center"> -->
                    <div class="col-md-6">
                        <div class="top-menu-left">
                            
                        </div>
                    </div>
                    
                    <div class="col-md-6" style="margin-top: 4px;">
                        <div class="top-menu-right">
                            <input name="change_status" id="change_status_{{$user->id}}" type="checkbox" data-id="{{$user->id}}" class="js-small changeProp" value="{{$user->status}}" data-type="{{$user->status}}" @if($user->status == 1) checked="" @endif>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
         <div class="card-header-img">
            <img class="img-fluid img-radius" src="{{ getImagePath($user->image,'users')}}" style="width:100px;height: 100px;object-fit: cover;border-radius: 50%;margin-top: -55px;
    border: 5px solid white;">

            <h4 style="    margin-top: 0px;">{{ $user->full_name }}</h4>

            <h5>{{ $user->email}}</h5>

            <h6>{{ $user->designation_name }}</h6>
            
         </div>

         

         <div>
             @php
                $usersession = Session('user_data');
                $userdata = EmployeeDetailById($usersession->id);
                $permission = $userdata->permissions;

                @endphp
            @if($userdata->department_id == 1 || (isset($permission[2]->edit) && $permission[2]->edit == 1))
            <a href="{{URL::to('/admin/edit_employee/'.$user->id)}}" class="btn btn-sm btn-primary waves-effect waves-light m-r-15"><i class="icofont icofont-pencil-alt-2 m-r-5"></i>Edit</a>
            @endif
            <a href="{{URL::to('admin/employee_details/'.$user->id)}}"><button type="button" class="btn btn-sm btn-success waves-effect waves-light"><i class="icofont icofont-user m-r-5"></i>View</button></a>
         </div>

      </div>

   </div>
   @empty
     <div class="col-md-12">
        <div class="card user-card">
          No Data Available.
        </div>
     </div>
   @endforelse
