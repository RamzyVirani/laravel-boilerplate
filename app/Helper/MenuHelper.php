<?php

namespace App\Helper;

use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

/**
 * Class MenuHelper
 * @package App\Helper
 */
class MenuHelper
{
    /**
     * @return string
     */
    public static function staticGeneratePermittedMenus()
    {
        $menus = Menu::all()->sortBy('position');
        $listItems = [];

        foreach ($menus as $key => $menu) {
            $permName = ($menu->slug === "dashboard") ? "dashboard" : $menu->slug . ".index";
            if (Auth::user()->can($permName)) {
                $listItems[$key]['name'] = $menu->name;
                $listItems[$key]['slug'] = $permName;
                $listItems[$key]['icon'] = $menu->icon;
                $listItems[$key]['status'] = $menu->status;
            } else if ($menu->static) {
                $listItems[$key]['name'] = $menu->name;
                $listItems[$key]['slug'] = $menu->slug;
                $listItems[$key]['icon'] = $menu->icon;
                $listItems[$key]['status'] = $menu->status;
            }
        }
        return self::GenerateLi($listItems);
    }

    /**
     * @param $data
     * @return string
     */
    protected static function GenerateLi($data)
    {
        $li = '';
        $route = '';
        foreach ($data as $datum) {
            if ($datum['status']) {
				// TODO: Check if Route Exists
                $route = (Request::routeIs('*.' . $datum['slug'] . '*')) ? 'active' : '';
                $li .= '<li class="' . $route . '">';
                $slug = $datum['slug'];
                $li .= '<a href="' . route("admin.$slug") . '">';
                $icon = $datum['icon'];
                $li .= '<i class="' . $icon . '"></i>';
                $name = $datum['name'];
                $li .= '<span>' . $name . '</span>';
                $li .= '</a></li>';
                $route = '';
            }
        }
        return $li;
    }
}