@extends('layouts.dashboard')

@section('content')
{{ HTML::script('libraries/validator/validation.js') }}
<section class="" id="propertylist">
  
  <div class="col-sm-12 propertylistwrap">
    <div class="clearfix">
        <h3 class="pull-left noMargin"><span class="fa fa-building-o noMargin"></span> Tenancy Details</h3>
        <a href="{{URL::to('/tenancy/create')}}" class="btn orange pull-right  pull-right">Add New Tenancy</a>
    </div>
    
    @if(Session::get('success'))
    <div class="margin-top-10 message">
    <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{{ Session::get('success') }}}</p>
    </div>
    @endif
    
    @if(Session::get('info') == true)
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}</p>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="input-group innerSearchBox">
                        <span class="input-group-addon" id="basic-addon1"><i class="fa fa-search noMargin"></i></span>
                    <input type="search" data-toggle="search" data-target=".tenancy_row" data-norecord=".nrf" class="form-control search_text" placeholder = "Search by text">
            </div>
            
        </div>
    </div>
    
    @if(count($dataset["tenancies"])>0)
    <div class="propertylist clearfix new cls_table" style="padding:0 0 10px;">    	
        
        <div class="tenantDetailHead" style="padding:10px;">
          <div class="row bold">
            <div class="col-sm-3">Property Name</div>
            <div class="col-sm-2">Tenant Name</div>
            <div class="col-sm-2">Tenant Email</div>
            <div class="col-sm-2">Tenant Phone</div>
            <div class="col-sm-3 text-center">View Details</div>
          </div>
        </div>

        
        <div class="tenantListHolder">
			@foreach ($dataset["tenancies"] as $tenancy)
            <div class="tenantRow tenancy_row">
                  <div class="row fontBold">
                    <div class="col-sm-3">{{{ substr($tenancy->title, 0, 25) }}}...</div>
                    <div class="col-sm-2">{{{ substr($tenancy->tenant_fname." ".$tenancy->tenant_lname, 0, 12) }}}...</div>
                    <div class="col-sm-2">{{{ substr($tenancy->tenant_email, 0, 15) }}}...</div>
                    <div class="col-sm-2">{{{ $tenancy->tenant_phone }}}</div>
                    <div class="col-sm-3 text-center">
                      <a href="javascript:;" data-id="{{ $tenancy->tenancy_id }}"  data-toggle="modal" data-target="#upload" class="btn btn-default viewAddDocumentForm" style="padding:0px 6px;"><span class="fa fa-upload noMargin" data-toggle="tooltip" title="Upload Others Document" data-placement="bottom"></span></a>
                    	<a href="{{URL::to('/tenancy/transaction')}}/{{{ $tenancy->tenancy_id }}}" class="btn btn-default" style="padding:0px 6px;"><span class="fa fa-btc noMargin" data-toggle="tooltip" title="Add Transaction" data-placement="bottom"></span></a>
                      <a href="{{URL::to('/tenancy/edit')}}/{{{ $tenancy->tenancy_id }}}" class="btn btn-default" style="padding:0px 6px;"><span class="fa fa-edit noMargin" data-toggle="tooltip" title="Edit Tenancy" data-placement="bottom"></span></a>
                    	<a href="javascript:;" class="btn btn-block orange viewTenantbtn" style="width:60px; display:inline-block;">View</a>
                    </div>
                  </div>

                  <div class="tenDetails">
                        <div class="tenInfo">
                          <p class="bold">Agreement from: <span class="regular">{{{ CommonHelper::dateToUx($tenancy->start_date) }}}</span></p>
                          <p class="bold">Agreement to: <span class="regular">{{{ CommonHelper::dateToUx($tenancy->end_date) }}}</span></p>
                          <p class="bold">Tenant Address: <span class="regular">{{{ $tenancy->tenant_address }}}</span></p>
                        </div>
                        
                        @if($tenancy->agreement_file || count($tenancy->documents)>0)
                        <h3>Documents</h3>
                        @endif
                        @if($tenancy->agreement_file)
                        <div class="doc">
                          <div class="row">
                            <div class="col-sm-10">
                                <p class="bold">Agreement Document <span>(<span class="bold">Valid From</span> {{{ CommonHelper::dateToUx($tenancy->start_date) }}} <span class="bold">To</span> {{{ CommonHelper::dateToUx($tenancy->end_date) }}})</span></p>
                            </div>
                            <div class="col-sm-2"><a href="{{{ URL::to('download').'/agreements/'.$tenancy->agreement_file }}}" class="btn btn-default btn-block btn-xs" target="_blank">Download</a></div>
                          </div>
                        </div>
                        @endif

                        @if(count($tenancy->documents)>0)
                        @foreach($tenancy->documents as $k=>$v)
                        <div class="doc">
                          <div class="row">
                            <div class="col-sm-10">
                                <p class="bold">{{$v->document_title}} <span><span class="bold">Valid From</span> {{{ CommonHelper::dateToUx($v->documentation_date) }}} 
                                @if(CommonHelper::dateToUx($v->expiry_date)!='')
                                <span class="bold">To</span> {{{ CommonHelper::dateToUx($v->expiry_date) }}}</span>
                                @endif
                                </p>
                            </div>
                            <div class="col-sm-2"><a href="{{{URL::to('download').'/documents/'.$v->document_file }}}" class="btn btn-default btn-block btn-xs" target="_blank">Download</a></div>
                          </div>
                        </div>
                        @endforeach
                        @endif
                       
                        
                        @if(count($tenancy->transactions)>0)
                        <h3>Transactions</h3>
                        <div class="vendorTrans">
                          <div class="vTranHeader bold">
                                    <div class="row">
                                      <div class="col-sm-2">
                                        Type
                                      </div>
                                      <div class="col-sm-3">
                                        Title
                                      </div>
                                      <div class="col-sm-3">
                                        Vendor Involved
                                      </div>
                                      <div class="col-sm-2">
                                        Date
                                      </div>
                                      <div class="col-sm-2">
                                        Amount
                                      </div>
                                    </div>
                          </div>
                         @foreach($tenancy->transactions as $k=>$v)
                          <div class="vTransRow">
                                <div class="row">
                                    <div class="col-sm-2">
                                      {{$v->transaction_type}}
                                    </div>
                                    <div class="col-sm-3">
                                      {{$v->transaction_title}}
                                    </div>
                                    <div class="col-sm-3">
                                      <?php echo ($v->vendor_name != "") ? $v->vendor_name : "N/A"; ?>
                                    </div>
                                    <div class="col-sm-2">
                                      {{{ CommonHelper::dateToUx($v->transaction_date) }}}
                                    </div>
                                    <div class="col-sm-2">
                                      {{$v->amount}}
                                    </div>
                                </div>
                          </div>
                          @endforeach
                          
                        </div>
                        @endif
                  </div>
            </div>
			@endforeach
            
      <div class="nrf" style="display:none">
          <div class="alert alert-warning">
             <i class="fa fa-exclamation-triangle"></i> No Record Found
          </div>
      </div>  

        </div>

    </div>
    @else
    <div class="alert alert-warning">
       <i class="fa fa-exclamation-triangle"></i> No Record Found
    </div>
    @endif
    
  </div>
</section>
<!--prefooter-->
<div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      {{ Form::open(array('id'=>'frm_doc','class' => '', 'route' => array('tenancy.adddocument'), 'files' => true, 'method' => 'post')) }} 
        
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Select Or Upload Additional Document</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" value="0" name="tenancy_id">
        <input type="hidden" value="0" name="document_id" value="0">
          <div class="row">
            <div class="col-sm-6">
              <label class="control-lebel"><b>Select Document</b></label>
              <div class="row" id="doc_list" style="max-height:236px;overflow:auto;cursor:pointer">
                @foreach($dataset['documents'] as $k=>$v)
                    <div class="col-sm-12 cls_selectable" data-id="{{ $v->document_id }}" data-tid="{{ $v->tenancy_id }}">
                      <div class="alert alert-info" style="padding:2px 5px;margin-bottom:10px;border-radius:2px;">
                        <div class="bold clearfix">
                          <label class="pull-left">{{$v->document_title}}</label>
                          <a href="javascript:;" class="pull-right btn btn-default btn-xs cls_check" data-toggle="tooltip" title="This File Already Added" style="display:none">
                            <span class="fa fa-check"></span>
                          </a>
                          <!--<a href="{{{ URL::to('download').'/documents/'.$v->document_file }}}" class="pull-right btn btn-default btn-xs" data-toggle="tooltip" title="Download This File">
                            <span class="fa fa-download"></span> Download
                          </a>-->
                        </div>
                        <span class="small">Valid From : {{{ CommonHelper::dateToUx($v->documentation_date) }}} </span>
                        @if(CommonHelper::dateToUx($v->expiry_date)!='')
                        <span class="small">to {{{ CommonHelper::dateToUx($v->expiry_date) }}}</span>
                        @endif
                      </div>
                    </div>                
                @endforeach
              </div>
            </div>
    
            <div class="col-sm-6">
            <label class="control-lebel"><b>Upload Document</b></label>
              <div class="form-group">
                <div class="row" id="doc_form_fields">
                  
                  <div class="col-sm-12">
                    <label>Select Document Head</label>
                    {{Form::select('document_head_id', $dataset['document_head'], '', array('class' => 'form-control', 'id'=>"location"))}}        
                  </div>
                  <div class="col-sm-12">
                    <label>Select File</label>
                    <div class="fileHolder">
                      <div class="row noMargin">
                        <div class="col-sm-12 noPadding">
                          <div class="fileBack">
                            {{ Form::file('upfile', array('class' => 'upFile')) }}
                            <span><i class="fa fa-upload"></i> Upload Document</span>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="col-sm-12">
                    <label>Documentation Date</label>
                    <div class="input-group date datetimepicker1">
                      {{ Form::text('documentation_date','',array('class'=>'form-control','autocomplete'=>'off'))}}
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>

                  </div>
                  <div class="col-sm-12">
                    <label>Expiry Date</label>
                    <div class="input-group date datetimepicker1">
                      {{ Form::text('expiry_date','',array('class'=>'form-control','autocomplete'=>'off'))}}
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                  </div>
                </div>
                
               
              </div>
            </div>
          </div>
        
      </div>
      <div class="modal-footer">
        <span class="pull-left text-warning">
          <i class="fa fa-warning"></i> Either you can select an existing document or upload new one.
        </span>
        <button type="submit" class="btn btn-primary orange modalBtn">Save changes</button>
      </div>
      {{ Form::close() }} 
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('.viewAddDocumentForm').click(function(){
      $('input[name="tenancy_id"]').val($(this).data('id'));
      $('.cls_check').hide();
      $('.cls_selectable[data-tid="'+$(this).data('id')+'"]').find('.cls_check').show();
    });

    $('.cls_selectable').click(function(){
      $('.cls_selectable .alert-success').removeClass('alert-success').addClass('alert-info');
      $(this).find('.alert').removeClass('alert-info').addClass('alert-success');
      $('[name="document_head_id"],[name="upfile"],[name="documentation_date"],[name="expiry_date"]').prop('disabled',true);
      $('[name="document_id"]').val($(this).data('id'));

    })
    $('#doc_form_fields').click(function(){
      $('.cls_selectable .alert-success').removeClass('alert-success').addClass('alert-info');
     // $(this).find('.alert').removeClass('alert-info').addClass('alert-success');
      $('[name="document_head_id"],[name="upfile"],[name="documentation_date"],[name="expiry_date"]').prop('disabled',false);
    });

    $('#frm_doc').validate({
      rules:{
        document_head_id:{
          required:true,
        },
        upFile:{
           required:true,
        },
        documentation_date:{
          required:true,
        },
        expiry_date:{
          required:true,
        }
      },
     errorClass:'text-danger',
     errorElement:'small',
     errorPlacement:function(error,element){
      if($(element).attr('name')=='documentation_date'){
        error.insertAfter($(element).closest('.input-group'));
      }
      else if($(element).attr('name')=='expiry_date'){
        error.insertAfter($(element).closest('.input-group'));
      }else{
         error.insertAfter($(element));
      }
     }
    });
  });
</script>
<style type="text/css">
  #doc_form_fields > div > label {margin-top:5px;margin-bottom: 0;}
</style>
@stop