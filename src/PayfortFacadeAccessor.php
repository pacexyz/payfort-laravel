<?php

namespace PayfortLaravel;


use PayfortLaravel\Services\PayfortAPI;
use PayfortLaravel\Services\PayfortRedirection;

class PayfortFacadeAccessor
{
    /**
     * Get Payfort API services provider
     *
     * @param array $extra_config Extra configurations
     * @return \PayfortLaravel\Services\PayfortAPI
     */
    public static function api($extra_config = [])
    {
        $config = array_merge(config('payfort'), $extra_config);
        return new PayfortAPI($config);
    }

    /**
     * Get Payfort Redirection services provider
     *
     * @param array $extra_config Extra configurations
     * @return \PayfortLaravel\Services\PayfortRedirection
     */
    public static function redirection($extra_config = [])
    {
        $config = array_merge(config('payfort'), $extra_config);
        return new PayfortRedirection($config);
    }
}