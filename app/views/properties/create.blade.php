@extends('layouts.default')
@section('content')

<?php
$location = new Location;
$dataset['locations']=$location->get_location_with_sub();

$loc = array(''=>'Select Location');
$subloc[''] = array(''=>'Select Location');
$transport_group =  array('' => 'Select Transport Group' );
foreach ($dataset['locations'] as $k=>$v){
  $loc[$k]=$v['location_name'];
   if($v['SubLocation']){
	   foreach ($v['SubLocation'] as $k1 => $v1) {
		  $subloc[$k][$v1['location_id']]=$v1['location_name'];
	   }
   }
   if($v['Transport']){
	   foreach ($v['Transport'] as $k1 => $v1) {
		  $transport_group[$k][$v1['transport_id']]=$v1['transport_name'];
	   }
   }
}
?>

<!--/profileimage-->
<style type="text/css">
div.arrow_fix:before{height:35px !important;}
</style>
<section class="container container2 margin-top-10 white radius-top" id="profileimage">
  <div class="clearfix padding-5 clouds">
    {{ $dataset['banner_panel'] }}
  </div>
</section>
<!--/profileimage-->
<section class="container container2 margin-top-10 white radius-top" id="postproperty">
  <aside class="col-sm-3 col-sm-push-9">
    <!--<div class="search-btn-wrap clearfix"> <a class="btn btn-primary btn-lg search-button margin-top details-search-button " href=""> <span class="fa fa-plus"></span> <span>Add
          New Property</span> </a> </div>-->
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad2.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad5.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad3.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
    <h2>
    	@if(Route::currentRouteAction() == "PropertiesController@edit")
        	{{{ $dataset["property"]->title }}}
        @else
    		Add new property details <small>(Post your property and list property features)</small>
        @endif
    </h2>
        
        @foreach ($errors->all() as $message)
        <div class="margin-top-10 message">
        <p class="btn-danger text-danger padding-5">
            <span class="fa fa-times-circle"></span>{{{ $message }}}
            <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a>
        </p>
        </div>
        <?php break; ?>
        @endforeach
            
    <div class="propertylist clearfix new clouds white">
      <div class="formwrap">
<div class="steps">
              <!--/Step Tabs-->
              <div class="clearfix bs-wizard clouds stepwrap">
              
                <div class="col-xs-3 bs-wizard-step step_1 active">
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress">
                    <div class="progress-bar"></div>
                  </div>
                  <a href="#step1" class="bs-wizard-dot"><span class="fa fa-circle"></span></a>
                  <div class="bs-wizard-info text-center">Basic Property Details </div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step step_2 disabled">
                  <div class="text-center bs-wizard-stepnum">Step 2</div>
                  <div class="progress">
                    <div class="progress-bar"></div>
                  </div>
                  <a href="#step2" class="bs-wizard-dot"><span class="fa fa-circle"></span></a>
                  <div class="bs-wizard-info text-center">Property Feature List </div>
                </div>
                
                <div class="col-xs-3 bs-wizard-step step_3 disabled">
                  <div class="text-center bs-wizard-stepnum">Step 3</div>
                  <div class="progress">
                    <div class="progress-bar"></div>
                  </div>
                  <a href="#step3" class="bs-wizard-dot"><span class="fa fa-circle"></span></a>
                  <div class="bs-wizard-info text-center">Property Photos </div>
                </div>
                
                <!--<div class="col-xs-3 bs-wizard-step disabled">
                  <div class="text-center bs-wizard-stepnum">Step 4</div>
                  <div class="progress">
                    <div class="progress-bar"></div>
                  </div>
                  <a href="#step4" class="bs-wizard-dot"><span class="fa fa-circle"></span></a>
                  <div class="bs-wizard-info text-center"> Location Map</div>
                </div>-->
              </div>
              <!--/Step Tabs-->
              <!--/Step Content Tabs-->
              <div class="formarea propertyinfo">
              	@if(Route::currentRouteAction() == "PropertiesController@edit")
              		{{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('property.update', $dataset["property"]->property_id), 'files' => true, 'method' => 'post')) }} 
                @else
                	{{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('property.store'), 'files' => true, 'method' => 'post')) }} 
                @endif
                
                  <input type="hidden" name="deal_id" value="<?php echo $dataset["deal_id"]; ?>" />
                  <input type="hidden" name="type_id" value="<?php echo $dataset["type_id"]; ?>" />
                  <div class="tab-content">
                    <!--/Step1 Content Basic Property Details -->
                    <div class="propertyformsteps" id="step1">
                      <h4> Basic Property Details </h4>
                      <div class="border-bottom"></div>
                      <div class="border-top"></div>
                      <div class="padding">

                     
                      
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="propertyname" class="control-label">Society/Project
                              Title</label>
                              {{Form::text('title', $dataset["property"]->title, array('class' => 'form-control', 'placeholder' => 'Enter Property Title'))}}
                          </div>
                        </div>  
                        <div class="col-sm-6">  
                          <div class="form-group">
                            <label class="control-label">Location</label>                            
                              <div class="arrow">
                                <div class="btn-group mutiselectbtn">                               
                                  {{Form::select('location', $loc, '', array('class' => 'form-control', 'id'=>"location"))}}
                                </div>
                              </div>                            
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Sub Location</label>
                              <div class="arrow">
                                <div class="btn-group mutiselectbtn">
                                  {{Form::select('location_sub', array(''=>'Select Sub Location'), '', array('class' => 'form-control', 'id'=>"location_sub"))}}
                                </div>
                              </div>
                          </div> 
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="cdaddress" class="control-label">Property Price</label>
                            <div class="input-group">
                                <span class="input-group-addon">&#xe3f;</span>
                                  <div class="row no-margin">
                                    <div class="col-xs-<?php if($dataset["deal_id"] == 2){ ?>6<?php }else{ ?>12<?php } ?>  no-margin">
                                        {{Form::text('price', $dataset["property"]->price, array('class' => 'form-control special_input', 'placeholder' => 'Enter Property Price', 'style'=>'height:36px'))}}
                                    </div>
                                      <?php if($dataset["deal_id"] == 2){ ?>
                                    <div class="col-xs-6  no-margin">
                                        
                                          <div class="arrow arrow_fix">
                                            <div class="btn-group mutiselectbtn">
                                              {{Form::select('basis', array('M' => 'Monthly'), $dataset["property"]->basis, array('class' => 'form-control special_input', 'style'=>'height:36px'))}}
                                            </div>
                                          </div>
                                      </div>
                                      <?php }else{ ?>
                                        <input type="hidden" name="basis" value="O" />
                                      <?php } ?>
                                  </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="propertyname" class="control-label">Description</label>                            
                              {{ Form::textarea('description', $dataset["property"]->description, ['class' => 'form-control','rows' => '5']) }}
                          </div>
                        </div>
                       
                        <div class="col-sm-12">
                          <div class="form-group">
                            <label for="cdaddress" class="control-label">Address</label>
                            {{ Form::textarea('address', $dataset["property"]->address, ['class' => 'form-control','rows' => '5']) }}
                          </div>
                        </div>
                        
                      </div>

                    </div>
                    <h4> Contact Details</h4>  
                    <div class="border-bottom"></div>
                    <div class="border-top"></div>
                    <div class="padding">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label for="cdcontact" class="control-label">Contact Number</label>
                              <div>
                              <?php if(isset($dataset["property"]->phone)){ $phone = $dataset["property"]->phone; }else{ $phone = Auth::user()->phone; } ?>
                              <input type="text" class="form-control locationcode" id="locationcode" placeholder="+66" value="+66" readonly="readonly" style="background:#111112 !important;"/>
                              {{Form::text('phone', $phone, array('class' => 'form-control ucontactright', 'placeholder' => 'Enter contact number'))}}
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label" for="cdemail">Email id</label>
                            <div>
                              <?php if(isset($dataset["property"]->email)){ $email = $dataset["property"]->email; }else{ $email = Auth::user()->email; } ?>
                              {{Form::text('email', $email, array('class' => 'form-control', 'placeholder' => 'Enter email address'))}}
                            </div>
                          </div>
                        </div>
                      </div>
                        
                        
                      </div>
                    
                     
                      <div id="transport_system" style="display:none;">
                        <h4> Transports</h4>
                        <div class="border-bottom"></div>
                        <div class="border-top"></div>
                        <div class="padding">
                        <div class="row cls_transport"></div>
                        <!--<div class="row">
                        <?php //if(isset($dataset["property"]->transports)){ ?>
                        <?php //foreach($dataset["property"]->transports as $k=>$v){?>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">{{$v->transport_name}}</label>
                                <div>
                                  <select class="form-control cls_transport_select ucontactright" name="transport_id[]">
                                    <option value="">Select Transport</option>
                                    <?php 
                                      /*$km='';$slct = '';
                                      foreach($v->Child as $ck=>$cv){
                                      $km = (!empty($dataset["property"]->selected_transports[$cv->transport_id])?$dataset["property"]->selected_transports[$cv->transport_id]:'');
                                      $slct =  (array_key_exists($cv->transport_id, $dataset["property"]->selected_transports)?'selected':'');*/
                                    ?>
                                    <option <?php //echo $slct;?> value="<?php //echo $cv->transport_id?>"><?php  //echo$cv->transport_name?></option>
                                    <?php //}?>
                                  </select>
                                  <input class="form-control locationcode cls_transport_distance" name="transport_dist[]" value="<?php //echo $km;?>" placeholder="Km">
                                </div>
                              
                            </div>
                          </div>
                          <?php //} //endforeach ?>
                          <?php //} //endif ?>
                          </div>-->
                        </div>
                    </div>  
                    

                    <div id="nearby_system" style="display:none;">
                        <h4> NearBy</h4>
                        <div class="border-bottom"></div>
                        <div class="border-top"></div>
                        <div class="padding">
                          <div class="row cls_nearby"></div>
                        </div>
                    </div>  
                        
                    </div>
                    <!--/Step1 Content Basic Property Details -->
                    <!--/Step2 Content Property Feature List -->
                    <div class="propertyformsteps" id="step2">
                      <h4> Property Feature List</h4>

                      @foreach($dataset["groups"] as $group)
                          <div class="padding unit border">
                            <h5 class="clouds padding-5">{{{ $group["group_name"] }}}</h5>
                            <div class="padding">
                            <div class="row">
                              
                            @foreach($group["attributes"] as $attribute)
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="pBedrooms" class="control-label">{{{ $attribute["attribute_name"] }}}</label>
                                	<?php
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
                                  	{{Form::checkbox('attributes['.$attribute["attribute_id"].']', "Yes", null, array('class' => 'form-control checkbox_radio'))}}
                                  @endif
                            </div>
                          </div>
                            @endforeach
                            </div>
                            </div>
                            <!--<div class="form-group">
                              <label for="pBathrooms" class="col-md-4 control-label">Number
                                of Bathrooms</label>
                              <div class="col-md-6">
                                <input type="number" class="form-control" id="pBathrooms" placeholder="Enter Number of Bathrooms"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label">Balcony</label>
                              <div class="col-md-6">
                                <div class="choosewrap">
                                  <label class="radio-inline">
                                    <input type="radio" name="inlineBalconyOptions" id="Available" value="Available">
                                    Available </label>
                                  <label class="radio-inline">
                                    <input type="radio" name="inlineBalconyOptions" id="NotAvailable" value="NotAvailable">
                                    Not Available </label>
                                </div>
                                <input type="number" class="form-control" id="pBathrooms" placeholder="Enter Number of Bathrooms"/>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label">Dinning / Drawing</label>
                              <div class="col-md-6">
                                <div class="choosewrap">
                                  <label class="radio-inline">
                                    <input type="radio" name="inlineDinningOptions" id="Available" value="Available">
                                    Available </label>
                                  <label class="radio-inline">
                                    <input type="radio" name="inlineDinningOptions" id="NotAvailable" value="NotAvailable">
                                    Not Available </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-4 control-label">Kitchen</label>
                              <div class="col-md-6">
                                <div class="choosewrap">
                                  <label class="radio-inline">
                                    <input type="radio" name="inlineKitchenOptions" id="Available" value="Available">
                                    Available </label>
                                  <label class="radio-inline">
                                    <input type="radio" name="inlineKitchenOptions" id="NotAvailable" value="NotAvailable">
                                    Not Available </label>
                                </div>
                              </div>
                            </div>-->
                          </div>
                      @endforeach
                      
                      <!--<div class="padding unit border">
                        <h5 class="clouds padding-5">Units</h5>
                        <div class="padding"></div>
                        <div class="form-group">
                          <label for="pBedrooms" class="col-md-4 control-label">Number
                            of Bedrooms</label>
                          <div class="col-md-6">
                            <input type="number" class="form-control" id="pBedrooms" placeholder="Enter Number of Bedrooms"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="pBathrooms" class="col-md-4 control-label">Number
                            of Bathrooms</label>
                          <div class="col-md-6">
                            <input type="number" class="form-control" id="pBathrooms" placeholder="Enter Number of Bathrooms"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Balcony</label>
                          <div class="col-md-6">
                            <div class="choosewrap">
                              <label class="radio-inline">
                                <input type="radio" name="inlineBalconyOptions" id="Available" value="Available">
                                Available </label>
                              <label class="radio-inline">
                                <input type="radio" name="inlineBalconyOptions" id="NotAvailable" value="NotAvailable">
                                Not Available </label>
                            </div>
                            <input type="number" class="form-control" id="pBathrooms" placeholder="Enter Number of Bathrooms"/>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Dinning / Drawing</label>
                          <div class="col-md-6">
                            <div class="choosewrap">
                              <label class="radio-inline">
                                <input type="radio" name="inlineDinningOptions" id="Available" value="Available">
                                Available </label>
                              <label class="radio-inline">
                                <input type="radio" name="inlineDinningOptions" id="NotAvailable" value="NotAvailable">
                                Not Available </label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Kitchen</label>
                          <div class="col-md-6">
                            <div class="choosewrap">
                              <label class="radio-inline">
                                <input type="radio" name="inlineKitchenOptions" id="Available" value="Available">
                                Available </label>
                              <label class="radio-inline">
                                <input type="radio" name="inlineKitchenOptions" id="NotAvailable" value="NotAvailable">
                                Not Available </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="padding furnishing border">
                        <h5 class="clouds padding-5">Furnishing</h5>
                        <div class="padding"></div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Furnishing</label>
                          <div class="col-md-6">
                            <div class="choosewrap">
                              <div class="radio">
                                <label>
                                  <input type="radio" name="inlineFurnishingOptions" id="Furnished" value="Furnished">
                                  Furnished </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="inlineFurnishingOptions" id="SemiFurnished" value="SemiFurnished">
                                  Semi-furnished </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="inlineFurnishingOptions" id="UnFurnished" value="UnFurnished">
                                  Unfurnished </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Furniture Type</label>
                          <div class="col-md-6">
                            <div class="multiselectwrap">
                              <div class="arrow">
                                <div class="btn-group mutiselectbtn">
                                  <select class="js-example-placeholder-multiple-furnituretype form-control" multiple="multiple">
                                    <option value="SubLocation1">Beds</option>
                                    <option value="SubLocation2">Wardrobes</option>
                                    <option value="SubLocation3">ACs</option>
                                    <option value="SubLocation4">Modular Kitchen</option>
                                    <option value="SubLocation5">Water Heater</option>
                                    <option value="SubLocation6">Refrigerator</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="padding floorPosition border">
                        <h5 class="clouds padding-5">Floor Position</h5>
                        <div class="padding"></div>
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="floorBuilding">Total Floors
                            in Building</label>
                          <div class="col-md-6">
                            <input type="number" placeholder="Enter Total Floors in Building" id="floorBuilding" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label">Property on Floor</label>
                          <div class="col-md-6">
                            <select class="form-control" id="propertyFloor">
                              <option>Select Property on Floor</option>
                              <option>Basement</option>
                              <option>Lower ground</option>
                              <option>Ground</option>
                              <option>1</option>
                              <option>2</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="padding floorPosition border">
                        <h5 class="clouds padding-5">Area</h5>
                        <div class="padding"></div>
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="SuperArea">Super built-up
                            Area <small>(units)</small></label>
                          <div class="col-md-6">
                            <input type="text" placeholder="Enter Super built-up Area" id="SuperArea" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="BuiltUpArea">Built-up Area <small>(units)</small></label>
                          <div class="col-md-6">
                            <input type="text" placeholder="Enter Built-up Area" id="BuiltUpArea" class="form-control">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-4 control-label" for="CarpetArea">Built-up Area <small>(units)</small></label>
                          <div class="col-md-6">
                            <input type="text" placeholder="Carpet Area" id="CarpetArea" class="form-control">
                          </div>
                        </div>
                      </div>-->
                    </div>
                    <!--/Step2 Content Property Feature List -->
                    <!--/Step3 Content Property Photos & Plan  -->
                    <div class="propertyformsteps" id="step3">
                      <!--<div class="clearfix">
                        <h4> Property Photos
                        	<a class="btn btn-danger orange right" href="javascript:void(0);"><span class="fa fa-plus"></span> Add Photos</a>                            
                        </h4>
                      </div>-->
                      <p></p>
                        <div class="form-group">
                        	<div class="clearfix">
                        		<label for="propertyname" class="col-md-4 control-label">Add Photos</label>
                            </div>
                            <div class="addSpImageHolder">
                                <div class="clearfix well">
                                    <div class="col-md-6">
                                  <div class="fileHolder">
                                        <?php
                                        $image_types = array("Locality", "Building", "Floor Plan", "Bedroom 1", "Bedroom 2", "Kitchen", "Others");
                                        foreach($image_types as $image_type){
                                        ?>
                                        <div class="row noMargin" id="file_wrap" style="margin-bottom:5px !important;">
                                          <div class="col-sm-6 noPadding" style="min-height:inherit !important;">
                                            <input type="text" class='form-control' name="image_titles[]" placeholder="Enter Title" value="<?php echo $image_type; ?>" readonly="readonly" style="color:#333333;"/>
                                          </div>
                                          <div class="col-sm-6 noPadding" style="min-height:inherit !important;">
                                            <div class="fileBack">
                                              {{ Form::file('image_files[]', array('class' => 'upFile')) }}
                                              <span><i class="fa fa-plus"></i> Add Image</span>
                                            </div>
                                          </div>
                                        </div>
                                        <?php } ?>
                                        <!--<a href="javascript:;" class="adFile" id="file_add"><i class="fa fa-plus"></i> Add More Images</a>-->
                                  </div>
                                </div>
                                </div>
                            </div>
                        </div>
                      <p></p>
                      	<div class="form-group">
                            <div class="addSpImageHolder">
                                <div class="well">
                                    <div class="clearfix">
                                
                                
                                    <?php if($dataset["property"]->media){ ?>
                                    @foreach($dataset["property"]->media as $key=>$media)
                                    <div class="portfolio-item uploadedImages">
                                        <a class="item-inner btn-block" href="javascript:void(0);"> <img alt="{{{ $media->media_title }}}" src="{{{ asset('files/properties')."/".$media->media_data }}}">
                                            <p class="upImageTitle">{{{ $media->media_title }}}</p>
                                        </a>
                                        <div class="deleteCheck"><input type="checkbox" name="image_deletes[]" value="<?php echo $media->media_id; ?>" /> Delete</div>
                                    </div>  
                                    @endforeach
                                    <?php } ?>
                                    
                                    </div>
                                    
                                	<p class="delImgAlert bg-info">The image will be deleted once you click update.</p>
                                </div>
                            </div>
                            
                            
                        </div>
                      <br />
                    
                      <div class="border-bottom"></div>
                      <!--<div class="border-top"></div>-->
                      <!--<div class="padding">
                        <div class="form-group">
                          <div class="photowrap">
                            <div class="col-md-4 portfolio-item">{{ HTML::image('images/portfolio/thumb/item1.jpg', '', array('class' => 'img-responsive')) }}<div class="editimg"> <span class="btn fileinput-button"> <span class="fa fa-edit"> </span> <span>Edit
                                    Image</span>
                                <input type="file" name="files[]" multiple="">
                                </span> </div>
                            </div>
                            <div class="col-md-4 portfolio-item">{{ HTML::image('images/portfolio/thumb/item1.jpg', '', array('class' => 'img-responsive')) }}<div class="editimg"> <span class="btn fileinput-button"> <span class="fa fa-edit"> </span> <span>Edit
                                    Image</span>
                                <input type="file" name="files[]" multiple="">
                                </span> </div>
                            </div>
                            <div class="col-md-4 portfolio-item">{{ HTML::image('images/portfolio/thumb/item1.jpg', '', array('class' => 'img-responsive')) }}<div class="editimg"> <span class="btn fileinput-button"> <span class="fa fa-edit"> </span> <span>Edit
                                    Image</span>
                                <input type="file" name="files[]" multiple="">
                                </span> </div>
                            </div>
                            <div class="col-md-4 portfolio-item">{{ HTML::image('images/portfolio/thumb/item1.jpg', '', array('class' => 'img-responsive')) }}<div class="editimg"> <span class="btn fileinput-button"> <span class="fa fa-edit"> </span> <span>Edit
                                    Image</span>
                                <input type="file" name="files[]" multiple="">
                                </span> </div>
                            </div>
                            <div class="col-md-4 portfolio-item">{{ HTML::image('images/portfolio/thumb/item1.jpg', '', array('class' => 'img-responsive')) }}<div class="editimg"> <span class="btn fileinput-button"> <span class="fa fa-edit"> </span> <span>Edit
                                    Image</span>
                                <input type="file" name="files[]" multiple="">
                                </span> </div>
                            </div>
                            <div class="col-md-4 portfolio-item">{{ HTML::image('images/portfolio/thumb/item1.jpg', '', array('class' => 'img-responsive')) }}<div class="editimg"> <span class="btn fileinput-button"> <span class="fa fa-edit"> </span> <span>Edit
                                    Image</span>
                                <input type="file" name="files[]" multiple="">
                                </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>-->
                      <!--<div class="clearfix">
                        <h4> Property Master Plan</h4>
                      </div>
                      <div class="border-bottom"></div>
                      <div class="border-top"></div>-->
                      <!--<div class="padding">
                        <div class="form-group">
                          <div class="photowrap">
                            <div class="col-md-12 portfolio-item"> {{ HTML::image('images/floorplan/floorplan.png', '', array('class' => 'img-responsive')) }}
                              <div class="editimg"> <span class="btn fileinput-button"> <span class="fa fa-edit"> </span> <span>Edit
                                    Image</span>
                                <input type="file" name="files[]" multiple="">
                                </span> </div>
                            </div>
                          </div>
                        </div>
                      </div>-->
                    </div>
                    <!--/Step3 Content Property Photos & Plan  -->
                    <!--/Step4 Content Property Location Map -->
                    <!--<div class="propertyformsteps" id="step4">
                      <h4> Property Map Location </h4>
                      <div class="border-bottom"></div>
                      <div class="border-top"></div>
                      <div class="form-group">
                        <div class="col-md-12">
                          <div id="map-canvas">{{ HTML::image('images/floorplan/map.png', '', array('class' => 'img-responsive')) }} </div>
                        </div>
                      </div>
                    </div>-->
                    <!--/Step4 Content Property Location Map -->
                  </div>
                  <!--/Prev-next Residential -->
                  <div class="prev-next-btnwrap">
                    <div class="border-bottom"></div>
                    <div class="border-top"></div>
                    <div class="form-group margin-top-10">
                      <div class="col-md-4 control-label"></div>
                      <div class="col-md-8">
                            <input class="btn btn-danger orange right"  type="submit" id="sbmt" @if(Route::currentRouteAction() == "PropertiesController@edit") value="Update" @else value="Submit" @endif id="sbmt" style="display:none;">
                            <!--<a href="javascript:void(0);" class="btn btn-danger orange right step_next"  id="next" onclick="property_create_validate();">Next</a> -->
                            <a href="javascript:void(0);" class="btn btn-danger orange right step_next"  id="next" >Next</a>
                            <a href="javascript:void(0);" class="btn pitch-black right prev step_prev" id="prev">Prev</a>
                       </div>
                    </div>
                  </div>
                  <!--/Prev-next Residential -->
                {{ Form::close() }}
              </div>
              <!--/Step Content Tabs-->
            </div>
      </div>
    </div>
  </div>
</section>
<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="">
      <div class="col-sm-6"> You are here: <a title="home" href="javascript:void(0)">Home</a></div>
      <div class="col-sm-6">
        <ul class="pull-right">
          <li class="totop"><a href="#" class="gototop" id="gototop">Top <span class="fa fa-arrow-up"></span></a></li>
          <!--#gototop-->
        </ul>
      </div>
    </div>
  </div>
  
</section>
@stop