<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * @OA\Info(
 *  title="Laravel 11 REST APIs Documentation with Sanctum",
 *  version="1.0.1"
 * )
 * 
 */
class ApiController extends Controller
{
    // Register (POST - name, email, password)
    /**
     * @OA\Post(
     *      path="/api/register",
     *      operationId="register",
     *      tags={"Register"},
     *      summary="User Register API",
     *      description="This API creates a new user",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *            required={"name","email", "password", "password_confirmation"},
     *            @OA\Property(property="name", type="string", example="moses"),
     *            @OA\Property(property="email", type="string", example="moseswisegit@gmail.com"),
     *            @OA\Property(property="password", type="string", format="password", example="123456789"),
     *            @OA\Property(property="password_confirmation", type="string", format="password", example="123456789")
     *         ),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"name","email", "password", "password_confirmation"},
     *               @OA\Property(property="name", type="string", example="moses"),
     *               @OA\Property(property="email", type="string", example="moseswisegit@gmail.com"),
     *               @OA\Property(property="password", type="string", format="password", example="123456789"),
     *               @OA\Property(property="password_confirmation", type="string", format="password", example="123456789")
     *            )
     *         )
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Registered Successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="User registered successfully")
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Validation error")
     *          )
     *       ),
     *      @OA\Response(response=400, description="Bad Request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function register(Request $request){
        // Validation
        $request->validate([
            "name" => "required|string",
            "email"=> "required|string|email|unique:users",
            "password" => "required|confirmed", //password_confirmation
        ]);
        // User model to save user in database
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);

        // Response
        return response()->json([
            "status" => true,
            "message" => "User registered successfully"
        ]);
    }

    // Login (POST - email, password)
    /**
     * @OA\Post(
     *      path="/api/login",
     *      operationId="login",
     *      tags={"Login"},
     *      summary="User Login API",
     *      description="This API logs in the user",
     *      @OA\RequestBody(
     *         @OA\JsonContent(
     *            required={"email", "password"},
     *            @OA\Property(property="email", type="string", example="moseswisegit@gmail.com"),
     *            @OA\Property(property="password", type="string", format="password", example="123456789")
     *         ),
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password"},
     *               @OA\Property(property="email", type="string", example="moseswisegit@gmail.com"),
     *               @OA\Property(property="password", type="string", format="password", example="123456789")
     *            )
     *         )
     *    ),
     *      @OA\Response(
     *          response=200,
     *          description="Logged in Successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="Login successful"),
     *              @OA\Property(property="token", type="string", example="your-access-token"),
     *              @OA\Property(property="tokenId", type="integer", example=1)
     *          )
     *       ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Validation error")
     *          )
     *       ),
     *      @OA\Response(response=400, description="Bad Request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function login(Request $request){
        // Validation
        $request->validate([
            "email"=> "required|string|email",
            "password" => "required", 
        ]);

        // Check user by email
        $user = User::where("email", $request->email)->first();

        // Check user by password
        if(!empty($user)){
            if (Hash::check($request->password, $user->password)) {
                // Login is ok 
                $tokenInfo = $user->createToken("myToken");
                $token = $tokenInfo->plainTextToken; // Token value
                $tokenId = $tokenInfo->accessToken->id; // Token ID

                return response()->json([
                    "status" => true,
                    "message" => "Login successful",
                    "token" => $token,
                    "tokenId" => $tokenId
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Password didn't match."
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
                "message" => "Invalid credentials"
            ]);
        }
    }

    // Profile (GET - Auth Token)
    /**
     * @OA\Get(
     *      path="/api/profile",
     *      operationId="profile",
     *      tags={"Profile"},
     *      summary="Get User Profile",
     *      description="Fetches the profile information of the logged-in user",
     *      @OA\Response(
     *          response=200,
     *          description="Profile information",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="Profile information"),
     *              @OA\Property(property="data", type="object", example={"name": "moses", "email": "moseswisegit@gmail.com"})
     *          )
     *       ),
     *      @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function profile(){
        $userData = auth()->user();

        return response()->json([
            "status" => true,
            "message" => "Profile information",
            "data"    => $userData
        ]);
    }

    // Logout (GET - Auth Token)
    /**
     * @OA\Get(
     *      path="/api/logout",
     *      operationId="logout",
     *      tags={"Logout"},
     *      summary="User Logout",
     *      description="Logs out the user by deleting all tokens",
     *      @OA\Response(
     *          response=200,
     *          description="User logged out successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="User logged out")
     *          )
     *       ),
     *      @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function logout(){
        // To get all tokens of logged-in user and delete them
        request()->user()->tokens()->delete();

        return response()->json([
            "status" => true,
            "message" => "User logged out"
        ]);
    }

    // Refresh (GET - Auth Token)
    /**
     * @OA\Get(
     *      path="/api/refresh-token",
     *      operationId="refreshToken",
     *      tags={"Token"},
     *      summary="Refresh Token",
     *      description="Generates a new token for the logged-in user",
     *      @OA\Response(
     *          response=200,
     *          description="Token refreshed successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="Refresh token"),
     *              @OA\Property(property="access_token", type="string", example="your-new-access-token"),
     *              @OA\Property(property="tokenId", type="integer", example=2)
     *          )
     *       ),
     *      @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function refreshToken(){
        $tokenInfo = request()->user()->createToken("myNewToken");
        $token = $tokenInfo->plainTextToken; // Token value
        $tokenId = $tokenInfo->accessToken->id; // Token ID

        return response()->json([
            "status" => true,
            "message" => "Refresh token",
            "access_token" => $token,
            "tokenId" => $tokenId
        ]);
    }

    // Delete Specific Token 
    /**
     * @OA\Delete(
     *      path="/api/delete-token/{tokenId}",
     *      operationId="deleteSingleToken",
     *      tags={"Token"},
     *      summary="Delete Specific Token",
     *      description="Deletes a specific token by its ID",
     *      @OA\Parameter(
     *          name="tokenId",
     *          in="path",
     *          required=true,
     *          description="ID of the token to delete",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Token deleted successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="Token deleted"),
     *              @OA\Property(property="delete_id", type="integer", example=1)
     *          )
     *       ),
     *      @OA\Response(
     *          response=404,
     *          description="Token not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="boolean", example=false),
     *              @OA\Property(property="message", type="string", example="Failed to delete token"),
     *              @OA\Property(property="token_id", type="integer", example=1)
     *          )
     *       ),
     *      @OA\Response(response=401, description="Unauthorized"),
     * )
     */
    public function deleteSingleToken($tokenId) {
        $all_tokens = request()->user()->tokens()->where("id", $tokenId)->first();

        if (!empty($all_tokens)) {
            $all_tokens->delete();

            return response()->json([
                "status" => true,
                "message" => "Token deleted",
                "delete_id" => $tokenId
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Failed to delete token",
                "token_id" => $tokenId
            ]);
        }
    }
}
