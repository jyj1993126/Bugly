<?php

namespace jyj1993126\Bugly;

/**
 * @author Leon J
 * @since 2017/2/22
 */
class Utils
{
    /**
     * @param array $request
     * @param string $appKey
     * @return bool
     */
	public static function validate( array $request, $appKey )
	{
        ksort($request, SORT_STRING);
        $paramString = '';
        foreach( $request as $key => $param )
        {
            if( $key == 'signature' )
            {
                continue;
            }
            $paramString .= $key . $param;
        }

        return $request['signature'] == hash_hmac('sha1',$paramString,$appKey);
	}

    /**
     * @param $eventContent
     * @param $password
     * @return string
     */
    public static function decrypt( $eventContent, $password )
    {
        $eventContent = base64_decode($eventContent);
        $password = base64_decode($password);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB), MCRYPT_RAND);
        $encrypt_eventContent = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $password, $eventContent, MCRYPT_MODE_ECB, $iv);
        $encrypt_eventContent = trim($encrypt_eventContent);
        $encrypt_eventContent = self::stripPKSC7Padding($encrypt_eventContent);

        return $encrypt_eventContent;
    }

    /**
     * @param $source
     * @return string
     */
    public static function stripPKSC7Padding($source)
    {
        $source = trim($source);
        $char = substr($source, -1);
        $num = ord($char);
        if ($num == 62) {
            return $source;
        }
        $source = substr($source, 0, -$num);

        return $source;
    }

}
