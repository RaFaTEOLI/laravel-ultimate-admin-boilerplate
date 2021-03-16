<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\RoleRequest;
use App\Repositories\PermissionRepository\PermissionRepository;
use Illuminate\Http\Request;
use App\Repositories\RolesRepository\RolesRepository;
use App\Services\Role\CreateRoleService;
use App\Traits\ReturnHandler;
use Exception;

class RolesController extends Controller
{
    use ReturnHandler;
    private $rolesRepository;

    public function __construct()
    {
        $this->middleware(["auth", "verified"]);
        $this->rolesRepository = new RolesRepository();
    }

    public function index(Request $request)
    {
        $roles = $this->rolesRepository->all();

        return $this->loaded($request, ["roles" => $roles], 200, "admin/role/roles");
    }

    public function store(RoleRequest $request)
    {
        try {
            $input = $request->all();

            $createRoleService = new CreateRoleService();
            $createRoleService->execute($input);

            return $this->success($request, "roles");
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }

    public function show($id, Request $request)
    {
        $role = $this->rolesRepository->findById($id);
        $permissions = (new PermissionRepository())->findPermissionsNotInRole($id);

        return $this->loaded($request, ["role" => $role, "permissions" => $permissions], 200, "admin/role/role");
    }

    public function update($id, Request $request)
    {
        try {
            $input = $request->only(["name", "display_name", "description"]);
            $this->rolesRepository->update($id, $input);

            return $this->success($request, "roles");
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }

    }

    public function destroy($id, Request $request)
    {
        try {
            $this->rolesRepository->delete($id);

            return $this->success($request, "roles");
        } catch (Exception $e) {
            return $this->error($request, __("actions.error"), $e->getCode());
        }
    }
}
