<?php

namespace Vallory\KrayinFormatter\Http\Middleware;

use Closure;
use Webkul\Core\Core;

class SetTimezone
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $timezoneConfig = core()->getConfigData('general.general.formatting.timezone');

        $timezone = config('app.timezone'); // Default fallback

        if ($timezoneConfig === 'auto') {
            // Try to get from cookie
            $cookieTimezone = $request->cookie('krayin_timezone');
            if ($cookieTimezone && in_array($cookieTimezone, timezone_identifiers_list())) {
                $timezone = $cookieTimezone;
            }
        } elseif ($timezoneConfig) {
            // Use manual config if set (and not 'auto')
            $timezone = $timezoneConfig;
        }

        if ($timezone) {
            config(['app.timezone' => $timezone]);
            date_default_timezone_set($timezone);
        }

        return $next($request);
    }
}
