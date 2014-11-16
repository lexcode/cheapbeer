<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LiveOauthApp
 *
 * @author @cpk
 */


class LiveOauthApp {
    //put your code here
    
 
//Add in the client id and domain for the URI redirect. The wl.signin%20wl.basic is a reference to the Application Permissions requested (see http://msdn.microsoft.com/en-us/library/live/hh826540.aspx#common). You need the %20 between the signin and basic or any other permissions you call. Also make sure you calling "code" for the response type. That should take care of the ReST call now let's move on to the oauth-hotmail.php script. We'll use the same standard field values and CuRL call to get the access_token. Note the url is different: https://login.live.com/oauth20_token.srf
    public $client_id = '00000000480FE40C';
    public $client_secret = 'wHyJfCKg-akEVF-J1-itIQPf7qSteNyz';
    public $redirect_uri = 'http://www.simplewebagency.com/invitations/outlook';
    


public function getAuthorizationUrl(){
   $base = 'https://login.live.com/oauth20_authorize.srf?';
    $fields=array(
    
    'scope'=> urlencode('wl.signin wl.basic wl.emails wl.birthday'),
    'client_id'=>  urlencode($this->client_id),
    'redirect_uri'=>  urlencode($this->redirect_uri),
    'response_type'=>  urlencode('code')
    
);
$post = array();
foreach($fields as $key=>$value) { $post[] = $key.'='.$value ; }
$n=implode('&', $post);
unset($post);
$base.=$n;


return $base ;
    
}

public function getAccessToken($auth_code){
    
 
$fields=array(
    'code'=>  urlencode($auth_code),
    'client_id'=>  urlencode($this->client_id),
    'client_secret'=>  urlencode($this->client_secret),
    'redirect_uri'=>  urlencode($this->redirect_uri),
    'grant_type'=>  urlencode('authorization_code')
);
$post = '';
foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
$post = rtrim($post,'&');

$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,'https://login.live.com/oauth20_token.srf');
curl_setopt($curl,CURLOPT_POST,5);
curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
$result = curl_exec($curl);
curl_close($curl);

$response =  json_decode($result);


return $response ;
}

public function getContacts($accesstoken){
    
    $url = 'https://apis.live.net/v5.0/me/contacts?access_token='.$accesstoken.'';
    
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,$url);
curl_setopt($curl, CURLOPT_HEADER, 0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
$result = curl_exec($curl);
curl_close($curl);

return $result ;
    
}


}

?>
