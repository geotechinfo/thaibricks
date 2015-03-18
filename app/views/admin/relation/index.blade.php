@extends('admin.layouts.default')
@section('body')
<!-- /Page Header and Breadcrumb Start -->
<section class="content-header row">
  <h1 class="page-header"> Relation Master</h1>
  <ol class="breadcrumb">
    <li><a href="#"><span class="fa fa-dashboard"></span>Dashboard</a></li>
    <li class="active">Relation Master</li>
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
    <div class="col-sm-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <h3>
              Transaction Type
              <a href="#" class="btn btn-info pull-right" data-toggle="modal" data-target="#adminDealModal">Add Type</a>
            </h3>
          </div>
          <div class="panel-body">
            <div class="deals_tree" id="deals_tree"></div>
          </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-warning">
          <div class="panel-heading">
            <h3>
              Group
              <a href="#" class="btn btn-warning pull-right" data-toggle="modal" data-target="#adminUpdatGroupeModal">Add Group</a>
            </h3>
          </div>
          <div class="panel-body">
            <div class="groups_tree" id="groups_tree"></div>
          </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-success">
          <div class="panel-heading">
            <h3>
              Property Type              
              <a href="#" class="btn btn-success pull-right" data-toggle="modal" data-target="#adminTypeModal">Add Type</a>
            </h3>
          </div>
          <div class="panel-body">
            <div class="types_tree" id="types_tree"></div>
          </div>
        </div>        
    </div>
   
    <div class="col-sm-6">
        <div class="panel panel-danger">
          <div class="panel-heading">
            <h3>
              Attribute
              <a href="#" class="btn btn-danger pull-right" data-toggle="modal" data-target="#adminAttributeModal">Add Attribute</a>
            </h3>
          </div>
          <div class="panel-body" id="panel-body">
            <div class="attributes_tree" id="attributes_tree"></div>
          </div>
        </div>
    </div>
</div>

<div class="modal fade" id="adminDealModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Transaction Type</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'frm_deal','class' => '', 'route' => array('admin.save_deal'), 'method' => 'post')) }} 
        
        <div class="row">
          <div class="col-sm-4 text-right">Transaction Name:</div>
          <div class="col-sm-8  text-left">
            <input type="hidden" name="deal_id" id="deal_id">
            <input type="text" name="deal_name" id="deal_name" placeholder="Transaction Name" class="form-control">
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


<div class="modal fade" id="adminUpdatGroupeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Group</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'frm_group','class' => '', 'route' => array('admin.save_group'), 'method' => 'post')) }} 
        <div class="row">
          <div class="col-sm-3 text-right">Parent:</div>
          <div class="col-sm-9  text-left">            
            {{Form::select('parent_id',$dataset['parent_group'],'',array('class'=>'form-control','id'=>'group_parent_id'))}}
          </div>
        </div>
        <p></p>
        <div class="row">
          <div class="col-sm-3 text-right">Name:</div>
          <div class="col-sm-9  text-left">
            <input type="hidden" name="group_id" id="group_id">
            <input type="text" name="group_name" id="group_name" placeholder="Group Name" class="form-control">
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



<div class="modal fade" id="adminTypeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Transaction Type</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'frm_type','class' => '', 'route' => array('admin.save_type'), 'method' => 'post')) }} 
        <div class="row">
          <div class="col-sm-3 text-right">Parent:</div>
          <div class="col-sm-9  text-left">            
            {{Form::select('parent_id',$dataset['parent_types'],'',array('class'=>'form-control','id'=>'type_parent_id'))}}
          </div>
        </div>
        <p></p>
        <div class="row">
          <div class="col-sm-3 text-right">Name:</div>
          <div class="col-sm-9  text-left">
            <input type="hidden" name="type_id" id="type_id">
            <input type="text" name="type_name" id="type_name" placeholder="Transaction Name" class="form-control">
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

<div class="modal fade" id="adminAttributeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Attribute</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'frm_attribute','class' => '', 'route' => array('admin.save_attribute'), 'method' => 'post')) }} 
        <div class="row">
          <div class="col-sm-3 text-right">Attribute Type:</div>
          <div class="col-sm-9  text-left">
            <select name="attribute_type" id="attribute_type" class="form-control">
              <option value="text">Text Box</option>
              <option value="check">Check Box</option>
              <option value="number">Number</option>
            </select>
          </div>
        </div>
        <p></p>
        <div class="row">
          <div class="col-sm-3 text-right">Attribute Name:</div>
          <div class="col-sm-9  text-left">
            <input type="hidden" name="attribute_id" id="attribute_id">
            <input type="text" name="attribute_name" id="attribute_name" placeholder="Attribute Name" class="form-control">
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

{{ HTML::script('libraries/validator/validation.js') }}
<script type="text/javascript">
    $(document).ready(function(){
        $('.modal').on('hidden.bs.modal', function (e) {
          $(this).find('input').val('');
          $(this).find('select').val('0');
          //alert($(this).find('input').length);
        })
         $('#deals_tree')
          .treeview({data:''})
          .on('nodeSelected', function(event, node) {
              $('#deal_id').val(node.deal_id);
              $('#deal_name').val(node.deal_name);
              $('#adminDealModal').modal('toggle');
          });

          $('#groups_tree')
          .treeview({data:''})
          .on('nodeSelected', function(event, node) {
            console.log(node)
              $('#group_id').val(node.group_id);
              $('#group_name').val(node.group_name);
              $('#group_parent_id').val(node.parent_id);
              if(node.parent_id==0){
                 $('#group_parent_id').prop('disabled',true).closest('.row').hide();
              }else{
                $('#group_parent_id').prop('disabled',false).closest('.row').show();
              }
              $('#adminUpdatGroupeModal').modal('toggle');
          });

          $('#types_tree')
          .treeview({data:''})
          .on('nodeSelected', function(event, node) {
            console.log(node)
              $('#type_id').val(node.type_id);
              $('#type_name').val(node.type_name);
              $('#type_parent_id').val(node.parent_id);
              if(node.parent_id==0){
                 $('#type_parent_id').prop('disabled',true).closest('.row').hide();
              }else{
                $('#type_parent_id').prop('disabled',false).closest('.row').show();
              }
              $('#adminTypeModal').modal('toggle');
          });


          $('#attributes_tree')
          .treeview({data:''})
          .on('nodeSelected', function(event, node) {
            console.log(node)
              $('#attribute_id').val(node.attribute_id);
              $('#attribute_name').val(node.attribute_name);
              $('#attribute_type').val(node.attribute_type);              
              $('#adminAttributeModal').modal('toggle');
          });

          var getDealsTree = function(){
            if($('#deals_tree').length){
              $.getJSON('<?php echo URL::to("admins/get_deals_tree/");?>',function(data){ 
                $('#deals_tree').treeview({data:data})
              });
            }
          }
          
          var getGroupsTree = function(){
            if($('#groups_tree').length){
              $.getJSON('<?php echo URL::to("admins/get_groups_tree/");?>',function(data){ 
                $('#groups_tree').treeview({data:data})
              });
            }
          }

          var getTypesTree = function(){
            if($('#types_tree').length){
              $.getJSON('<?php echo URL::to("admins/get_types_tree/");?>',function(data){ 
                $('#types_tree').treeview({data:data});
                //alert($('#types_tree .expand-collapse').length);
                //$('#types_tree .expand-collapse').trigger('click');
              });
            }
          }

          
          var getAttributesTree = function(){
            if($('#attributes_tree').length){
              $.getJSON('<?php echo URL::to("admins/get_attributes_tree/");?>',function(data){ 
                $('#attributes_tree').treeview({data:data})
              });
            }
          }


          var refreshAll = function(){
            getDealsTree();
            getGroupsTree();
            getTypesTree();
            getAttributesTree();
          }
          //$('#transports').treeview({data: '<?php echo $dataset["transports"]; ?>'})

         
          refreshAll();
          
          $('#frm_deal').validate({
            rules:{
              'deal_name':{required:true}
            },
            errorClass:'text-danger',
            errorElement:'small',
            submitHandler:function(form){
              $.post(
                $(form).attr('action'),
                $(form).serialize(),
                function(m){
                  var  o = $.parseJSON(m);
                  $('#adminDealModal').modal('toggle');
                  getDealsTree();
                  ths.button('reset')
                }
              );
              return false;
            }
          });


          $('#frm_group').validate({
            rules:{
              'parent_id':{},
              'group_name':{required:true}
            },
            errorClass:'text-danger',
            errorElement:'small',
            submitHandler:function(form){
              $.post(
                $(form).attr('action'),
                $(form).serialize(),
                function(m){
                  var  o = $.parseJSON(m);
                  $('#adminUpdatGroupeModal').modal('toggle');
                  getGroupsTree();
                  ths.button('reset')
                }
              );
              return false;
            }
          });

          $('#frm_type').validate({
            rules:{
              'parent_id':{},
              'type_name':{required:true}
            },
            errorClass:'text-danger',
            errorElement:'small',
            submitHandler:function(form){
              $.post(
                $(form).attr('action'),
                $(form).serialize(),
                function(m){
                  var  o = $.parseJSON(m);
                  $('#adminTypeModal').modal('toggle');
                  getTypesTree();
                  ths.button('reset')
                }
              );
              return false;
            }
          });

          $('#frm_attribute').validate({
            rules:{
              'type_name':{required:true}
            },
            errorClass:'text-danger',
            errorElement:'small',
            submitHandler:function(form){
              $.post(
                $(form).attr('action'),
                $(form).serialize(),
                function(m){
                  var  o = $.parseJSON(m);
                  $('#adminAttributeModal').modal('toggle');
                  getAttributesTree();
                  ths.button('reset')
                }
              );
              return false;
            }
          });

    });
</script>
@stop