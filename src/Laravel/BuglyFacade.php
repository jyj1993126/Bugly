<?php
/**
 * @author Leon J
 * @since 2017/2/23
 */

namespace jyj1993126\Bugly\Laravel;

use Illuminate\Support\Facades\Facade;

class BuglyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Bugly';
    }
}