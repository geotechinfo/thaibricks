@extends('admin.layouts.default')
@section('body')
{{ HTML::script('libraries/validator/validation.js') }}
{{ HTML::script('js/jquery-ui.js') }}
{{ HTML::style('css/jquery-ui.css') }}

<?php
	//pr($dataset["list"],1);
?>
<section class="content-header row">
  <h1 class="page-header"> Manage Ad Packages </h1>
  
</section>
<div class="row">
  <div class="divider"></div>
</div>

<div class="row" id="alert-messages">
@if(Session::has('success'))
<p></p>
<div class="alert alert-success">
	<span class="fa fa-tick"></span>&nbsp; {{ Session::get('success') }}
</div>
@endif
@if(Session::has('warning'))
<p></p>
<div class="alert alert-warning">
    <span class="fa fa-tick"></span>&nbsp; {{ Session::get('warning') }}
</div>
@endif

@if(Session::has('info'))
<p></p>
<div class="alert alert-info">
    <span class="fa fa-tick"></span>&nbsp; {{ Session::get('info') }}
</div>
@endif

@foreach ($errors->all() as $message)
<p></p>
<div class="alert alert-danger">
	<span class="fa fa-times"></span>&nbsp; {{{ $message }}}
</div>
<?php break; ?>
@endforeach
</div>

<section>
    <p></p>
    <input type="hidden" name="user_id" id="user_id">
    <div class="row">
    {{ Form::open(array('id'=>'frm','class' => '', 'route' => array('admin.get_advertise'), 'method' => 'post')) }}      
        <div class="col-sm-5">
            <input type="search" class="form-control" data-toggle="search" data-target=".user_list tr" data-norecord=".nrf" Placeholder="Search By Text">
        </div>        
        <div class="col-sm-7 text-right">
            <a href="#" data-toggle="modal" data-target="#modalAddPackage" class="btn btn-success">Add Package</a>
        </div>
    {{ Form::close() }}  
    </div>
    <p></p>
    <div class="row">
    	<div class="col-sm-12">
            <div class="table-responsive" id="list_table">

                <table class="responsive table table-striped table-bordered"  width="100%" cellspacing="5" cellpadding="2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ad type</th>
                        <th>Location Name</th>
                        <th>Duration</th>
                        <th>Grace Period</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="list" class="user_list">

                    @foreach($dataset['list'] as $k=>$v)
                    <tr data-state="s">
                        <td>
                            {{$k+1}}
                        </td>
                        <td>
                            {{$dataset['ad_type_n'][$v->ad_type]}} 
                        </td>
                        <td>
                            {{($v->location_name==''?'For Home Page':$v->location_name)}} 
                        </td>
                        <td>
                            {{$v->duration}}
                        </td>
                        <td>                           
                            {{$v->grace_period}}
                        </td>
                        <td>                           
                            &#xe3f; {{$v->price}}
                        </td>
                        <td>
                          <a href="javascript:;" class="edit_modal btn btn-warning btn-xs" data-ad_package_id="{{$v->ad_package_id}}" data-ad_type="{{$v->ad_type}}" data-location_id="{{$v->location_id}}" data-duration="{{$v->duration}}" data-grace_period="{{$v->grace_period}}" data-price="{{$v->price}}">Edit</a>
                          
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
                <div class="nrf" style="display:none">
                    <div class="alert alert-warning">
                       <i class="fa fa-exclamation-triangle"></i> No Record Found
                    </div>
                </div>
            </div>
    	</div>
    </div>

</section>
<div class="modal fade" id="modalAddPackage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Package</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'frm_add_package','class' => '', 'route' => array('admin.adpackages.save'), 'method' => 'post')) }} 
        <input type="hidden" name="ad_package_id" id="ad_package_id">
        <div class="row">
            <div class="col-sm-6">  
                <label class="control-lebel">Location:</label>        
                {{Form::select('location_id[]',$dataset['locations'],'',array('class'=>'form-control','id'=>'location_id','multiple'=>'multiple'))}}
            </div>          
            <div class="col-sm-6">  
                <label class="control-lebel">Ad Type:</label>        
                {{Form::select('ad_type',$dataset['ad_type'],'',array('class'=>'form-control','id'=>'ad_type'))}}
            </div>  
            <div class="col-sm-6">
                <label class="control-lebel">Duration:</label>  
                {{Form::number('duration','',array('class'=>'form-control','id'=>'duration','placeholder'=>'Package Duration(in days)','min'=>'0'))}}
            </div>
            <div class="col-sm-6">
                <label class="control-lebel">Grace Period:</label>  
                {{Form::number('grace_period','',array('class'=>'form-control','id'=>'grace_period','placeholder'=>'Grace Period(in days)','min'=>'0'))}}
            </div> 
            <div class="col-sm-6">
                <label class="control-lebel">Price <small>(&#xe3f;)</small>:</label>  
                {{Form::text('price','',array('class'=>'form-control','id'=>'price','placeholder'=>'Package Price'))}}
            </div>          
        </div>
        
        <p></p>
        <div class="row">  
          <div class="col-sm-12 text-center">
            <button type="submit" id="save_location" class="btn btn-success"> Save</button>
          </div>
        </div>
      {{ Form::close() }}  
        
      </div>
    </div>  
  </div>
</div>  
 
<script type="text/javascript">
	$(document).ready(function(){
		$('#frm_add_package').validate({
            rules:{                
                duration:{
                    required:true,
                    digits:true
                },
                grace_period:{
                    required:true,
                    digits:true
                },
                price:{
                    required:true,
                    number:true
                }
            },
            errorClass:'text-danger'
        })

        $('.edit_modal').click(function(){
            $('#ad_package_id').val($(this).data('ad_package_id'));
            $('#ad_type').val($(this).data('ad_type'));
            $('#location_id').val($(this).data('location_id'));
            $('#duration').val($(this).data('duration'));
            $('#grace_period').val($(this).data('grace_period'));
            $('#price').val($(this).data('price'));
            $('#modalAddPackage').modal('toggle');
        });

        $('.modal').on('hidden.bs.modal', function (e) {
          $('.modal form').append($('<input/>').attr({'type':'reset'}).hide());
          $('.modal form input[type="reset"]').trigger('click').remove();
        })
       

	});
</script>
@stop