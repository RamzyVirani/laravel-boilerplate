<?php

namespace App\Repositories\Admin;

use App\Models\Language;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class LanguageRepository
 * @package App\Repositories\Admin
 * @version July 13, 2018, 4:47 am UTC
 *
 * @method Language findWithoutFail($id, $columns = ['*'])
 * @method Language find($id, $columns = ['*'])
 * @method Language first($columns = ['*'])
 */
class LanguageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'title',
        'native_name',
        'direction',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Language::class;
    }


    public function saveRecord($request)
    {
        $input = $request->all();
        $language = $this->create($input);
        return $language;
    }

   public function updateRecord($request, $language)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? $input['status'] : 0;

        if ($language->code == 'en') // as english is default locale, cannot disable this
            $input['status'] = 1;
        $language = $this->update($input, $language->code);
        return $language;
    }

    public function deleteRecord($id)
    {
        $this->delete($id);
        return $id;
    }
}
