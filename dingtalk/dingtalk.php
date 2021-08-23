<?php

class Dingtalk
{

    protected $appkey = "";
    protected $secret = "";
    protected $appid = "";
    protected $appsecret = "";

    /**
     * Dingtask constructor.
     * @param $params
     */
    public function __construct($params)
    {
        $this->appkey = $params['appkey'];
        $this->secret = $params['secret'];
        $this->appid = $params['appid'];
        $this->appsecret = $params['appsecret'];
    }

    /**
     * 获取token
     */
    public function getToken()
    {
        $c = new \DingTalkClient(\DingTalkConstant::$CALL_TYPE_OAPI, \DingTalkConstant::$METHOD_GET,
            \DingTalkConstant::$FORMAT_JSON);
        $req = new \OapiGettokenRequest;
        $req->setAppkey($this->appkey);
        $req->setAppsecret($this->secret);
        $resp = $c->execute($req, null, "https://oapi.dingtalk.com/gettoken");
        return $resp;
    }

    /**
     * 获取UnionId
     */
    public function getUnionId($code = "")
    {
        $c = new \DingTalkClient(\DingTalkConstant::$CALL_TYPE_OAPI, \DingTalkConstant::$METHOD_POST,
            \DingTalkConstant::$FORMAT_JSON);
        $req = new \OapiSnsGetuserinfoBycodeRequest;
        $req->setTmpAuthCode($code);
        $resp = $c->executeWithAccessKey($req, "https://oapi.dingtalk.com/sns/getuserinfo_bycode", $this->appid,
            $this->appsecret);
        return $resp;
    }

    /**
     * 获取用户id
     */
    public function getUserId($unionid, $token)
    {
        $c = new \DingTalkClient(\DingTalkConstant::$CALL_TYPE_OAPI, \DingTalkConstant::$METHOD_GET,
            \DingTalkConstant::$FORMAT_JSON);
        $req = new \OapiUserGetUseridByUnionidRequest;
        $req->setUnionid($unionid);
        $resp = $c->execute($req, $token, "https://oapi.dingtalk.com/user/getUseridByUnionid");
        return $resp;
    }

    /**
     * 获取用户详情
     */
    public function getUserInfo($userid, $token)
    {
        $c = new \DingTalkClient(DingTalkConstant::$CALL_TYPE_OAPI, DingTalkConstant::$METHOD_GET,
            DingTalkConstant::$FORMAT_JSON);
        $req = new OapiUserGetRequest;
        $req->setUserid($userid);
        $resp = $c->execute($req, $token, "https://oapi.dingtalk.com/user/get");
        return $resp;
    }

    //

}

