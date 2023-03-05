<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     description="Waaiburg API Documentation",
 *     version="1.0.0",
 *     title="Waaiburg API",
 * )
 * 
 *  @OA\Tag(
 *     name="users",
 *     description="API Endpoints of Projects"
 * )
 * 
 * @OA\Tag(
 *     name="userTypes",
 *     description="API Endpoints of userTypes"
 * )
 * 
 * @OA\Tag(
 *     name="sections",
 *     description="API Endpoints of sections"
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
