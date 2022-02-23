<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Repositories\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Http\Controllers\NewPasswordController;

class ResetPasswordController extends Controller
{
    use ApiResponser;
    use PasswordValidationRules;
    /**
     * @OA\Post(
     * path="/forgot-password",
     * summary="Send reset password link",
     * description="Send reset password link to user",
     * operationId="send",
     * tags={"Reset Password"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send email",
     *    @OA\JsonContent(
     *       @OA\Property(property="email", type="string", format="email", example="user@email.com"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Verification link sent!"),
     *      ),
     *    ),
     * )
     */
    public function send(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? $this->success(['status' => __($status)], 200)
            : $this->error(__($status), 401);
    }

    /**
     * @OA\Post(
     * path="/reset-password",
     * summary="Reset your password",
     * description="Send new password",
     * operationId="reset",
     * tags={"Reset Password"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send email",
     *    @OA\JsonContent(
     *       @OA\Property(property="email", type="string", format="email", example="youremail@email.com"),
     *       @OA\Property(property="token", type="string", example="2y10IqrVuWeqe1edn4KtIpm5ulyajCvcsKmlmFbuP9yeP8mRjQXYD8S"),
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="password"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Your password has been reset!"),
     *      ),
     *    ),
     * )
     */
    public function reset(ResetPasswordRequest $request)
    {
        try {
            if (Auth::user()) {
                $input = $request->all();
                (new UserRepository())->update(Auth::user()->id, ["password" => Hash::make($input["password"])]);
                return $this->success(['message' => __('passwords.reset')]);
            } else {
                $response = (new NewPasswordController(Auth::guard()))->store($request);

                if (isset($response->toResponse($request)->original)) {
                    return $this->success($response->toResponse($request)->original);
                }
                return $this->success($response->toResponse($request));
            }
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * @OA\Patch(
     * path="/reset-password",
     * summary="Reset your password",
     * description="Send new password",
     * operationId="change",
     * tags={"Reset Password"},
     * @OA\RequestBody(
     *    required=true,
     *    description="Send password to reset",
     *    @OA\JsonContent(
     *       @OA\Property(property="password", type="string", format="password", example="password"),
     *       @OA\Property(property="password_confirmation", type="string", format="password", example="password"),
     *    ),
     * ),
     * @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Your password has been reset!"),
     *      ),
     *    ),
     * )
     */
    public function change(Request $request)
    {
        try {
            $input = $request->all();

            (new UserRepository())->update(Auth::user()->id, ["password" => Hash::make($input["password"])]);
            return $this->success(['message' => __('passwords.reset')]);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
