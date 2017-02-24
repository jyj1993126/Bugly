<?php
/**
 * @author Leon J
 * @since 2017/2/23
 */

namespace jyj1993126\Bugly\Laravel;

use Illuminate\Http\Request;
use jyj1993126\Bugly\Service\Bugly as BuglySDK;

class Bugly extends BuglySDK
{
    /**
     * @param Request $request
     * @return BuglySDK
     */
    public function resolveRequest(Request $request)
    {
        return parent::resolve($request->all());
    }
}