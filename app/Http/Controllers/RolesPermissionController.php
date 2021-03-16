<?php

namespace App\Http\Controllers;

use Exception;
use App\Services\RolePermission\UpdateRolePermissionService;
use App\Services\RolePermission\RemoveRolePermissionService;
use App\Http\Requests\RolePermission\RolePermissionRequest;
use App\Traits\ReturnHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesPermissionController extends Controller
{
    use ReturnHandler;

    public function store($roleId, $permissionId, Request $request)
    {
        try {
            $validator = Validator::make(
                ["role_id" => $roleId, "permission_id" => $permissionId],
                RolePermissionRequest::rules($roleId),
            );

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator->errors());
            }

            $updateRolePermissionService = new UpdateRolePermissionService();
            $updateRolePermissionService->execute(["roleId" => $roleId, "permissionId" => $permissionId]);

            return $this->success($request, "roles.show", ["id" => $roleId]);
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }

    public function destroy($roleId, $permissionId, Request $request)
    {
        try {
            $validator = Validator::make(
                ["role_id" => $roleId, "permission_id" => $permissionId],
                RolePermissionRequest::deleteRules(),
            );

            if ($validator->fails()) {
                dd($validator->errors());
                return redirect()
                    ->back()
                    ->withErrors($validator->errors());
            }

            $removeRolePermissionService = new RemoveRolePermissionService();
            $removeRolePermissionService->execute(["roleId" => $roleId, "permissionId" => $permissionId]);

            return $this->success($request, "roles.show", ["id" => $roleId]);
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }
}
