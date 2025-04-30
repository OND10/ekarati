<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\User\Http\Requests\SigninRequest;
use Modules\User\Http\Requests\SignUpRequest;
use Modules\User\Http\Requests\UpdateProfileRequest;
use Modules\User\Services\UserService;

class UserController extends Controller
{



    private $user_service;

    public function __construct(UserService $userService)
    {
        $this->user_service = $userService;
    }
    /**
     * @OA\Get(
     *      path="/users",
     *      tags={"Users"},
     *      summary="Get all users",
     *      description="Get list of all users",
     *      @OA\Response(response=200, description="Users retrieved Successfully")
     * )
     */
    public function index()
    {
        $result = $this->user_service->getAllUsers();

        // $result = User::search(request('search'))->get();

        // return response()->json($result);
        return $result;
    }


    public function register(SignUpRequest $request)
    {
        Log::info($request);
        $data = $request->validated();
        $response = $this->user_service->registerUser($data);
        return $response;
    }


    /**
     * @OA\Post(
     *      path="/login",
     *      tags={"Users"},
     *      summary="Signin endpoint",
     *      description="Signin a user by requiring email and password",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              @OA\Property(property="email", type="string", maxLength=30, description="Email of user"),
     *              @OA\Property(property="password", type="string", maxLength=30, description="Password of user"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="User is logged Successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="token", type="string", description="JWT Token for user")
     *          )
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation failed",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", description="Error message"),
     *              @OA\Property(property="errors", type="object", description="Validation error details")
     *          )
     *      ),
     *      @OA\Response(response=401, description="Unauthorized"),
     *      @OA\Parameter(
     *          name="Accept",
     *          in="header",
     *          required=true,
     *          description="The Accept header for the request",
     *          @OA\Schema(type="string", default="application/json")
     *      )
     * )
     */

    public function login(SigninRequest $request)
    {
        $data = $request->validated();
        $response = $this->user_service->login($data);
        return $response;
    }


    public function profile(Request $request)
    {

        $user = $request->user();
        $result = $this->user_service->getUserProfile($user);
        return $result;
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->validated();

        // Ensure 'image_url' key exists before accessing it
        if (!array_key_exists('image_url', $data) || $data['image_url'] === '' || $data['image_url'] === null) {
            $data['image_url'] = null;
        }

        $user = $request->user();
        $result = $this->user_service->updateProfile($user, $data, $data['image_url']);
        return $result;
    }

    public function forgotPassword(Request $request)
    {
        $response = $this->user_service->forgotPassword($request->all());
        return $response;
    }

    public function resetPassword(Request $request)
    {
        $response = $this->user_service->resetPassword($request->all());
        return $response;
    }

    public function patch($id, Request $request)
    {
        $result = $this->user_service->updateUser($id, $request->all());

        return $result;
    }

    public function delete($id)
    {
        $result = $this->user_service->deleteUser($id);

        return $result;
    }

    public function validateToken(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);


        $result = $this->user_service->validateToken($request->token);

        return $result;
    }

    public function logout(Request $request)
    {

        $result = $this->user_service->logout($request->user());
        return $result;
    }

    public function refreshToken(Request $request)
    {
        $data = $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $response = $this->user_service->refreshAccessToken($data['refresh_token']);
        return $response;
    }

    public function show($id)
    {
        $result = $this->user_service->getUserById($id);

        return $result;
    }

    public function activateUser($id)
    {
        $result = $this->user_service->activateUser($id);

        return $result;
    }

    public function deactivateUser($id)
    {
        $result = $this->user_service->deactivateUser($id);

        return $result;
    }
}
