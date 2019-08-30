<?php

namespace App\Http\Controllers\admin;

use App\Helper\BreadcrumbsRegister;
use App\Http\Requests\Admin\CreateModuleConfigRequest;
use App\Http\Requests\Admin\CreateModuleRequest;
use App\Http\Requests\Admin\UpdateModuleConfigRequest;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use InfyOm\Generator\Common\GeneratorFieldRelation;
use InfyOm\Generator\Utils\GeneratorForeignKey;
use InfyOm\Generator\Utils\GeneratorTable;
use InfyOm\Generator\Utils\TableFieldsGenerator;
use Laracasts\Flash\Flash;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\StreamOutput;
use Symfony\Component\VarDumper\Caster\DoctrineCaster;

/**
 * Class ModuleController
 * @package App\Http\Controllers\admin
 */
class ModuleController extends Controller
{
    protected $BreadCrumbName;
    protected $schemaManager;
    protected $ModelName;
    protected $data;

    /**
     * ModuleController constructor.
     */
    public function __construct()
    {
        $this->schemaManager = DB::getDoctrineSchemaManager();
        $this->ModelName = 'modules';
        $this->BreadCrumbName = 'Modules';

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        $this->data['modules'] = Module::where('is_protected', 0)->where('is_module', 1)->where('deleted_at', null)->get();
        return view('admin.module.list', $this->data);
    }

    /**
     * @param null $moduleId
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStep1($moduleId = null)
    {
        \Doctrine\Common\Inflector\Inflector::rules('plural', [
            '/us$/i' => 'us'
        ]);

        if ($moduleId != null) {
            $this->data['module_data'] = Module::where('id', $moduleId)->get()->first();
            $this->data['id'] = $moduleId;
        }
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);

        $tables = $this->schemaManager->listTables();
        $protected_tables = [
            'menus',
            'migrations',
            'modules',
            'password_resets',
            'permission_role',
            'permissions',
            'role_user',
            'roles',
//            'users'
        ];

        $keyVal = [];
        foreach ($tables as $key => $table) {
            if (!in_array($table->getName(), $protected_tables)) {
                $keyVal[$table->getName()] = $table->getName();
            }

//            if ($table->getPrimaryKey() != null) {
//                $keyCount[] = (count($table->getPrimaryKey()->getColumns()));
//            } else {
//                $keyCount[] = 0;
//            }
        }
        $this->data['tables'] = $keyVal;
//        $this->data['keyCount'] = $keyCount;

        $this->data['step'] = 'step1';
        if (isset($_GET['model_error']))
            return view('admin.module.wizard', $this->data)->withErrors($_GET['model_error']);
        else
            return view('admin.module.wizard', $this->data);
    }

    /**
     * @param CreateModuleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postStep1(CreateModuleRequest $request)
    {
        $this->data['table_name'] = $request->table_name;
        $this->data['name'] = $request->module;
        $this->data['icon'] = 'fa fa-' . $request->icon;
        $this->data['slug'] = str_plural($request->slug);
        $this->data['is_module'] = 1;

        if (isset($request->id)) {
            Module::where('id', $request->id)->update($this->data);
            $this->data['id'] = $request->id;
        } else {
            $newModule = Module::create($this->data);
            $this->data['id'] = $newModule->id;
        }

        return redirect('admin/module/step2/' . $this->data['id']);
    }

    /**
     * @param $moduleId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStep2($moduleId)
    {
        $tablename = Module::where('id', $moduleId)->get()->first();
//        $this->data['tableFields'] = DB::select('SHOW FULL FIELDS FROM '.$tablename->table_name);
        $this->data['tableFields'] = $this->schemaManager->listTableDetails($tablename->table_name)->getColumns();
        $this->data['id'] = Module::select('id')->get()->last()->id;
        $this->data['step'] = 'step2';
        $this->data['module_data'] = json_decode($tablename->config);

        $tables = $this->schemaManager->listTables();
        $keyVal = [];
        foreach ($tables as $key => $table) {
            $keyVal[$table->getName()] = $table->getName();
        }
        $this->data['tables'] = $keyVal;

        foreach ($this->data['tableFields'] as $key => $items) {
            $this->data['columns'][] = $items->getName();
        }
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.module.wizard', $this->data);
    }

    /**
     * @param CreateModuleConfigRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postStep2(CreateModuleConfigRequest $request)
    {
        $this->data['id'] = $request->id;
        $tablename = Module::where('id', $request->id)->get()->first();

        $this->data['tableFields'] = $this->schemaManager->listTableDetails($tablename->table_name)->getColumns();
        $pk = $this->schemaManager->listTableDetails($tablename->table_name)->getPrimaryKey()->getColumns()[0];

        foreach ($request->name as $request_data) {
            $dataByUser[] = $request_data;
        }

//        dd(json_decode($this->getTableRelation($tablename->table_name)));
//        $relation = json_decode($this->getTableRelation($tablename->table_name))->relation;
//        if (isset(json_decode($this->getTableRelation($tablename->table_name))->dbType)) {
//            $relationType = json_decode($this->getTableRelation($tablename->table_name))->dbType;
//        } else {
//            $relationType = json_decode($this->getTableRelation($tablename->table_name))->type;
//        }
//        dd($relation,$relationType);
        $Config_data = [];
        $count = 0;
        foreach ($this->data['tableFields'] as $key => $item) {
            $Config_data[$count]['name'] = $item->getName();
            $Config_data[$count]['primary'] = $item->getName() == $pk ? true : false;
            $Config_data[$count]['dbType'] = $item->getType()->getName() == 'integer' ? 'increments' : (($item->getLength() != null) ? $item->getType()->getName() . ',' . $item->getLength() : $item->getType()->getName());
            $Config_data[$count]['fillable'] = false;
            $Config_data[$count]['inForm'] = false;
            $Config_data[$count]['htmlType'] = false;
            $Config_data[$count]['validations'] = false;
            $Config_data[$count]['inIndex'] = false;
            $Config_data[$count]['searchable'] = false;
            /*$Config_data[$count]['relation'] = false;
            $Config_data[$count]['type'] = $relationType;
            $Config_data[$count]['relation'] = $relation;*/

            if (array_search($item->getName(), $dataByUser) > -1) {
//                $req_index = array_search($item->getName(),$dataByUser);
                $Config_data[$count]['inIndex'] = true;
                $Config_data[$count]['searchable'] = true;
//                $Config_data[$count]['relation'] = ($request->join_table[$req_index]==null)?false:"mt1,".$request->join_table[$req_index].",user_id,".$request->join_field[$req_index];
            }
            $count++;
        }

        $module = Module::where('id', $request->id)->update(['config' => json_encode($Config_data)]);

        return redirect('admin/module/step3/' . $this->data['id']);
    }

    /**
     * @param $moduleId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getStep3($moduleId)
    {
        $tablename = Module::where('id', $moduleId)->get()->first();
//        $this->data['tableFields'] = DB::select('SHOW FULL FIELDS FROM '.$tablename->table_name);
        $this->data['tableFields'] = $this->schemaManager->listTableDetails($tablename->table_name)->getColumns();
        $this->data['step'] = 'step3';
        $this->data['id'] = $moduleId;
        $this->data['module_data'] = json_decode($tablename->config);
        foreach ($this->data['tableFields'] as $key => $items) {
            $this->data['columns'][] = $items->getName();
        }
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.module.wizard', $this->data);
    }

    /**
     * @param UpdateModuleConfigRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postStep3(UpdateModuleConfigRequest $request)
    {
        $this->data['id'] = $request->id;
        $tablename = Module::where('id', $request->id)->get()->first();
//        $this->data['tableFields'] = DB::select('SHOW FULL FIELDS FROM '.$tablename->table_name);
        $this->data['tableFields'] = $this->schemaManager->listTableDetails($tablename->table_name)->getColumns();

        $this->data['migration'] = $request->make_migration;

        foreach ($request->name as $request_data) {
            $dataByUser[] = $request_data;
        }

        $Config_data = json_decode($tablename->config);
        $count = 0;

        foreach ($this->data['tableFields'] as $key => $item) {
            if (array_search($item->getName(), $dataByUser) > -1) {
                $req_data_id = array_search($item->getName(), $dataByUser);
                $Config_data[$count]->htmlType = $request->type[$req_data_id];
                $Config_data[$count]->validations = $request->validation[$req_data_id];
                $Config_data[$count]->fillable = true;
                $Config_data[$count]->inForm = true;
            }
            $count++;
        }

        $Config_data = json_encode($Config_data);

        $fileName = 'moduleConfig_' . $tablename->name . '_' . time() . '.json';
        Storage::disk('local')->put($fileName, $Config_data);

        $updateData = [
            'config' => $Config_data,
            'status' => 1
        ];
        Module::find($request->id)->update($updateData);
//        Menu::where('slug', $tablename->slug)->update(['status' => 1]);

        $this->updateModuleCSV($request->id);
        /*        $model_name = str_replace("_", " ", $tablename->name);
                $model_name = Pluralizer::singular(ucwords($model_name));
                $model_name = str_replace(" ", "", $model_name);*/

        $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();

        #TODO: make this default table condition dynamic
        $params = [
            'model'        => $tablename->name,
            '--fromTable'  => '',
            '--tableName'  => $tablename->table_name,
//            '--datatables' => true,
            '--fieldsFile' => $storagePath . $fileName,

            '-n' => true
        ];

        /*$default_tables = [
            'users', 'role_user', 'roles', 'permission_role', 'permissions', 'migrations', 'menus', 'modules', 'password_resets', 'locales', 'pages', 'page_translations'
        ];
        if (array_search($tablename->table_name, $default_tables) > -1) {
            $params['--skip'] = 'migration';
        }*/

        if ($this->data['migration'] == '') {
            $params['--skip'] = 'migration';
        } elseif ($request->make_migration == 0) {
            $params['--skip'] = 'migration';
        }

        //Artisan::call("infyom:api_scaffold {$model_name} --fromTable --tableName={$tablename->table_name} --datatables=true --fieldsFile='{$storagePath}module_config.json'");
//        $buffer = new BufferedOutput();
//        ob_start();
//        $stream = fopen("php://output", "w");
//        $buffer = new StreamOutput($stream);
//        $buffer = new BufferedOutput();
//        $output = ob_get_clean();
//        dd($output);
        $exit = Artisan::call("infyom:api_scaffold", $params);
        if ($exit == 0) {
            Flash::success('New Module added successfully.');
            //return redirect(route('admin.' . $tablename->slug . '.index'));
            return redirect(route('admin.modules.index'));
        } else {
            $errors = [
                'Kindly Check Folder Permissions',
                'Make Sure Storage Directory Is Write Able',
                'Make Sure Storage/app/' . $fileName . ' file exist',
                //$output
            ];
            Flash::error($errors);
            return redirect()->back();
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function updateModuleCSV($id)
    {
        $module = Module::find($id)->toArray();
        $newData = [
            $module['id'],
            $module['name'],
            $module['slug'],
            $module['table_name'],
            $module['icon'],
            $module['status'],
            $module['is_module'],
            $module['config'],
            $module['is_protected']
        ];
        $util = new \App\Helper\Util();
        $updatedData = $util->updateCSV('modules_seeder.csv', [$newData]);
        return true;
    }
    /*public function getJoinFields(Request $request)
    {
        $this->data['tableFields'] = $this->schemaManager->listTableDetails($request->tablename)->getColumns();
        foreach ($this->data['tableFields'] as $key => $items) {
            $columns[] = $items->getName();
        }
        return $columns;
    }

    public function getTableRelation($tableName)
    {
        $tableFieldsGenerator = new TableFieldsGenerator($tableName);
        $tableFieldsGenerator->prepareFieldsFromTable();
        $tableFieldsGenerator->prepareRelations();
        $releationLists = [];

        foreach (get_object_vars($tableFieldsGenerator)['relations'] as $relation) {
            $releationLists[] = get_object_vars($relation);
        }
        foreach ($releationLists as $key => $item) {
            if ($item['inputs'][0] != '') {
                $relationTypes[] = get_object_vars(get_object_vars($tableFieldsGenerator)['relations'][$key])['type'];
                $relationModels[] = get_object_vars(get_object_vars($tableFieldsGenerator)['relations'][$key])['inputs'][0];
            }
        }

        if (isset($relationTypes)) {
            foreach ($relationTypes as $key => $relationType) {
                if ($relationType == '1tm') {
                    $variable['type'] = 'relation';
                    $variable['relation'] = $relationType . ',' . $relationModels[$key];
                } elseif ($relationType == 'mt1') {
                    $LocalColumns = $this->schemaManager->listTableDetails($tableName)
                        ->getForeignKeys()['posts_category_id_foreign']->getLocalColumns();
                    $ForeignColumns = $this->schemaManager->listTableDetails($tableName)
                        ->getForeignKeys()['posts_category_id_foreign']->getForeignColumns();
                    $ForeignTableName = $this->schemaManager->listTableDetails($tableName)
                        ->getForeignKeys()['posts_category_id_foreign']->getForeignTableName();
                    $variable['dbType'] = "integer:unsigned:default,0:foreign," . $ForeignTableName . "," . $ForeignColumns[0];
                    $variable['relation'] = $relationType . "," . $relationModels[$key] . "," . $LocalColumns[0] . "," . $ForeignColumns[0];
                } elseif ($relationType == 'mtm') {
                    $relationBridgeTable = get_object_vars(get_object_vars($tableFieldsGenerator)['relations'][$key])['inputs'][1];

                    foreach ($this->schemaManager->listTableDetails($relationBridgeTable)->getColumns() as $column) {
                        $bridgeTableColumns[] = $column->getName();
                    }

                    $variable[$key]['type'] = "relation";
                    $variable[$key]['relation'] = $relationType . "," . $relationModels[$key] . "," . $relationBridgeTable . "," . $bridgeTableColumns[0] . "," . $bridgeTableColumns[1];
                }
            }
        } else {
            $variable['type'] = false;
            $variable['relation'] = false;
        }

        return json_encode($variable);
    }*/
}