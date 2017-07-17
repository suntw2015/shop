<?php

require_once 'aliyun-php-sdk-core/Config.php';
require_once 'aliyun-php-sdk-core/Autoloader/Autoloader.php';
require_once 'aliyun-php-sdk-core/Profile/DefaultProfile.php';
require_once 'aliyun-php-sdk-core/DefaultAcsClient.php';
require_once 'Dysmsapi/Request/V20170525/SendSmsRequest.php';
include_once 'Dysmsapi/Request/V20170525/QuerySendDetailsRequest.php';

Class CI_SmsCenter{

    //阿里云短信配置
    private static $aliKeyId = '';
    private static $alikeySecret = '';

    private static $config = array(
        //新订单通知管理者
        'new_order_manage'  => array(
            'sign_name'     => '粮仓良铺',
            'template_code' => 'SMS_77370100'
        )
    );

    public function send($sms_name,$recev,$data){
        $res =  array(
            'code'  => -1,
            'msg'   => '未知错误'
        );

        if(!isset(self::$config[$sms_name])){
            $res['msg'] = '短信类别未定义';
            return $res;
        }

        if(empty($recev)){
            $res['msg'] = '短信接受者为空';
            return $res;
        }

        if(empty($data)){
            $res['msg'] = '短信变量列表为空';
            return $res;
        }

        $data = json_encode($data);
        $data = '';

        $smsConfig = self::$config[$sms_name];

        $accessKeyId = self::$aliKeyId;
        $accessKeySecret = self::$alikeySecret;
        
        $product = "Dysmsapi";
        //短信API产品域名
        $domain = "dysmsapi.aliyuncs.com";
        //暂时不支持多Region
        $region = "cn-beijing";
        
        //初始化访问的acsCleint
        $profile = DefaultProfile::getProfile($region, $accessKeyId, $accessKeySecret);
        DefaultProfile::addEndpoint("cn-beijing", "cn-beijing", $product, $domain);
        $acsClient= new DefaultAcsClient($profile);

        $request = new Dysmsapi\Request\V20170525\SendSmsRequest;

        //必填-短信接收号码。支持以逗号分隔的形式进行批量调用，批量上限为20个手机号码,批量调用相对于单条调用及时性稍有延迟,验证码类型的短信推荐使用单条调用的方式
        $request->setPhoneNumbers($recev);
        //必填-短信签名
        $request->setSignName($smsConfig['sign_name']);
        //必填-短信模板Code
        $request->setTemplateCode($smsConfig['template_code']);
        //选填-假如模板中存在变量需要替换则为必填(JSON格式)
        $request->setTemplateParam($data);
        //选填-发送短信流水号
        // $request->setOutId("1234");
        //发起访问请求
        $acsResponse = $acsClient->getAcsResponse($request);

        if($acsResponse->Code != 'OK'){
            $res['msg'] = sprintf('RequestId:%s Code:%s Message:%s',$acsResponse->RequestId,$acsResponse->Code,$acsResponse->Message);
            return $res;
        }

        $res['code'] = 0;
        $res['msg'] = '发送成功';

        return $res;
    }
}