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
 * @OA\Tag(
 *    name="roles",
 *   description="API Endpoints of roles"
 * )
 * @OA\Tag(
 *     name="questions",
 *     description="API Endpoints of questions"
 * )
 * @OA\Tag(
 *     name="infos",
 *     description="API Endpoints of infos"
 * )
 * @OA\Tag(
 *     name="infocontents",
 *     description="API Endpoints of infocontents"
 * )
 * @OA\Tag(
 *     name="departmentlists",
 *     description="API Endpoints of departmentlists"
 * )
 * @OA\Tag(
 *     name="departments",
 *     description="API Endpoints of departments"
 * )
 * @OA\Tag(
 *     name="auths",
 *     description="API Endpoints of auths"
 * )
 * @OA\Tag(
 *     name="answers",
 *     description="API Endpoints of answers"
 * )
 */


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
