    <div class="white clearfix">
      <div class="col-md-2 col-sm-2 col-xs-2 no-margin">
         <div class="white center">
          <div class="profileimg" style="padding:5px">
            <a href="javascript:void(0)" class="btn btn-default btn-sm profile_image" style="position:absolute;top:10px;right:10px;display:inline-block"><span class="fa fa-camera"></span></a>  
            <a href="javascript:void(0)"> {{ HTML::image('files/profileimages/'.Auth::user()->profile_image, '', array('class' => 'img-responsive','id'=>'profile_image')) }}</a>
            
          </div>
          <div class="padding-5"><a class="" href="javascript:void(0)"> {{{ Auth::user()->first_name }}} {{{ Auth::user()->last_name }}}</a></div>
      </div>  

      </div>
      <div class="col-md-10 col-sm-10 col-xs-10 no-margin" >
        <div class="white padding-5" style="position:relative;">
          <div style="height:200px;overflow:hidden;">
            <a href="javascript:void(0)" style="position:absolute;top:10px;right:10px;display:inline-block" class="btn btn-default btn-sm banner_image"><span class="fa fa-camera"></span></a>
            <a class="" href="javascript:void(0)">{{ HTML::image('files/user_banner_images/'.Auth::user()->banner_image, '', array('class' => 'img-responsive','id'=>'banner_image')) }}</a>
          </div>
        </div>
      </div>
    </div>

