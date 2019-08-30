<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\SettingDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateSettingRequest;
use App\Http\Requests\Admin\UpdateSettingRequest;
use App\Models\SettingTranslation;
use App\Repositories\Admin\LanguageRepository;
use App\Repositories\Admin\SettingRepository;
use App\Repositories\Admin\SettingTranslationRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class SettingController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  SettingRepository */
    private $settingRepository;

    /** @var  SettingTranslation */
    private $settingTranslationRepository;

    /** @var  LanguageRepository */
    private $languageRepository;

    public function __construct(SettingRepository $settingRepo, SettingTranslationRepository $settingTranslationRepo, LanguageRepository $languageRepo)
    {
        $this->settingRepository = $settingRepo;
        $this->settingTranslationRepository = $settingTranslationRepo;
        $this->languageRepository = $languageRepo;
        $this->ModelName = 'settings';
        $this->BreadCrumbName = 'Settings';
    }

    /**
     * Display a listing of the Setting.
     *
     * @param SettingDataTable $settingDataTable
     * @return Response
     */
    public function index(SettingDataTable $settingDataTable)
    {
        $settings = $this->settingRepository->first();
        return redirect(route('admin.settings.show', $settings->id));

        /*BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $settingDataTable->render('admin.settings.index', ['title' => $this->BreadCrumbName]);*/
    }

    /**
     * @return $this
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.settings.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created Setting in storage.
     *
     * @param CreateSettingRequest $request
     *
     * @return Response
     */
    public function store(CreateSettingRequest $request)
    {
        $setting = $this->settingRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.settings.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.settings.edit', $setting->id));
        } else {
            $redirect_to = redirect(route('admin.settings.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified Setting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.settings.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $setting);
        return view('admin.settings.show')->with(['setting' => $setting, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified Setting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.settings.index'));
        }
        $locales = $this->languageRepository->orderBy('updated_at', 'ASC')->findWhere(['status' => 1]);

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $setting);
        return view('admin.settings.edit')->with(['setting' => $setting, 'title' => $this->BreadCrumbName, 'locales' => $locales]);
    }

    /**
     * Update the specified Setting in storage.
     *
     * @param  int $id
     * @param UpdateSettingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSettingRequest $request)
    {
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            Flash::error('App Setting not found');
            return redirect(route('admin.settings.index'));
        }

        $newSetting = $this->settingRepository->saveRecord($request);
        $this->settingTranslationRepository->saveRecord($request, $newSetting);
        $this->settingRepository->deleteRecord($id);

        Flash::success('App Setting updated successfully.');
        return redirect(route('admin.settings.show', $newSetting->id));
    }

    /**
     * Remove the specified Setting from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $setting = $this->settingRepository->findWithoutFail($id);

        if (empty($setting)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.settings.index'));
        }

        $this->settingRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.settings.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
