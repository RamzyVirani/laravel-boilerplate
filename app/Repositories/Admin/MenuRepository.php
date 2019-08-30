<?php

namespace App\Repositories\Admin;

use App\Models\Menu;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MenuRepository
 * @package App\Repositories\Admin
 * @version July 16, 2018, 9:58 am UTC
 *
 * @method Menu findWithoutFail($id, $columns = ['*'])
 * @method Menu find($id, $columns = ['*'])
 * @method Menu first($columns = ['*'])
*/
class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Menu::class;
    }
	
	/**
     * @param $request
     * @return mixed
     */
    public function updateRecord($request)
    {
        $response['msg'] = false;
        $input = $request->all();

        if (!empty($input['rowId']) && !empty($input['rowPosition']) && !empty($input['prevRowId']) && !empty($input['prevRowPosition'])) {
            //current Row
            $row1_id = $input['rowId'];
            $row1_position['position'] = $input['rowPosition'];

            //Previous Row
            $row2_id = $input['prevRowId'];
            $row2_position['position'] = $input['prevRowPosition'];

            //Swapping
            $row1 = $this->update($row1_position, $row2_id);
            $row2 = $this->update($row2_position, $row1_id);

            if ($row1 && $row2) {
                $response['msg'] = true;
            }
        }
        return $response;
    }
}
