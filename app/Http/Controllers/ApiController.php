<?php

namespace VoceCrianca\Http\Controllers;

use VoceCrianca\Traits\ApiResponse;
use VoceCrianca\Traits\JWTTokenBearerTrait;

/**
 * Class ApiController
 * @package VoceCrianca\Http\Controllers
 */
class ApiController extends Controller
{
    use JWTTokenBearerTrait;
    use ApiResponse;
}
