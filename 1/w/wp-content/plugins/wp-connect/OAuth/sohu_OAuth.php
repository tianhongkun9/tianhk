<?php
/** 
 * 搜狐微博操作类 
 * 
 * @package sae 
 * @author Easy Chen 
 * @version 1.0 
 */ 
class sohuClient 
{ 

    // 构造函数 
    function __construct( $akey , $skey , $accecss_token , $accecss_token_secret ) 
    { 
        $this->oauth = new sohuOAuth( $akey , $skey , $accecss_token , $accecss_token_secret ); 
    }

    // 获取其他人资料
	function show_user( $uid )
	{
		$params = array();
		$params['id'] = $uid;
		return $this->oauth->get( 'http://api.t.sohu.com/users/show.json' ,  $params );
	}

    // 其他用户发表时间线
	function user_timeline( $page = 1, $count = 20, $uid)
	{
		$params = array();
		$params['id'] = $uid;
		$params['count'] = $count;
		$params['page'] = $page;

		return $this->oauth->get('http://api.t.sohu.com/statuses/user_timeline.json', $params );
	}

    // 其他帐户听众列表
	function followers( $cursor = NULL , $count = 20 , $uid )
	{
		$params = array();
		$params['id'] = $uid;
		$params['count'] = $count;
		$params['cursor'] = $cursor;
		return $this->oauth->get( 'http://api.t.sohu.com/statuses/followers.json' , $params );
	}

    // 发表微博(文本、图片) 
    function update( $text, $value = '' ) 
    {  
        $param = array(); 
        $param['status'] = urlencode($text);

		if ($value[0] == "image" && $value[1]) {
			$param['status'] = urlencode($param['status']);
			$param['pic'] = $value[1];
			return $this->oauth->post( 'http://api.t.sohu.com/statuses/upload.json' , $param , true );
		} else {
			return $this->oauth->post( 'http://api.t.sohu.com/statuses/update.json' , $param );
		}
    }
    
	// 获取自己信息
    function verify_credentials() 
    { 
        return $this->oauth->get( 'http://api.t.sohu.com/account/verify_credentials.json' );
    } 

}

/** 
 * 搜狐微博 OAuth 认证类 
 * 
 * @package sae 
 * @author Easy Chen 
 * @version 1.0 
 */ 
class sohuOAuth {
    // Contains the last HTTP status code returned.  
    public $http_code; 
    // Contains the last API call. 
    public $url; 
    // Set up the API root URL. 
    public $host = "http://api.t.sohu.com/"; 
    // Set timeout default. 
    public $timeout = 30; 
    // Set connect timeout. 
    public $connecttimeout = 30;  
    // Verify SSL Cert. 
    public $ssl_verifypeer = FALSE; 
    // Respons format. 
    public $format = 'json'; 
    // Decode returned json data. 
    public $decode_json = TRUE; 
    // Contains the last HTTP headers returned. 
    public $http_info; 
    // Set the useragnet. 
    public $useragent = 'SohuOAuth v0.0.1'; 
    /* Immediately retry the API call if the response was not successful. */ 
    //public $retry = TRUE; 
    
    /** 
     *Set API URLS
     */
    function accessTokenURL()  { return 'http://api.t.sohu.com/oauth/access_token'; } 
    function authenticateURL() { return 'http://api.t.sohu.com/oauth/authenticate'; } 
    function authorizeURL()    { return 'http://api.t.sohu.com/oauth/authorize'; } 
    function requestTokenURL() { return 'http://api.t.sohu.com/oauth/request_token'; } 

    /** 
     * Debug helpers 
     */
    function lastStatusCode() { return $this->http_status; } 
    function lastAPICall() { return $this->last_api_call; } 

    /** 
     * construct WeiboOAuth object 
     */ 
    function __construct($consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL) { 
        $this->sha1_method = new OAuthSignatureMethod_HMAC_SHA1(); 
        $this->consumer = new OAuthConsumer($consumer_key, $consumer_secret); 
        if (!empty($oauth_token) && !empty($oauth_token_secret)) { 
            $this->token = new OAuthConsumer($oauth_token, $oauth_token_secret); 
        } else { 
            $this->token = NULL; 
        } 
    } 

    /** 
     * Get a request_token from Weibo 
     * 
     * @return array a key/value array containing oauth_token and oauth_token_secret 
     */ 
    function getRequestToken($oauth_callback = NULL) { 
        $parameters = array(); 
        if (!empty($oauth_callback)) { 
            $parameters['oauth_callback'] = $oauth_callback; 
        }  

        $request = $this->oAuthRequest($this->requestTokenURL(), 'GET', $parameters); 
        $token = OAuthUtil::parse_parameters($request); 
        $this->token = new OAuthConsumer($token['oauth_token'], $token['oauth_token_secret']); 
        return $token; 
    } 

    /** 
     * Get the authorize URL 
     * 
     * @return string 
     */ 
    function getAuthorizeURL($token, $sign_in_with_Weibo = TRUE , $url) { 
        if (is_array($token)) { 
            $token = $token['oauth_token']; 
        } 
        if (empty($sign_in_with_Weibo)) { 
            return $this->authorizeURL() . "?oauth_token={$token}&oauth_callback=" . urlencode($url); 
        } else { 
            return $this->authenticateURL() . "?oauth_token={$token}&oauth_callback=". urlencode($url); 
        } 
    } 

    /** 
     * Exchange the request token and secret for an access token and 
     * secret, to sign API calls. 
     * 
     * @return array array("oauth_token" => the access token, 
     *                "oauth_token_secret" => the access secret) 
     */ 
    function getAccessToken($oauth_verifier = FALSE, $oauth_token = false) { 
        $parameters = array(); 
        if (!empty($oauth_verifier)) { 
            $parameters['oauth_verifier'] = $oauth_verifier; 
        } 


        $request = $this->oAuthRequest($this->accessTokenURL(), 'GET', $parameters); 
        $token = OAuthUtil::parse_parameters($request); 
        $this->token = new OAuthConsumer($token['oauth_token'], $token['oauth_token_secret']); 
        return $token; 
    } 

    /** 
     * GET wrappwer for oAuthRequest. 
     * 
     * @return mixed 
     */ 
    function get($url, $parameters = array()) { 
        $response = $this->oAuthRequest($url, 'GET', $parameters); 
        if ($this->format === 'json' && $this->decode_json) { 
            return json_decode($response, true); 
        } 
        return $response; 
    } 

    /** 
     * POST wreapper for oAuthRequest. 
     * 
     * @return mixed 
     */ 
    function post($url, $parameters = array() , $multi = false) { 
        
        $response = $this->oAuthRequest($url, 'POST', $parameters , $multi ); 
        if ($this->format === 'json' && $this->decode_json) { 
            return json_decode($response, true); 
        } 
        return $response; 
    } 

    /** 
     * DELTE wrapper for oAuthReqeust. 
     * 
     * @return mixed 
     */ 
    function delete($url, $parameters = array()) { 
        $response = $this->oAuthRequest($url, 'DELETE', $parameters); 
        if ($this->format === 'json' && $this->decode_json) { 
            return json_decode($response, true); 
        } 
        return $response; 
    } 

    /** 
     * Format and sign an OAuth / API request 
     * 
     * @return string 
     */ 
    function oAuthRequest($url, $method, $parameters , $multi = false) { 

        if (strrpos($url, 'http://') !== 0 && strrpos($url, 'http://') !== 0) { 
            $url = "{$this->host}{$url}.{$this->format}"; 
        } 

        // echo $url ; 
        $request = OAuthRequest::from_consumer_and_token($this->consumer, $this->token, $method, $url, $parameters); 
        $request->sign_request($this->sha1_method, $this->consumer, $this->token); 
        switch ($method) { 
        case 'GET': 
            //echo $request->to_url(); 
            return $this->http($request->to_url(), 'GET'); 
        default: 
            return $this->http($request->get_normalized_http_url(), $method, $request->to_postdata($multi) , $multi ); 
        } 
    } 

    /** 
     * Make an HTTP request 
     * 
     * @return string API results 
     */ 
	function http($url, $method, $postfields = null , $multi = false) {
		$params = array(
			"method" => $method,
			"timeout" => $this -> timeout,
			"user-agent" => $this -> useragent,
			"sslverify" => $this -> ssl_verifypeer,
			"body" => $postfields,
			"headers" => ($multi) ? array("Content-Type" => "multipart/form-data; boundary=" . OAuthUtil :: $boundary , "Expect: ") : ''
		);
		return class_http($url, $params);
	}
}