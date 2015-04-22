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
          <h4 class="text-left no-margin">Reset Password</h4>
            <div class="border-bottom"></div>
                
				        {{ Form::open(array('route' => array('do_reset_password'), 'method' => 'post','id'=>'frm_reset')) }}
                  <input type="hidden" name="con[user_id]" value="{{$dataset['user_id']}}">
                  <input type="hidden" name="con[reset_code]" value="{{$dataset['reset_code']}}">
                  <div class="form-group">
                    {{Form::password('new_password',array('class' => 'form-control','id'=>'new_password', 'placeholder' => 'New Password'))}}
                  </div>
                  <div class="form-group">
                  	{{Form::password('confirm_password',array('class' => 'form-control', 'placeholder' => 'Retype Password'))}}
                  </div>

                  <button class="btn btn-default btn-lg orange login_btn" type="submit">Update</button>
                  <a class="btn btn-success btn-lg login_btn" href="{{URL::action('UsersController@login')}}">Login</a>
                {{ Form::close() }}
         </div>
      </div>
      <div class="col-sm-6">
      <div class="well clearfix grey registerAside">
          <h4 class="text-left no-margin">New to Thaibricks?</h4>
            <div class="border-bottom"></div>
            <p class="text-left margin-top-10">Donot have an account ? Start now register yourself as a seller and start posting your property details</p>
            <a class="btn login_btn goToRegisterBtn" href="{{URL::action('UsersController@create')}}">Register Now</a>
         </div>
      </div>
    </div>
  </div>
</section>


<script type="text/javascript">
  $(document).ready(function(){
    $('#frm_reset').validate({
          rules:{
            new_password:{
              required:true,
            },
            confirm_password:{
              required:true,
              equalTo:'#new_password'
            }
          },
          errorClass:'text-danger'
    });
    //$('#forgotpassword')..valid();
});
</script>

@stop