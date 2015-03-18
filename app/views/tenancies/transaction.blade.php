@extends('layouts.dashboard')
@section('content')
<?php
  //pr($dataset['transaction']);
  $transaction_id = isset($dataset['transaction']->transaction_id)?$dataset['transaction']->transaction_id:0;
  $tenancy_id = isset($dataset['transaction']->tenancy_id)?$dataset['transaction']->tenancy_id:$dataset["tenancy_id"];
  $tenancy_id = ($tenancy_id==''?0:$tenancy_id);
  $transaction_head = isset($dataset['transaction']->transaction_head_id)?$dataset['transaction']->transaction_head_id:0;
  $transaction_date = isset($dataset['transaction']->transaction_date)?CommonHelper::dateToUx($dataset['transaction']->transaction_date):0;
  $transaction_amount = isset($dataset['transaction']->transaction_amount)?$dataset['transaction']->transaction_amount:'';
?>  
<section class="" id="propertylist">
 
  <div class="col-sm-12 propertylistwrap">
    <h3 class="noMargin"><span class="fa fa-btc noMargin"></span> Add Transaction</h3>
    
    @foreach ($errors->all() as $message)
    <div class="margin-top-10 message">
    <p class="btn-danger text-danger padding-5">
        <span class="fa fa-times-circle"></span>{{{ $message }}}
        <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a>
    </p>
    </div>
    <?php break; ?>
    @endforeach
    <div class="propertylist clearfix new" style="padding:0;">    	
      <div class="formwrap addTransactionForm">

      <!-- Add transaction Form Begins -->
      {{ Form::open(array('class' => 'form-horizontal', 'route' => array('tenancy.transactionsave', $tenancy_id), 'files' => true, 'method' => 'post')) }} 
      <input type="hidden" name="transaction_id" value="{{$transaction_id}}">
        <div>
            <h4>Select Tenancy</h4>
            <div class="border-bottom"></div>
            <div class="padding well">
              <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">
                          <label class="control-label" for="propertyname">Select Tenancy</label>
                            <div class="arrow">
                                <div class="btn-group mutiselectbtn">
                                     <?php
                                        $current_tenancies = array();
                                        $current_tenancies["0"] = "Select your tenancy for transaction.";
                                        foreach($dataset["tenancies"] as $tenancy){
                                            $current_tenancies[$tenancy->tenancy_id] = $tenancy->title;
                                        }
                                      ?>
                                      {{Form::select('tenancy_name', $current_tenancies, $tenancy_id, array('class' => 'form-control', 'id'=>""))}}
                                </div>
                            </div>
                      </div>
                  </div>
              </div>
            </div>
    
    
            <h4>Transaction Type</h4>
            <div class="border-bottom"></div>
            <div class="padding well">
    
                          <div class="row">
    
    
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <label class="control-label" for="propertyname">Transaction Type</label>
                                                <div class="arrow">
                                                    <div class="btn-group mutiselectbtn">
                                                        {{Form::select('transaction_head', $dataset["transaction_heads"], $transaction_head, array('class' => 'form-control', id => 'selectTransactionHead'))}}
                                                    </div>
                                                </div>
                                      </div>
                                  </div>
    
                                  <div class="col-sm-6">
                                          <div class="form-group">
                                                  <label for="propertyname" class="control-label">Transaction Date</label>
                                                  <div class='input-group date datetimepicker1' id=''>
                                                      {{Form::text('transaction_date', $transaction_date, array('class' => 'form-control', 'placeholder' => 'Transaction Date'))}}
                                                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                      </span>
                                                  </div>
                                          </div>
                                  </div>
                                  
                                  <div class="vendorToggle">
                                      <div class="col-sm-6 ">
                                          <div class="form-group">
                                              <label class="control-label" for="propertyname">Vendor Involvement</label>
                                              <div class="vendorIn">
                                                <input type="checkbox" id="vandor" name="" value="0"> <label for="vandor">Vendor Involved</label>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-6 vandorName">
                                          <div class="form-group">
                                              <label class="control-label" for="propertyname">Select Vendor</label>
                                                        
                                                            <div class="input-prepend input-append">
    
                                                            <div class="arrow">
                                                                <div class="btn-group mutiselectbtn">
                                                                    <div class="btn-group selectSropGroup">
                                                                        <select class="form-control" name="vendor_id">
                                                                              <option value="0">Select Vendor</option>
                                                                              @foreach($dataset['vendors'] as $k=>$v)
                                                                              <option  value = "{{ $v->vendor_id }}">{{$v->vendor_name}}</option>
                                                                              @endforeach
                                                                              
                                                                        </select>
                                                                                                                                            
                                                                    </div>
                                                                </div>
                                                              </div>
    
                                                            </div>
                                          </div>
                                      </div>
    
                                  </div >
                          </div>
    
            </div>
    
    
            <h4>Amount of Transaction</h4>
            <div class="border-bottom"></div>
            <div class="padding well">
              <div class="row">
                <div class="col-sm-6">
                    <label for="cdaddress" class="control-label">Transaction Amount</label>
                    <div class="input-group">
                        <span class="input-group-addon">&#xe3f;</span>
                        <div class="row">
                        <div class="col-xs-12  noMargin">
                        {{Form::text('transaction_amount', $transaction_amount, array('class' => 'form-control special_input', 'placeholder' => 'Enter Transaction Amount'))}}
                        </div>
                        </div>
                     </div>
                </div>
                <div class="col-sm-6 ntAmtSbmt">
                  <div class="ntAmtgap"></div>
                  <input type="submit" value="Submit" class="btn btn-default orange" />
                </div>
              </div>
            </div>
        </div>
        {{ Form::close() }}

<!-- Modal -->
<div class="modal fade" id="addVendorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    {{ Form::open(array('class' => 'form-horizontal padding', 'route' => array('tenancy.savevendor'), 'files' => true, 'method' => 'post')) }} 
    <input type="hidden" name="vendor_id" id="vendor_id" value="0">  
    <input type="hidden" name="user_id" id="user_id" value="0">  
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Vendor</h4>
      </div>
      <div class="modal-body">  
              <div class="modBodyHolder">
                      <div class="row">
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label class="control-label" for="propertyname">Vendor Name</label>
                                      <input type="text" class="form-control" name="vendor_name" placeholder="Enter Vendor Name" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label class="control-label" for="propertyname">Vendor Contact Number</label>
                                      <input type="text" class="form-control" name="vendor_phone" placeholder="Enter Vendor Contact Number" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label class="control-label" for="propertyname">Vendor Email</label>
                                      <input type="text" class="form-control" name="vendor_email" placeholder="Enter Vendor Email" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label class="control-label" for="propertyname">Vendor Address</label>
                                      <textarea class="form-control" name="vendor_address" placeholder="Enter Vendor Address"></textarea>
                                  </div>
                              </div>
                      </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="add_vendor_frm" class="btn btn-default orange">Add Vendor</button>
      </div>
       {{ Form::close() }}
    </div>
  </div>
</div>

      </div>
    </div>
  </div>
</section>

<!--prefooter-->
<script type="text/javascript">
  $(document).ready(function(){
    $('#add_vendor_frm').click(function(){
      var ths = $(this);
      
      $.post(
         ths.closest('form').attr('action'),
         ths.closest('form').serialize(),
         function(m){
          var o = $.parseJSON(m);
          var li = $('<li/>')
          .addClass('cls_li_vendor')
          .attr({
            'data-vendor_id':o.vendor_id
          })
          .append($('<a/>').attr({'href':'javascript:;'}).text(o.vendor_name));
          $('#ul_vendor .adVendorholder').before(li);
          $('#vandor').val(o.vendor_id);
          $('#vendor_dd').html(o.vendor_name+'<span class="caretHolder"><span class="caret"></span></span>')
          $('#addVendorModal').modal('toggle');
         } 
      )
    });

    $(document).on('click','#ul_vendor li',function(){
      //alert($(this).data('vendor_id'))
      $('#vandor').val($(this).data('vendor_id'));
    });
  });
</script>
@stop