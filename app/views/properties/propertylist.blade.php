@extends('layouts.dashboard')

@section('content')

<div class="alert alert-success" id="success_msg" style="display:none"></div>
<section class="">
  <h3>
    <span class="fa fa-map-marker"></span>My Property
    
  </h3>
  <div class="divider"></div>
  <div class="mypropertyThumb clearfix">
  <div class="propertylistwrap">
  	@if(Session::get('success'))
    <div class="margin-top-10 message">
    <p class="btn-success text-success padding-5"><span class="fa fa-check"></span>{{{ Session::get('success') }}}</p>
    </div>
    @endif
    
    @if(Session::get('info'))
    <div class="margin-top-10 message">
    <p class="btn-info text-info padding-5"><span class="fa fa-info"></span>{{{ Session::get('info') }}}</p>
    </div>
    {{{ Session::forget('info') }}}
    @endif

    <ul class="portfolio-items relatedpropety myproperty clearfix">
    <li class="portfolio-item col-md-2 addpropertythumb"> 
          <div class="addnewbutton">
            <a href="{{URL::to('/property/create')}}" class="portfolio-item-add">
                <p class="imagebg">
                    <span class="fa fa-map-marker"></span>
                    <span class="button type-submit width-auto"><span class="fa fa-plus-square"></span>Add Property</span>
                </p>
            </a>
          </div>
          </li>
  	@foreach($dataset["properties"] as $property)
    <?php 
        $remaining_days = (VALIDITY_DAYS - floor((strtotime("now")-$property->last_active)/3600/24));
        $remaining_text = ""; 
        $class="";
        if($remaining_days>=0){
          $remaining_text =  " $remaining_days days remaining. "; $class="alert-success";
        }else{
          $remaining_text = "Inactive for ".($remaining_days*(-1)). " days"; $class="alert-warning";
        }
    ?>
      <li class="portfolio-item col-md-2 cls_extend"> 
          <div class="small alert {{$class}}" style="position: absolute;top: 4px;left: 4px;padding: 1px
           5px;border-radius: 2px;z-index: 1;">
              {{$remaining_text}}
          </div>
          <?php if($remaining_days < WARNING_DAYS && $remaining_days>=0){ ?>
          <div class="" style="position: absolute;top: 4px;right: 4px;z-index: 1;">
              <a href="javascript:;" class="btn btn-success btn-xs cls_extend_btn" data-id="{{ $property->property_id}}" title=" Enable your Property">Extend</a>
          </div>
          <?php }else if($remaining_days<0){ ?>
          <div class="" style="position: absolute;top: 4px;right: 4px;z-index: 1;">
              <a href="javascript:;" class="btn btn-success btn-xs cls_extend_btn" data-id="{{ $property->property_id}}" title=" Enable your Property">Enable</a>
          </div>
          <?php } ?>   
          <a href="{{URL::to('/property/edit')}}/{{{ $property->property_id }}}" class="item-inner btn-block"> 
              <span class="fa fa-pencil"></span>
              {{ HTML::image(asset('files/properties')."/".$property->media[0]->media_data, '', array('class' => 'img-responsive propertylistimg')) }}
              <span class="typeOfProp">{{$property->deal_name}}</span>
          </a> 
          <div class="commentwrap asbestos btn-block">
            <div>           
              <div class="projectinfobtn center addpropertyname"><a href="{{URL::action('PropertiesController@show',[''])}}/{{{ $property->property_id }}}" class="textEllipsis">{{{ $property->title }}}</a></div>
              <div class="darkGrey locationprice">
                <span class="lname">{{{ $property->locationsub_name }}}, {{{ $property->location_name }}}</span> | 
                <span class="price">&#xe3f; {{{ number_format($property->price, 0, ".", ",") }}}</span>
              </div>
            </div>
          </div> 
      </li>


     
    
    @endforeach
    
    </ul>
    
    
    
  </div>
  </div>
</section>

<script type="text/javascript">
  $(document).ready(function(){
    $('.cls_extend_btn').click(function(){
      var ths = $(this);
      ths.button('loading')
      var property_id = $(this).data('id')
      $.post(
        '<?php echo URL::to("property/extend")?>',
        {
          property_id:property_id
        },
        function(m){
          //alert(m);
          ths.button('reset');
          $('#success_msg').show().text('You property has been successfully enabled.').delay(5000).fadeOut();
          ths.hide();
          ths.closest('.cls_extend').find('.small').hide();
        }
      )
    });
  });
</script>
@stop