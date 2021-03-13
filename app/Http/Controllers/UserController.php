<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Services\User\CreateUserService;
use App\Repositories\RolesRepository\RolesRepository;
use App\Http\Requests\User\UserRequest;
use App\Traits\ReturnHandler;
use Exception;

class UserController extends Controller
{
    use ReturnHandler;
    private $userRepository;

    public function __construct()
    {
        $this->middleware(["auth", "verified"]);
        $this->userRepository = new UserRepository();
    }

    public function index(Request $request)
    {

        $users = $this->userRepository->all();

        return $this->loaded($request, ["users" => $users], 200, "admin/user/users");
    }

    public function store(UserRequest $request)
    {
        try {
            $input = $request->all();

            $createUserService = new CreateUserService();
            $user = $createUserService->execute($input);

            // Sends Email Verification
            $user->sendEmailVerificationNotification();

            return $this->success($request, "users");
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }

    public function show($id, Request $request)
    {
        $user = $this->userRepository->findById($id);
        $roles = (new RolesRepository())->findRolesNotInUser($id);

        return $this->loaded($request, ["user" => $user, "roles" => $roles], 200, "admin/user/user");
    }

    public function update($id, Request $request)
    {
        try {
            $input = $request->only(["name", "email"]);
            $this->userRepository->update($id, $input);

            return $this->success($request, "users");
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }

    public function destroy($id, Request $request)
    {
        try {
            $this->userRepository->delete($id);

            return $this->success($request, "users");
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }
}
