@extends('layouts.default')
@section('content')
<section class="container container2 margin-top-10" id="propertylist">
  <aside class="col-sm-3 col-sm-push-9">
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad4.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
  	@if(Session::get('error') == true)
      <div class="margin-top-10 message">
        <p class="btn-danger text-danger padding-5"> <span class="fa fa-times-circle"></span>You have provided invalid email, password combination!
        <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a> </p>
      </div>
    @endif
    
    @foreach ($errors->all() as $message)
      <div class="margin-top-10 message">
        <p class="btn-danger text-danger padding-5"> <span class="fa fa-times-circle"></span>{{{ $message }}}
        <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a> </p>
      </div>
    <?php break; ?>
    @endforeach
    
    
    <div class="row">
      <div class="col-sm-6">
      <div class="well featuredagentbox clearfix grey loginAside">
          <h4 class="text-left no-margin">Sign In</h4>
            <div class="border-bottom"></div>
            <p class="text-left">Already have an account the login direcly</p>
				{{ Form::open(array('route' => array('login'), 'method' => 'post')) }}
                  <div class="form-group">
                    {{Form::text('email', null,array('class' => 'form-control', 'placeholder' => 'Email'))}}
                  </div>
                  <div class="form-group">
                  	{{Form::password('password',array('class' => 'form-control', 'placeholder' => 'Password'))}}
                  </div>
                  <button class="btn btn-default btn-lg orange login_btn" type="submit">Login</button>
                {{ Form::close() }}
         </div>
      </div>
      <div class="col-sm-6">
      <div class="well featuredagentbox clearfix grey registerAside">
          <h4 class="text-left no-margin">New to Thaibricks?</h4>
            <div class="border-bottom"></div>
            <p class="text-left">Donot have an account ? Start now register yourself as a seller and start posting your property details</p>
            <a class="btn login_btn goToRegisterBtn" href="{{URL::to('/create')}}">Register Now</a>
         </div>
      </div>
    </div>
  </div>
</section>
@stop