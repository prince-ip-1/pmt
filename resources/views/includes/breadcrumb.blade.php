@php
if(isset($data['sub_title']) && !empty($data['sub_title'])){
    $url = $data['sub_title_url'];
   $split = explode('/',$url);
   
   if(getDepartment() == 1){
    $new_url = 'admin/'.$split[1];
   }else{
    $new_url = 'employee/'.$split[1];
   }
}
@endphp

<div class="page-body breadcrumb-page">
            <div class="card borderless-card">
                                            <div class="card-block caption-breadcrumb">
                                                <div class="breadcrumb-header">
                                                    <h5>{{ ucfirst($data['title']) }}  @if($data['title'] == 'Attendance List')({{date('d-m-Y')}})@endif</h5> 
                                                    
                                                </div>
                                                <div class="page-header-breadcrumb">
                                                    <ul class="breadcrumb-title">
                                                        <li class="breadcrumb-item">
                                                            @if(getDepartment() == 1)
                                                            <a href="{{ URL::to('admin/dashboard')}}">
                                                                <i class="icofont icofont-home"></i> Home
                                                            </a>
                                                            @else
                                                            <a href="{{ URL::to('employee/dashboard')}}">
                                                                <i class="icofont icofont-home"></i> Home
                                                            </a>
                                                            @endif
                                                        </li>
                                                        @if(isset($data['sub_title']) && !empty($data['sub_title']))
                                                        <li class="breadcrumb-item"><a href="{{ URL::to($new_url)}}">{{ $data['sub_title'] }}</a>
                                                        </li>
                                                        @else
                                                            
                                                        @endif
                                                        <li class="breadcrumb-item">{{ ucfirst($data['title']) }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
            </div>
        </div>