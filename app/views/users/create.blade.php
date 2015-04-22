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
  <div class="col-sm-9 propertylistwrap">
    <h2  style="margin-top:0;padding-top:0;">Register to sell your property</h2>
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
                
            </p>
            </div>
            <div class="margin-top-10 message">
            <p class="btn-warning text-warning padding-5"><span class="fa fa-warning"></span>Donec ullamcorper nulla non metus auctor fringilla. </p>
            </div>
            
            <div class="margin-top-10 message">
            <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>Donec ullamcorper nulla non metus auctor fringilla. </p>
            </div>-->
            @if(Session::get('success') == true)
            <div class="margin-top-10 message">
            <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>You have successfully registered with ThaiBricks! </p>
            </div>
            @endif
            
            @foreach ($errors->all() as $message)
            <div class="margin-top-10 message">
            <p class="btn-danger text-danger padding-5">
              <span class="fa fa-times-circle"></span>{{{ $message }}}
                
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
                    <label for="caddress" class="col-md-4 control-label">{{Form::label('Description','Description')}}</label>
                    <div class="col-md-6">
                    {{Form::textarea('description', null,array('class' => 'form-control', 'placeholder' => 'Enter About You'))}}
                    </div>
                </div>
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
                
                <div class="form-group">
                  <div class="col-md-4 control-label"></div>
                  <div class="col-md-6">
                    <label class="control-label label-left">
                      <input type="checkbox" name="terms_condition" value="1">
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
          
          
         
        </div>
        
        
      </div>
    </div>
  </div>
  <aside class="col-sm-3">
  	<div class="well clearfix grey">
         	<h4 class="text-left no-margin">Sign In</h4>
            <div class="border-bottom"></div>
            <!--<p class="text-left margin-top-10">Already have an account the login directly</p>-->
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
    
        {{View::make('layouts.side_ad_block')}}
    
  </aside>

</section>

@stop