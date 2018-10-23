<?php

namespace VoceCrianca\Traits;

use Illuminate\Support\Facades\Request;

/**
 * Trait RequestHeadersTrait
 * @package VoceCrianca\Traits
 */
trait RequestHeadersTrait
{

    /**
     * @return array
     */
    public function requestHeaders()
    {
        $headers = [];
        $headers['userAgent'] = Request::server('HTTP_USER_AGENT');
        $headers['ip'] = Request::ip();
        $headers['urlReferer'] = Request::server('HTTP_REFERER');
        return $headers;
    }

}
