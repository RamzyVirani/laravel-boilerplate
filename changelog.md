## [1.0.0] - 2018-04-07

### Added
- Laravel 5.6 Framework
- Installed InfyOm Laravel Generator
    - AdminLTE Theme
    - Swagger Generator from InfyOm
- DataTables
- Entrust (ACL)
- Published Layouts
- App
    - DataTables
        - PermissionDataTable
        - RoleDataTable
        - UserDataTable
    - Exceptions
        - Handler::unauthenticated
    - Http/Controllers
        - Admin
            - Auth
                - LoginController
                - ForgotPasswordController
                - RegisterController
                - ResetPasswordController
            - PermissionController
            - RoleController
            - UserController
            - HomeController
            - ModuleController
        - Api
            - PermissionController
            - RoleController
            - UserController
    - Http/MiddleWare
        - CheckAdminPermission
    - Http/Requests
        - Admin
            - CreatePermissionRequest
            - CreateRoleRequest
            - CreateUserRequest
            - CreateModuleConfigRequest
            - CreateModuleRequest
            - UpdatePermissionRequest
            - UpdateRoleRequest
            - UpdateUserRequest
            - UpdateModuleConfigRequest
        - Api
            - CreatePermissionApiRequest
            - CreateRoleApiRequest
            - CreateUserApiRequest
            - UpdatePermissionApiRequest
            - UpdateRoleApiRequest
            - UpdateUserApiRequest
    - Http/Kernel
        - routeMiddleware
    - Models
        - Permissions
        - Role
        - User
        - Module
    - Observer
        - ModuleObserver
            - To create permissions on each module generated. And assign them to the generator's role
    - Providers
        - RouteServiceProviders
            - ApiRoutes
                - NameSpace
                - _Named Routes_
            - mapAdminRoutes
    - Repositories
        - PermissionRepository
        - RoleRepository
        - UserRepository
- Database
    - Migrations
        - _User Table_
        - _Password Reset Table_
        - _Permissions Table_
        - _Role Table_
        - _Permission_Role Table_
        - _Role_User Table_
        - _Modules Table_
    - Seeders
        - Permission
        - Role
        - Permission
- Public/js/admin
    - module
        - step1.js
        - step2.js
        - step3.js
    - custom.js
    - pluralize.js
- Resources
    - **InfyOm Templates**
    - admin
        - auth
            - emails/password
            - passwords/email
            - passwords/reset
            - login
            - register
        - layouts
            - app
            - datatables_css
            - datatables_js
            - menu
            - sidebar
        - module
            - list
            - step1
            - step2
            - step3
            - wizard
        - permissions
            - create
            - datatables_actions
            - edit
            - fields
            - index
            - show
            - show_fields
            - show_table
        - roles
            - create
            - datatables_actions
            - edit
            - fields
            - index
            - show
            - show_fields
            - show_table
        - users
            - create
            - datatables_actions
            - edit
            - fields
            - index
            - show
            - show_fields
            - show_table
        - home
    - auth
        - emails/password
        - passwords/email
        - passwords/reset
        - login
        - register
    - errors
        - 403
    - layouts
        - app
    - home
    - welcome
- routes
    - admin

## [1.0.1] - 2018-04-10
### Added

- Menu dynamically added:
    - Menu Migration and seed
    - Class created MenuHelper
    - Menu Blade update
    
- Role edit/view
    - Dynamic modules
    
- Breadcrumbs
    - Helper
    - view->layout->app
    - Template Updated
    
    ## [1.0.2] - 2018-06-20
    ### Added
    
- Profile
    - Edit Profile for All Users
    - Authenticated user can't change their role 
- Swagger
    - Working on Role, Permission, User for Swagger testing
    - Create Property integers
    
## [1.0.3] - 2018-04-10
### Update

- Role

## [1.0.4] - 2018-05-10
### Update
- Translatable trait
- Cascade delete trait
- Role edit permission bug resolved
