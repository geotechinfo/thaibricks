    <div class="white clearfix">
      <div class="col-md-2 col-sm-2 col-xs-2 no-margin">
         <div class="white center posRelative">
          <div class="profileimg" style="padding:5px 0 5px 5px">
            <!--<a href="javascript:void(0)" class="btn btn-default btn-sm profile_image" style="position:absolute;top:10px;right:10px;display:inline-block"><span class="fa fa-camera"></span></a>  -->
            <?php 
              $pi = ($user->profile_image==''?'images/agentprofile/profiledummy.png':'files/profiles/'.$user->profile_image);
              $pb = ($user->banner_image==''?'images/agentprofile/profilebanner.png':'files/banners/'.$user->banner_image);
            ?>
             <span>{{ HTML::image($pi, '', array('class' => 'img-responsive','id'=>'profile_image')) }}</span>
            
          <div class="bannerAgentName"><span> {{{ $user->first_name }}} {{{ $user->last_name }}} </span></div>
          </div>
      </div>  

      </div>
      <div class="col-md-10 col-sm-10 col-xs-10 no-margin" >
        <div class="white padding-5" style="position:relative;padding-left:15px;">
          <div style="height:185px;overflow:hidden;">
            <!--<a href="javascript:void(0)" style="position:absolute;top:10px;right:10px;display:inline-block" class="btn btn-default btn-sm banner_image"><span class="fa fa-camera"></span></a>-->
            <span>{{ HTML::image($pb, '', array('class' => 'img-responsive','id'=>'banner_image')) }}</span>
          </div>
        </div>
      </div>
    </div>

