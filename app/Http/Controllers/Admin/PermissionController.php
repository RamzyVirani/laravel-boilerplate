<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CreatePermissionRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use App\Repositories\Admin\PermissionRepository;
use App\DataTables\Admin\PermissionDataTable;
use App\Http\Controllers\AppBaseController;
use App\Helper\BreadcrumbsRegister;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;

/**
 * Class PermissionController
 * @package App\Http\Controllers\Admin
 */
class PermissionController extends AppBaseController
{
    /** @var  PermissionRepository */
    private $permissionRepository;

    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /**
     * PermissionController constructor.
     * @param PermissionRepository $permissionRepo
     */
    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepository = $permissionRepo;
        $this->ModelName = 'permissions';
        $this->BreadCrumbName = 'Permission';
    }

    /**
     * Display a listing of the Permission.
     *
     * @param PermissionDataTable $permissionDataTable
     * @return Response
     */
    public function index(PermissionDataTable $permissionDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $permissionDataTable->render('admin.permissions.index');
    }

    /**
     * Show the form for creating a new Permission.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.permissions.create');
    }

    /**
     * Store a newly created Permission in storage.
     *
     * @param CreatePermissionRequest $request
     *
     * @return Response
     */
    public function store(CreatePermissionRequest $request)
    {
        $permission = $this->permissionRepository->saveRecord($request);

        Flash::success('Permission saved successfully.');
        return redirect(route('admin.permissions.index'));
    }

    /**
     * Display the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');
            return redirect(route('admin.permissions.index'));
        }
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $permission);
        return view('admin.permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified Permission.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');
            return redirect(route('admin.permissions.index'));
        }
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $permission);
        return view('admin.permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     *
     * @param  int $id
     * @param UpdatePermissionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);

        if (empty($permission)) {
            Flash::error('Permission not found');
            return redirect(route('admin.permissions.index'));
        }

        $permission = $this->permissionRepository->update($request->all(), $id);

        Flash::success('Permission updated successfully.');
        return redirect(route('admin.permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $permission = $this->permissionRepository->findWithoutFail($id);
        if (empty($permission)) {
            Flash::error('Permission not found');
            return redirect(route('admin.permissions.index'));
        }

        if ($permission->is_protected == 1) {
            Flash::error('You are not allowed to perform this action.');
            return redirect(route('admin.permissions.index'));
        }

        $this->permissionRepository->delete($id);

        Flash::success('Permission deleted successfully.');
        return redirect(route('admin.permissions.index'));
    }
}