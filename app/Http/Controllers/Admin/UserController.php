<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Helper\BreadcrumbsRegister;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Repositories\Admin\RoleRepository;
use App\Repositories\Admin\UserDetailRepository;
use App\Repositories\Admin\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    /** ModelName */
    private $ModelName;

    /** ModelName */
    private $BreadCrumbName;

    /** @var  RoleRepository */
    private $roleRepository;

    /** @var  UserDetailRepository */
    private $userDetailRepository;

    public function __construct(UserRepository $userRepo, RoleRepository $roleRepo, UserDetailRepository $detailRepo)
    {
        $this->userRepository = $userRepo;
        $this->userDetailRepository = $detailRepo;
        $this->roleRepository = $roleRepo;
        $this->ModelName = 'users';
        $this->BreadCrumbName = 'Users';
    }

    /**
     * Display a listing of the User.
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $userDataTable->render('admin.users.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new User.
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        $roles = $this->roleRepository->all()->where('id', '!=', '1')->pluck('display_name', 'id')->all();
        return view('admin.users.create')->with([
            'title' => $this->BreadCrumbName,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created User in storage.
     * @param CreateUserRequest $request
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = $this->userRepository->saveRecord($request);

        $this->userDetailRepository->saveRecord($user->id, $request);

        Flash::success('User saved successfully.');
        return redirect(route('admin.users.index'))->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Display the specified User.
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $user);
        return view('admin.users.show')->with(['title' => $this->BreadCrumbName, 'user' => $user]);
    }

    /**
     * Show the form for editing the specified User.
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }

        $roles = $this->roleRepository->all()->where('id', '!=', '1')->pluck('display_name', 'id')->all();
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $user);
        return view('admin.users.edit')->with(['user' => $user, 'title' => $this->BreadCrumbName, 'roles' => $roles]);
    }

    /**
     * Update the specified User in storage.
     * @param  int $id
     * @param UpdateUserRequest $request
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }

        $this->userRepository->updateRecord($request, $user);

        Flash::success('User updated successfully.');
        return redirect(route('admin.users.index'))->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified User from storage.
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }

        $this->userRepository->deleteRecord($id);

        Flash::success('User deleted successfully.');
        return redirect(route('admin.users.index'))->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function profile()
    {
        $user = Auth::user();
        if (empty($user)) {
            Flash::error('User not found');
            return redirect(route('admin.users.index'));
        }
        $this->BreadCrumbName = 'Profile';

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.users.edit')->with(['title' => $this->BreadCrumbName, 'user' => $user]);
    }
}