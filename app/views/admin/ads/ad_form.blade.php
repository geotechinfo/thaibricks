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
  <h1 class="page-header"> Manage Advertisement  </h1>
  
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
    {{ Form::open(array('id'=>'frm_add_advertise','class' => '', 'route' => array('admin.save_advertise'), 'method' => 'post')) }} 
        <input type="hidden" name="advertisement_id" id="advertisement_id">
        <div class="row">          
          <div class="col-sm-6">  
            <label class="control-lebel">Ad Type:</label>        
            {{Form::select('ad_type',$dataset['ad_type'],'',array('class'=>'form-control cls_package_fetch','id'=>'ad_type'))}}
          </div>
          <div class="col-sm-6">  
            <label class="control-lebel">Location:</label>        
            {{Form::select('location_id',$dataset['locations'],'',array('class'=>'form-control cls_package_fetch','id'=>'location_id'))}}
          </div>
        </div>
        <p></p>
        <div class="row">
            <div class="col-sm-12" id="package_list">
                
            </div>
        </div>
        <p></p>
        <div id="details" style="display:none"> 
            <div class="row">
                <div class="col-sm-3">
                    <label class="control-lebel">Duration:</label>  
                    {{Form::number('duration','',array('class'=>'form-control','id'=>'duration','placeholder'=>'Package Duration(in days)','min'=>'0','readonly'=>'readonly'))}}
                </div>
                <div class="col-sm-3">
                    <label class="control-lebel">Grace Period:</label>  
                    {{Form::number('grace_period','',array('class'=>'form-control','id'=>'grace_period','placeholder'=>'Grass Period(in days)','min'=>'0','readonly'=>'readonly'))}}
                </div>          
            
                <div class="col-sm-3">
                    <label class="control-lebel">Start Date:</label>  
                    {{Form::text('start_date','',array('class'=>'form-control','id'=>'start_date','placeholder'=>'Start Date','readonly'=>'readonly','style'=>'cursor:pointer;background:#fff'))}}
                </div>
                <div class="col-sm-3">
                    <label class="control-lebel">End Date:</label>  
                    {{Form::text('end_date','',array('class'=>'form-control','id'=>'end_date','placeholder'=>'End Date','readonly'=>'readonly'))}}
                </div>          
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-3">
                    <label class="control-lebel">Price(&#xe3f;):</label>  
                    {{Form::number('price','',array('class'=>'form-control','id'=>'price','placeholder'=>'Package Price','readonly'=>'readonly'))}}
                </div>
                <div class="col-sm-3">
                    <label class="control-lebel">Discount:</label>  
                    {{Form::text('discount','',array('class'=>'form-control','id'=>'discount','placeholder'=>'Discount Percentage'))}}
                </div> 
                <div class="col-sm-3">
                    <label class="control-lebel">Discounted Price(&#xe3f;):</label>  
                    {{Form::text('discounted_price','',array('class'=>'form-control','id'=>'discounted_price','placeholder'=>'Discount Price','readonly'=>'readonly'))}}
                </div> 
                <div class="col-sm-3">
                    <label class="control-lebel">Link Type:</label>  
                    {{Form::select('type',$dataset['type'],'',array('class'=>'form-control','id'=>'type','data-toggle'=>'link_lype'))}}
                </div>        
            </div>
            <p></p>
            <div class="row">
                <div class="col-sm-6" style="position:relative">
                    <label class="control-lebel">Ad Image:</label> 
                    <input type="text" name="image_file" id="image_file" style="opacity:0;width:0px;" > 
                    <input type="file" name="up_file" id="up_file" style="display:none"> 
                    <input type="hidden"  id="image_height" > 
                    <input type="hidden"  id="image_width" > 
                    <img src="http://placehold.it/300x200" style="display:;" id="preview" class="thumbnail">
                    <button type="button" class="btn btn-info" id="uploadImage" style="position:absolute;top:40px;left:30px;" ><span class="glyphicon glyphicon-upload"></span> Select Image</button>
                </div> 
                <div class="col-sm-6" data-target="1" data-toggle="link_type_text">
                    <label class="control-lebel">Property Code:</label>  
                    {{Form::text('property_code','',array('class'=>'form-control','id'=>'property_code','placeholder'=>'Property Code'))}}
                    {{Form::hidden('property_id','',array('id'=>'property_id'))}}
                </div>
                <div class="col-sm-6" data-target="2" data-toggle="link_type_text" style="display:none">
                    <label class="control-lebel">External Url:</label>  
                    {{Form::text('external_link','',array('class'=>'form-control','id'=>'external_link','placeholder'=>'External Links'))}}
                </div> 
                <div class="col-sm-6" data-target="3" data-toggle="link_type_text" style="display:none">
                    <label class="control-lebel">Google Ads:</label>  
                    {{Form::textarea('google_ads','',array('class'=>'form-control','id'=>'google_ads','placeholder'=>'Google Ads Code','rows'=>3))}}
                </div>
                <div class="col-sm-6 cls_desc"  style="display:">
                    <div>
                    <label class="control-lebel">Caption:</label>  
                    {{Form::text('description[caption]','',array('class'=>'form-control','id'=>'caption','placeholder'=>'Enter Caption','maxlength'=>'50'))}}
                    </div>
                    <div>
                    <label class="control-lebel">Description:</label>  
                    {{Form::text('description[info_line]','',array('class'=>'form-control','id'=>'info_line','placeholder'=>'Enter Description','maxlength'=>'110'))}}
                    </div>
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
        
        
        <p></p>

</section>
<script type="text/javascript">
	$(document).ready(function(){
        $(document).on('click','[name="ad_package_id"]',function(){
            $('#duration').val($(this).data('duration'));
            $('#grace_period').val($(this).data('grace_period'));
            $('#price,#discounted_price').val($(this).data('price'));
            $('#image_height').val($(this).data('image_height'));
            $('#image_width').val($(this).data('image_width'));
            $('#preview').attr('src','http://placehold.it/'+$(this).data('image_width')+'X'+$(this).data('image_height'));
            $('#details').show();
        });

        
        $('[data-toggle="link_lype"]').change(function(){
           $('[data-toggle="link_type_text"]').hide();
           $('[data-toggle="link_type_text"][data-target="'+$(this).val()+'"]').show();
        });

        $('#discount').bind('change keyup',function(){
            if($(this).val()==''){
                $('#discounted_price').val($('#price').val());
                return false;
            }
            var v = parseFloat($('#price').val()*1)-(parseFloat($('#price').val()*1)*(parseFloat($(this).val())/100))
            $('#discounted_price').val(v)
        });

        $('#start_date').datepicker({
            minDate: new Date(<?php echo date("Y,m,d")?>),
            dateFormat:'dd/mm/yy',
            onSelect: function(selected,evnt) {
                setEnddate();
            }
        });

        $('#type').find('option[value="3"]').hide();
        $('#ad_type').change(function(){
            if($(this).val()==1){
                $('#type').find('option[value="3"]').hide();
                $('.cls_desc').show();
            }else{
                $('#type').find('option[value="3"]').show();
                $('.cls_desc').hide();
            }
        });

		$('.cls_package_fetch').change(function(){
            $('#details').hide();
           	fetchPackage();
		});
		
        var fetchPackage = function(){
           resetForm();
            $.post(
                '{{URL::to("admins/get_package_details/")}}',
                {
                    'ad_type':$('#ad_type').val(),
                    'location_id':$('#location_id').val()
                },
                function(m){

                    $('#package_list').html(m);
                }   
            )   
        }

        var fetchAdvertise = function(){
            $('#list_table').load('{{URL::to("admins/get_advertise/")}}')   
        }

        var setEnddate = function(){
            if($('#start_date').val()==''){
                return false;
            }
            var exploded=$('#start_date').val().split("/");
            var d = new Date(exploded[2],exploded[1],exploded[0]);
            var target_date = d.getTime()+($('#duration').val()*24*3600*1000);

            var theDate = new Date(target_date);
            dateString = theDate.getDate()+"/"+theDate.getMonth()+"/"+theDate.getFullYear();
            $('#end_date').val(dateString)
        }

        var resetForm  = function(){
            $('#duration,#grace_period,#start_date,#end_date,#price,#discount,#discounted_price,#property_code,#property_id,#external_link,#google_ads,#caption,#info_line').val('')
        }

        fetchAdvertise();
        fetchPackage()

        $('.search_text').keyup(function(){
            var ths = $(this);
            var v = ths.val();
            if(v.length==0){
               $('#tbluserlist tr').show()
            }else{              
                $('#tbluserlist tr').each(function(){                
                    if($(this).text().search(new RegExp(v, "i")) > 0){    
                        $(this).show();
                    }else{
                        $(this).hide();
                    }
                });
                
            }
        })

        $(document).on('change','.cls_type',function(){
            $('.cls_link').hide()
            $('[data-target="links'+$(this).val()+'"]').show();
        });

        $('#frm_add_advertise').validate({
            rules:{
                ad_type:{
                    required:true
                },
                location_id:{
                    /*required:true*/
                },
                duration:{
                    required:true,
                    digits:true
                },
                grace_period:{
                    required:true,
                    digits:true
                },
                start_date:{
                     required:true,
                 },
                end_date:{
                     required:true,
                },
                price:{
                    required:true,
                    number:true
                },
                discount:{
                    number:true
                },
                discounted_price:{
                    number:true
                },
                type:{
                     required:true,
                },
               
                property_code:{
                    required: {
                            depends: function(element) {
                                if($('#type').val()==1){
                                    return true
                                }else{
                                    return false;
                                }
                            }
                    },
                    remote:{
                        url:'{{URL::to("admins/property_code_check")}}',
                        type:'POST'
                    }
                },
                external_link:{
                    required: {
                            depends: function(element) {
                                if($('#type').val()==2){
                                    return true
                                }else{
                                    return false;
                                }
                            }
                    },
                    url:true
                },
                google_ads:{
                    required: {
                            depends: function(element) {
                                if($('#type').val()==3){
                                    return true
                                }else{
                                    return false;
                                }
                            }
                    }
                },
                'description[caption]':{
                    required:true,
                    maxlength:50
                },
                'description[info_line]':{
                    required:true,
                    maxlength:110
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
        url: '{{URL::to("admins/upload_advertise")}}',
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