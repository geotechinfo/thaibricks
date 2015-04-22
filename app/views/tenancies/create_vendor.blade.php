@extends('layouts.dashboard')

@section('content')
<?php 
  $vandor_id = isset($dataset['vendor']->vendor_id)?$dataset['vendor']->vendor_id:0;
?>
<section class="" id="propertylist">
  
  <div class="col-sm-12 propertylistwrap">
    <div class="clearfix">
        <h3 class="pull-left noMargin"><span class="fa fa-users"></span> Vendor</h3>
    </div>
    <p></p>
    @if(Session::get('success'))
    <div class="margin-top-10 message">
    <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{{ Session::get('success') }}}</p>
    </div>
    @endif
    
    @if(Session::get('info') == true)
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}</p>
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

    <div class="propertyformsteps ">
      <div class="vendorTrans">     
          <h4><?php if(Route::current()->getName()=='tenancy.vendor_edit') {?>Edit Vendor<?php }else{ ?>Add Vendor<?php } ?></h4 >
          
          <div class="padding greyBg">
          <?php if(Route::current()->getName()=='tenancy.vendor_create') {?>
          {{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('tenancy.addvendor'), 'files' => false, 'method' => 'post')) }} 
          <?php }else{?>
          {{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('tenancy.updatevendor'), 'files' => false, 'method' => 'post')) }} 
          <?php }?>
          <input type="hidden" name="vendor_id" value="{{$dataset['vendor']->vendor_id}}">
            <div class="row form-group">
                <div class="col-sm-6">
                  <div class="row">
                    <div class="col-sm-12">
                      <label class="control-label" for="propertyname">Vendor Name</label>
                      {{ Form::text('vendor_name',$dataset['vendor']->vendor_name,array('class'=>"form-control",'placeholder'=>"Enter Vendor Name"))}}
                    </div>                 
                    <div class="col-sm-12">
                      <label class="control-label" for="propertyname">Vendor Contact Number</label>
                      {{ Form::text('vendor_phone',$dataset['vendor']->vendor_phone,array('class'=>"form-control",'placeholder'=>"Enter Vendor Contact Number"))}}
                    </div>               
                    <div class="col-sm-12">
                      <label class="control-label" for="propertyname">Vendor Email</label>
                      {{ Form::text('vendor_email',$dataset['vendor']->vendor_email,array('class'=>"form-control",'placeholder'=>"Enter Vendor Email"))}}
                    </div>
                  </div>
                </div>
               <div class="col-sm-6">
                  <label class="control-label" for="propertyname">Vendor Address</label>
                  {{ Form::textarea('vendor_address',$dataset['vendor']->vendor_address,array('class'=>"form-control",'placeholder'=>"Enter Vendor Address",'style'=>"height:185px"))}}
                </div>
               
               <p></p>
               
                <div class="col-sm-12 text-right" style="margin-top:10px"><button type="submit" id="" class="btn btn-default orange "><?php if(Route::current()->getName()=='tenancy.vendor_edit') {?>Update<?php }else{ ?>Add Vendor<?php } ?></button></div>

            </div>
            
            
          {{ Form::close() }}    
          </div>
              
      </div>
    </div>
    
  </div>
</section>
<!--prefooter-->
<script type="text/javascript">
  $(document).ready(function(){
    $('#add_vendor_frm').click(function(){
      var ths = $(this);
      
      $.post(
         ths.closest('form').attr('action'),
         ths.closest('form').serialize(),
         function(m){
          var o = $.parseJSON(m);
          window.location="<?php echo URL::action('TenancyController@vendor_list')?>";
         } 
      )
    });
  });  
  </script>
@stop


