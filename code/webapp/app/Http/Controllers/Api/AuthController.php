<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/**
 * @OA\Schema(
 * schema="Auth",
 * @OA\Property(
 * property="user_type_id",
 * type="integer",
 * format="int64",
 * example=1
 * ),
 * @OA\Property(
 * property="firstname",
 * type="string",
 * example="John"
 * ),
 * @OA\Property(
 * property="surname",
 * type="string",
 * example="Doe"
 * ),
 * @OA\Property(
 * property="email",
 * type="string",
 * example="email"
 * ),
 * @OA\Property(
 * property="password",
 * type="string",
 * example="password"
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * example="2021-05-01 12:00:00"
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * example="2021-05-01 12:00:00"
 * ),
 * )
 */

class AuthController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request)
    {
        try {
            // Define what fields can be used when creating a user
            // Also define which fields are required
            $request->request->add(["user_type_id" => 2]);
            $validateUser = Validator::make($request->all(), [
                "user_type_id" => "required",
                "firstname" => "required",
                "surname" => "required",
                "email" => "required|email|unique:users,email",
                "password" => "required",
            ]);

            // When field is incorrect or missing, throw an error
            if ($validateUser->fails()) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => "validation error",
                        "error" => $validateUser->errors(),
                    ],
                    401
                );
            }

            // Create user with the send information
            $user = User::create([
                "user_type_id" => $request->user_type_id,
                "firstname" => $request->firstname,
                "surname" => $request->surname,
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);

            // When successfull send a message and create API Token
            return response()->json(
                [
                    "status" => true,
                    "message" => "User Created Successfully",
                    "Token" => $user->createToken("API TOKEN")->plainTextToken,
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "status" => false,
                    "message" => $th->getmessage(),
                ],
                500
            );
        }
    }

    /**
     * Login User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                "email" => "required|email",
                "password" => "required",
            ]);

            if ($validateUser->fails()) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => "validation error",
                        "error" => $validateUser->errors(),
                    ],
                    401
                );
            }

            if (!Auth::attempt($request->only(["email", "password"]))) {
                return response()->json(
                    [
                        "status" => false,
                        "message" => "Email & Password do not match.",
                    ],
                    401
                );
            }

            $user = User::where("email", $request->email)->first();

            return response()->json(
                [
                    "status" => true,
                    "message" => "User Logged In Successfully",
                    "Token" => $user->createToken("API TOKEN")->plainTextToken,
                ],
                200
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    "status" => false,
                    "message" => $th->getmessage(),
                ],
                500
            );
        }
    }
}
