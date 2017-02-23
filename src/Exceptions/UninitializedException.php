<?php
/**
 * @author Leon J
 * @since 2017/2/22
 */

namespace jyj1993126\Bugly;

use Exception;

class UninitializedException extends Exception
{
    public function __construct( ...$key )
    {
        parent::__construct( '这些变量未初始化: ' . implode(',', $key) );
    }
}