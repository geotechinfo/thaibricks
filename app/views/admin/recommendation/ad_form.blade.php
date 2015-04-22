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
  <h1 class="page-header"> Manage Recommendation  </h1>
  
</section>
<div class="row">
  <div class="divider"></div>
</div>

<div class="row" id="alert_messages">
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
    {{ Form::open(array('id'=>'frm_add_reco','class' => '', 'route' => array('admin.save_recommendation'), 'method' => 'post')) }} 
        <input type="hidden" name="recommendation_id" id="recommendation_id">
        
        <p></p>
        <div id="details" style="display:"> 
            <div class="row">
                <div class="col-sm-6">  
                    <label class="control-lebel">Location:</label>        
                    {{Form::select('location_id',$dataset['locations'],'',array('class'=>'form-control','id'=>'location_id'))}}
                </div>  
                <div class="col-sm-6" data-target="1" data-toggle="link_type_text">
                    <label class="control-lebel">Property Code:</label>  
                    {{Form::text('property_code','',array('class'=>'form-control','id'=>'property_code','placeholder'=>'Property Code'))}}
                </div>
            </div>
            <p></p>
            
            <div class="row">
                <div class="col-sm-6" style="position:relative">
                    <label class="control-lebel">Ad Image:</label> 
                    <input type="text" name="image_file" id="image_file" style="opacity:0;width:0px;" > 
                    <input type="file" name="up_file" id="up_file" style="display:none"> 
                    <input type="hidden"  id="image_height" value="240" > 
                    <input type="hidden"  id="image_width" value="600" > 
                    <img src="http://placehold.it/1200x480" style="display:;" id="preview" class="thumbnail">
                    <button type="button" class="btn btn-info" id="uploadImage" style="position:absolute;top:40px;left:30px;" ><span class="glyphicon glyphicon-upload"></span> Select Image</button>
                </div> 
                
                <div class="col-sm-6" data-target="2" data-toggle="link_type_text">
                    <label class="control-lebel">Description:</label>  
                    {{Form::textarea('description','',array('class'=>'form-control','id'=>'description','placeholder'=>'Description'))}}
                </div> 
                                   
            </div>
            <p></p>
            <div class="row">  
              <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-success"> Save</button>
                <button type="reset" id="reset" style="display:none"> Reset</button>
              </div>
            </div>
        </div>        
        {{ Form::close() }}  
       <p></p>
        <div class="row">
            <div class="col-sm-12" id="list">
                
            </div>
        </div>
        
        <p></p>

</section>
<script type="text/javascript">
	$(document).ready(function(){
        

        $('#location_id').change(function(){
            fetchRecomendation();
        });
        

        var fetchRecomendation = function(){
           
            $.get(
                '{{URL::action("AdminsRecommendationsController@get_recommendation")}}',
                {
                   'location_id':($('#location_id').val()==''?0:$('#location_id').val())
                },
                function(m){
                    //alert(m);
                    $('#list').html(m);
                }   
            )   
        }

        fetchRecomendation();

        $('#frm_add_reco').validate({
            rules:{
                location_id:{
                    /*required:true*/
                },
                property_code:{
                    required:true,
                    remote:{
                        url:'{{URL::to("admins/property_code_check")}}',
                        type:'POST'
                    }
                },
                description:{
                    required:true,
                    maxlength:200
                },
                image_file:{
                    required:true
                }

            },
            messages:{
                property_code:{
                    remote:'Please Enter Valid Property Code'
                }
            },
            errorElement:'small',
            errorClass:'text-danger'
        });
var _URL = window.URL || window.webkitURL;
    $('#up_file')
    .fileupload({
        url: '{{URL::to("admins/upload_recommendation")}}',
        dataType: 'json',
        done: function (e, data) {                       
            $('#preview').attr('src',data.result.new_file_url).show();
            $('#image_file').val(data.result.new_file_name);      
            $('#uploadImage').html('<span class="glyphicon glyphicon-upload"></span> Select Image').attr('disabled',false);
            $('#save_ad').attr('disabled',false);                              
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('.progress-bar').animate({'width':progress + '%'});                   
        },
        stop:function(){
            $('.progress').hide();
        },
        start:function(){
            $('#uploadImage').text('Uploading...').attr('disabled',true);
            $('#save_ad').attr('disabled',true);
            $('.progress').show();
            $('.progress-bar').css('width','0%');
            $('#preview').parent().find('small').remove();
        },
        add: function(e, data) {
                var uploadErrors = [];
                 var image, file;

                var acceptFileTypes = /^image\/(jpg|jpeg|png|gif)$/i;
                if(data.originalFiles[0]['type'].length && !acceptFileTypes.test(data.originalFiles[0]['type'])) {
                    $('#preview').parent().find('small').remove();
                    $('#preview').before($('<small/>').addClass('text-danger').text('Please Select image file.'));
                }else if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) {
                    $('#preview').parent().find('small').remove();
                    $('#preview').before($('<small/>').addClass('text-danger').text('Filesize is too big'));
                }else if(file = data.originalFiles[0]) {       
                    image = new Image();        
                    image.onload = function() {         
                        if(this.width!=$('#image_width').val() || this.height!=$('#image_height').val()){
                            $('#preview').parent().find('small').remove();
                            $('#preview').before($('<small/>').addClass('text-danger').text('Image Size should be '+$('#image_width').val()+'X'+$('#image_height').val()+". But Your current image size is"+this.width+'X'+this.height));
                        }else{
                            data.submit();                             
                        }                      
                    };    
                    image.src = _URL.createObjectURL(file);
                }else{
                    data.submit();                             
                }
                
        }                        
    });

    $('#uploadImage').click(function(){
        $('#up_file').trigger('click');  
    });

});
</script>
@stop