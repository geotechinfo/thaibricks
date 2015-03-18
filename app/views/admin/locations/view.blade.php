@extends('admin.layouts.default')
@section('body')
<!-- /Page Header and Breadcrumb Start -->
<section class="content-header row">
  <h1 class="page-header"> Manage Transport <small>locations and transport</small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="fa fa-dashboard"></span>Dashboard</a></li>
    <li class="active">Manage Transport</li>
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
    <h3>Transport Group</h3>
    {{ Form::open(array('route' => array('location.addgroup'), 'method' => 'post')) }}
    <div class="form-group col-md-6">
        {{Form::label('location','Location / City')}}
        {{Form::select('location_id', $dataset["locations"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('transport','Transport Group')}}
        {{Form::text('group_name', null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-2">
        {{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Station Name</h3>
    {{ Form::open(array('route' => array('location.addtransport'), 'method' => 'post')) }}
    <div class="form-group col-md-6">
        {{Form::label('group','Transport Group')}}
        {{Form::select('transport_group', $dataset["groups"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-6">
        {{Form::label('transport','Transport Name')}}
        {{Form::text('transport_name', null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-2">
        {{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Transport Tree</h3>
    <div class="form-group col-md-12">
        <div id="transports"></div>
    </div>
</div>

<div class="modal fade" id="adminUpdateTransport" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'frm','class' => '', 'route' => array('location.update_transport'), 'method' => 'post')) }} 
      
        <div class="row">
          <div class="col-sm-3 text-right">Parent:</div>
          <div class="col-sm-9  text-left">            
            {{Form::select('parent_id',$dataset['transport_parents'],'',array('class'=>'form-control','id'=>'parent_id'))}}
          </div>
        </div>
        <p></p>
        <div class="row">  
          <div class="col-sm-3 text-right">Title:</div>
          <div class="col-sm-9  text-left">
            <input type="hidden" id="nodeid">
            <input type="hidden" name="transport_id" id="transport_id">
            <input type="text" name="transport_name" id="transport_name" class="form-control">
          </div>          
        </div>
        <p></p>
        <div class="row">
          <div class="col-sm-12 text-center">
            <button type="button" id="save_transport" class="btn btn-success"> Update</button>
          </div>
        </div>
      {{ Form::close() }}  
        
      </div>
    </div>  
  </div>
</div>   
<script type="text/javascript">
    $(document).ready(function(){
         $('#transports')
          .treeview({data:''})
          .on('nodeSelected', function(event, node) {
                //alert(node.parent_id);
              $('#nodeid').val(node.nodeId)
              $('#transport_id').val(node.transport_id);
              $('#transport_name').val(node.transport_name);
              $('#parent_id').val(node.parent_id);
              if(node.parent_id==0){
                 $('#parent_id').prop('disabled',true).closest('.row').hide();
              }else{
                $('#parent_id').prop('disabled',false).closest('.row').show();
              }
              $('#adminUpdateTransport').modal('toggle');
          });

        var getTransportTree = function(){
            if( $('#transports').length){
              $.getJSON('<?php echo URL::to("admins/get_transport_tree/");?>/1',function(data){ //alert(data);
                $('#transports').treeview({data:data})
              });
            }
        }  
        getTransportTree();

        $('#save_transport').click(function(){
        var ths = $(this);
        ths.button('loading')
          $.post(
            $('#frm').attr('action'),
            $('#frm').serialize(),
            function(m){
              var  o = $.parseJSON(m);
              $('#adminUpdateTransport').modal('toggle');
              getTransportTree();
              //getNearbyTree();
              ths.button('reset')
            }
          )
        });
    });
</script>
@stop