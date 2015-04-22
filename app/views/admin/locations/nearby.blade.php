@extends('admin.layouts.default')
@section('body')
{{ HTML::script('libraries/validator/validation.js') }}

<!-- /Page Header and Breadcrumb Start -->
<section class="content-header row">
  <h1 class="page-header"> Manage NearBy <small>locations and Nearby</small> </h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="fa fa-dashboard"></span>Dashboard</a></li>
    <li class="active">Manage NearBy</li>
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
    <h3>NearBy Group</h3>
    {{ Form::open(array('route' => array('location.addnearbygroup'), 'method' => 'post','id'=>'frm_group')) }}
    <div class="form-group col-md-3">
        {{Form::label('location','Location / City')}}
        {{Form::select('location_id', $dataset["locations"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-3">
        {{Form::label('transport','NearBy Group')}}
        {{Form::text('group_name', null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-2">
        <label>&nbsp;</label>
        {{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Nearby Name</h3>
    {{ Form::open(array('route' => array('location.addnearby'), 'method' => 'post','id'=>'frm_name')) }}
    <div class="form-group col-md-3">
        {{Form::label('group','NearBy Group')}}
        {{Form::select('transport_group', $dataset["groups"], null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-3">
        {{Form::label('transport','NearBy Name')}}
        {{Form::text('transport_name', null, array('class' => 'form-control'))}}
    </div>
    <div class="form-group col-md-2">
      <label>&nbsp;</label>
      {{Form::submit('Create', array('class' => 'form-control btn btn-primary'))}}
    </div>
    {{ Form::close() }}
</div>

<div class="row">
    <h3>Near By Tree</h3>
    <div class="form-group col-md-12">
        <div id="nearby_tree"></div>
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
        $('#frm_group').validate({
          rules:{
            'location_id':{required:true},
            'group_name':{required:true},
          },
          errorElement:'small',
          errorClass:'text-danger'
        });
        $('#frm_name').validate({
          rules:{
            'transport_group':{required:true},
            'transport_name':{required:true},
          },
          errorElement:'small',
          errorClass:'text-danger'
        });
       // alert($('#frm_group').valid());
         $('#nearby_tree')
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

          var getNearbyTree = function(){
            if($('#nearby_tree').length){
              $.getJSON('<?php echo URL::to("admins/get_transport_tree/");?>/2',function(data){ 
                $('#nearby_tree').treeview({data:data})
              });
            }
          }
          //$('#transports').treeview({data: '<?php echo $dataset["transports"]; ?>'})

         
          getNearbyTree();

          $('#save_transport').click(function(){
            var ths = $(this);
            ths.button('loading')
              $.post(
                $('#frm').attr('action'),
                $('#frm').serialize(),
                function(m){
                  var  o = $.parseJSON(m);
                  $('#adminUpdateTransport').modal('toggle');
                  //getTransportTree();
                  getNearbyTree();
                  ths.button('reset')
                }
              )
            });
    });
</script>
@stop