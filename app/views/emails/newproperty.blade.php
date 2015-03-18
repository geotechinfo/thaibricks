<table width="100%" border="0" cellspacing="0" cellpadding="7" style="max-width:620px;margin:auto;border:1px solid #d5d8d9;color:#545454;background:#eff2f3;font:13px Tahoma,Geneva,sans-serif">
  <tbody><tr>
    <td>
      <div style="border:1px solid #d5d8d9;border-bottom:none">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f9fafa">
                  <tbody><tr>
                    <td valign="top" style="min-width:163px">
                      {{ HTML::image('images/logo.jpg', '', array('class' => 'logo')) }}
                    </td>                    
                  </tr>
                </tbody></table>
                </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #d5d8d9;background:#fff;border-bottom:none;border-top:none">
         
          <tbody><tr>
            <td style="padding:20px 16px 15px">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td style="font-family:Tahoma,Geneva,sans-serif">
                <p style="margin:0px;padding-bottom:7px">Dear {{$dataset['user']->first_name." ".$dataset['user']->last_name}},</p>
                <p style="margin-top:0px;padding-bottom:6px">Thank you for posting your property with us! Your property [{{$dataset['property']->title}}] will be screened in 24 business hours. Once approved, it will start featuring in the search results.</p>
                </td>
              </tr>
              <tr>
                <td style="border:1px solid #e9eaeb;padding:8px 15px 8px 16px">
                  <table border="0" cellspacing="0" cellpadding="0" style="font-family:'Segoe UI';font-size:12px;color:#9a9a9a;max-width:351px;padding-right:9px;float:left">
                      <tbody>
                      <tr>
                        <td style="font-size:15px;font-weight:bold;line-height:18px;padding-bottom:4px">
                            <a href="#" style="text-decoration:none;padding-right:7px">{{$dataset['property']->description}}</a>
                            
                        </td>
                        <td rowspan="2">
                          <a href="{{URL::to('/property/show')}}/{{{ $dataset['property']->property_id }}}" class="item-inner btn-block"> 
                              {{ HTML::image(asset('files/properties')."/".$dataset['property']->media[0]->media_data, '', array('class' => 'img-responsive propertylistimg')) }}
                          </a> 
                        </td>
                      </tr>
                      <tr>
                        <td style="font-size:18px;font-weight:bold;padding-bottom:7px">
                            <table border="0" cellspacing="0" cellpadding="0">
                              <tbody><tr>
                                <td>
                                <font style="color:#fe7800;padding-right:4px">
                                &#xe3f; {{{ number_format($dataset['property']->price, 2, ".", ",") }}}
                                </font>
                                
                              </td></tr>
                            </tbody></table>
                        </td>
                      </tr>
                     
                      <tr>
                        <td style="padding:9px 0 10px"><a href="#14bbf5f4e83daf5b_14bbf58f3ef2dd45_14bbf56f4b40138f_" style="color:#9a9a9a">Owner: indiaTimesUser </a></td>
                      </tr>
                    </tbody></table>
                    

                </td>
              </tr>
              
                                          
              
                             <tr>
              
                <td style="padding-left:15px">
                
<div style="background:#39a0fd;background:linear-gradient(#39a0fd,#1f86e3);border-radius:15px;min-height:20px;margin:auto;border:solid 1px #1f86e3;width:68%"></div>
</div>
<p></p>
                            <p style="width:235px;margin-bottom:0px">You're doing good. Increase the completion score for your property by taking a few steps:</p>
                        </td>
                      </tr>
                    </tbody></table>
                    
                    <table border="0" cellspacing="0" cellpadding="0" style="float:left;width:242px;padding-bottom:10px">
                      <tbody><tr>
                        <td style="font-size:13px;color:#282828">
                        <p style="margin:0 0 3px;padding-left:3px"><font><img src="https://ci4.googleusercontent.com/proxy/X1vX2R9-shw0znMkPuINw_8hFygwquPjV7Q95BiewbUd0-Ip-ujg-HybS37WcYTtk9SJK7dz4W5twGjteRzZBq4=s0-d-e1-ft#http://cdn.staticmb.com/images/arrowNew.gif" width="9" height="9" style="padding-right:7px" class="CToWUd"></font><font>Specify the amenities</font></p>
                        <p style="margin:0 0 3px;padding-left:3px"><font><img src="https://ci4.googleusercontent.com/proxy/X1vX2R9-shw0znMkPuINw_8hFygwquPjV7Q95BiewbUd0-Ip-ujg-HybS37WcYTtk9SJK7dz4W5twGjteRzZBq4=s0-d-e1-ft#http://cdn.staticmb.com/images/arrowNew.gif" width="9" height="9" style="padding-right:7px" class="CToWUd"></font><font>Add a property video</font></p>
                        </td>
                      </tr>
                    </tbody></table>
                    
                    </td>
                  </tr>
                 
                </tbody></table>

                </td>
              </tr>
              
            </tbody></table>
            </td>
          </tr>
        </tbody></table>
        
        
        <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tbody><tr>
        <td style="padding:0px 14px 0px;border-bottom:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#eff2f3" style="font-size:11px;color:#727272;padding:9px 0 10px 18px;line-height:16px"><p style="margin:0px;padding:0px">All trademarks, logos and names are properties of their respective owners. All Rights Reserved.<br>
          © Copyright 2014 Times Internet Limited.  </p></td>
      </tr>
    </tbody></table>
        
        
    </td>
  </tr>
 
</tbody></table>