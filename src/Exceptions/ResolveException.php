<?php

namespace jyj1993126\Bugly;

use Exception;

/**
 * @author Leon J
 * @since 2017/2/22
 */
class ResolveException extends Exception
{
    /**
     * ResolveException constructor.
     * @param string $key
     */
    public function __construct( $key = '' )
    {
        parent::__construct("解析失败 : $key");
    }
}