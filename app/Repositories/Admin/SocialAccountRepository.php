<?php

namespace App\Repositories\Admin;

use App\Models\SocialAccount;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class USocialAccountRepository
 * @package App\Repositories\Admin
 * @version July 14, 2018, 9:11 am UTC
 *
 * @method SocialAccount findWithoutFail($id, $columns = ['*'])
 * @method SocialAccount find($id, $columns = ['*'])
 * @method SocialAccount first($columns = ['*'])
 */
class SocialAccountRepository extends BaseRepository
{
    /**
     * Returns specified model class name.
     *
     * @return string
     */
    public function model()
    {
        return SocialAccount::class;
    }

    /**
     * @param $userId
     * @param $request
     * @return bool
     */
    public function saveRecord($userId, $request)
    {
        $input = $request->only(['platform', 'client_id', 'token', 'expires_at']);
        $input['user_id'] = $userId;
        $this->create($input);
        return true;
    }

    /**
     * @param $request
     * @param $user
     */
    public function updateRecord($request, $user)
    {

    }
}