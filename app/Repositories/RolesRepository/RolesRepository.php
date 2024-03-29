<?php

namespace App\Repositories\RolesRepository;

use App\Models\Role;
use App\Models\User;
use App\Repositories\RolesRepository\RolesRepositoryInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Collection;

class RolesRepository implements RolesRepositoryInterface
{
    /**
     * Fetch All
     *
     * @return Role
     */
    public function all(int $limit = 0, int $offset = 0): Collection
    {
        return Role::when($limit, function ($query, $limit) {
            return $query->limit($limit);
        })
            ->when($offset && $limit, function ($query, $offset) {
                return $query->offset($offset);
            })->get()->map->format();
    }

    /**
     * Fetch All without permissions
     *
     * @return Role
     */
    public function allWithoutPermissions()
    {
        return Role::all()->map->formatWithoutPermissions();
    }

    /**
     * Fetch All roles that the specific user doesn't have
     *
     * @return Role
     */
    public function findRolesNotInUser($userId)
    {
        $user = (new UserRepository())->findById($userId);
        $userRoles = [];
        foreach ($user->roles as $role) {
            array_push($userRoles, $role->id);
        }

        return Role::whereNotIn("id", $userRoles)
            ->get()
            ->map->formatWithoutPermissions();
    }

    /**
     * Get By Id
     *
     * @return Role
     * @param integer $id
     */
    public function findById($id)
    {
        return Role::find($id)->format();
    }

    /**
     * Update
     *
     * @return Boolean
     * @param integer $id
     * @param array $set
     */
    public function update($id, $set)
    {
        $obj = Role::where("id", $id)->first();

        $obj->update($set);

        return $obj;
    }

    /**
     * Delete
     *
     * @return Boolean
     * @param integer $id
     */
    public function delete($id)
    {
        Role::where("id", $id)->delete();

        return true;
    }
}
