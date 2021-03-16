<?php

namespace App\Http\Controllers;

use App\Http\Requests\Permission\PermissionRequest;
use App\Repositories\PermissionRepository\PermissionRepository;
use App\Services\Permission\CreatePermissionService;
use App\Traits\ReturnHandler;
use Illuminate\Http\Request;
use Exception;

class PermissionController extends Controller
{
    use ReturnHandler;
    private $permissionRepository;

    public function __construct()
    {
        $this->middleware(["auth", "verified"]);
        $this->permissionRepository = new PermissionRepository();
    }

    public function index(Request $request)
    {
        $permissions = $this->permissionRepository->all();

        return $this->loaded($request, ["permissions" => $permissions], 200, "admin/permission/permissions");
    }

    public function store(PermissionRequest $request)
    {
        try {
            $input = $request->all();

            $createPermissionService = new CreatePermissionService();
            $createPermissionService->execute($input);

            return $this->success($request, "permissions");
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }

    public function show($id, Request $request)
    {
        $permission = $this->permissionRepository->findById($id);

        return $this->loaded($request, ["permission" => $permission], 200, "admin/permission/permission");
    }

    public function update($id, Request $request)
    {
        $input = $request->only(["name", "display_name", "description"]);
        $this->permissionRepository->update($id, $input);

        return $this->success($request, "permissions");
    }

    public function destroy($id, Request $request)
    {
        try {
            $this->permissionRepository->delete($id);

            return $this->success($request, "permissions");
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }
}
