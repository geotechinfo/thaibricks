@extends('layouts.default')
@section('content')
<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="innerBread">
      <div class="col-sm-12">
          <span>You are here:</span>
          <ul class="topBreadcrumbs">
            <li><a href="javascript:;">Home</a></li>
            <li><a href="javascript:;">Sign up</a></li>
          </ul>
      
      </div>
      
    </div>
  </div>
</section>

<section class="container container2 margin-top-10" id="propertylist">
  <aside class="col-sm-3 col-sm-push-9">
  	<div class="well clearfix grey">
         	<h4 class="text-left no-margin">Sign In</h4>
            <div class="border-bottom"></div>
            <p class="text-left margin-top-10">Already have an account the login direcly</p>
            {{ Form::open(array('route' => array('login'), 'method' => 'post')) }}
                  <div class="form-group">
                    {{Form::text('email', null,array('class' => 'form-control', 'placeholder' => 'Email'))}}
                  </div>
                  <div class="form-group">
                    {{Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password'))}}
                  </div>
                  {{Form::submit('Login', array('class' => 'btn btn-default orange login_btn'))}}
           {{ Form::close() }}
         </div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad1.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad2.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad3.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
    <h2>Register to sell your property</h2>
    <div class="propertylist clearfix new">
      <div class="formwrap">
        <div role="tabpanel">
          <ul role="tablist" class="nav nav-tabs">
            <li class="active" role="presentation"> <a data-toggle="tab" role="tab" aria-controls="seller" href="#seller">Seller</a> </li>
            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="agent" href="#agent">Agent </a></li>
            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="builder" href="#builder">Builder</a></li>
          </ul>
        </div>
        <div class="tab-content white no-margin registration-body">
        
        
        
          <div role="tabpanel" class="tab-pane active padding clearfix" id="seller">
          
            <!--<div class="margin-top-10 message">
          	<p class="btn-danger text-danger padding-5">
            	<span class="fa fa-times-circle"></span>Donec ullamcorper nulla non metus auctor fringilla. 
                <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a>
            </p>
          	</div>
            <div class="margin-top-10 message">
          	<p class="btn-warning text-warning padding-5"><span class="fa fa-warning"></span>Donec ullamcorper nulla non metus auctor fringilla. <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
          	</div>
            
            <div class="margin-top-10 message">
          	<p class="btn-success text-success padding-5"><span class="fa fa-check"></span>Donec ullamcorper nulla non metus auctor fringilla. <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
          	</div>-->
            @if(Session::get('success') == true)
            <div class="margin-top-10 message">
          	<p class="btn-success text-success padding-5"><span class="fa fa-check"></span>You have successfully registered with ThaiBricks! <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
          	</div>
            @endif
            
            @foreach ($errors->all() as $message)
            <div class="margin-top-10 message">
          	<p class="btn-danger text-danger padding-5">
            	<span class="fa fa-times-circle"></span>{{{ $message }}}
                <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a>
            </p>
          	</div>
            <?php break; ?>
            @endforeach
            
            <div class="formarea">
              {{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('store'), 'method' => 'post')) }} 
                <h4> Personal Details</h4>
                <div class="border-bottom"></div>
                <div class="border-top"></div>
                <div class="padding">
                  <div class="form-group">
                    <label for="uname" class="col-md-4 control-label">{{Form::label('first_name','First Name')}}</label>
                    <div class="col-md-6">	
                		{{Form::text('first_name', null,array('class' => 'form-control', 'placeholder' => 'Enter your first name'))}}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="uemail" class="col-md-4 control-label">{{Form::label('last_name','Last Name')}}</label>
                    <div class="col-md-6">
                		{{Form::text('last_name', null,array('class' => 'form-control', 'placeholder' => 'Enter your last name'))}}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="upassword" class="col-md-4 control-label">{{Form::label('location','Location')}}</label>
                    <div class="col-md-6">
                    <?php  $loc = array(''=>'Select Location');
                                foreach ($dataset['locations'] as $k=>$v){
                                  $loc[$k]=$v['location_name'];
                                }
                              ?>
                		{{Form::select('location', $loc, '', array('class' => 'form-control'))}}
                    </div>
                  </div>
                </div>
                <h4> Account Details</h4>
                <div class="border-bottom"></div>
                <div class="border-top"></div>
                <div class="padding">
                <div class="form-group">
                    <label for="caddress" class="col-md-4 control-label">{{Form::label('email','Email')}}</label>
                    <div class="col-md-6">
                		{{Form::text('email', null,array('class' => 'form-control', 'placeholder' => 'Enter your email'))}}
                    </div>
                  </div>
                <div class="form-group">
                  <label for="ucontact" class="col-md-4 control-label">{{Form::label('phone','Phone')}}</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control locationcode" id="locationcode" placeholder="+66" value="+66" readonly="readonly" style="color:#000000"/>                    
                	{{Form::text('phone', null,array('class' => 'form-control ucontactright', 'placeholder' => 'Enter your phone'))}}
                  </div>
                </div>
                <div class="form-group">
                  <label for="ucontact" class="col-md-4 control-label">{{Form::label('password','Password')}}</label>
                  <div class="col-md-6">
                		{{Form::password('password',array('class' => 'form-control', 'placeholder' => 'Enter your password'))}}
                  </div>
                </div>
                <div class="form-group">
                  <label for="ucontact" class="col-md-4 control-label">{{Form::label('password_confirmation','Re-type Password')}}</label>
                  <div class="col-md-6">
                    	{{Form::password('password_confirmation',array('class' => 'form-control', 'placeholder' => 'Retype your password'))}}
                  </div>
                </div>
                <!--<div class="form-group">
                  <label for="ucountry" class="col-md-4 control-label">Country</label>
                  <div class="col-md-6">
                    <select class="form-control" id="ucountry">
                      <option>Select Country</option>
                      <option>Australia</option>
                      <option>India</option>
                    </select>
                  </div>
                </div>-->
                <!--<div class="form-group">
                  <label for="ucity" class="col-md-4 control-label">City</label>
                  <div class="col-md-6">
                    <select class="form-control" id="ucountry">
                      <option>Select City</option>
                      <option>City1</option>
                      <option>City1</option>
                    </select>
                  </div>
                </div>-->
                <!--<div class="form-group">
                    <label for="curl" class="col-md-4 control-label">
                    <span class="text-danger">*</span>Select profile url
                     <small>http://www.thaibrick.com/ </small>
                    </label>
                   
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="curl" placeholder="Enter desired url"/>
                      <small class="text-danger">Please enter the details </small>
                    </div>
                  </div>-->
                <div class="form-group">
                  <div class="col-md-4 control-label"></div>
                  <div class="col-md-6">
                    <label class="control-label label-left">
                      <input type="checkbox" value="">
                      I confirm that I have read and agreed to <a href="javascript:void(0);">Privacy
                      Policy</a> and <a href="javascript:void(0);">Terms of Use </a> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-4 control-label"></div>
                  <div class="col-md-6"> {{Form::submit('Register', array('class' => 'btn btn-primary btn-lg orange'))}} </div>
                </div>
                
                </div>
              {{ Form::close() }}
            </div>
          </div>
          
          
          <!--<div role="tabpanel" class="tab-pane padding clearfix" id="agent">
        	<div class="formarea">
              <form class="form-horizontal padding" role="form">
                <h4> Account Details</h4>
                <div class="border-bottom"></div>
                <div class="border-top"></div>
                <div class="padding">
                  <div class="form-group">
                    <label for="auname" class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="auname" placeholder="Enter Your Name" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="auemail" class="col-md-4 control-label">Email
                      id</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="auemail" placeholder="Enter Your Email Id" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="aupassword" class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                      <input type="password" class="form-control" id="aupassword" placeholder="Enter Your Password"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="aupasswordconfirm" class="col-md-4 control-label">Confirm
                      Password</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="aupasswordconfirm" placeholder="Re enter Your Password" />
                    </div>
                  </div>
                </div>
                <h4> Agency Details</h4>
                <div class="border-bottom"></div>
                <div class="border-top"></div>
                <div class="padding">
                <div class="form-group">
                  <label for="aucomapnyname" class="col-md-4 control-label">Company
                    Name</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="aucomapnyname" placeholder="Enter Your Company Name"/>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="aucontact" class="col-md-4 control-label">Company Contact
                    Number</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control locationcode" id="alocationcode" placeholder="+91" value="+91"/>
                    <input type="number" class="form-control ucontactright" id="aucontact" placeholder="Enter Your Contact Number"/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="ucountry" class="col-md-4 control-label">Country</label>
                  <div class="col-md-6">
                    <select class="form-control" id="ucountry">
                      <option>Select Country</option>
                      <option>Australia</option>
                      <option>India</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="aucity" class="col-md-4 control-label">City</label>
                  <div class="col-md-6">
                    <select class="form-control" id="aucity">
                      <option>Select City</option>
                      <option>City1</option>
                      <option>City1</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="acaddress" class="col-md-4 control-label">Company Address</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="acaddress" placeholder="Enter Company Address"/>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="acaddress" class="col-md-4 control-label">Property Type</label>
                    <div class="col-md-6">
                      	<label class="checkbox-inline">
                          <input type="checkbox" id="aresidential" value="option1"> Residential
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="acommercial" value="option2"> Commercial
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="aland" value="option3"> Land
                        </label>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="acurl" class="col-md-4 control-label">
                    <span class="text-danger">*</span>Select profile url
                     <small>http://www.thaibrick.com/ </small>
                    </label>
                   
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="acurl" placeholder="Enter desired url"/>
                      <small class="text-danger">Please enter the details </small>
                    </div>
                  </div>
                <div class="form-group">
                  <div class="col-md-4 control-label"></div>
                  <div class="col-md-6">
                    <label class="control-label label-left">
                      <input type="checkbox" value="">

                      I confirm that I have read and agreed to <a href="javascript:void(0);">Privacy
                      Policy</a> and <a href="javascript:void(0);">Terms of Use </a> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-4 control-label"></div>
                  <div class="col-md-6"> <a href="javascript:void(0);" class="btn btn-primary btn-lg orange">Register</a> </div>
                </div>
                </div>
              </form>
            </div>
        </div>-->
          <!--<div role="tabpanel" class="tab-pane padding clearfix" id="builder">
          	<div class="formarea">
              <form class="form-horizontal padding" role="form">
                <h4> Account Details</h4>
                <div class="border-bottom"></div>
                <div class="border-top"></div>
                <div class="padding">
                  <div class="form-group">
                    <label for="buname" class="col-md-4 control-label">Name</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="buname" placeholder="Enter Your Name" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="buemail" class="col-md-4 control-label">Email
                      id</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="buemail" placeholder="Enter Your Email Id" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="bupassword" class="col-md-4 control-label">Password</label>
                    <div class="col-md-6">
                      <input type="password" class="form-control" id="bupassword" placeholder="Enter Your Password"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="bupasswordconfirm" class="col-md-4 control-label">Confirm
                      Password</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="bupasswordconfirm" placeholder="Re enter Your Password" />
                    </div>
                  </div>
                </div>
                <h4> Builder Details</h4>
                <div class="border-bottom"></div>
                <div class="border-top"></div>
                <div class="padding">
                <div class="form-group">
                  <label for="bucomapnyname" class="col-md-4 control-label">Company
                    Name</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="bucomapnyname" placeholder="Enter Your Company Name"/>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="bucontact" class="col-md-4 control-label">Company Contact
                    Number</label>
                  <div class="col-md-6">
                    <input type="text" class="form-control locationcode" id="blocationcode" placeholder="+91" value="+91"/>
                    <input type="number" class="form-control ucontactright" id="bucontact" placeholder="Enter Your Contact Number"/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="bcountry" class="col-md-4 control-label">Country</label>
                  <div class="col-md-6">
                    <select class="form-control" id="ucountry">
                      <option>Select Country</option>
                      <option>Australia</option>
                      <option>India</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="bucity" class="col-md-4 control-label">City</label>
                  <div class="col-md-6">
                    <select class="form-control" id="bucity">
                      <option>Select City</option>
                      <option>City1</option>
                      <option>City1</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                    <label for="bcaddress" class="col-md-4 control-label">Company Address</label>
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="bcaddress" placeholder="Enter Company Address"/>
                    </div>
                  </div>
                 <div class="form-group">
                    <label for="acaddress" class="col-md-4 control-label">Property Type</label>
                    <div class="col-md-6">
                      	<label class="checkbox-inline">
                          <input type="checkbox" id="aresidential" value="option1"> Residential
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="acommercial" value="option2"> Commercial
                        </label>
                        <label class="checkbox-inline">
                          <input type="checkbox" id="aland" value="option3"> Land
                        </label>
                    </div>
                  </div> 
                <div class="form-group">
                    <label for="bcurl" class="col-md-4 control-label">
                    <span class="text-danger">*</span>Select profile url
                     <small>http://www.thaibrick.com/ </small>
                    </label>
                   
                    <div class="col-md-6">
                      <input type="text" class="form-control" id="bcurl" placeholder="Enter desired url"/>
                      <small class="text-danger">Please enter the details </small>
                    </div>
                  </div>
                <div class="form-group">
                  <div class="col-md-4 control-label"></div>
                  <div class="col-md-6">
                    <label class="control-label label-left">
                      <input type="checkbox" value="">

                      I confirm that I have read and agreed to <a href="javascript:void(0);">Privacy
                      Policy</a> and <a href="javascript:void(0);">Terms of Use </a> </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-4 control-label"></div>
                  <div class="col-md-6"> <a href="javascript:void(0);" class="btn btn-primary btn-lg orange">Register</a> </div>
                </div>
                </div>
              </form>
            </div>
          </div>-->
        </div>
        
        
      </div>
    </div>
  </div>
</section>
<!--<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="">
      <div class="col-sm-6"> You are here: <a title="home" href="javascript:void(0)">Sign up</a></div>
      <div class="col-sm-6">
        <ul class="pull-right">
          <li class="totop"><a href="#" class="gototop" id="gototop">Top <span class="fa fa-arrow-up"></span></a></li>
          
        </ul>
      </div>
    </div>
  </div>
</section>-->
@stop