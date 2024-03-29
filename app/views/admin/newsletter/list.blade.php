@extends('admin.layouts.default')
@section('body')
<?php
	//pr($dataset["list"]);
?>
<section class="content-header row">
  <h1 class="page-header"> Newsletter User List  </h1>
  
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
    
    <input type="hidden" name="user_id" id="user_id">
    <div class="row">
        <div class="col-sm-8">
            <input type="search" class="form-control" data-toggle="search" data-target=".user_list tr" data-norecord=".nrf" Placeholder="Search By Text">
        </div>
        <div class="col-sm-4 text-right">            
            <!--
            <a href="javascript:;" class="btn btn-primary" data-toggle="filter" data-target=".user_list tr" data-prop_name="data-state" data-prop_value="">All</a>
            <a href="javascript:;" class="btn btn-success" data-toggle="filter" data-target=".user_list tr" data-prop_name="data-state" data-prop_value="s1">Active</a>
            <a href="javascript:;" class="btn btn-warning" data-toggle="filter" data-target=".user_list tr" data-prop_name="data-state" data-prop_value="s0">Inactive</a>
            -->
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
    					<th>Email</th>
    					<th>Date & Time</th>
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
    						{{$v->newsletter_user}}
    					</td>
    					<td>
    						{{$v->newsletter_email}}
    					</td>
    					
    					<td>
                          {{date('d-M Y',strtotime($v->created))}} at {{date('h:i a',strtotime($v->created))}}
                        </td>
    				</tr>
    				@endforeach
    			</tbody>
    		</table>
            <div class="nrf" style="display:none">
                <div class="alert alert-warning">
                 <i class="fa fa-exclamation-triangle"></i>   No Record Found
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