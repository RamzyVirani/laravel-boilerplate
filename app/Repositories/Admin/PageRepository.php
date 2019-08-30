<?php

namespace App\Repositories\Admin;

use App\Models\Page;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PageRepository
 * @package App\Repositories\Admin
 * @version July 13, 2018, 6:53 am UTC
 *
 * @method Page findWithoutFail($id, $columns = ['*'])
 * @method Page find($id, $columns = ['*'])
 * @method Page first($columns = ['*'])
 */
class PageRepository extends BaseRepository
{
    private $languageRepository;
    private $pageTranslationRepository;
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'slug',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Page::class;
    }

    /**
     * @param $request
     * @return array
     */
    public function saveRecord($request)
    {
        $input = $request->all();
        $page = $this->create($input);
        return $page;
    }

    /**
     * @param $request
     * @param $page
     * @return mixed
     */
    public function updateRecord($request, $page)
    {
        $input = $request->only(['slug', 'status']);
        $page = $this->update($input, $page->id);
        return $page;
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
