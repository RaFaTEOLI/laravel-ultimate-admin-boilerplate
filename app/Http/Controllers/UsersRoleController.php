<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRole\UsersRoleRequest;
use Illuminate\Support\Facades\Validator;
use App\Services\User\UpdateUserRoleService;
use App\Services\User\RemoveUserRoleService;
use App\Traits\ReturnHandler;
use Illuminate\Http\Request;
use Exception;

class UsersRoleController extends Controller
{
    use ReturnHandler;
    public function store($userId, $roleId, Request $request)
    {
        try {
            $validator = Validator::make(
                ["user_id" => $userId, "role_id" => $roleId],
                UsersRoleRequest::rules($userId),
            );

            if ($validator->fails()) {
                return $this->error($request, __("actions.error"), $e->getCode());
                return redirect()
                    ->back()
                    ->withErrors($validator->errors());
            }

            $updateUserRoleService = new UpdateUserRoleService();
            $updateUserRoleService->execute(["userId" => $userId, "roleId" => $roleId]);

            return $this->success($request, "users.show", ["id" => $userId]);
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }

    public function destroy($userId, $roleId, Request $request)
    {
        try {
            $validator = Validator::make(["user_id" => $userId, "role_id" => $roleId], UsersRoleRequest::deleteRules());

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator->errors());
            }

            $removeUserRoleService = new RemoveUserRoleService();
            $removeUserRoleService->execute(["userId" => $userId, "roleId" => $roleId]);

            return $this->success($request, "users.show", ["id" => $userId]);
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }
}
