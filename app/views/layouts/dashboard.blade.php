<?php
$location = new Location;
$dataset['locations']=$location->get_location_with_sub();

$loc = array(''=>'Select Location');
$subloc[''] = array(''=>'Select Location');
$transport_group =  array('' => 'Select Transport Group' );
foreach ($dataset['locations'] as $k=>$v){
  $loc[$k]=$v['location_name'];
  if($v['SubLocation']){
     foreach ($v['SubLocation'] as $k1 => $v1) {
      $subloc[$k][$v1['location_id']]=$v1['location_name'];
     }
  }
  if($v['Transport']){
     foreach ($v['Transport'] as $k1 => $v1) {
      $transport_group[$k][$v1['transport_id']]=$v1['transport_name'];
     }
  }
}
//print_r($dataset["property"]->location);die;
//$url = action('PropertiesController@myproperties');
//echo $url;die;
//echo Route::current()->getName();
//pr(Request::segments()[0]);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- head start--><head>
<meta charset="UTF-8" />
<title>Thaibricks | Seller Dashboard</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
<!-- styles -->
<!--<link rel="stylesheet" href="css/bootstrap.css" />
<link rel="stylesheet" href="css/font-awesome.css" />
<link rel="stylesheet" href="css/sidebar.css" />
<link rel="stylesheet" href="plugins/select2/css/select2.css" />
<link rel="stylesheet" href="css/main.css" />
<link rel="stylesheet" href="css/sellerdashboard.css" />-->

{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/font-awesome.css') }}
{{ HTML::style('libraries/slider/css/slider.css') }}
{{ HTML::style('libraries/select2/css/select2.css') }}
{{ HTML::style('libraries/startrating/jquery.rating.css') }}
{{ HTML::style('css/prettyPhoto.css') }}
{{ HTML::style('css/main.css') }}
{{ HTML::style('css/date.css') }}
{{ HTML::style('css/sidebar.css') }}
{{ HTML::style('css/sellerdashboard.css') }}
<!-- styles -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

{{ HTML::script('js/jquery.js') }}
{{ HTML::script('js/jquery-ui.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/jquery.prettyPhoto.js') }}
{{ HTML::script('js/moment.js') }}
{{ HTML::script('js/date.js') }}

<style type="text/css">
  .nearbygroup {border:1px #DDD solid;margin-bottom: 10px;padding:0 15px;background:#FFF;border-bottom: none;}
  .nearbygroup input[type="checkbox"] {position: absolute;left:12px;top:2px;}
  .nearbygroup label.textTruncate {padding-left:34px;line-height: 24px;display: inline-block;}
  .nearbygroup > .row .nearbyScroll > .row {margin:0 0 10px ;}
  .nearbygroup > .row .nearbyScroll > .row:last-child {margin-bottom:0px !important;}
  .nrByHolder {border-bottom: 1px #DDD solid;height:32px;}
  .nearbygroup > .form-group > label {background:#888;color:#FFF;margin-bottom: 10px;padding: 5px 12px;}
  .nearbygroup > .form-group {padding: 0;margin-bottom: 0}
  .nearbyDistance {height: 32px;border-right:none;}
  .nearbyScroll {max-height: 242px;overflow:auto;width: 100%; }
</style>
</head>
<!-- head start-->
<!-- body-->
<body>
<!-- Left Menu-Logo-user section  -->
<aside class="darkGrey leftMenuNav col-md-2">
  <div class="media user-media logoWrap"> <a class="logo" href="javascript:void(0);"> {{ HTML::image('images/logo_icon.png', '', array('class' => 'logo')) }} </a> </div>
  <div class="welcomeuserWrap">
    <div class="user-panel">
      
      <!--<div class="image">
        <div class="img-circle"><span class="fa fa-user"></span></div>
      </div>-->
      <div class="info">
        <p> Welcome,<br/>
          {{Auth::user()->first_name}} {{Auth::user()->last_name}}</p>
      </div>
    </div>
  </div>
  <ul class="sellermenu">
    <li class="panel <?php echo (Route::current()->getName()=='property.myproperties'?'active':'')?>"> <a href="{{URL::to('/property/myproperties/')}}" > 
        <span class="fa fa-map-marker"></span> <span class="leftLink">My
        Properties</span> </a> 
    </li>
    <?php
      $ll_links = array('tenancy.tenancies','tenancy.transaction_list','tenancy.vendor_list');
    ?>
    <li class="panel"> <a data-target=".landlord-nav" class="accordion-toggle collapsed relativeAnchor" data-toggle="collapse" data-parent="#menu" href="#"> <span class="fa fa fa-list-alt"></span> <span class="leftLink">Landlord </span><span class="caret"></span> &nbsp; </a>
      <ul class="collapse landlord-nav <?php echo (in_array(Route::current()->getName(), $ll_links)=='tenancy'?'in':'')?>">
        <li class="<?php echo (Route::current()->getName()=='tenancy.tenancies'?'active':'')?>"> <a href="{{URL::to('/tenancy/tenancies')}}" > <span class="fa fa-building-o"></span> <span class="leftLink">Tenancy</span> </a> </li>
        <li class="<?php echo (Route::current()->getName()=='tenancy.transaction_list'?'active':'')?>"> <a href="{{URL::to('/transaction/list')}}" > <span class="fa fa-btc"></span> <span class="leftLink">Transaction</span> </a> </li>
        <li class="<?php echo (Route::current()->getName()=='tenancy.vendor_list'?'active':'')?>"> <a href="{{URL::to('/vendor/list')}}" > <span class="fa fa-users"></span> <span class="leftLink">Vendor</span> </a> </li>
      </ul>
    </li>
    <!--
    <li class="panel"> <a href="javascript:void(0);" > <span class="fa fa-certificate"></span> Advertisement </a> </li>
    <li class="panel"> <a href="javascript:void(0);" > <span class="fa fa-file-text-o"></span> Contact List </a> </li>
    -->
    <?php
      $p_links = array('profile','profile.changepassword','profile.userimages');

    ?>
    <li class="panel <?php echo (Request::segments()[0]=='user'?'active':'')?>"> 
      <a data-target=".user-nav" class="accordion-toggle collapsed relativeAnchor" data-toggle="collapse" data-parent="#menu" href="#"> <span class="fa fa-pencil"></span> <span class="leftLink">Profile Management</span><span class="caret"></span></a>
      <ul class="collapse user-nav <?php echo (in_array(Route::current()->getName(), $p_links)=='tenancy'?'in':'')?>">
        <li class="<?php echo (Route::current()->getName()=='profile'?'active':'')?>"> <a href="{{URL::to('/profile')}}" > <span class="fa fa-edit"></span> <span class="leftLink">Edit Profile</span> </a> </li>
        <li class="<?php echo (Route::current()->getName()=='profile.changepassword'?'active':'')?>"> <a href="{{URL::to('/profile/changepassword')}}" > <span class="fa fa-lock"></span> <span class="leftLink">Change Password </span></a> </li>
        <li class="<?php echo (Route::current()->getName()=='profile.userimages'?'active':'')?>"> <a href="{{URL::to('/profile/userimages')}}" > <span class="fa fa-file-image-o"></span> <span class="leftLink">Change Images </span></a> </li>
        <!--<li class=""> <a href="{{URL::to('/profile/profileimage')}}" > <span class="fa fa-user"></span> <span class="leftLink">Change Profile Image</span> </a> </li>
        <li class=""> <a href="{{URL::to('/profile/bannerimage')}}" > <span class="fa fa-image"></span> <span class="leftLink">Change Banner</span> </a> </li>
        -->
      </ul>
    </li>
  </ul>
</aside>
<!--Left Menu-Logo-user section  -->
<!-- Right Wrapper -->
<div class="rightContentWrap col-md-10">
  <!--Right Area -->
  <div class="inner">
    <!--Right Navigation -->
    <nav class="navbar navbar-default darkGrey topnav">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="javascript:void(0);bs-example-navbar-collapse-1"> <span class="sr-only">Toggle
          navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <!--<li class="active"><a href="javascript:void(0);"><span class="fa fa-bell-o"></span>Alerts <span class="label label-danger counter">4</span></a></li>-->
            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="fa fa-plus-square-o"></span>Add
                New<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{URL::to('/property/create')}}"><span class="fa fa-map-marker"></span>Property</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::to('/tenancy/create')}}"><span class="fa fa-building-o"></span>Tenancy</a></li>
                <li class="divider"></li>
                <li><a href="{{URL::to('/tenancy/transaction')}}/0"><span class="fa fa-btc"></span>Transaction</a></li>
                <!--
                <li class="divider"></li>
                <li><a href="javascript:void(0);"><span class="fa fa-users"></span>Vendor</a></li>-->
              </ul>
            </li>
            <li><a href="javascript:void(0);"><span class="fa fa-envelope"></span>Contact
                Us</a></li>
            <li><a href="{{URL::to('/logout')}}"><span class="fa fa-sign-out"></span>Logout</a></li>
            <li class="brick"><a href="{{URL::to('/')}}"><span class="fa fa-globe"></span>Visit
                Website</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    <!--Right Navigation -->
    <!--Right content -->
    <section class="innerContent">
      @yield('content')
    </section>
    <!--Right content -->
  </div>
  <!--Right Area -->
  <!-- Footer -->
  <footer id="footer">
    <p>&copy; Thaibricks &nbsp;2015 - 2016 &nbsp;</p>
  </footer>
  <!--Footer -->
</div>
<!--Right Wrapper-->
<!-- Scripts -->
<!--<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="plugin/select2/js/select2.js"></script>
<script src="js/sellerdashboard.js"></script>
<script src="js/main.js"></script>-->

{{ HTML::script('libraries/slider/js/bootstrap-slider.js') }}
{{ HTML::script('libraries/select2/js/select2.js') }}
{{ HTML::script('libraries/startrating/jquery.rating.js') }}
{{ HTML::script('libraries/uploadifive/js/jquery.ui.widget.js') }}
{{ HTML::script('libraries/uploadifive/js/jquery.fileupload.js') }}
{{ HTML::script('js/sellerdashboard.js') }}
{{ HTML::script('js/main.js') }}
<!-- Scripts -->
<script type="text/javascript">
$(document).ready(function(){
    $(".propertyinfo .propertyformsteps").each(function(e) {
        if (e != 0)
            $(this).hide();
    });
  $("#prev").hide();

  
});

$(document).ready(function(){
  $("#file_add").click( function(){
    var file_wrap = $("#file_wrap").clone();
    $("#file_wrap").after(file_wrap);       
  });
});

$(document).ready(function(){
  var locationJson = $.parseJSON('{{ json_encode($dataset['locations']) }}');
  function chnage_rule(){
      /*$("#location_sub").empty();
    if($("#location").val() == "Bangkok"){
      $("#location_sub").append($("<option />").val("").text("Sub Location"));
      $("#location_sub").append($("<option />").val("Asok").text("Asok"));
      $("#location_sub").append($("<option />").val("Nana").text("Nana"));
    }else if($("#location").val() == "Phuket"){
      $("#location_sub").append($("<option />").val("").text("Sub Location"));
      $("#location_sub").append($("<option />").val("Patong").text("Patong"));
      $("#location_sub").append($("<option />").val("Laguna").text("Laguna"));
    }*/
    var location = $("#location").val();
    $("#location_sub").empty();
    $("#transport_id").empty();

    $("#location_sub").append($("<option />").val("").text("Select Sub Location"));
    if(locationJson[location] != undefined){
      if(locationJson[location].SubLocation){
        $.each(locationJson[location].SubLocation,function(i,obj){
          $("#location_sub").append($("<option />").val(obj.location_id).text(obj.location_name));
        });
      }
    }
    $("#transport_id").append($("<option />").val('').text('Select Transport Group'));
    $("#transport_system").hide();
    $(".cls_transport").empty();  
    
    var selected_transports = [];
    <?php
    if($dataset["property"]->selected_transports){
      foreach($dataset["property"]->selected_transports as $transport_id=>$kilometer){
    ?>
      selected_transports[<?php echo $transport_id; ?>] = <?php echo $kilometer; ?>;
    <?php
      }
    }
    ?>
    
    if(locationJson[location] != undefined){
      if(locationJson[location].Transport){
         $(".cls_transport,.cls_nearby").empty();
        $.each(locationJson[location].Transport, function(i, obj){
          
          if(obj.type=='1'){
            var slct = $('<select/>')
            .addClass('form-control cls_transport_select ucontactright')
            .attr({'name':'transport_id[]'})
            .append($("<option />")
            .val('')
            .text('Select Transport')
            );
            
            var kilometer = null;
            
            if(obj.Child.length){
              $.each(obj.Child,function(i1,obj1){
                if(selected_transports[obj1.transport_id] != undefined){
                slct.append($("<option />").attr("selected", "selected").val(obj1.transport_id).text(obj1.transport_name));
                kilometer = selected_transports[obj1.transport_id];
              }else{
                slct.append($("<option />").val(obj1.transport_id).text(obj1.transport_name));
              }
              });
              var inpt = $('<input/>').addClass('form-control locationcode cls_transport_distance').attr({'name':'transport_dist[]', 'placeholder':'Km', 'value':kilometer});
              var rw = $('<div/>').addClass('').append(slct).append(inpt);
          
          
              var col = $('<div/>').addClass('col-sm-6 transportgroup');
              var html = $('<div/>').addClass('form-group');
              var lb = $('<label/>').addClass('control-label').text(obj.transport_name);
              var cn = $('<div/>').addClass('').append(rw);
              html.append(lb).append(cn)
              col.append(html);
              $(".cls_transport").append(col);
            }else{
              $('#transport_system').hide();
            }
              

          }
          if(obj.type=='2'){
             
            if(obj.Child.length){
            var kilometer = null;
            var col = $('<div/>').addClass('col-sm-6');
            var html = $('<div/>').addClass('form-group row');
            var lb = $('<label/>').addClass('control-label col-xs-12').text(obj.transport_name);
            html.append(lb);
            var scroll = $('<div/>').addClass('nearbyScroll')
            //console.log(obj.Child)

            $.each(obj.Child,function(i1,obj1){
              var rw = $('<div/>').addClass('row');
              var col8 = $('<div/>').addClass('col-sm-10 col-xs-9 noPadding');
              var col4 = $('<div/>').addClass('col-sm-2 col-xs-3 noPadding');
              var kilometer = selected_transports[obj1.transport_id];
  
              //alert(kilometer)
                var text = $('<label/>')
                .addClass('textTruncate')               
                .text(obj1.transport_name);
                
                var inpu_chk = $('<input/>')
                .attr({'type':'checkbox','name':'transport_id[]'})
                .prop('checked',(kilometer==undefined?false:true))
                .addClass('transport_checkbox')           
                .val(obj1.transport_id);

                
                var inpt_dst = $('<input/>')
                .addClass('form-control cls_transport_distance nearbyDistance')
                .attr({'name':'transport_dist[]', 'placeholder':'Km', 'value':kilometer,'type':'number','min':'0'});
                var dv = $('<div/>').addClass('nrByHolder').append(inpu_chk).append(text)
                col8.append(dv)
                col4.append(inpt_dst);
                rw.append(col8).append(col4);
                scroll.append(rw);
            });
            html.append(scroll);
            col.append($('<div/>').addClass('nearbygroup').append(html));
            $(".cls_nearby").append(col);
          }


        }      

        });
      }
    }
    //console.log(obj);
    //$("#transport_system,#nearby_system").show();
    
    if($('.nearbygroup').length==0){
        $('#nearby_system').hide();
    }else{
      $('#nearby_system').show();
    }
    if($('.transportgroup').length==0){
      $("#transport_system").hide();
    }else{
      $("#transport_system").show();
    }
  }
  $("#location").change( function(){
    chnage_rule();
  });
  
  <?php if(isset($_GET["location"]) && $_GET["location"] != ""){ ?>
    $("#location").val('<?php echo $_GET["location"]; ?>');
    chnage_rule();
  <?php } ?>
  <?php if(isset($_GET["location_sub"]) && $_GET["location_sub"] != ""){ ?>
    $("#location_sub").val('<?php echo $_GET["location_sub"]; ?>');
  <?php } ?>
  
  <?php if(isset($dataset["property"]->location) && $dataset["property"]->location != ""){ ?>
    $("#location").val('<?php echo $dataset["property"]->location; ?>');
    chnage_rule();
  <?php } ?>
  <?php if(isset($dataset["property"]->location_sub) && $dataset["property"]->location_sub != ""){ ?>
    $("#location_sub").val('<?php echo $dataset["property"]->location_sub; ?>');
  <?php } ?>
  
  <?php if(Input::old('location') != ""){ ?>
    $("#location").val('<?php echo Input::old('location'); ?>');
    chnage_rule();
  <?php } ?>
  <?php if(Input::old('location_sub') != ""){ ?>
    $("#location_sub").val('<?php echo Input::old('location_sub'); ?>');
  <?php } ?>
});

$(document).ready(function(){  
  if(window.location.hash=='#changePass'){
    $('[aria-controls="changePass"]').trigger('click');
  }

  if(window.location.hash=='#profile_edit'){
    $('[data-target="#profile_edit"]').trigger('click');
  }
  /*
  if($('.innerContent img').length){
    $('.innerContent img').one("load", function() {}).each(function() {
      if(this.complete){$(this).load()}
      else{$(this).attr('src','http://gipl-ntb026/thaibricks_portal/public/files/properties/no_image.png')}  
    });
  }
  */
  
  $('[data-toggle="tooltip"]').tooltip();
  
function readImage(file) {
    var reader = new FileReader();
    var image  = new Image();

    reader.readAsDataURL(file);  
    reader.onload = function(_file) {
        image.src    = _file.target.result;              // url.createObjectURL(file);
        image.onload = function() {
            var w = this.width,
                h = this.height,
                t = file.type,                           // ext only: // file.type.split('/')[1],
                n = file.name,
                s = ~~(file.size/1024) +'KB';
            //$('#uploadPreview').append('<img src="'+ this.src +'"> '+w+'x'+h+' '+s+' '+t+' '+n+'<br>');
            //alert(this.height)
            return this;
        };
        image.onerror= function() {
            alert('Invalid file type: '+ file.type);
        };      
    };

}
});
</script>

</body>
<!-- body-->
</html>

