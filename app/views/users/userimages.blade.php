@extends('layouts.dashboard')
@section('content')
{{ HTML::script('libraries/cropper-master/src/cropper.js') }}
{{ HTML::script('libraries/cropper-master/demos/js/userimageCropper.js') }}
{{ HTML::style('libraries/cropper-master/src/cropper.css') }}
{{ HTML::style('libraries/cropper-master/demos/css/docs.css') }}


<!--/profileimage-->
<section class="">
  
  <div class="col-sm-12 propertylistwrap">
  

    <div class="propertylist">
    
      <!-- Tabs -->
        <div role="tabpanel">
          @if(Session::get('success'))
            <div class="margin-top-10 message">
            <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{Session::get('success')}}</p>
            </div>
          @endif
          @if(Session::get('error'))
            <div class="margin-top-10 message">
            <p class="btn-danger  padding-5"><span class="fa fa-cross"></span>{{Session::get('error')}}</p>
            </div>
          @endif
         
          
          <!-- Tab panes -->
          <div class="tab-content propertyformsteps profile ">
            <div role="tabpanel" class="tab-pane active" id="acDetails">
              <h4>Change Profile Image</h4>
              <div class="padding greyBg">

                <div class="accountInfoGroup">
                        <div class="row">

                          <div class="col-sm-3">
                              <?php
                              $file ="files/profiles/".Auth::user()->profile_image;
                              if(Auth::user()->profile_image==''){
                                $file = "http://placehold.it/100x100";
                              }
                              ?>
                              {{ HTML::image($file, '', array('class' => 'img-responsive','id'=>'profileImage')) }}
                          </div>
                          <div class="col-sm-9">
                            <input type="button" id="" value="Select File" class="btn orange profile_image" />
                            <p></p>
                            <div class="progress" style="display:none">
                              <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span>40% Complete</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <p></p>
                </div>
                <div class="text-right row">
                    <div class="col-sm-3">
                              
                    </div>
                    
                </div>
              </div>
            </div>
          
            
          </div>
        
          <div class="tab-content propertyformsteps banner">
            <div role="tabpanel" class="tab-pane active" id="acDetails">
              <h4>Change Banner Image</h4>
              <div class="padding greyBg">

                <div class="accountInfoGroup">
                        <div class="row">

                          <div class="col-sm-3">
                              <?php
                              $file ="files/banners/".Auth::user()->banner_image;
                              if(Auth::user()->profile_image==''){
                                $file = "http://placehold.it/930x185";
                              }
                              ?>
                              {{ HTML::image($file, '', array('class' => 'img-responsive','id'=>'bannerImage')) }}
                          </div>
                          <div class="col-sm-9">
                            <input type="button" id="" value="Select File"  class="btn orange banner_image" />
                            <p></p>
                            <div class="progress" style="display:none">
                              <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span>40% Complete</span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <p></p>
                </div>
                <div class="text-right row">
                    <div class="col-sm-3">
                              
                    </div>
                    
                </div>
              </div>
            </div>
          
            
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
        <h4 class="modal-title" id="myModalLabel">Image Cropper</h4>
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
                          <img class="cropper" src="http://placehold.it/800x600" alt="Picture" style="max-width:200px;">
                        </div>
                      </div>
                        
                    </div>
                    
                    <div class="row eg-output" style="display:none">
                      <div class="col-md-12" >
                        <input type="hidden" id="aspectRatio" value="1">
                        <input type="hidden" id="userimagecreateURL" value="{{URL::action('UsersController@userimagecreate')}}">
                        <button class="btn btn-primary" id="getDataURL" type="button">Get Data URL</button>                    
                        <button class="btn btn-warning" id="reset" type="button">Reset</button>
                        <button class="btn btn-info" id="zoomIn" type="button">Zoom In</button>
                        <button class="btn btn-info" id="zoomOut" type="button">Zoom Out</button>
                        <button class="btn btn-info" id="rotateLeft" type="button">Rotate Left</button>
                        <button class="btn btn-info" id="rotateRight" type="button">Rotate Right</button>
                        <button class="btn btn-info" id="setAspectRatio" type="button">Set Aspect Ratio</button>
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



<script type="text/javascript">
  $(document).ready(function(){

    $('.profile_image').click(function(){
      var url = '<?php echo route('profile.changeprofileimage');?>'      
      $('#cropdone').attr('data-target','profileImage')
      //$('#cropperModal').modal('toggle');
      $('#aspectRatio').val('1');
      $("#reset").trigger('click');
      $("#setAspectRatio").trigger('click');
      $('#inputImage').trigger('click');

     /* 
     $('<input/>')
        .attr({type:'file',name:'image_files'})
        .fileupload({
            url: url,
            dataType: 'json',             
            done: function (e, data) {               
              $('#profile_image').attr('src',data.result.file_url);
              $('.profile .progress .active').removeClass('active');
            },
            progressall: function (e, data) {
              var progress = parseInt(data.loaded / data.total * 100, 10);
              $('.profile .progress-bar').animate({'width':progress + '%'}).html('<span>'+progress+'%</span>');         
            },
            stop:function(){
              //$('.progress').hide();
            },
            start:function(){
              $('.profile .progress').show();
              $('.profile .progress-bar').css('width','0%');
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
                  
        })
        .trigger('click');  
     */
    });

   $('.banner_image').click(function(){
      var url = '<?php echo route('profile.changebannerimage');?>'
      $('#cropdone').attr('data-target','bannerImage')
      //$('#cropperModal').modal('toggle');
      $('#inputImage').trigger('click');
      $('#aspectRatio').val(5.02);
      $('#setAspectRatio').trigger('click')
      /*
      $('<input/>')
        .attr({type:'file',name:'image_files'})
        .fileupload({
            url: url,
            dataType: 'json',             
            done: function (e, data) {               
              $('#banner_image').attr('src',data.result.file_url);
              $('.banner .progress .active').removeClass('active');
            },
            progressall: function (e, data) {
              var progress = parseInt(data.loaded / data.total * 100, 10);
              $('.banner .progress-bar').animate({'width':progress + '%'}).html('<span>'+progress+'%</span>');   
            },
            stop:function(){
              //$('.progress').hide();
            },
            start:function(){
              $('.banner .progress').show();
              $('.banner .progress-bar').css('width','0%');
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
                  
        })
        .trigger('click');  
      */
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

  });
</script>



@stop