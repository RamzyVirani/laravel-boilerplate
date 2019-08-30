<?php

namespace App\Helper;

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/**
 * Class BreadcrumbsRegister
 * @package App\Helper
 */
class BreadcrumbsRegister
{
    /**
     * @param null $modelName
     * @param null $BreadCrumbName
     * @param null $model
     * @param bool $profile
     */
    public static function Register($modelName = null, $BreadCrumbName = null, $model = null, $profile = false)
    {
        $prefixes = config('infyom.laravel_generator.prefixes.route');
        $routeName = $prefixes . '.' . $modelName;

        if ($modelName == null) {
            // Home
            Breadcrumbs::register($prefixes . '.dashboard', function ($breadcrumbs) use ($prefixes) {
                $breadcrumbs->push(__('Home'), route($prefixes . '.dashboard'));
            });
        } else {
            // Home
            Breadcrumbs::register($prefixes . '.dashboard', function ($breadcrumbs) use ($prefixes) {
                $breadcrumbs->push(__('Home'), route($prefixes . '.dashboard'));
            });

            // Home > index
            Breadcrumbs::register($routeName . ".index", function ($breadcrumbs) use ($BreadCrumbName, $routeName, $prefixes) {
                $breadcrumbs->parent($prefixes . '.dashboard');
                $breadcrumbs->push(__($BreadCrumbName), route($routeName . '.index'));
            });

            // Home > Profile
            Breadcrumbs::register($routeName . ".profile", function ($breadcrumbs) use ($BreadCrumbName, $routeName, $prefixes) {
                $breadcrumbs->parent($prefixes . '.dashboard');
                $breadcrumbs->push(__($BreadCrumbName), route($routeName . '.profile'));
            });

            // Home > create
            Breadcrumbs::register($prefixes . '.' . $modelName . '.create', function ($breadcrumbs) use ($BreadCrumbName, $prefixes) {
                $breadcrumbs->parent($prefixes . '.dashboard');
                $breadcrumbs->push(__($BreadCrumbName), "");
            });

            if ($model != null) {
                // Home > show
                Breadcrumbs::register($prefixes . '.' . $modelName . '.show', function ($breadcrumbs) use ($model, $routeName, $prefixes) {
                    $breadcrumbs->parent($routeName . '.index');
                    $breadcrumbs->push('View', '');
                });

                // Home > edit
                Breadcrumbs::register($prefixes . '.' . $modelName . '.edit', function ($breadcrumbs) use ($model, $routeName, $prefixes) {
                    $breadcrumbs->parent($routeName . '.index');
                    $breadcrumbs->push('View', route($routeName . '.show', $model));
                    $breadcrumbs->push('Edit', "");
                });

                if ($profile) {
                    // Home > show
                    Breadcrumbs::register($prefixes . '.' . $modelName . '.profile', function ($breadcrumbs) use ($model, $routeName, $prefixes) {
                        $breadcrumbs->parent($routeName . '.index');
                        $breadcrumbs->push(__('View'), '');
                    });
                }
            }
        }
    }
}