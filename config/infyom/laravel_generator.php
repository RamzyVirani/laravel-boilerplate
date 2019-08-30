<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Paths
    |--------------------------------------------------------------------------
    |
    */

    'path'                => [

        'migration'       => base_path('database/migrations/'),

        'model'           => app_path('Models/'),

        'datatables'      => app_path('DataTables/Admin/'),

        'repository'      => app_path('Repositories/Admin/'),

        'routes'          => base_path('routes/admin.php'),

        'api_routes'      => base_path('routes/api.php'),

        'request'         => app_path('Http/Requests/Admin/'),

        'api_request'     => app_path('Http/Requests/Api/'),

        'controller'      => app_path('Http/Controllers/Admin/'),

        'api_controller'  => app_path('Http/Controllers/Api/'),

        'test_trait'      => base_path('tests/traits/'),

        'repository_test' => base_path('tests/'),

        'api_test'        => base_path('tests/'),

        'views'           => base_path('resources/views/'),

        'schema_files'    => base_path('resources/model_schemas/'),

        'templates_dir'   => base_path('resources/infyom/infyom-generator-templates/'),

        'modelJs'         => base_path('resources/assets/js/models/'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Namespaces
    |--------------------------------------------------------------------------
    |
    */

    'namespace'           => [

        'model'          => 'App\Models',

        'datatables'     => 'App\DataTables\Admin',

        'repository'     => 'App\Repositories\Admin',

        'controller'     => 'App\Http\Controllers\Admin',

        'api_controller' => 'App\Http\Controllers\Api',

        'request'        => 'App\Http\Requests\Admin',

        'api_request'    => 'App\Http\Requests\Api',
    ],

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    */

    'templates'           => 'adminlte-templates',

    /*
    |--------------------------------------------------------------------------
    | Model extend class
    |--------------------------------------------------------------------------
    |
    */

    'model_extend_class'  => 'Eloquent',

    /*
    |--------------------------------------------------------------------------
    | API routes prefix & version
    |--------------------------------------------------------------------------
    |
    */

    'api_prefix'          => 'api',

    'api_version'         => 'v1',

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    */

    'options'             => [

        'softDelete'                => true,

        'tables_searchable_default' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Prefixes
    |--------------------------------------------------------------------------
    |
    */

    'prefixes'            => [

        'route'  => 'admin',  // using admin will create route('admin.?.index') type routes

        'path'   => '',

        'view'   => 'admin',  // using backend will create return view('backend.?.index') type the backend views directory

        'public' => '',

        //'api'    => 'v1',
    ],

    /*
    |--------------------------------------------------------------------------
    | Add-Ons
    |--------------------------------------------------------------------------
    |
    */

    'add_on'              => [

        'swagger'    => true,

        'tests'      => true,

        'datatables' => true,

        'menu'       => [

            'enabled'   => true,

            'menu_file' => 'admin/layouts/menu.blade.php',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Timestamp Fields
    |--------------------------------------------------------------------------
    |
    */

    'timestamps'          => [

        'enabled'    => true,

        'created_at' => 'created_at',

        'updated_at' => 'updated_at',

        'deleted_at' => 'deleted_at',
    ],

    /*
    |--------------------------------------------------------------------------
    | Save model files to `App/Models` when use `--prefix`. see #208
    |--------------------------------------------------------------------------
    |
    */
    'ignore_model_prefix' => false,
];