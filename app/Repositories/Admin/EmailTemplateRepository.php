<?php

namespace App\Repositories\Admin;

use App\Models\EmailTemplate;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class EmailTemplateRepository
 * @package App\Repositories\Admin
 * @version December 20, 2019, 9:47 am UTC
 *
 * @method EmailTemplate findWithoutFail($id, $columns = ['*'])
 * @method EmailTemplate find($id, $columns = ['*'])
 * @method EmailTemplate first($columns = ['*'])
*/
class EmailTemplateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'key',
        'created_at',
        'updated_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return EmailTemplate::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $emailTemplate = $this->create($input);
        return $emailTemplate;
    }

    /**
     * @param $request
     * @param $emailTemplate
     * @return mixed
     */
    public function updateRecord($request, $emailTemplate)
    {
        $input = $request->all();
        $emailTemplate = $this->update($input, $emailTemplate->id);
        return $emailTemplate;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $emailTemplate = $this->delete($id);
        return $emailTemplate;
    }
}
