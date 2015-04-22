<?php if(count($dataset['list'])){ ?>
{{isset($dataset['heading'])?$dataset['heading']:''}}
<table class="responsive table table-striped table-bordered"  width="100%" cellspacing="5" cellpadding="2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ad Type</th>
                        <th>Location</th>
                        <th>Image</th>
                        <th>Duration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="list" class="user_list">
                    @foreach($dataset['list'] as $k=>$v)
                    <tr data-state="" class="<?php echo ($v->ad_status==0?'disabled':''); ?>">
                        <td>
                            {{$k+1}}
                        </td>
                        <td>
                            <?php echo $dataset['ad_type_n'][$v->ad_type];?>                            
                        </td>
                        <td>
                            <?php  echo ($v->location_name?$v->location_name:'For Home Page'); ?>
                        </td>
                        <td>                           
                           <img src="{{URL::to('/')}}/files/advertise/{{$v->image_file}}" style="width:150px;"> 
                        </td>
                        <td>
                            <?php echo ((strtotime($v->end_date)-strtotime($v->start_date))/(3600*24))+1 ?>Days
                            ({{date('d-M Y',strtotime($v->start_date))}} to {{date('d-M Y',strtotime($v->end_date))}})

                        </td>
                        <td>
                            @if($v->ad_status==1)
                                <a data-advertisement_id="{{$v->advertisement_id}}" data-ad_package_id="{{$v->ad_package_id}}" data-toggle="modal" data-target="#adDactivateConfrimationModal" class="btn btn-danger">Deactivate</a>
                            @else    
                                Disabled
                            @endif    
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
   <div class="modal fade" id="adDactivateConfrimationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Advertise Deactivate Confirmation</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'frm_deactive_advertise','class' => '', 'route' => array('admin.deactivate_advertise'), 'method' => 'post')) }} 
        <input type="hidden" name="advertisement_id" id="de_advertise_id">
        <input type="hidden" name="ad_package_id" id="de_package_id">
        <div class="row">
            <div class="col-sm-12">  
                <table class="responsive table table-striped table-bordered"  width="100%" cellspacing="5" cellpadding="2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ad Type</th>
                            <th>Location</th>
                            <th>Image</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody id="confirm_tbody">
                        
                    </tbody>
                </table>
            </div>          
            <div class="col-sm-8">     
                <input type="password" name="password" placeholder="Type Your Password" id="password" class="form-control">
            </div>  
            <div class="col-sm-4 text-right">  
                <button type="submit" id="save_location" class="btn btn-success">Deactivate</button>
            </div> 
            <div class="col-sm-12 text-danger">
               <small> <span class="glyphicon glyphicon-exclamation-sign"></span> If you really want to deactivate this ad, please confirm your password and click on "Deactivate" button</small>
            </div>
                     
        </div>        
       
      {{ Form::close() }}  
        
      </div>
    </div>  
  </div>
</div> 
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-target="#adDactivateConfrimationModal"]').click(function(){
            $('#de_advertise_id').val($(this).data('advertisement_id'));
            $('#de_package_id').val($(this).data('ad_package_id'));
            //alert($(this).data('advertisement_id'))
            //alert($(this).data('ad_package_id'))
            var c = $(this).closest('tr').clone();
            c.find('td:last').remove();
            $('#confirm_tbody').html(c);

            
        });

        $('#frm_deactive_advertise').validate({
            rules:{
                'password':{
                    required:true,
                    remote:{
                        url:'{{URL::action("AdminsAdsController@password_check")}}',
                        type:'POST'
                    }
                }
            },
            messages:{
                'password':{remote:'Please enter correct password'}
            },
            errorClass:'text-danger',
            errorElement:'span',
            submitHandler:function(form){
                $.post(
                    $(form).attr('action'),
                    $(form).serialize(),
                    function(m){
                        //alert(m);
                        var obj = $.parseJSON(m);
                        
                        $('#adDactivateConfrimationModal').modal('toggle');
                        if(obj.status_code=='0'){
                            html = '<div class="alert alert-danger"><span class="fa fa-times"></span>&nbsp;'+obj.message+'</div>';
                            $('#alert_messages').html(html);
                        }else{
                            html = '<div class="alert alert-success"><span class="fa fa-tick"></span>&nbsp;'+obj.message+'</div>';
                            $('#alert_messages').html(html);

                            $('#adDactivateConfrimationModal').on('hidden.bs.modal', function (e) {
                               if($('.cls_package_fetch').length>0){
                                    $('.cls_package_fetch').trigger('change');
                               }else{
                                 //$('#list_table').load('{{URL::to("admins/get_advertise/")}}') ;
                                 $.get('{{URL::to("admins/get_advertise/")}}',function(m){$('#list_table').html(m)});
                               }     
                               
                            });
                        }
                        
                        
                    }
                )
            }
        });
    });
</script>         
<?php }else{?>
        <div class="alert alert-warning">
          <span class="glyphicon glyphicon-exclamation-sign"></span>  No records found
        </div>
<?php }?>