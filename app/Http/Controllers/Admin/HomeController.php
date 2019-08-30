<?php

namespace App\Http\Controllers\Admin;

use App\Criteria\UserCriteria;
use App\Helper\BreadcrumbsRegister;
use App\Helper\Util;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MenuRepository;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 * @package App\Http\Controllers\Admin
 */
class HomeController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var MenuRepository
     */
    protected $menuRepository;

    /**
     * HomeController constructor.
     * @param UserRepository $userRepo
     * @param RoleRepository $roleRepo
     * @param MenuRepository $menuRepo
     */
    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo, MenuRepository $menuRepo)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepo;
        $this->roleRepository = $roleRepo;
        $this->menuRepository = $menuRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo '<script>alert("add authentication pram in API swagger doc")</script>';
        if (App::environment() == 'staging') {
            $this->menuRepository->update(['status' => 0], 5);
        }
        // COUNTERS
        $android = $this->userRepository
            ->resetCriteria()
            ->pushCriteria(new UserCriteria([
                'device_type' => 'android'
            ]))
            ->findWhereNotIn('id', [1])
            ->count();

        $ios = $this->userRepository
            ->resetCriteria()
            ->pushCriteria(new UserCriteria([
                'device_type' => 'ios'
            ]))
            ->findWhereNotIn('id', [1])
            ->count();

        //<editor-fold desc="User Device Graphs">
        $graphAndroid = $this->userRepository
            ->resetCriteria()
            ->pushCriteria(new UserCriteria([
                'device_type' => 'android',
                'graph'       => Util::GRAPH_MONTHLY
            ]))
            ->findWhereNotIn('id', [1])
            ->pluck('count', 'month_year')
            ->all();

        $graphIos = $this->userRepository
            ->resetCriteria()
            ->pushCriteria(new UserCriteria([
                'device_type' => 'ios',
                'graph'       => Util::GRAPH_MONTHLY
            ]))
            ->findWhereNotIn('id', [1])
            ->pluck('count', 'month_year')
            ->all();

        $deviceGraph = [];
        for ($i = 1; $i <= 12; $i++) {
            $month_year    = date("n-Y", strtotime("-$i months"));
            $deviceGraph[] = [
                "y" => $month_year,
                "a" => isset($graphAndroid[$month_year]) ? $graphAndroid[$month_year] : 0,
                "b" => isset($graphIos[$month_year]) ? $graphIos[$month_year] : 0
            ];
        }
        $deviceGraph = array_reverse($deviceGraph);
        //</editor-fold>

        BreadcrumbsRegister::Register();
        return view('admin.home')->with(compact(
            'android',
            'ios',
            'deviceGraph'
        ));
    }
}