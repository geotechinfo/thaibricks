@extends('layouts.dashboard')
@section('content')
<!--/profileimage-->
<?php  $loc = array(''=>'Select Location');
  foreach ($dataset['locations'] as $k=>$v){
    $loc[$k]=$v['location_name'];
  }
?>

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
              <h4>Personal Details</h4>
            	<div class="padding greyBg">
                {{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('profile.update'), 'method' => 'post')) }}
                <div class="row">
                  <div class="col-sm-12">
                     @foreach ($errors->all() as $message)
                    <div class="margin-top-10 message">
                    <p class="btn-danger text-danger padding-5">
                      <span class="fa fa-exclamation-triangle"></span>{{{ $message }}}
                        <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a>
                    </p>
                    </div>
                    <?php break; ?>
                    @endforeach
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">    
                        <label class="control-label">First Name</label>            
                        <?php echo Form::text('first_name',Auth::user()->first_name,array('class'=>'form-control','placeholder'=>'Frist Name')); ?>
                    </div>
                    <div class="col-sm-6">     
                        <label class="control-label">Last Name</label>                   
                        <?php echo Form::text('last_name',Auth::user()->last_name,array('class'=>'form-control','placeholder'=>'Last Name')); ?>
                    </div>
                </div>
                <p></p>
                    
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label">Location</label>
                        <?php echo Form::select('location', $loc, Auth::user()->location,array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label">Email</label>
                        <?php echo Form::text('email',Auth::user()->email,array('class'=>'form-control')); ?>
                    </div>
                </div>


                <p></p>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="control-label">Phone</label>
                        <?php echo Form::text('phone',Auth::user()->phone,array('class'=>'form-control')); ?>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label">About Me</label>
                        <?php echo Form::textarea('description',Auth::user()->description,array('class'=>'form-control','rows'=>3)); ?>
                    </div>
                </div>    
                <p></p>
                <div class="text-right">
                  <button class="btn btn-success orange">
                    <i class="fa fa-check"></i>
                    Save
                  </button>
                </div>
                {{ Form::close()  }}
              </div>
            </div>
          </div>
            
        
        </div>
        
        
        
    </div>
    
    
    
  </div>
</section>

@stop