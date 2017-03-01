<?php

namespace jyj1993126\Bugly\Service;

use jyj1993126\Bugly\ResolveException;
use jyj1993126\Bugly\Utils;
use stdClass;

/**
 * @author Leon J
 * @since 2017/2/22
 */
class Bugly
{
    const REQUEST_PARAMS = [ 'eventType', 'eventContent', 'timestamp', 'isEncrypt', 'signature' ];

    /**
     * @var array
     */
    public $requestBody;

    /**
     * @var stdClass
     */
    public $eventContentBody;

    /**
     * @param array $request
     * @param $appKey
     * @return $this
     * @throws ResolveException
     */
    public function resolve(array $request, $appKey)
    {

        if (!Utils::validate($request, $appKey)) {
            throw new ResolveException( 'signature' );
        }

        foreach (self::REQUEST_PARAMS as $param) {
            if (!key_exists($param, $request)) {
                throw new ResolveException($param);
            }
            switch ($param) {
                case 'signature':
                    break;
                case 'eventContent':
                    if( $request['isEncrypt'] ) {
                        $eventContentBody = Utils::decrypt($request[$param], $appKey);
                    }else {
                        $eventContentBody = $request[$param];
                    }
                    $this->eventContentBody = json_decode($eventContentBody);
                    break;
                default:
                    $this->requestBody[$param] = $request[$param];
            }
        }

        return $this;
    }

    /**
     * @param $key
     * @return null
     */
    public function __get($key)
    {
        if( $key == 'eventContent' )
        {
            return $this->eventContentBody;
        }
        if( key_exists($key, $this->requestBody) )
        {
            return $this->requestBody[$key];
        }
        return null;
    }

}