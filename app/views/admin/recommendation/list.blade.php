<?php if(count($dataset['list'])){ ?>
{{isset($dataset['heading'])?$dataset['heading']:''}}
<table class="responsive table table-striped table-bordered"  width="100%" cellspacing="5" cellpadding="2">
    <thead>
        <tr>
            <th width="2%">#</th>
            <th width="15%">Location</th>
            <th width="30%">Image</th>
            <th width="">Description</th>
            <th width="5%">Action</th>
        </tr>
    </thead>
    <tbody id="list" class="user_list">
        @foreach($dataset['list'] as $k=>$v)
        <tr data-state="" >
            <td>
                {{$k+1}}
            </td>
            <td>
                <?php  echo ($v->location_name?$v->location_name:'For Home Page'); ?>
            </td>
            <td>                           
               <img src="{{URL::to('/')}}/files/recommendation/{{$v->image_file}}" style="width:150px;"> 
            </td>
            <td>
                {{$v->description}}
            </td>
            <td>

                @if($v->status==1)
                    <a data-recommendation_id="{{$v->recommendation_id}}" data-toggle="modal" data-target="#dactivateConfrimationModal" class="btn btn-warning btn-xs">Deactivate</a>
                @else    
                    Inactive
                @endif    
                    
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" id="dactivateConfrimationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmation To Deactivate</h4>
      </div>
      <div class="modal-body">
      {{ Form::open(array('id'=>'frm_deactive','class' => '', 'route' => array('admin.deactivate_recommendation'), 'method' => 'post')) }} 
        <input type="hidden" name="recommendation_id" id="recommendation_id">
        <div class="row">
            <div class="col-sm-12">  
                <table class="responsive table table-striped table-bordered"  width="100%" cellspacing="5" cellpadding="2">
                    <thead>
                        <tr>
                            <th width="2%">#</th>
                            <th width="15%">Location</th>
                            <th width="30%">Image</th>
                            <th width="">Description</th>
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
<?php }else{?>
        <div class="alert alert-warning">
          <span class="glyphicon glyphicon-exclamation-sign"></span>  No records has been found
        </div>
<?php }?>
<script type="text/javascript">
    $(document).ready(function(){
         $('[data-target="#dactivateConfrimationModal"]').click(function(){
            $('.modal #recommendation_id').val($(this).data('recommendation_id'));
            //alert($(this).data('recommendation_id'));
            var c = $(this).closest('tr').clone();
            c.find('td:last').remove();
            $('#confirm_tbody').html(c);            
        });

         $('#frm_deactive').validate({
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
                        
                        $('#dactivateConfrimationModal').modal('toggle');
                        if(obj.status_code=='0'){
                            html = '<div class="alert alert-danger"><span class="fa fa-times"></span>&nbsp;'+obj.message+'</div>';
                            $('#alert_messages').html(html);
                        }else{
                            html = '<div class="alert alert-success"><span class="fa fa-tick"></span>&nbsp;'+obj.message+'</div>';
                            $('#alert_messages').html(html);

                            $('#dactivateConfrimationModal').on('hidden.bs.modal', function (e) {
                              
                              $.get(
                                    '{{URL::action("AdminsRecommendationsController@get_recommendation")}}',
                                    {
                                       'location_id':$('#location_id').val()
                                    },
                                    function(m){
                                        //alert(m);
                                        $('#list').html(m);
                                    }   
                                );
                            });
                        }
                        
                        
                    }
                )
            }
        });
    });
</script>