@extends('layouts.ajax')
@section('content')
<?php
  //pr($dataset["property"]->attributes);
?>  
@foreach($dataset["groups"] as $group)
        <div class="padding unit border greyBg">
          <h5 class="clouds">{{{ $group["group_name"] }}}</h5>
          <div class="padding">
          <div class="row">
            
          @foreach($group["attributes"] as $attribute)
          <div class="col-sm-6">
            <div class="form-group">
              <label for="pBedrooms" class="control-label">{{{ $attribute["attribute_name"] }}}</label>
              	<?php
$attribute_value = null;                
if(isset($dataset["property"]->attributes)){
	foreach($dataset["property"]->attributes as $value){
		if($attribute["attribute_id"] == $value->attribute_id){
			$attribute_value = $value->attribute_value;
		}
	}
}else{
	$attribute_value = null;
}
?>
                                	@if($attribute["attribute_type"] == "number")
                                      <?php $placeholder = "Number of ".$attribute["attribute_name"]; ?>
                                      {{Form::number('attributes['.$attribute["attribute_id"].']', $attribute_value, array('min' => 1, 'class' => 'form-control', 'placeholder' => $placeholder))}}
                                  @elseif($attribute["attribute_type"] == "text")
                                  	<?php $placeholder = "Enter ".$attribute["attribute_name"]; ?>
                                  	{{Form::text('attributes['.$attribute["attribute_id"].']', $attribute_value, array('class' => 'form-control', 'placeholder' => $placeholder))}}
                                  @elseif($attribute["attribute_type"] == "check")
                                  	<?php $ischeck = ($attribute_value == "Yes") ? true : false; ?>
                                  	{{Form::checkbox('attributes['.$attribute["attribute_id"].']', "Yes", $ischeck, array('class' => 'form-control checkbox_radio'))}}
                                  @endif
  </div>
</div>
  @endforeach
  </div>
  </div>
                            
                          </div>
                      @endforeach
@stop                      