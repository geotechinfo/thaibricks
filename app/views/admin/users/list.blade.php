@extends('admin.layouts.default')
@section('body')
<?php
	//pr($dataset["list"]);
?>
<section class="content-header row">
  <h1 class="page-header"> Manage Users  </h1>
  
</section>
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
<section>
<div class="clearfix" style="margin:10px 0">
	<h3 class="pull-left" style="margin:0">List</h3>
	<!--<a href="javascript:;" id="activate" class="btn btn-primary pull-right">Activate</a>-->
    <!--<input type="search" class="form-control pull-right search_text" placeholder = "Search by text">-->
</div>
    
    {{ Form::open(array('route' => array('admin.user.changestatus'), 'method' => 'post','id'=>'frm_activate')) }}
    <input type="hidden" name="user_id" id="user_id">
    <div class="row">
        <div class="col-sm-8">
            <input type="search" class="form-control" data-toggle="search" data-target=".user_list tr" Placeholder="Search By Text">
        </div>
        <div class="col-sm-4 text-right">            
            <a href="javascript:;" class="btn btn-primary" data-toggle="filter" data-target=".user_list tr" data-prop_name="data-state" data-prop_value="">All</a>
            <a href="javascript:;" class="btn btn-success" data-toggle="filter" data-target=".user_list tr" data-prop_name="data-state" data-prop_value="s1">Active</a>
            <a href="javascript:;" class="btn btn-warning" data-toggle="filter" data-target=".user_list tr" data-prop_name="data-state" data-prop_value="s0">Inactive</a>
        </div>
    </div>
    <p></p>
    <div class="row">
    	<div class="col-sm-12">
                        <div class="table-responsive">
    		<table class="responsive table table-striped table-bordered"  width="100%" cellspacing="5" cellpadding="2">
    			<thead>
    				<tr>
    					<th>#</th>
    					<th>Name</th>
    					<th>Location</th>
    					<th>Phone</th>
                        <th>Email</th>
    					<th>Action</th>
    				</tr>
    			</thead>
    			<tbody id="tbluserlist" class="user_list">
    				@foreach($dataset['list'] as $k=>$v)
    				<?php
    					//pr($v);
    				?>
    				<tr data-state="s{{$v->status}}">
    					<td>
    						{{$k+1}}
    					</td>
    					<td>
    						{{$v->first_name}} {{$v->last_name}}
    					</td>
    					<td>
    						{{$v->location_name}}
    					</td>
    					<td>                           
                            {{$v->phone}}
                        </td>
                        <td>
    						{{$v->email}}
    					</td>
    					<td>
                          <a href="{{URL::to('admins/user/changestatus/')}}/{{$v->user_id}}"><?php echo($v->status==1?'<i class="text-info">Active</i>':'<i class="text-danger">Inactive</i>');?></a>
                        </td>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
                        </div>
    	</div>
    </div>
    {{ Form::close() }}

</section>

<script type="text/javascript">
	$(document).ready(function(){
		$('.chk_all').click(function(){
			$('.chk_ids').prop('checked',$(this).prop('checked'));
            
		});
		$('#activate').click(function(){
			$('#frm_activate').submit();
			/*
			$.post(
				$('#frm_activate').attr('action'),
				$('#frm_activate').serialize(),
				function(m){

				}	
			)
			*/
		});

        $('.search_text').keyup(function(){
            var ths = $(this);
            var v = ths.val();
            if(v.length==0){
               $('#tbluserlist tr').show()
            }else{
                
                //alert($('td:contains('+v+')').length)
                
                $('#tbluserlist tr').each(function(){                
                    //if($(this).find(':contains('+v+')').length){
                    if($(this).text().search(new RegExp(v, "i")) > 0){    
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                    
                });
                
            }
        })
	});
</script>
@stop