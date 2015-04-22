@extends('layouts.dashboard')
@section('content')

{{ HTML::script('libraries/uploadifive/js/jquery.ui.widget.js') }}
{{ HTML::script('libraries/uploadifive/js/jquery.fileupload.js') }}
{{ HTML::script('libraries/validator/validation.js') }}


{{ HTML::script('libraries/cropper-master/src/cropper.js') }}
{{ HTML::script('libraries/cropper-master/demos/js/propertyImageCropper.js') }}
{{ HTML::style('libraries/cropper-master/src/cropper.css') }}
{{ HTML::style('libraries/cropper-master/demos/css/docs.css') }}


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

<!--/profileimage-->
<section class="" id="postproperty">
  
  <div class="col-sm-12 propertylistwrap">
    <h3><span class="fa fa-map-marker"></span>
    	@if(Route::currentRouteAction() == "PropertiesController@edit")
        	{{{ $dataset["property"]->title }}}
        @else
    		Add new property details <small>(Post your property and list property features)</small>
        @endif
    </h3>
    <div class="divider"></div>
        
        @foreach ($errors->all() as $message)
        <div class="margin-top-10 message">
        <p class="btn-danger text-danger padding-5">
            <span class="fa fa-times-circle"></span>{{{ $message }}}
        </p>
        </div>
        <?php break; ?>
        @endforeach
            
    <div class="propertylist clearfix new clouds white">
      <div class="formwrap">
<div class="steps">
              <!--/Step Tabs-->
              <div class="clearfix bs-wizard clouds stepwrap greyBg">
              
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
                
                <div class="col-xs-3 bs-wizard-step step_4 disabled">
                  <div class="text-center bs-wizard-stepnum">Step 4</div>
                  <div class="progress">
                    <div class="progress-bar"></div>
                  </div>
                  <a href="#step4" class="bs-wizard-dot"><span class="fa fa-circle"></span></a>
                  <div class="bs-wizard-info text-center"> Message </div>
                </div>
              </div>
              <!--/Step Tabs-->
              <!--/Step Content Tabs-->
              <div class="formarea propertyinfo">
              	@if(Route::currentRouteAction() == "PropertiesController@edit")
              		{{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('property.update', $dataset["property"]->property_id), 'files' => true, 'method' => 'post')) }} 
                @else
                	{{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('property.store'), 'files' => true, 'method' => 'post')) }} 
                @endif
                
                  
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
                            <label class="control-label">Transaction Type</label>
                            <?php
                              $dval = isset($dataset['property']->deal_id)?$dataset['property']->deal_id:null;
							  $dropdown_class = "form-control ";
							  $readonly = isset($dataset['property']->property_id) && $dataset['property']->property_id>0 ? "disabled" : "none";
                            ?>
                            {{Form::select('deal_id', $dataset['deals'], $dval, array('class' => $dropdown_class,'id'=>'deal_id', $readonly))}}
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label class="control-label">Property Type</label>
                            <?php
                              $tval = isset($dataset['property']->type_id)?$dataset['property']->type_id:null;
                            ?>
                            {{Form::select('type_id', $dataset['types'], $tval, array('class' => $dropdown_class,'id'=>'type_id', $readonly))}}
                          </div>
                        </div>
                        
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
                                  <div class="row noMargin">
                                    <div class="col-xs-12  no-margin cls_price">
                                        {{Form::text('price', $dataset["property"]->price, array('class' => 'form-control special_input', 'placeholder' => 'Enter Property Price'))}}
                                    </div>
                                    <div class="col-xs-6  no-margin cls_basis" style="display:none">
                                        
                                          <div class="arrow">
                                            <div class="btn-group mutiselectbtn">
                                              {{Form::select('basis', array('M' => 'Monthly','Q'=>'Qarterly','W'=>'Weekly'), $dataset["property"]->basis, array('class' => 'form-control special_input'))}}
                                            </div>
                                          </div>
                                      </div>                                      
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
                              <input type="text" class="form-control locationcode" id="locationcode" placeholder="+66" value="+66" readonly="readonly"/>
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
                        <div class="padding greyBg">
                        <div class="row cls_transport"></div>
                       
                        </div>
                    </div>  
                    
                    <h4> Amenity & Facility</h4>  
                    <div class="border-bottom"></div>
                    <div class="border-top"></div>
                    <div class="padding">
                      <div class="row">
                        @foreach($dataset['amenities'] as $id=>$title)
                        <div class="col-sm-3">
                          <label>
                              <input type="checkbox" name="amenities[]" <?php echo (isset($dataset['property']->amenity_ids) && in_array($id, $dataset['property']->amenity_ids)?'checked':'')?> value="{{$id}}"> {{$title}}
                          </label>
                        </div>
                        @endforeach
                      </div>
                    </div>  

                    <div id="nearby_system" style="display:none;">
                        <h4> Nearby</h4>
                        <div class="border-bottom"></div>
                        <div class="border-top"></div>
                        <div class="padding greyBg">
                          <div class="row cls_nearby"></div>
                        </div>
                    </div>  
                        
                    </div>
                    <!--/Step1 Content Basic Property Details -->
                    <!--/Step2 Content Property Feature List -->
                    <div class="propertyformsteps" id="step2" style="display:none;">
                      <h4> Property Feature List</h4>
                      <div class="div_prop_group" id="div_prop_group"></div>
                      
                      
                      
                    </div>
                    <!--/Step2 Content Property Feature List -->
                    <!--/Step3 Content Property Photos & Plan  -->
                    <div class="propertyformsteps" id="step3" style="display:none;">
                      
                      <p></p>
                        <div class="form-group">
                        	<div class="clearfix">
                        		<h4>Upload Property Photos</h4>
                            </div>
                            <div class="greyBg padding">
                            	<div class="row">
                                    <div class="col-md-12">
                                      <div class="fileHolder">
                                          <?php
                                          $image_types = array("Locality", "Building", "Floor Plan", "Bedroom 1", "Bedroom 2", "Kitchen", "Others");
                                          foreach($image_types as $image_type){
                                          ?>
                                          <div class="row noMargin" id="file_wrap" style="margin-bottom:5px !important;">
                                            <div class="col-sm-3 col-xs-6 noPadding" style="min-height:inherit !important;">
                                              <input type="text" class='form-control' name="image_titles[]" placeholder="Enter Title" value="<?php echo $image_type; ?>" readonly="readonly" style="color:#333333;"/>
                                            </div>
                                            <div class="col-sm-3 col-xs-6 noPadding" style="min-height:inherit !important;">
                                              <div class="fileBack">
                                                {{ Form::button('image_files', array('class' => 'upFile','data-target'=>$image_type)) }}
                                                
                                                <span><i class="fa fa-plus"></i> Add Image</span>
                                              </div>
                                              <textarea rows="20" name="image_raw_data[{{{$image_type}}}]" style="display:none"></textarea>
                                            </div>
                                            <div class="col-sm-6 col-xs-12 propImageProgress">
                                              <div class="progress">
                                                <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                  <span>40% Complete</span>
                                                </div>
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
                      <?php if(isset($dataset["property"]->media) && count($dataset["property"]->media)){ ?>
                      	<div class="form-group">
                            <div class="addSpImageHolder greyBg padding addImgDisplayList">
                             <?php if(isset($dataset["property"]->media) && count($dataset["property"]->media)){ ?>
                            <p class="bg-info alertImgDelete">The image will be deleted once you click update.</p>
                            <?php }?>
                                <div>
                                    <div class="clearfix">
                                
                                
                                    <?php if(isset($dataset["property"]->media)){ ?>
                                    @foreach($dataset["property"]->media as $key=>$media)
                                    @if($media->media_data!='no_image.png')
                                    <div class="portfolio-item uploadedImages">
                                        <a class="item-inner btn-block" href="javascript:void(0);"> <img alt="{{{ $media->media_title }}}" src="{{{ asset('files/properties')."/".$media->media_data }}}">
                                            <p class="upImageTitle">{{{ $media->media_title }}}</p>
                                        </a>
                                        <div class="deleteCheck"><input type="checkbox" name="image_deletes[]" value="<?php echo $media->media_id; ?>" /> Delete</div>
                                        
                                    </div> 
                                    @endif 
                                    @endforeach
                                    <?php } ?>
                                    
                                    </div>
                                    
                                	
                                </div>
                            </div>
                            
                            
                        </div>
                      <?php }?>  
                      <br />
                    
                    </div>
                    <!--/Step3 Content Property Photos & Plan  -->
                    <!--/Step4 Content Property Location Map -->
                     <div class="propertyformsteps" id="step4" style="display:none;">
                       <div id="savemessage" class="saveMessage">
                         
                       </div>
                     </div>
                    <!--/Step4 Content Property Location Map -->
                  </div>
                  <!--/Prev-next Residential -->
                  <div class="prev-next-btnwrap">
                    <!--<div class="border-bottom"></div>
                    <div class="border-top"></div>-->
                    <div class="form-group margin-top-10">
                      <div class="col-md-4 control-label"></div>
                      <div class="col-md-8">
                            <input class="btn btn-danger orange right"  type="submit" id="sbmt" @if(Route::currentRouteAction() == "PropertiesController@edit") value="Update" @else value="Submit" @endif id="sbmt" style="display:none;">
                            <!--<a href="javascript:void(0);" class="btn btn-danger orange right step_next"  id="next" onclick="property_create_validate();">Next</a> -->
                            <a href="javascript:void(0);" class="btn btn-danger orange right step_next"  id="next" >Next</a>
                            <a href="javascript:void(0);" class="btn pitch-black right prev step_prev" id="prev">Prev</a>
                            <a href="{{URL::to('/property/myproperties/')}}" class="btn btn-primary orange right" id="list" style="display:none"><i class="fa fa-list"></i> Go To List</a>
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
<div class="modal fade" id="cropperModal" tabindex="-1" role="dialog" data-backdrop="static" daya-keyboard="false" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crop Photo</h4>
      </div>
      <div class="modal-body">
        <div class="row">
  <div class="col-sm-12">
     
      <div class="thumbnail" id="dv_data">
         <div class="row" style="display: ">
            
            <div class="col-sm-12">
            <div class="row eg-main" style="margin-bottom:0">
              <div class="col-sm-12">
                <div class="eg-wrapper" style="height:auto; visibility:hidden;">                 
                  <img class="cropper" src="http://placehold.it/800x600" alt="Picture">
                </div>
              </div>
                
              </div>
              
             <div class="row eg-output" style="display:none">
                  <div class="col-md-12" >
                    <input type="hidden" id="aspectRatio" value="1.333">
                    <button class="btn btn-primary" id="getDataURL" type="button">Get Data URL</button>                    
                    <button class="btn btn-warning" id="reset" type="button">Reset</button>
                    <button class="btn btn-info" id="zoomIn" type="button">Zoom In</button>
                    <button class="btn btn-info" id="zoomOut" type="button">Zoom Out</button>
                    <button class="btn btn-info" id="rotateLeft" type="button">Rotate Left</button>
                    <button class="btn btn-info" id="rotateRight" type="button">Rotate Right</button>
                    <label class="btn btn-primary" for="inputImage" title="Upload image file">
                      <input class="hide" id="inputImage" name="file" type="file" accept="image/*">
                      Upload
                    </label>
                  </div>
                  <div class="col-md-6">
                    <textarea class="form-control" name="" id="dataURL" rows="10" style="display:"></textarea>
                  </div>
                  <div class="col-md-6">
                    <div id="showDataURL"></div>
                  </div>
                </div>
            </div>
         </div>
      </div>
  </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="cropdone" class="btn btn-success">
            <span class="glyphicon glyphicon-ok"></span> Save
        </button>
      </div>
    </div>
  </div>
</div>
<input type="hidden" id="image_create_url" value="{{URL::to('image_create_url')}}" >
<script type="text/javascript">
  $(document).ready(function(){
    $('#deal_id').change(function(){
      if($(this).val()==2){
        $('.cls_basis').show();
        $('.cls_price').removeClass('col-sm-12').addClass('col-sm-6')
      }else{
        $('.cls_basis').hide();
        $('.cls_price').removeClass('col-sm-6').addClass('col-sm-12');
      }
      
    });
    $('#deal_id,#type_id').change(function(){

      //alert('ch')
      $.post(
          '<?php echo URL::to("property/get_groups")?>',
          {
            deal_id:$('#deal_id').val(),
            type_id:$('#type_id').val(),
            property_id:'<?php echo $dataset["property"]->property_id;?>'
          },
          function(html){
            //alert(html);
            $('#div_prop_group').html(html);
          }
      )
    });

    <?php if(isset($dataset["property"]->property_id) && $dataset["property"]->property_id>0){?>
      //alert('<?php echo $dataset["property"]->property_id?>')
      $('#deal_id,#type_id').trigger('change');
    <?php }?>  

    
    var url = "<?php echo route('property.propertyimage');?>"
    /*
    $('.upFile')
      .attr({type:'file',name:'image_files'})
      .fileupload({
          url: url,
          dataType: 'json',             
          done: function (e, data) {               
            //$('#profile_image').attr('src',data.result.file_url);
            var title = $(this).closest('.row').find('[name="image_titles[]"]').val();
            var hdn = $('<input/>')
            .addClass('propimagename').
            attr({'type':'hidden','name':'image_name['+title+']'})
            .val(data.result.new_name);
            $(this).after(hdn);

            
            $(this).closest('.row').find('.propImageProgress .active').removeClass('active');
          },
          progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $(this).closest('.row').find('.propImageProgress .progress-bar').animate({'width':progress + '%'}).html('<span>'+progress+'% Complete</span>');         
            $('#sbmt').prop('disabled',true);
          },
          stop:function(){
            $('#sbmt').prop('disabled',false);
            //$('.progress').hide();
          },
          start:function(){
            $(this).closest('.row').find('.propImageProgress .progress').show();
            //$('.progress').show();
            $(this).closest('.row').find('.propImageProgress .progress-bar').css('width','0%');
          },
          add: function(e, data) {
                  var uploadErrors = [];
                  console.log(data.originalFiles[0]);
                  var acceptFileTypes = /^image\/(jpg|jpeg|png|gif)$/i;
                  if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                      uploadErrors.push('Not an accepted file type!\nPlease Select image file.\nSupported Extention:JPG,GIF,PNG');
                  }
                  if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) {
                      uploadErrors.push('Filesize is too big');
                  }
                  if(uploadErrors.length > 0) {
                      alert(uploadErrors.join("\n"));
                  } else {
                      data.submit();
                  }
          }
                
      });
      */
      $('.upFile').click(function(){
        //$('#cropperModal').modal('toggle');
        $('#inputImage').trigger('click');
        $('#cropdone').attr('data-target',$(this).data('target'));
      });
	   $('#inputImage').change(function(){
        $(".eg-wrapper").css("visibility", "hidden");
	   		$('#cropperModal').modal('show');
	   });

    
    //$('#cropperModal').modal('toggle');
    $('#cropperModal').on('shown.bs.modal', function() {
        $(window).trigger("resize");
        setTimeout('$(".eg-wrapper").css("visibility", "visible")', 500);
    });
      

      $('form').validate({
          rules:{
            type_id:{required:true,digits:true,min:1},
            deal_id:{required:true,min:1},
            title:{required:true,minlength:10},
            location:{required:true},
            price:{required:true,digits:true},
            description:{required:true,minlength:10},            
            location_sub:{required:true},
            phone:{required:true,digits:true},
            email:{required:true,email:true}
          },
          messages:{
            type_id:{required:'This field is required',digits:'Field should be integer',min:'Please Select Property Type' },
            deal_id:{required:'This field is required',min:'Please Select Transaction Type'},
            title:{required:'This field is required',minlength:'Please Enter minimum 5 character'},
            location:{required:'This field is required'},
            price:{required:'This field is required',number:'Please enter valid price',digits:'Plese enter numeric value without decimal',},
            description:{required:'This field is required',minlength:'Please Enter minimum 10 character'},            
            location_sub:{required:'This field is required'},
            phone:{required:'This field is required',digits:'Please Enter valid phone no.'},
            email:{required:'This field is required',email:'Please enter valid email'}
          },
          errorClass:'text-danger error_special',
          errorElement:'small',
          invalidHandler: function(form, validator) {
                  $('small.error_special').remove();
                  $("html, body").animate({ scrollTop: 250 }, "slow");
          },
          errorPlacement:function(error,element){
              if($(element).attr('name')=='price'){
                $(element).closest('.input-group').after(error);
              }else{
                 $(element).after(error);
              }
          },
          onkeyup: false,
          submitHandler:function(form){
            $('#sbmt').button('loading');
            $.post(
              $(form).attr('action'),
              $(form).serialize(),
              function(m){
                var o = $.parseJSON(m);
                $('#savemessage').html(o.message);
                step_counter++;
                $("html, body").animate({ scrollTop: 250 }, "slow");
                //$("#next").hide();
                //$("#sbmt").show();
                
                $(".step_3").removeClass("active").addClass("complete");
                $(".step_4").removeClass("disabled").addClass("active");
                $('#sbmt').button('reset');
                $("#step3,#sbmt,#prev").hide();
                $("#step4,#list").show();
              }
            )
          }


      });
      
      var step_counter = 1;

      $("#next").click(function(){
    if(step_counter == 1){
      var success = $('form').valid();
      
      if(success == true){
        step_counter++;
        $("html, body").animate({ scrollTop: 250 }, "slow");
        
        $("#prev").show();
        
        $(".step_1").removeClass("active").addClass("complete");
        $(".step_2").removeClass("disabled").addClass("active");
        
        $("#step1").hide();
        $("#step2").show();
      }
    }else if(step_counter == 2){
      $('[name^="attributes"]').each(function(){
        if($(this).attr('type')=='text' || $(this).attr('type')=='number'){
          $(this).rules('add',{required:true})
        }
      })
      $(".text-danger").empty();
      var success = true;
      $("#step2 input, #step1 select").not('.cls_transport_select,.cls_transport_distance').each(function() {
        if($(this).val() == ""){
          $(this).after('<small class="text-danger">This field is required. </small>');
          $(this).focus();
          success = false;
          return false;
        }
      });
      
      if(success == true){
        step_counter++;
        $("html, body").animate({ scrollTop: 250 }, "slow");
        
        $("#next").hide();
        $("#sbmt").show();
        
        $(".step_2").removeClass("active").addClass("complete");
        $(".step_3").removeClass("disabled").addClass("active");
        
        $("#step2").hide();
        $("#step3").show();
      }
    }
    
        return false;
    });

    
    
    $("#prev").click(function(){    
    if(step_counter == 2){
      step_counter--;
      $("html, body").animate({ scrollTop: 250 }, "slow");
      
      $("#prev").hide();
      
      $(".step_1").removeClass("complete").addClass("active");
      $(".step_2").removeClass("active").addClass("disbaled");
      
      $("#step1").show();
      $("#step2").hide();
    }else if(step_counter == 3){
      step_counter--;
      $("html, body").animate({ scrollTop: 250 }, "slow");
      
      $("#next").show();
      $("#sbmt").hide();
      
      $(".step_2").removeClass("complete").addClass("active");
      $(".step_3").removeClass("active").addClass("disbaled");
      
      $("#step2").show();
      $("#step3").hide();
    }
        return false;
    });

  });
</script>
@stop