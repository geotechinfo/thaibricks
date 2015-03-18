@extends('layouts.ajax')
@section('content')

<div>
<table width="620" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#eff2f3" style="border-top:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">
  <tbody><tr>
    <td style="padding:13px 12px 0px 12px"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border-top:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9">
      <tbody><tr>
        <td style="padding:7px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td bgcolor="#fafafa" style="color:#000;padding-bottom:5px"><table width="45%" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td style="line-height:33px">&nbsp;</td>
                <td>
                  <div style="width:225px">
                    <div style="font-size:33px;font-family:'Times New Roman',Times,serif;text-align:center;line-height:30px">
                      <a href="{{URL::to('/')}}" style="text-decoration:none;color:#000000" target="_blank">
                          {{ HTML::image('images/logo.jpg', '', array('class' => 'logo')) }}
                      </a>
                    </div>
                  </div>
                </td>
              </tr>
                </tbody></table></td>
              </tr>
            </tbody></table></td>
          </tr>
        </tbody></table></td>
      </tr>
    </tbody></table>
  

<table width="620" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#eff2f3" style="border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">
  <tbody><tr>
    <td style="padding:0px 12px 0px 12px"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9">
      <tbody><tr>
        <td style="padding:0px 14px"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tbody><tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody><tr>
                    <td style="color:#c3262d;font-size:19px;font-family:Arial,Helvetica,sans-serif;padding-top:14px">Login Details Notification</td>
                  </tr>
                  <tr>
                    <td style="padding-top:5px;color:#313131"><br>
                      Dear {{$dataset['user']->first_name." ".$dataset['user']->last_name}},<br>
                      <br>
                      Thank you for registering with <font color="#CC0000">thaibricks</font>.com<br>
                          </td>                
                </tr>
                  
                  
                                    <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td bgcolor="#eff2f3" style="color:#313131;border:1px solid #d5d8d9;padding:8px 13px;line-height:16px">
                    
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tbody><tr>
                        <td valign="top" style="padding:5px 0px"><strong>Your Login Credentials:</strong></td>
                      </tr>
                      <tr>
                        <td valign="top" style="padding:5px 0px">
                          <table border="0" cellspacing="0" cellpadding="0" style="line-height:18px">
                              <tbody><tr>
                                <td>Username / Email Id</td>
                                <td style="padding:0px 10px">:</td>
                                <td><strong><a href="mailto:{{$dataset['user']->email}}" target="_blank">{{$dataset['user']->email}}</a></strong></td>
                              </tr>
                              <tr>
                                <td>Password</td>
                                <td style="padding:0px 10px">:</td>
                                <td><strong>{{$dataset['password']}}</strong></td>
                              </tr>
                            </tbody></table>                        </td>
                      </tr>
                    </tbody></table>                    </td>
                  </tr>
                                    
                  
                  <tr>
                    <td>
                      <p style="margin-top:10px">
                        Enter your username and password to 
                        <a href="{{URL::to('login')}}" target="_blank">
                          <font color="#005bcc">log in.</font>
                        </a> 
                        We recommend that you preserve this mail.</p>
                    </td>
               
               
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td style="padding:4px 0 0 0;line-height:16px;color:#313131">Your Trusted Partner,<br>
                      <a href="{{URL::to('/')}}" style="color:#313131" target="_blank">{{URL::to('/')}}</a><br>
                    </td>
                  </tr>
                </tbody></table></td>
                
              </tr>
            </tbody></table></td>
          </tr>
        </tbody></table></td>
      </tr>
            
    </tbody></table></td>
  </tr>

</tbody></table>














<table width="620" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#eff2f3" style="border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9;border-bottom:1px solid #d5d8d9;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000">
  <tbody><tr>
    <td style="padding:0px 12px 0px 12px"><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
      <tbody><tr>
        <td style="padding:0px 14px 0px;border-bottom:1px solid #d5d8d9;border-right:1px solid #d5d8d9;border-left:1px solid #d5d8d9">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#eff2f3" style="font-size:11px;color:#727272;padding:9px 0 10px 18px;line-height:16px"><p style="margin:0px;padding:0px">All trademarks, logos and names are properties of their respective owners. All Rights Reserved.<br>
          © Copyright 2014 Times Internet Limited. </p></td>
      </tr>
    </tbody></table></td>
  </tr>
</tbody></table>
<table width="620" border="0" cellspacing="0" cellpadding="0" align="center" style="padding-bottom:2px">
  <tbody><tr>
      <td height="50px" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#000;background-color:#f9f9f9;padding-left:10px;padding-right:10px">
        <b> Note: </b>
          In case you are not receiving property updates from on SMS, please de-list your mobile number from NDNC List by calling 1909. Further, as per TRAI guidelines, w.e.f. 27th September 2011, SMS alerts are sent between <span class="aBn" data-term="goog_276238970" tabindex="0"><span class="aQJ">9 a.m. - 9 p.m.</span></span>
    </td>
  </tr>
</tbody></table><div class="yj6qo"></div><div class="adL">
</div></div>
@stop()