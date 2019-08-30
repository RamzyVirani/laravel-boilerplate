# Laravel boilerplate

Basic boilerplate to create laravel projects with Admin Panel, Role Based Access Control, i18n support, Swagger Doc using InfyOm (Laravel CRUD Generator). 

PS: This boilerplate works on Database First Approach, After the installation, you should design your database through your preferred Database Administration tool then generate modules from the admin panel selecting your tables one by one.

## Whats used?

- **PHP 7.1** 
- **Laravel 5.6**
- InfyOm Laravel Generator
- AdminLTE Theme
- Swagger Generator from InfyOm
- DataTables
- Entrust (ACL)
- Repository Pattern

## Libraries
**Laravel 5.6**
- laravel/framework: 5.6.*,
- laravel/tinker: ^1.0,
- laravelcollective/html: ^5.6.0,
- fideloper/proxy: ^4.0,
- doctrine/dbal: ~2.3

**Image Processeing**
- intervention/image: ^2.4,

**Swagger Doc**
- appointer/swaggervel: ^2.3,

**JWT**
- tymon/jwt-auth: 1.*,

**Breadcrumbs (Admin Panel)**
- davejamesmiller/laravel-breadcrumbs: ^5.0,

**i18n**
- dimsav/laravel-translatable: ^9.0,

**Cascade Soft Deletes**
- iatstuti/laravel-cascade-soft-deletes: ^1.4.0,

**InfyOm (with AdminLTE Template and DataTables)**
- infyomlabs/adminlte-templates: 5.6.x-dev,
- infyomlabs/laravel-generator: 5.6.x-dev#7bd3981,
- infyomlabs/swagger-generator: dev-master,
- yajra/laravel-datatables-buttons: 3.*,
- yajra/laravel-datatables-oracle: ~8.0,

**Push Notification**
- edujugon/push-notification: ^2.2,

**RBAC (ACL)**
- zizaco/entrust: 1.9.1

## Installation
- Download the zip of this repository
- Upload it on Web Server
- Install & Update libraries with `composer update`
- Set your Database credentials in `.env`.
- Run Migration and Seeder `php artisan migrate:refresh --seed`

Boilerplate will create tables and insert basic modules, menus, users, roles, permissions in the database. 


## How To?
**Step 1**
- Make Schema Architecture in your preferred database administration tool.
- Click on Module
- Click Create
- Select the table you want to create a module for
- Enter Module Name (Only alphanumeric characters and spaces are allowed for module names. Using spaces will Generate your classes with CamelCase and will add hyphens in your routes and permission names)
- Select the Icon for this module
- Next

**Step 2**
- Add / Remove Columns you want in the Module Index View (DataTable)
 
**Step 3**
- Add / Remove fields for forms. {Create / Edit}
- Type -> HTML input type.
- Validation -> laravel validations.
- Width -> Bootstrap Columns.
- Select Yes if you want to generate migrations for this module.


**Check Generated Files:**
- DataTable, 
- Admin Controller, 
- Api Controller, 
- Request, 
- Model, 
- Repositories, 
- Migrations, 
- Views, 
- Tests,
- Tests Traits,
- routes/api.php, 
- routes/admin.php,
- public/modules_seeder.csv,
- public/menus_seeder.csv,
- public/permissions_seeder.csv,
- public/permission_role_seeder.csv,

## Admin Credentials:
- Super admin (development admin)
    - 'email'    => "superadmin@boilerplate.com"
    - 'password' => 'superadmin123'
- Admin
    - 'email'    => "admin@boilerplate.com"
    - 'password' => 'admin123'

## Some Useful Scripts
**Want to use Searchable Dropdown?**
- Add class `select2` to your dropdown.

**Ask SW confirmation before delete?**
- Call function `confirmDelete()` on Onclick event.

**Want toggle switch instead of checkbox?**
- Add attribute `'data-toggle'=>'toggle'` on html checkbox.

**Want to add add fields from another related table in datatables?**
- please see DataTables/Admin/UserDataTable.php

**Want to add Translatable module?**
- please see Page Module For Reference.

**Make dependent dropdowns**
- Use class="select2" and data-url="route_to_fetch_data" data-depends="parent_name"


**_PS: Download the zip of this project to initialize git for your project repository_**

---
## _Build Something Amazing!!_