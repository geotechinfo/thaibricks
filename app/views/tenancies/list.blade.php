@extends('layouts.default')

@section('content')
<section class="container container2 margin-top-10" id="propertylist">
  <aside class="col-sm-3 col-sm-push-9">
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad6.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad8.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad7.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
    <div class="clearfix">
        <h2 class="pull-left">Tenancy Details</h2>
        <a href="{{URL::to('/tenancy/create')}}" class="btn orange pull-right addNewVendorButton">Add New Tenancy</a>
    </div>
    
    @if(Session::get('success'))
    <div class="margin-top-10 message">
    <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{{ Session::get('success') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    @endif
    
    @if(Session::get('info') == true)
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    @endif
    
    @if(count($dataset["tenancies"])>0)
    <div class="propertylist clearfix new">    	
        
        <div class="tenantDetailHead hidden-xs">
          <div class="row bold">
            <div class="col-sm-3">Property Name</div>
            <div class="col-sm-2">Tenant Name</div>
            <div class="col-sm-2">Tenant Email</div>
            <div class="col-sm-2">Tenant Phone</div>
            <div class="col-sm-3">View Details</div>
          </div>
        </div>

        <div class="borderThin hidden-xs"></div>
        <div class="tenantListHolder">
			@foreach ($dataset["tenancies"] as $tenancy)
            <div class="tenantRow">
                  <div class="row fontBold">
                    <div class="col-sm-3">{{{ substr($tenancy->title, 0, 25) }}}...</div>
                    <div class="col-sm-2">{{{ substr($tenancy->tenant_fname." ".$tenancy->tenant_lname, 0, 12) }}}...</div>
                    <div class="col-sm-2">{{{ substr($tenancy->tenant_email, 0, 15) }}}...</div>
                    <div class="col-sm-2">{{{ $tenancy->tenant_phone }}}</div>
                    <div class="col-sm-3">
                    	<a href="{{URL::to('/tenancy/transaction')}}/{{{ $tenancy->tenancy_id }}}" class="btn btn-default viewTenantbtn" style="padding:0px 6px;"><span class="fa fa-btc"></span></a>
                        <a href="{{URL::to('/tenancy/edit')}}/{{{ $tenancy->tenancy_id }}}" class="btn btn-default viewTenantbtn" style="padding:0px 6px;"><span class="fa fa-edit"></span></a>
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
                            <div class="col-sm-2"><a href="{{{ asset('files/agreements')."/".$tenancy->agreement_file }}}" class="btn btn-default btn-block btn-xs" target="_blank">Download</a></div>
                          </div>
                        </div>
                        @endif
                        <!--<div class="doc">
                          <div class="row">
                            <div class="col-sm-10">
                                <p class="bold">Document name <span>(<span class="bold">Agreement from</span> 12/4/2014 <span class="bold">to</span> 12/10/2014)</span></p>
                            </div>
                            <div class="col-sm-2"><a href="javascript:;" class="btn btn-default btn-block btn-xs">Download</a></div>
                          </div>
                        </div>-->
                  </div>
            </div>
			@endforeach
            
            <!--<div class="tenantRow">
                  <div class="row fontBold">
                    <div class="col-sm-3">Pleasant Home</div>
                    <div class="col-sm-3">Jenny doe</div>
                    <div class="col-sm-2">jenny@gmail.com</div>
                    <div class="col-sm-2">9876543210</div>
                    <div class="col-sm-2"><a href="javascript:;" class="btn btn-block orange viewTenantbtn">View Details</a></div>
                  </div>

                  <div class="tenDetails">
                        <p class="bold">Tenant Address: <span class="regular">1600 Amphitheatre Parkway, Mountain View, CA.</span></p>
                        <p class="bold">Agreement from: <span class="regular">December 2014.</span></p>
                        <p class="bold">Agreement to: <span class="regular">April 2015.</span></p>
                        <div class="borderThin"></div>
                        <h3>Docs</h3>
                        <div class="doc">
                          <div class="row">
                            <div class="col-sm-10">
                                <p class="bold">This is a sample document</p>
                            </div>
                            <div class="col-sm-2"><a href="javascript:;" class="btn btn-default btn-block btn-xs">Download</a></div>
                          </div>
                        </div>
                        <div class="doc">
                          <div class="row">
                            <div class="col-sm-10">
                                <p class="bold">This is a sample document</p>
                            </div>
                            <div class="col-sm-2"><a href="javascript:;" class="btn btn-default btn-block btn-xs">Download</a></div>
                          </div>
                        </div>
                  </div>
            </div>-->

        </div>

    </div>
    @endif
  </div>
</section>
<section class="container container2" id="gototopwrap">
  <div class="">
    <div class="">
      <div class="col-sm-6"> You are here: <a title="home" href="javascript:void(0)">Home</a></div>
      <div class="col-sm-6">
        <ul class="pull-right">
          <li class="totop"><a href="#" class="gototop" id="gototop">Top <span class="fa fa-arrow-up"></span></a></li>
          <!--#gototop-->
        </ul>
      </div>
    </div>
  </div>
</section>
<!--prefooter-->

@stop