<?php

namespace App\Repositories\Admin;

use App\Models\ContactUs;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ContactUsRepository
 * @package App\Repositories\Admin
 * @version July 14, 2018, 6:36 am UTC
 *
 * @method ContactUs findWithoutFail($id, $columns = ['*'])
 * @method ContactUs find($id, $columns = ['*'])
 * @method ContactUs first($columns = ['*'])
 */
class ContactUsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'email',
        'subject',
        'status',
        'created_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return ContactUs::class;
    }

    /**
     * @param $request
     * @return array
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $this->create($input);
        return [];
    }

    /**
     * @param $request
     * @param $id
     * @return array
     */
    public function updateRecord($request, $id)
    {
        $input = $request->all();
        $this->update($input, $id);
        return [];
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