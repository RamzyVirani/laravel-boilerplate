<?php

namespace App\Repositories\Admin;

use App\Models\SettingTranslation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SettingTranslationRepository
 * @package App\Repositories\Admin
 * @version October 2, 2018, 6:09 am UTC
 *
 * @method SettingTranslation findWithoutFail($id, $columns = ['*'])
 * @method SettingTranslation find($id, $columns = ['*'])
 * @method SettingTranslation first($columns = ['*'])
 */
class SettingTranslationRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'locale',
        'title',
        'address',
        'about',
        'created_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SettingTranslation::class;
    }

    /**
     * @param $request
     * @param $setting
     * @return mixed
     */
    public function saveRecord($request, $setting)
    {
        $input = $request->only(['title', 'address', 'about']);
        foreach ($input['title'] as $key => $title) {
            if (!empty($title)) {
                $update_data = [];
                $update_data['setting_id'] = $setting->id;
                $update_data['locale'] = $key;
                $update_data['title'] = $title;
                $update_data['address'] = $input['address'][$key];
                $update_data['about'] = $input['about'][$key];

                $this->create($update_data);
            }
        }
        return $setting;
    }

    /**
     * @param $request
     * @param $setting
     * @return mixed
     */
    public function updateRecord($request, $setting)
    {
        $input = $request->all();
        $setting = $this->update($input, $setting->id);
        return $setting;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteRecord($id)
    {
        $setting = $this->delete($id);
        return $setting;
    }
}
