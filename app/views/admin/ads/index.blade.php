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
  <h1 class="page-header"> Manage Advertisement</h1>
  
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
    {{ Form::open(array('id'=>'frm','class' => '', 'route' => array('admin.get_advertise'), 'method' => 'post')) }}      
        <div class="col-sm-3">
            <input type="search" class="form-control" data-toggle="search" data-target=".user_list tr" data-norecord=".nrf" Placeholder="Search By Text">
        </div>        
        <div  class="col-sm-9 text-right">            
            <a href="{{URL::to('admins/add_advertise/')}}"  class="btn btn-primary" >Add Advertisement</a>
        </div>
    {{ Form::close() }}  
    </div>
    <p></p>
    <div class="row">
    	<div class="col-sm-12">
            <div class="table-responsive" id="list_table">

               
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
        $('#save_ad').click(function(){
            $('#frm_add_advertise').submit();
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
            //alert((parseFloat($(this).val())/100));
            $('#discounted_price').val(v)
        });

        $('#start_date').datepicker({
        minDate: 0,
        dateFormat:'dd/mm/yy',
        onSelect: function(selected,evnt) {
            //alert(selected);
            setEnddate();
            //alert(theDate.toDateString())
        }
       }) 
		$('.cls_package_fetch').change(function(){
           	fetchPackage();
		});
		
        var fetchPackage = function(){
            $.post(
                '{{URL::to("admins/get_package_details/")}}',
                {
                    'ad_type':$('#ad_type').val(),
                    'location_id':$('#location_id').val()
                },
                function(m){
                    //alert(m);
                    var row = $.parseJSON(m);
                    $('#duration').val(row.duration);
                    $('#grace_period').val(row.grace_period);
                    $('#price,#discounted_price').val(row.price);
                    $('#ad_package_id').val(row.ad_package_id);
                    setEnddate();
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

        fetchAdvertise();
        //fetchPackage()

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

    
    $('#uploadImage').click(function(){             
            $('<input/>')
            .attr({type:'file',name:'up_file'})
            .fileupload({
                    url: '{{URL::to("admins/upload_advertise")}}',
                    dataType: 'json',
                    done: function (e, data) {                       
                        //$('#filename').val(data.result.file_path);    
                        $('#preview').attr('src',data.result.new_file_url).show();
                        $('#image_file').val(data.result.new_file_name);      
                        //$('#file_original_name').val(data.result.ori_file_name);        
                                            
                    },
                    progressall: function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $('.progress-bar').animate({'width':progress + '%'});                   
                    },
                    stop:function(){
                        $('.progress').hide();
                    },
                    start:function(){
                        $('.progress').show();
                        $('.progress-bar').css('width','0%');
                    },
                    add: function(e, data) {
                            
                            var uploadErrors = [];
                            //alert(data.originalFiles[0]['type']);
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