@extends('layouts.dashboard')

@section('content')
<section class="" id="propertylist">
  
  <div class="col-sm-12 propertylistwrap">
    <div class="clearfix">
        <h3 class="pull-left noMargin"><span class="fa fa-users"></span> Vendor</h3>
        <a href="{{URL::to('/vendor/create')}}" class="btn orange pull-right  noMargin">Add New Vendor</a>
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
                <input type="search" data-toggle="search" data-target=".vendor_row" data-norecord=".nrf" class="form-control search_text" placeholder = "Search by text">
            </div>
            
        </div>
    </div>
    @if(count($dataset["list"])>0)
    <div class="vendorTrans cls_table">    	
        <div class="vTranHeader bold transListHeadRow">
          <div class="row bold">
            <div class="col-sm-1">#</div>
            <div class="col-sm-3">Vendor Name</div>
            <div class="col-sm-2">Vendor Address</div>
            <div class="col-sm-2">Vendor Email</div>
            <div class="col-sm-2">Vendor Phone</div>
            <div class="col-sm-2 text-center">Action</div>
          </div>
        </div>

        
    	@foreach ($dataset["list"] as $k=>$vendor)
        <div class="transListRow vendor_row">
              <div class="row">
                <div class="col-sm-1">{{$k+1}}</div>
                <div class="col-sm-3"><span class="textTruncate">{{{ $vendor->vendor_name }}}</span></div>
                <div class="col-sm-2"><span class="textTruncate">{{{ $vendor->vendor_address }}}</span></div>
                <div class="col-sm-2"><span class="textTruncate">{{{ $vendor->vendor_email}}}</span></div>
                <div class="col-sm-2"><span class="textTruncate">{{{ $vendor->vendor_phone}}}</span></div>
                <div class="col-sm-2 text-center">
                  <a href="javascript:;" class="btn btn-default btn-xs cls_vt_list" title="Transaction List" data-toggle="tooltip"><span class="fa fa-list noMargin"></span>({{count($vendor->transaction_list)}})</a>
                  <a href="{{URL::action('TenancyController@vendor_edit', [$vendor->vendor_id])}}" class="btn btn-default btn-xs"><span class="fa fa-edit noMargin"></span></a>
                </div>
              
                <div class="cls_vendor_transaction_list" style="display:none">
                  @if(count($vendor->transaction_list))
                  <div class="col-sm-12">
                    <div class="well">
                        <div class="vTranHeader bold">
                                    <div class="row">
                                      <div class="col-sm-1">#</div>
                                      <div class="col-sm-2">
                                        Type
                                      </div>
                                      <div class="col-sm-3">
                                        Title
                                      </div>
                                      <div class="col-sm-3">
                                        Vendor Involved
                                      </div>
                                      <div class="col-sm-1">
                                        Date
                                      </div>
                                      <div class="col-sm-2 text-right">
                                        Amount
                                      </div>
                                    </div>

                          </div>
                         @foreach($vendor->transaction_list as $kt=>$v)
                          <div class="vTransRow">
                                <div class="row">
                                    <?php //pr($v);?>
                                    <div class="col-sm-1">{{$kt+1}}</div>
                                    <div class="col-sm-2">
                                      {{$v->transaction_type}}
                                    </div>
                                    <div class="col-sm-3">
                                      {{$v->transaction_title}}
                                    </div>
                                    <div class="col-sm-3">
                                      <?php echo ($v->vendor_name != "") ? $v->vendor_name : "N/A"; ?>
                                    </div>
                                    <div class="col-sm-1">
                                      {{{ CommonHelper::dateToUx($v->transaction_date) }}}
                                    </div>
                                    <div class="col-sm-2 text-right">
                                      {{$v->amount}}
                                    </div>
                                </div>
                          </div>
                          @endforeach
                    </div>
                  </div>
                  @else
                  <div class="col-sm-12">
                    <div class="well">
                    <div class="vTransRow">
                      <div class="row">
                        <h3 class="text-center"><i class="fa fa-exclamation-triangle"></i> No Transaction Found</h3>
                      </div>
                    </div>
                    </div>  
                  </div>
                  @endif
                
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
<!--prefooter-->
<script type="text/javascript">
  $(function(){
    $('.cls_vt_list').click(function(){
      //alert('ok');
      var ths = $(this);
      ths.closest('.row').find('.cls_vendor_transaction_list').toggle();
    });
  });
</script>
@stop