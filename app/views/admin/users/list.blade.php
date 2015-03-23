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
    <p></p>
    <input type="hidden" name="user_id" id="user_id">
    <div class="row">
        <div class="col-sm-8">
            <input type="search" class="form-control" data-toggle="search" data-target=".user_list tr" data-norecord=".nrf" Placeholder="Search By Text">
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
                          <a href="{{URL::to('admins/user/changestatus/')}}/{{$v->user_id}}"><?php echo($v->status==1?'<i class="text-danger">Deactivate</i>':'<i class="text-info">Activate</i>');?></a>
                          | <a title="<?php echo($v->is_featured==1?'Make it Normal':'Make it Featured') ?>" href="{{URL::to('admins/user/changefeatured/')}}/{{$v->user_id}}"><?php echo($v->is_featured==1?'<i class="text-info">Featured</i>':'<i class="text-danger">Normal</i>');?></a>
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