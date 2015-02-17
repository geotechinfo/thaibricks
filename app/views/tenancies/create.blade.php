@extends('layouts.default')
@section('content')

<!--/profileimage-->
<section class="container container2 margin-top-10" id="propertylist">
  <aside class="col-sm-3 col-sm-push-9">
    <!--<div class="search-btn-wrap clearfix"> <a class="btn btn-primary btn-lg search-button margin-top details-search-button " href=""> <span class="fa fa-plus"></span> <span>Add
          New Property</span> </a> </div>-->
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad2.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad5.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad3.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
    <h2>
    	@if(Route::currentRouteAction() == "TenancyController@edit")
    		Edit Tenancy
        @else
        	Add Tenancy
        @endif
    </h2>
    
    @foreach ($errors->all() as $message)
    <div class="margin-top-10 message">
    <p class="btn-danger text-danger padding-5">
        <span class="fa fa-times-circle"></span>{{{ $message }}}
        <a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a>
    </p>
    </div>
    <?php break; ?>
    @endforeach
    
    @if(Session::get('error'))
    <div class="margin-top-10 message">
    <p class="btn-danger text-danger padding-5"><span class="fa fa-times-circle"></span>{{{ Session::get('error') }}}<a href="javascript:void(0);" class="right closemessage"><span class="glyphicon glyphicon-remove"></span></a></p>
    </div>
    @endif

    
    <div class="propertylist clearfix new">    	
      <div class="formwrap tenancyForm">
      	@if(Route::currentRouteAction() == "TenancyController@edit")
        	{{ Form::open(array('class' => '', 'route' => array('tenancy.update', $dataset["tenancy"]->tenancy_id), 'files' => true, 'method' => 'post')) }} 
        @else
        	{{ Form::open(array('class' => '', 'route' => array('tenancy.store'), 'files' => true, 'method' => 'post')) }} 
        @endif
              <div>
                      <h4>Property Selection</h4>
                      <div class="border-bottom"></div>


                      <div class="padding well">
                              <div class="row">
                                      <div class="col-sm-6">
                                          <div class="form-group">
                                              <label for="propertyname" class="control-label">Select Property (Rent / Lease)</label>
                                              <?php
												$tenantable_properties = array();
												$tenantable_properties[""] = "Select your property for rent/lease.";
												foreach($dataset["properties"] as $property){
													$tenantable_properties[$property->property_id] = $property->title;
												}
											  ?>
                                              {{Form::select('property_id', $tenantable_properties, $dataset["tenancy"]->property_id, array('class' => 'form-control', 'id'=>""))}}
                                          </div>
                                      </div>
                              </div>
                      </div>

                      <h4>Tenant Information</h4>
                      <div class="border-bottom"></div>
                      
                      <div class="padding well">
                              <div class="row">
                                      <div class="col-sm-6">
                                              <div class="form-group">
                                                      <label for="propertyname" class="control-label">First Name</label>
                                                      {{Form::text('first_name', $dataset["tenancy"]->tenant_fname, array('class' => 'form-control', 'placeholder' => 'First Name'))}}
                                              </div>
                                      </div>
                                      <div class="col-sm-6">
                                              <div class="form-group">
                                                      <label for="propertyname" class="control-label">Last Name</label>
                                                      {{Form::text('last_name', $dataset["tenancy"]->tenant_lname, array('class' => 'form-control', 'placeholder' => 'Last Name'))}}
                                              </div>
                                      </div>
                                      <div class="col-sm-6">
                                      		<div class="form-group">
                                                <label for="cdcontact" class="control-label">Phone</label>
                                                  <div>
                                                  <input type="text" class="form-control locationcode" id="locationcode" placeholder="+66" value="+66" readonly="readonly" style="background:#111112 !important;"/>
                                                  {{Form::text('phone', $dataset["tenancy"]->tenant_phone, array('class' => 'form-control ucontactright', 'placeholder' => 'Enter contact number'))}}
                                                  </div>
                                              </div>
                                      </div>
                                      <div class="col-sm-6">
                                              <div class="form-group">
                                                      <label for="propertyname" class="control-label">Email</label>
                                                      {{Form::text('email', $dataset["tenancy"]->tenant_email, array('class' => 'form-control', 'placeholder' => 'Enter email address'))}}
                                              </div>
                                      </div>
                                      <div class="col-sm-12">
                                              <div class="form-group">
                                                      <label for="propertyname" class="control-label">Address</label>
                                                      {{ Form::textarea('address', $dataset["tenancy"]->tenant_address, ['class' => 'form-control','rows' => '5']) }}
                                              </div>
                                      </div>
                              </div>
                      </div>


                      <h4>Agreement Information</h4>
                      <div class="border-bottom"></div>

                      <div class="padding well">
                      		<div class="row">
                            	<div class="col-sm-6">
                                                <div class="form-group">
                                                        <label for="propertyname" class="control-label">Upload Agreement</label>
                                                        <div class="fileHolder">
                                                          <div class="row noMargin">
                                                            <div class="col-sm-12 noPadding">
                                                              <div class="fileBack">
                                                                {{ Form::file('agreement_file', array('class' => 'upFile')) }}
                                                                <span><i class="fa fa-upload"></i> Upload Agreement</span>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                </div>
                                        </div>
                            </div>
                              <div class="row">
                                      <div class="col-sm-6">
                                              <div class="form-group">
                                                      <label for="propertyname" class="control-label">Agreement From</label>
                                                      <div class='input-group date datetimepicker1' id=''>
                                                          {{Form::text('start_date', CommonHelper::dateToUx($dataset["tenancy"]->start_date), array('class' => 'form-control', 'placeholder' => 'Agreement begins from'))}}
                                                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                          </span>
                                                      </div>
                                              </div>
                                      </div>
                                      <div class="col-sm-6">
                                              <div class="form-group">
                                                      <label for="propertyname" class="control-label">Agreement To</label>
                                                      <div class='input-group date datetimepicker1' id=''>
                                                          {{Form::text('end_date', CommonHelper::dateToUx($dataset["tenancy"]->end_date), array('class' => 'form-control', 'placeholder' => 'Agreement ends on'))}}
                                                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                          </span>
                                                      </div>
                                              </div>
                                      </div>


                              </div>
                      </div>


                      <!--<h4>Multiple Document Upload</h4>
                      <div class="border-bottom"></div>

                      <div class="padding well repeatNewDoc">
                        <div class="repeatNewHolder">
                          <div class="row newForms">
                                        <div class="col-sm-6">
                                                <div class="form-group">
                                                        <label for="propertyname" class="control-label">Head Caption</label>
                                                        <input class="form-control" placeholder="Enter Head Caption" name="title" type="text">
                                                </div>
                                        </div>
                                        <div class="col-sm-6">
                                                <div class="form-group">
                                                        <label for="propertyname" class="control-label">Upload Document</label>
                                                        <div class="fileHolder">
                                                          <div class="row noMargin">
                                                            <div class="col-sm-12 noPadding">
                                                              <div class="fileBack">
                                                                <input type="file" class="upFile">
                                                                <span><i class="fa fa-upload"></i> Upload your document</span>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                </div>
                                        </div>




                                        <div class="col-sm-6">
                                              <div class="form-group">
                                                      <label for="propertyname" class="control-label">Agreement To</label>
                                                      <div class='input-group date datetimepicker1' id=''>
                                                          <input type='text' class="form-control" placeholder="Agreement ends on" />
                                                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                          </span>
                                                      </div>
                                              </div>
                                      </div>
                                      <div class="col-sm-6">
                                              <div class="form-group">
                                                      <label for="propertyname" class="control-label">Agreement To</label>
                                                      <div class='input-group date datetimepicker1'>
                                                          <input type='text' class="form-control" placeholder="Agreement ends on" />
                                                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                          </span>
                                                      </div>
                                              </div>
                                      </div>
                          </div>


                      <div class="addNewDoc clearfix">
                        <a href="javascript:;" class="addNewBtn pull-left">
                          <i class="fa fa-plus"></i> 
                          <span>Add new Document</span>
                        </a>
                        <a href="javascript:;" class="btn btn-default orange pull-right">Submit</a>
                      </div>
                        
</div>

                      </div>-->
                      
                      <div class="addNewDoc clearfix">
                      	@if(Route::currentRouteAction() == "TenancyController@edit")
                            <input type="submit" class="btn btn-default orange pull-right" value="Update" />
                        @else
                            <input type="submit" class="btn btn-default orange pull-right" value="Submit" />
                        @endif
                      </div>
              </div>
          {{ Form::close() }}
      </div>
    </div>
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

@stop