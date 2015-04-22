@extends('layouts.dashboard')

@section('content')
<section class="" id="propertylist">
  
  <div class="col-sm-12 propertylistwrap">
    <div class="clearfix transHeader">
        <h3 class="pull-left noMargin"><span class="fa fa-btc noMargin"></span> Transaction List</h3>
        <a href="{{URL::to('/tenancy/transaction/')}}/0" class="btn orange pull-right ">Add Tracsaction</a>
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
            <input type="search" data-toggle="search" data-target=".transaction_row" data-norecord=".nrf" class="form-control search_text" placeholder = "Search by text">
            </div>
            
        </div>
    </div>
      @if(count($dataset['list'])>0)
          
          <div class="vendorTrans cls_table">
            <div class="vTranHeader bold transListHeadRow">
                <div class="row">
                  <div class="col-sm-1">#</div>
                  <div class="col-sm-2">Property</div>                  
                  <div class="col-sm-2">Tenant</div>                  
                  <div class="col-sm-1">Type</div>
                  <div class="col-sm-2">Title</div>
                  <div class="col-sm-1">Vendor</div>
                  <div class="col-sm-1">Date</div>
                  <div class="col-sm-1 text-right">Amount</div>
                  <div class="col-sm-1">Action</div>
                </div>
            </div>
           @foreach($dataset['list'] as $k=>$v)
           <?php //pr($v);?>
                <div class="transListRow transaction_row">
                      <div class="row">
                          <div class="col-sm-1">
                            {{$k+1}}
                          </div>
                          <div class="col-sm-2">
                           
                            <?php echo ($v->title==''?'N/A':$v->title)?>
                          </div>
                          <div class="col-sm-2">
                            {{$v->tenants_first_name}} {{$v->tenants_last_name}}
                            
                          </div>
                          <div class="col-sm-1">
                            {{$v->transaction_type}}
                          </div>
                          <div class="col-sm-2">
                            {{$v->transaction_title}}
                          </div>
                          <div class="col-sm-1">
                            <?php echo ($v->vendor_name != "") ? $v->vendor_name : "N/A"; ?>
                          </div>
                          <div class="col-sm-1">
                            {{{ CommonHelper::dateToUx($v->transaction_date) }}}
                          </div>
                          <div class="col-sm-1 text-right">
                            {{$v->transaction_amount}}
                          </div>
                          <div class="col-sm-1 text-center">
                            <a style="padding:0px 6px;" class="btn btn-default viewTenantbtn" href="{{URL::to('transaction/edit/')}}/{{$v->transaction_id}}">
                                <span class="fa fa-edit noMargin"></span>
                            </a>
                          </div>
                      </div>
                </div>
            @endforeach
           <div class="nrf" style="display:none">
              <div class="alert alert-warning">
                 <i class="fa fa-exclamation-triangle"></i> No Record Found
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
@stop