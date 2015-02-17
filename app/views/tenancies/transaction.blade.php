@extends('layouts.default')
@section('content')

<section class="container container2 margin-top-10" id="propertylist">
  <aside class="col-sm-3 col-sm-push-9">
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad2.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad5.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad3.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
    <h2>Add Transaction</h2>
    <div class="propertylist clearfix new">    	
      <div class="formwrap addTransactionForm">

      <!-- Add transaction Form Begins -->
        <form>
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
																$current_tenancies[""] = "Select your tenancy for transaction.";
																foreach($dataset["tenancies"] as $tenancy){
																	$current_tenancies[$tenancy->tenancy_id] = $tenancy->title;
																}
															  ?>
															  {{Form::select('tenancy_id', $current_tenancies, $dataset["tenancy_id"], array('class' => 'form-control', 'id'=>""))}}
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
                                                            <select class="form-control" id="vendorTypeSelect">
                                                                <option selected="true" style="display:none;">Select Transaction Type</option>
                                                                <optgroup label="Expense">
                                                                    <option class="vendorShow">Tax</option>
                                                                    <option class="vendorShow">Repairy</option>
                                                                    <option class="vendorShow">Painting</option>
                                                                </optgroup>
                                                                <optgroup label="Income">                          
                                                                    <option class="vendorHide">Deposit</option>
                                                                    <option class="vendorHide">Rent</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                          </div>
                                      </div>

                                      <div class="col-sm-6">
                                              <div class="form-group">
                                                      <label for="propertyname" class="control-label">Transaction Date</label>
                                                      <div class='input-group date datetimepicker10' id=''>
                                                          <input type='text' class="form-control" placeholder="Agreement ends on" />
                                                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                                          </span>
                                                      </div>
                                              </div>
                                      </div>
                                      <script type="text/javascript">
                                      $(function(){
                                        $(function () {
                                            $('.datetimepicker10').datetimepicker();
                                        });
                                      })
                                      </script>

                                      <div class="vendorToggle">
                                          <div class="col-sm-6 ">
                                              <div class="form-group">
                                                  <label class="control-label" for="propertyname">Vendor Involvement</label>
                                                  <div class="vendorIn">
                                                    <input type="checkbox" id="vandor"> <label for="vandor">Vendor Involved</label>
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

                                                                            <button class="btn dropdown-toggle selectDropper" name="recordinput" data-toggle="dropdown">
                                                                            Select Vendor
                                                                            <!-- <span class="caretHolder"><span class="caret"></span></span> -->
                                                                            </button>
                                                                            <ul class="dropdown-menu selectDrop">
                                                                                  <li><a href="javascript:;">Vendor 1</a></li>
                                                                                  <li><a href="javascript:;">Vendor 2</a></li>
                                                                                  <li><a href="javascript:;">Vendor 3</a></li>
                                                                                  <li><a href="javascript:;">Vendor 4</a></li>
                                                                                  <li><a href="javascript:;">Vendor 5</a></li>

                                                                                  <li class="adVendorholder"><button class="btn" data-toggle="modal" data-target="#addVendorModal">Add New Vendor</button></li>
                                                                            </ul>
                                                                            <script type="text/javascript">
                                                                                $(function(){
                                                                                  $(".selectDrop li a").click(function(){
                                                                                    var selText = $(this).text();
                                                                                    $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caretHolder"><span class="caret"></span></span>');
                                                                                  });
                                                                                });
                                                                            </script>                                                                    
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
                        <label for="netAmount">Net Amount</label>
                        <input type="text" class="form-control" id="netAmount" />
                    </div>
                    <div class="col-sm-6 ntAmtSbmt">
                      <div class="ntAmtgap"></div>
                      <a href="javascript:;" class="btn btn-default orange">Submit</a>
                    </div>
                  </div>
                </div>


            </div>
        </form>

<!-- Modal -->
<div class="modal fade" id="addVendorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
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
                                      <input type="text" class="form-control" placeholder="Enter Vendor Name" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label class="control-label" for="propertyname">Vendor Contact Number</label>
                                      <input type="text" class="form-control" placeholder="Enter Vendor Contact Number" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label class="control-label" for="propertyname">Vendor Email</label>
                                      <input type="text" class="form-control" placeholder="Enter Vendor Email" />
                                  </div>
                              </div>
                              <div class="col-sm-12">
                                  <div class="form-group">
                                      <label class="control-label" for="propertyname">Vendor Address</label>
                                      <textarea class="form-control" placeholder="Enter Vendor Address"></textarea>
                                  </div>
                              </div>
                      </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default orange">Add Vendor</button>
      </div>
    </div>
  </div>
</div>

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
<!--prefooter-->

@stop