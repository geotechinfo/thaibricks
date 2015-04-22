@extends('admin.layouts.default')
@section('body')
{{ HTML::script('libraries/validator/validation.js') }}

{{ HTML::script('libraries/uploadifive/js/jquery.ui.widget.js') }}
{{ HTML::script('libraries/uploadifive/js/jquery.fileupload.js') }}

{{ HTML::script('js/jquery-ui.js') }}
{{ HTML::style('css/jquery-ui.css') }}

<?php
	//pr($dataset["list"]);
?>
<section class="content-header row">
  <h1 class="page-header"> Manage Recommendation</h1>
  
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
@if(Session::has('danger'))
<p></p>
<div class="alert alert-danger">
    <span class="fa fa-tick"></span>&nbsp; {{ Session::get('danger') }}
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
        <div class="col-sm-3">
            <input type="search" class="form-control" data-toggle="search" data-target=".user_list tr" data-norecord=".nrf" Placeholder="Search By Text">
        </div>        
        <div  class="col-sm-9 text-right">            
            <a href="{{URL::to('admins/add_recommendation/')}}"  class="btn btn-primary" >Add Recommendation</a>
        </div>
    {{ Form::close() }}  
    </div>
    <p></p>
    <div class="row">
    	<div class="col-sm-12">

            <div class="table-responsive" id="list">

            </div>
            <div class="nrf" style="display:none">
                <div class="alert alert-warning">
                   <i class="fa fa-exclamation-triangle"></i> No Record Found
                </div>
            </div>            
    	</div>
    </div>

</section>
<script type="text/javascript">
    $(document).ready(function(){
        var fetchRecomendation = function(){
           
            $('#list').load('{{URL::action("AdminsRecommendationsController@get_recommendation")}}')   
        }
        fetchRecomendation()
    });
</script>
@stop