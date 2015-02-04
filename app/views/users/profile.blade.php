@extends('layouts.default')
@section('content')
<!--/profileimage-->
<section class="container container2 margin-top-10 white radius-top" id="profileimage">
  <div class="clearfix padding-5 clouds">
    <div class="white clearfix">
      <div class="col-md-2 col-sm-2 col-xs-2 no-margin">
        <div class="white center">
          <div class="profileimg"> 
          <a href="javascript:void(0)" class="editphoto"><span class="fa fa-camera"></span><a href="javascript:void(0)">
          <a href="javascript:void(0)"> <img class="img-responsive" src="images/agentprofile/profiledummy.png"></a>
          </div>
          <div class="padding-5"><a class="" href="javascript:void(0)"> User
              Name </a></div>
          <div> </div>
        </div>
      </div>
      <div class="col-md-10 col-sm-10 col-xs-10 no-margin">
        <div class="white padding-5 coverpic">
        <a href="javascript:void(0)" class="editphoto"><span class="fa fa-camera"></span><a href="javascript:void(0)">
        <img src="images/agentprofile/banner.png" class="img-responsive"/>
        </div>
      </div>
    </div>
  </div>
</section>
<!--/profileimage-->
<section class="container container2 margin-top-10 white radius-top">
  <aside class="col-sm-3 col-sm-push-9">
  	<!--<div class="search-btn-wrap clearfix"> <a class="btn btn-primary btn-lg search-button margin-top details-search-button " href=""> <span class="fa fa-plus"></span> <span>Add New Property</span> </a> </div>-->
    <div class="search-btn-wrap clearfix"> <a data-toggle="modal" data-target="#addPrperty" class="btn btn-primary btn-lg search-button margin-top details-search-button adProperty" href=""> <span class="fa fa-plus"></span> <span>Add New Property</span> </a> </div>
    
    <!-- Modal -->
        <div class="modal fade" id="addPrperty" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
            	{{ Form::open(array('route' => array('property.create'), 'method' => 'get')) }}
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Property</h4>
              </div>
              <div class="modal-body addPropertyModal">
                <div class="row">
                  <div class="col-sm-3 col-sm-offset-1">
                  <label>Property Type</label>
                  </div>
                  <div class="col-sm-7">
                     {{Form::select('type_id', $dataset["types"], null, array('class' => 'form-control'))}}
                  </div>
                </div>
                <p></p>
                <div class="row">
                  <div class="col-sm-3 col-sm-offset-1">
                  <label>Transaction Type</label>
                  </div>
                  <div class="col-sm-7">
                  	{{Form::select('deal_id', $dataset["deals"], null, array('class' => 'form-control'))}} 
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary orange modalBtn">Submit</button>
              </div>
              {{ Form::open(array('route' => array('login'), 'method' => 'post')) }}
            </div>
          </div>
        </div>
        
        
        
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad5.jpg', '', array('class' => '')) }}</div>
    <div class="ad-wrap">{{ HTML::image('images/demoimages/ad1.jpg', '', array('class' => '')) }}</div>
  </aside>
  <div class="col-sm-9 col-sm-pull-3 propertylistwrap">
  

    <div class="propertylist">
    
      <!-- Tabs -->
        <div role="tabpanel">
        
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#acDetails" aria-controls="acDetails" role="tab" data-toggle="tab">Account Details</a></li>
            <li role="presentation"><a href="#changePass" aria-controls="changePass" role="tab" data-toggle="tab">Change Password</a></li>
          </ul>
        
          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="acDetails">
            	<div class="updateProfile">
          <div class="updateProfileSection">
            <div class="upProHeaderHolder">
                <h4> Personal Details</h4>
                <a href="javascript:;" class="profileUpdateBtn flexCenter"><i class="fa fa-edit"></i></a>
                <div class="border-bottom"></div>
                <div class="border-top"></div>
            </div>
            <div class="padding">
                <div class="accountInfoGroup">
                        <div class="row">
                          <div class="col-sm-4 acInfoLabel">
                            <label>Name</label>
                          </div>
                          <div class="col-sm-8">
                            <p class="bold accountInfo">{{{ Auth::user()->first_name }}} {{{ Auth::user()->last_name }}}</p>
                          </div>
                        </div>
                </div>
                <div class="accountInfoGroup">
                        <div class="row">
                          <div class="col-sm-4 acInfoLabel">
                            <label>Location</label>
                          </div>
                          <div class="col-sm-8">
                            <p class="bold accountInfo">{{{ Auth::user()->location }}}</p>
                          </div>
                        </div>
                </div>
            </div>

            <div class="upProHeaderHolder">
                <h4> Account Details</h4>
                <!--<a href="javascript:;" class="profileUpdateBtn flexCenter"><i class="fa fa-edit"></i></a>-->
                <div class="border-bottom"></div>
                <div class="border-top"></div>
            </div>
            <div class="padding">
                <div class="accountInfoGroup">
                        <div class="row">
                          <div class="col-sm-4 acInfoLabel">
                            <label>Email</label>
                          </div>
                          <div class="col-sm-8">
                            <p class="bold accountInfo">{{{ Auth::user()->email }}}</p>
                          </div>
                        </div>
                </div>
                <div class="accountInfoGroup">
                        <div class="row">
                          <div class="col-sm-4 acInfoLabel">
                            <label>Phone</label>
                          </div>
                          <div class="col-sm-8">
                            <p class="bold accountInfo">{{{ Auth::user()->phone }}}</p>
                          </div>
                        </div>
                </div>
              </div>

          </div>
        </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="changePass">
            <div class="updateProfile">
            <div class="updateProfileSection">
            <div class="upProHeaderHolder">
                <h4>Change Password</h4>
                <!--<a href="javascript:;" class="profileUpdateBtn flexCenter"><i class="fa fa-edit"></i></a>-->
                <div class="border-bottom"></div>
                <div class="border-top"></div>
            </div>
            <div class="padding chPassword">
                <div class="accountInfoGroup">
                        <div class="row">
                          <div class="col-sm-4 acInfoLabel">
                            <label>Old Password</label>
                          </div>
                          <div class="col-sm-8">
                            <p class="bold accountInfo"><input type="text" class="form-control" placeholder="Old Password" /></p>
                          </div>
                        </div>
                </div>
                <div class="accountInfoGroup">
                        <div class="row">
                          <div class="col-sm-4 acInfoLabel">
                            <label>New Password</label>
                          </div>
                          <div class="col-sm-8">
                            <p class="bold accountInfo"><input type="text" class="form-control" placeholder="New Password" /></p>
                          </div>
                        </div>
                </div>
                <div class="accountInfoGroup">
                        <div class="row">
                          <div class="col-sm-4 acInfoLabel">
                            <label>Retype New Password</label>
                          </div>
                          <div class="col-sm-8">
                            <p class="bold accountInfo"><input type="text" class="form-control" placeholder="Retype Password"/></p>
                          </div>
                        </div>
                </div>
                
                <div class="text-right">
                	<input type="submit" class="btn orange" />
                </div>
                
              </div>
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
@stop