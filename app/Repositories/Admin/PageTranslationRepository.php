<?php

namespace App\Repositories\Admin;

use App\Models\PageTranslation;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PageTranslationRepository
 * @package App\Repositories\Admin
 * @version July 13, 2018, 6:53 am UTC
 *
 * @method PageTranslation findWithoutFail($id, $columns = ['*'])
 * @method PageTranslation find($id, $columns = ['*'])
 * @method PageTranslation first($columns = ['*'])
*/
class PageTranslationRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return PageTranslation::class;
    }
	
    /**
     * @param $request
     * @param $page
     * @return mixed
     */
    public function updateRecord($request, $page)
    {
        $input = $request->only(['title', 'content', 'translation_status']);
        
        foreach ($input['title'] as $key => $title) {
            if ($title != '') {
                $update_data = [];
                $update_data['page_id'] = $page->id;
                $update_data['locale'] = $key;
                $update_data['title'] = $title;
                $update_data['content'] = $input['content'][$key];
                $update_data['status'] = isset($input['translation_status'][$key]) ? $input['translation_status'][$key] : 0;
                $this->model->updateOrCreate(['page_id' => $page->id, 'locale' => $key], $update_data);
            }
        }
        return $page;
    }
}
