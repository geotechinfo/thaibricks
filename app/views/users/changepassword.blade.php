@extends('layouts.dashboard')
@section('content')
{{ HTML::script('libraries/validator/validation.js') }}


<!--/profileimage-->
<section class="">
  
  <div class="col-sm-12 propertylistwrap">
  

    <div class="propertylist">
    
      <!-- Tabs -->
        <div role="tabpanel">
          @if(Session::get('success'))
            <div class="margin-top-10 message">
            <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{Session::get('success')}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
            </div>
          @endif
          @if(Session::get('error'))
            <div class="margin-top-10 message">
            <p class="btn-danger  padding-5"><span class="fa fa-cross"></span>{{Session::get('error')}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
            </div>
          @endif
         
          
          <!-- Tab panes -->
          <div class="tab-content propertyformsteps">
            <div role="tabpanel" class="tab-pane active" id="acDetails">
              <h4>Change Password</h4>
            	<div class="padding greyBg">
                {{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('profile.do_changepassword'), 'method' => 'post','id'=>'frm')) }}

                <div class="accountInfoGroup">
                        <div class="row">

                          <div class="col-sm-6 col-sm-offset-3">
                            <label class="control-label">Old Password</label>
                            {{ Form::password('password',array('class'=>'form-control','placeholder'=>'Old Password'))}}
                          </div>
                        </div>
                        <p></p>
                </div>
                <div class="accountInfoGroup">
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <label class="control-label">New Password</label>
                            {{ Form::password('new_password',array('class'=>'form-control','placeholder'=>'New Password','id'=>'new_password'))}}
                          </div>
                        </div>
                        <p></p>
                </div>
                <div class="accountInfoGroup">
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                            <label class="control-label">Retype New Password</label>
                            {{ Form::password('new_password_confirmation',array('class'=>'form-control','placeholder'=>'Confirm Password'))}}
                          </div>
                        </div>
                        <p></p>
                </div>
                
                
                <div class="text-right row">
                          <div class="col-sm-6 col-sm-offset-3">
                                    <input type="submit" class="btn orange" />
                          </div>
                </div>
                {{ Form::close()  }}
              </div>
            </div>
          
            
          </div>
        
        </div>
        
        
        
    </div>
    
    
    
  </div>
</section>

<script type="text/javascript">
  $(function(){
    $('#frm').validate({
      rules:{
        password:{
          required:true,
          minlength:5
        },
        new_password:{
          required:true,
          minlength:5
        },
        new_password_confirmation:{
          required:true,
          equalTo:'#new_password'
        }
      },
      errorClass:'text-danger',
      errorElement:'small'
    })
  })
</script>


@stop