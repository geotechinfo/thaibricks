@extends('admin.layouts.default')
@section('body')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h2>View Relations</h2>        
        
        @if(Session::get('empty') == true)
        <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <strong>Application don't have any specified relations!</strong> <a href="{{URL::to('/admin/relation/create')}}">Create Relation</a>
        </div>
        @endif
        
        <div id="relations"></div>
    </div>
</div>
<link type="text/css" href="{{asset("libraries\bootstrap-treeview\src\css\bootstrap-treeview.css")}}" />
<script src="{{asset("libraries\bootstrap-treeview\src\js\bootstrap-treeview.js")}}"></script>
<script type="text/javascript">
	$('#relations').treeview({data: '<?php echo $dataset; ?>'});
</script>
@stop