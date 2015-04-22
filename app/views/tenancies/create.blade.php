@extends('layouts.dashboard')
@section('content')
{{ HTML::script('libraries/validator/validation.js') }}
<!--/profileimage-->
<section class="" id="propertylist">
  
  <div class="col-sm-12 propertylistwrap">
    <h3 class="noMargin"><span class="fa fa-building-o"></span>
    	@if(Route::currentRouteAction() == "TenancyController@edit")
    		Edit Tenancy
        @else
        	Add Tenancy
        @endif
    </h3>
    
    @foreach ($errors->all() as $message)
    <div class="margin-top-10 message">
    <p class="btn-danger text-danger padding-5">
        <span class="fa fa-times-circle"></span>{{{ $message }}}
        
    </p>
    </div>
    <?php break; ?>
    @endforeach
    
    @if(Session::get('error'))
    <div class="margin-top-10 message">
    <p class="btn-danger text-danger padding-5"><span class="fa fa-times-circle"></span>{{{ Session::get('error') }}}</p>
    </div>
    @endif

    
    <div class="propertylist clearfix new" style="padding:0;">    	
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
													if(in_array($property->deal_id, array(2))){
														$tenantable_properties[$property->property_id] = $property->title;
													}
												}
                        $disabled = (isset($dataset['is_edit'])?'disabled':'');
											  ?>
                                              {{Form::select('property', $tenantable_properties, $dataset["tenancy"]->property_id, array('class' => 'form-control', 'id'=>"",$disabled))}}
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
                                                  <div class="input-group">
                                                  <span class="input-group-addon">+66</span>                                                 
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

@stop