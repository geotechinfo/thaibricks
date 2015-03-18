@extends('layouts.dashboard')
@section('content')


<!--/profileimage-->
<section class="">
  
  <div class="col-sm-12 propertylistwrap">
  

    <div class="propertylist">
    
      <!-- Tabs -->
        <div role="tabpanel">
          @if(Session::get('success'))
            <div class="margin-top-10 message">
            <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{Session::get('success')}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
            </div>
          @endif
          @if(Session::get('error'))
            <div class="margin-top-10 message">
            <p class="btn-danger  padding-5"><span class="fa fa-cross"></span>{{Session::get('error')}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
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
                              {{ HTML::image('files/profiles/'.Auth::user()->profile_image, '', array('class' => 'img-responsive','id'=>'profile_image')) }}
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
                              {{ HTML::image('files/banners/'.Auth::user()->banner_image, '', array('class' => 'img-responsive','id'=>'banner_image')) }}
                          </div>
                          <div class="col-sm-9">
                            <input type="button" id="" value="Select File" class="btn orange banner_image" />
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
<script type="text/javascript">
  $(document).ready(function(){
    $('.profile_image').click(function(){
     
    var url = '<?php echo route('profile.changeprofileimage');?>'
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
  });

   $('.banner_image').click(function(){
    var url = '<?php echo route('profile.changebannerimage');?>'
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
  });
  });
</script>



@stop