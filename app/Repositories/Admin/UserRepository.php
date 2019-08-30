<?php

namespace App\Repositories\Admin;

use App\Models\User;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserRepository
 * @package App\Repositories\Admin
 * @version April 2, 2018, 9:11 am UTC
 *
 * @method User findWithoutFail($id, $columns = ['*'])
 * @method User find($id, $columns = ['*'])
 * @method User first($columns = ['*'])
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'password',
        'remember_token'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    /**
     * @param $userId
     * @param $roleId
     */
    public function attachRole($userId, $roleId)
    {
        $user = $this->findWithoutFail($userId);
        $user->roles()->attach($roleId);
        $user->save();
    }

    /**
     * @param $userId
     * @param $roleId
     */
    public function detachRole($userId, $roleId)
    {
        $user = $this->findWithoutFail($userId);
        $user->roles()->detach($roleId);
        $user->save();
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return $this->model->whereEmail($email)->first();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $userData = $request->only(['name', 'email', 'password']);
        $postData['name'] = ucwords($userData['name']);
        $postData['email'] = $userData['email'];
        $postData['password'] = bcrypt($userData['password']);

        $user = $this->create($postData);

        $selectedRoles = [];
        if ($request->has('roles') || $request->get('roles', null) !== null) {
            $selectedRoles = $request->get('roles');

            $existingRoles = $user->roles->pluck('id')->all();
            $newRoles = array_diff($selectedRoles, $existingRoles);
            $rolesToBeDeleted = array_diff($existingRoles, $selectedRoles);
            foreach ($newRoles as $newRole) {
                $this->attachRole($user->id, $newRole);
            }
            foreach ($rolesToBeDeleted as $roleToBeDeleted) {
                $this->detachRole($user->id, $roleToBeDeleted);
            }
        }

        return $user;
    }

    /**
     * @param $request
     * @param $user
     * @return mixed
     */
    public function updateRecord($request, $user)
    {
        $data = $request->all();
        if ($request->has('password') && $request->get('password', null) === null) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $selectedRoles = [];
        if ($request->has('roles') || $request->get('roles', null) !== null) {
            $selectedRoles = $request->get('roles');
            unset($data['roles']);

            $existingRoles = $user->roles->pluck('id')->all();
            $newRoles = array_diff($selectedRoles, $existingRoles);
            $rolesToBeDeleted = array_diff($existingRoles, $selectedRoles);
            foreach ($newRoles as $newRole) {
                $this->attachRole($user->id, $newRole);
            }
            foreach ($rolesToBeDeleted as $roleToBeDeleted) {
                $this->detachRole($user->id, $roleToBeDeleted);
            }
        }

        $user = $this->update($data, $user->id);
        return $user;
    }

    /**
     * @param $id
     * @return array
     */
    public function deleteRecord($id)
    {
        $this->delete($id);
        return [];
    }
}