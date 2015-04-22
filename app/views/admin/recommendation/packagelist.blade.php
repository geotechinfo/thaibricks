<?php if(count($dataset['list'])){ ?>
{{isset($dataset['heading'])?$dataset['heading']:''}}
<table class="responsive table table-striped table-bordered"  width="100%" cellspacing="5" cellpadding="2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Duration</th>
                        <th>Grace Period</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="list" class="user_list">
                    @foreach($dataset['list'] as $k=>$v)
                    <tr data-state="s{{$v->status}}">
                        <td>
                            {{$k+1}}
                        </td>
                        <td>
                            {{$v->duration}} Day(s)
                        </td>
                        <td>
                            {{$v->grace_period}} Day(s)
                        </td>
                        <td>                           
                            &#xe3f; {{$v->price}}
                        </td>
                        
                        <td>
                          <input type="radio"  name="ad_package_id" value="{{$v->ad_package_id}}" data-image_height="{{$v->image_height}}" data-image_width="{{$v->image_width}}" data-duration="{{$v->duration}}" data-price="{{$v->price}}" data-grace_period="{{$v->grace_period}}">                          
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>  
<?php }else{?>
    <div class="alert alert-warning">
        <span class="glyphicon glyphicon-exclamation-sign"></span> No Package Available for this combimation
    </div>
<?php }?>