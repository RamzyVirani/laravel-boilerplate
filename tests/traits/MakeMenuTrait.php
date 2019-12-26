<?php

namespace Tests\Traits;

use \App;
use Faker\Factory as Faker;
use App\Models\Menu;
use App\Repositories\Admin\MenuRepository;

trait MakeMenuTrait
{
    /**
     * Create fake instance of Menu and save it in database
     *
     * @param array $menuFields
     * @return Menu
     */
    public function makeMenu($menuFields = [])
    {
        /** @var MenuRepository $menuRepo */
        $menuRepo = App::make(MenuRepository::class);
        $theme    = $this->fakeMenuData($menuFields);
        return $menuRepo->create($theme);
    }

    /**
     * Get fake instance of Menu
     *
     * @param array $menuFields
     * @return Menu
     */
    public function fakeMenu($menuFields = [])
    {
        return new Menu($this->fakeMenuData($menuFields));
    }

    /**
     * Get fake data of Menu
     *
     * @param array $postFields
     * @return array
     */
    public function fakeMenuData($menuFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name'         => $fake->word,
//            'icon'         => $fake->word,
            'slug'         => $fake->slug,
            'position'     => $fake->numberBetween(0, 13),
            'is_protected' => $fake->numberBetween(0, 1),
            'status'       => $fake->numberBetween(0, 1),
//            'created_at'   => $fake->date('Y-m-d H:i:s'),
//            'updated_at'   => $fake->date('Y-m-d H:i:s'),
//            'deleted_at'   => $fake->date('Y-m-d H:i:s')
        ], $menuFields);
    }
}
