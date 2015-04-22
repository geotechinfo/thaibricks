@extends('layouts.default')
@section('content')
{{ HTML::script('libraries/validator/validation.js') }}
<section class="container container2 margin-top-10" id="propertylist">
  <aside class="col-sm-3 col-sm-push-9">
    
        {{View::make('layouts.side_ad_block',array('dataset'=>array('limit'=>1)))}}
  
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
  	@if(Session::get('error') == true)
      <div class="margin-top-10 message">
        <p class="btn-danger text-danger padding-5"> <span class="fa fa-times-circle"></span>You have provided invalid email, password combination!
         </p>
      </div>
    @endif
    @if(Session::has('info') == true)
      <div class="margin-top-10 message">
        <p class="btn-warning text-danger padding-5"> <span class="fa fa-times-circle"></span>{{Session::get('info')}}
         </p>
      </div>
    @endif

     @if(Session::has('success') == true)
      <div class="margin-top-10 message">
        <p class="btn-success text-danger padding-5"> <span class="fa fa-times-circle"></span>{{Session::get('success')}}
        </p>
      </div>
    @endif
    
    @foreach ($errors->all() as $message)
      <div class="margin-top-10 message">
        <p class="btn-danger text-danger padding-5"> <span class="fa fa-times-circle"></span>{{{ $message }}}
        </p>
      </div>
    <?php break; ?>
    @endforeach
    
    
    <div class="row">
      <div class="col-sm-6">
      <div class="well clearfix grey loginAside">
          <h4 class="text-left no-margin">Sign In</h4>
            <div class="border-bottom"></div>
            <!-- <p class="text-left margin-top-10">Already have an account the login directly</p>-->
				{{ Form::open(array('route' => array('login'), 'method' => 'post')) }}
                  <div class="form-group">
                    {{Form::text('email', null,array('class' => 'form-control', 'placeholder' => 'Email'))}}
                  </div>
                  <div class="form-group">
                  	{{Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password'))}}
                  </div>

                  <button class="btn btn-default btn-lg orange login_btn" type="submit">Login</button>
                  <a href="#" data-toggle="modal" data-target="#resetPasswordModal" class="btn btn-success btn-lg">Forgot Password</a>
                {{ Form::close() }}
                
         </div>
      </div>
      <div class="col-sm-6">
      <div class="well clearfix grey registerAside">
          <h4 class="text-left no-margin">New to Thaibricks?</h4>
            <div class="border-bottom"></div>
            <p class="text-left margin-top-10">Don't have an account ? Start now register yourself as a seller and start posting your property details.</p>
            <a class="btn login_btn goToRegisterBtn" href="{{URL::action('UsersController@create')}}">Register Now</a>
         </div>
      </div>
    </div>
  </div>
</section>

<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'forgotpassword','class' => '', 'route' => array('forgotpassword'), 'method' => 'post')) }} 
        <input type="hidden" name="ad_package_id" id="ad_package_id">
        <div class="row">
            <div class="col-sm-10">  
                {{Form::text('email','',array('class'=>'form-control','id'=>'email','placeholder'=>'Enter Your Email'))}}
            </div>          
            <div class="col-sm-2">
              <button type="submit" id="save_location" class="btn btn-success">Send</button>
            </div>        
        </div>
      {{ Form::close() }}  
        
      </div>
    </div>  
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#forgotpassword').validate({
          rules:{
            email:{
              required:true,
              email:true
            }
          },
          errorClass:'text-danger'
    });
    //$('#forgotpassword')..valid();
});
</script>

@stop