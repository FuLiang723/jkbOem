<?php
$id = 'demo1';
$secret = 'demo1pass';
$scope = '';
$username = 'dengsingle@163.com';
$password = md5('123456');

$post_data = 'grant_type=password&username='.$username.'&password='.$password.'&client_id='.$id.'&client_secret='.$secret;
$token_url = 'http://dev-api.jiankongbao.com/v2/oauth/token.json';

$token_response = `curl -s $token_url --data "$post_data"`;

if( $token = json_decode($token_response) )
{
    if( isset($token->access_token) )
        $access_token = $token->access_token;
    else
    {
        echo $token_response,"\n";
    }
}
else
    exit($token_response);

//login api
$email = 'leon9527@jiankongbao.com';
$password = md5('111111');
$resource_url = 'http://dev-api.jiankongbao.com/v2/user/login.json?access_token='.$access_token;
$res = `curl -s --data "email=$email&password=$password" '$resource_url'`;

//site task list api
$resource_url = 'http://dev-api.jiankongbao.com/v2/site/allowlists.json?access_token='.$access_token.'&user_id=251880';
$res = `curl -s '$resource_url'`;

//server tasj list api
$resource_url = 'http://dev-api.jiankongbao.com/v2/server/allowlists.json?access_token='.$access_token.'&user_id=251880';
$res = `curl -s '$resource_url'`;

echo "$res\n";
print_r(json_decode($res));
