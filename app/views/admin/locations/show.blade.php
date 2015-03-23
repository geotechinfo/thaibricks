@extends('admin.layouts.default')
@section('body')
{{ HTML::script('libraries/validator/validation.js') }}

<!-- /Page Header and Breadcrumb Start -->
<section class="content-header row">
  <h1 class="page-header"> Manage Location <small>locations and transport</small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="fa fa-dashboard"></span>Dashboard</a></li>
    <li class="active">Manage Location</li>
  </ol>
</section>
<!-- /Page Header and Breadcrumb End -->

<!-- /Page Content Start -->
<div class="row">
  <div class="divider"></div>
</div>

<div class="row">
@if(Session::has('success'))
<p></p>
<div class="alert alert-success">
	<span class="fa fa-tick"></span>&nbsp; {{ Session::get('success') }}
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

<div class="row">
    <h3>Create Location</h3>
    {{ Form::open(array('route' => array('location.addlocation'), 'method' => 'post','id'=>'frm_loc')) }}
    <div class="form-group col-md-4">
        {{Form::label('location','Location Name')}}
        {{Form::text('location_name', null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-2">
        {{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Add Sub Location</h3>
    {{ Form::open(array('route' => array('location.addsublocation'), 'method' => 'post','id'=>'frm_subloc')) }}
    <div class="form-group col-md-6">
        {{Form::label('location','Location/City')}}
        {{Form::select('location_id', $dataset["parents"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('location','Sub Location')}}
        {{Form::text('sub_location', null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-2">
        {{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Location Tree</h3>
    <div class="col-md-6">
    	<div id="locations"></div>
    </div>
</div>

<div class="modal fade" id="adminUpdateLocation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'frm_loc','class' => '', 'route' => array('location.update_location'), 'method' => 'post')) }} 
        <div class="row">
          <div class="col-sm-3 text-right">Parent:</div>
          <div class="col-sm-9  text-left">            
            {{Form::select('parent_id',$dataset['parents'],'',array('class'=>'form-control','id'=>'parent_id'))}}
          </div>
        </div>
        <p></p>
        <div class="row">
          <div class="col-sm-3 text-right">Name:</div>
          <div class="col-sm-9  text-left">
            <input type="hidden" id="nodeid">
            <input type="hidden" name="location_id" id="location_id">
            <input type="text" name="location_name" id="location_name" class="form-control">
          </div>
        </div>
        <p></p>
        <div class="row">  
          <div class="col-sm-12 text-center">
            <button type="button" id="save_location" class="btn btn-success"> Update</button>
          </div>
        </div>
      {{ Form::close() }}  
        
      </div>
    </div>  
  </div>
</div>  

<script type="text/javascript">
    $(document).ready(function(){
        $('#frm_loc').validate({
          rules:{
            'location_name':{required:true},
          },
          errorElement:'small',
          errorClass:'text-danger'
        });
        $('#frm_subloc').validate({
          rules:{
            'location_id':{required:true},
            'sub_location':{required:true},
          },
          errorElement:'small',
          errorClass:'text-danger'
        });

         $('#locations')
          .treeview({data: ''})
          .on('nodeSelected', function(event, node) {
              $('#nodeid').val(node.nodeId)
              $('#parent_id').val(node.parent_id);
              $('#location_id').val(node.location_id);
              $('#location_name').val(node.location_name);
              //alert(node.parent_id);
              if(node.parent_id==0){
                 $('#parent_id').prop('disabled',true).closest('.row').hide();
              }else{
                $('#parent_id').prop('disabled',false).closest('.row').show();
              }
              $('#adminUpdateLocation').modal('toggle');
          });

        var getLocationTree = function(){
            if( $('#locations').length){
              $.getJSON('<?php echo URL::to("admins/get_location_tree/");?>',function(data){ //alert(data);
                $('#locations').treeview({data:data})
              });
            }
        }  
            getLocationTree();
            $('#frm_loc').submit(function(e){
                e.preventDefault();
                $('#save_location').trigger('click');
            });
          $('#save_location').click(function(){
            var ths = $(this);
            ths.button('loading')
              $.post(
                $('#frm_loc').attr('action'),
                $('#frm_loc').serialize(),
                function(m){
                  var  o = $.parseJSON(m);
                  $('#adminUpdateLocation').modal('toggle');
                  getLocationTree();
                  
                  ths.button('reset')
                }
              )
            });
    });
</script>
@stop