                <div class="col-md-6 col-lg-9">

                    <!-- Greeting card start -->

                    <div class="card">

                        <div class="card-header" style="margin-bottom: -21px;">

                            <h5>{{ date('l, F jS Y')}}</h5>

                            <div class="card-header-right">

                                <ul class="list-unstyled card-option">

                                    <li><i class="feather icon-minus minimize-card"></i></li>

                                </ul>

                            </div>

                        </div>

                        <div class="card-block">

                            <span class="d-block text-c-blue f-36" id="greeting"></span>

                            <h4> {{session('user_data')->name}}</h4>

                        </div>

                        <div class="card-footer bg-c-blue">

                                                        <h6 class="text-white m-b-0"></h6>

                                                    </div>

                    </div>

                    <!-- Greeting card end -->

                </div>

