<?php

namespace App\Repositories\Admin;

use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SettingRepository
 * @package App\Repositories\Admin
 * @version October 2, 2018, 6:09 am UTC
 *
 * @method Setting findWithoutFail($id, $columns = ['*'])
 * @method Setting find($id, $columns = ['*'])
 * @method Setting first($columns = ['*'])
 */
class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'default_language',
        'email',
        'logo',
        'phone',
        'app_version',
        'force_update',
        'created_at'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveRecord($request)
    {
        $input = $request->only(['socialName', 'socialLink', 'logo', 'default_locale', 'email', 'phone', 'latitude', 'longitude', 'playstore', 'appstore', 'social_links', 'force_update', 'app_version']);

        $input['socialName'] = array_values(array_filter($input['socialName']));
        $input['socialLink'] = array_values(array_filter($input['socialLink']));

        if (!empty($input['socialName'])) {
            foreach ($input['socialName'] as $key => $item) {
                $socialAccounts[][$item] = $input['socialLink'][$key];
            }
            unset($input['socialName'], $input['socialLink']);
            $input['social_links'] = json_encode($socialAccounts);
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $input['logo'] = Storage::putFile('public', $file);
        }

        $newSetting = $this->create($input);
        return $newSetting;
    }

    /**
     * @param $request
     * @param $setting
     * @return mixed
     */
    public function updateRecord($request, $setting)
    {
        $input = $request->only(['socialName', 'socialLink', 'logo', 'default_locale', 'email', 'phone', 'latitude', 'longitude', 'playstore', 'appstore', 'social_links', 'force_update', 'app_version']);

        $input['socialName'] = array_values(array_filter($input['socialName']));
        $input['socialLink'] = array_values(array_filter($input['socialLink']));

        if (!empty($input['socialName'])) {
            foreach ($input['socialName'] as $key => $item) {
                $socialAccounts[][$item] = $input['socialLink'][$key];
            }
            unset($input['socialName'], $input['socialLink']);
            $input['social_links'] = json_encode($socialAccounts);
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $input['logo'] = Storage::putFile('public', $file);
        }

        $newSetting = $this->create($input);
        return $newSetting;
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
