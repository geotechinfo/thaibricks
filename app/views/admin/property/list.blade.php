@extends('admin.layouts.default')
@section('body')
<?php
	//pr($dataset["list"]);
?>
<section class="content-header row">
  <h1 class="page-header"> <?php echo (isset($dataset['title'])?$dataset['title']:'Manage Property')?> </h1>
  
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
<p></p>
    
    <div class="row">
        <div class="col-sm-8">
            <input type="search" class="form-control" data-toggle="search" data-target=".prop_list tr" data-norecord=".nrf" Placeholder="Search By Text">
        </div>
        @if($dataset['is_dashboard']==1)
        <div class="col-sm-4 text-right">            
            <a href="javascript:;" class="btn btn-primary" data-norecord=".nrf" data-toggle="filter" data-target=".prop_list tr" data-prop_name="data-state" data-prop_value="">All</a>
            <a href="javascript:;" class="btn btn-success" data-norecord=".nrf" data-toggle="filter" data-target=".prop_list tr" data-prop_name="data-state" data-prop_value="s1">Active</a>
            <a href="javascript:;" class="btn btn-warning" data-norecord=".nrf" data-toggle="filter" data-target=".prop_list tr" data-prop_name="data-state" data-prop_value="s0">Inactive</a>
        </div>
        @endif
    </div>
    <p></p>
    <div class="row">
    	<div class="col-sm-12">
                        <div class="table-responsive">
    		<table class="responsive table table-striped table-bordered" width="100%" cellspacing="5" cellpadding="2">
    			<thead>
    				<tr>
    					<th>#</th>
    					<th>Title</th>
    					<th>Location</th>
    					<th>User</th>
    					<th>Email</th>
    					<th>Price</th>
    					<th>Status</th>
                        <th>Action</th>
    				</tr>
    			</thead>
    			<tbody class="prop_list">
    				@foreach($dataset['list'] as $k=>$v)
    				<?php
    					//pr($v);
    				?>
    				<tr data-state="s{{$v->status}}">
    					<td width="3%">
    						{{$k+1}}
    					</td>
    					<td width="25%">
    						 {{$v->title}}
    					</td>
    					<td width="15%">
    						{{$v->location_name}}->{{$v->locationsub_name}}
    					</td>
    					<td width="15%">
    						{{$v->first_name." ".$v->last_name}}
    					</td>
    					<td width="10%">
    						{{$v->email}}
    					</td>
    					<td width="5%">    						
    						{{$v->price}}
    					</td>
						<td>
							<?php echo ($v->status==0?'<span class="text-danger">Inactive</span>':'<span class="text-success">Active</span>')?>
						</td>
                        <td>
                            <a target="_blank" href="{{URL::action('PropertiesController@show', [$v->property_id])}}">
                                 Details
                            </a>
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
	});
</script>
@stop