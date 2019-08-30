<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\PageDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreatePageRequest;
use App\Http\Requests\Admin\UpdatePageRequest;
use App\Repositories\Admin\LanguageRepository;
use App\Repositories\Admin\PageRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\Admin\PageTranslationRepository;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 */
class PageController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  PageRepository */
    private $pageRepository;

    /** @var  LanguageRepository */
    private $languageRepository;

    /** @var  LanguageRepository */
    private $pageTranslationRepository;

    /**
     * PageController constructor.
     * @param PageRepository $pageRepo
     * @param PageTranslationRepository $pageTranslationRepo
     * @param LanguageRepository $languageRepo
     */
    public function __construct(PageRepository $pageRepo, PageTranslationRepository $pageTranslationRepo, LanguageRepository $languageRepo)
    {
        $this->pageRepository = $pageRepo;
        $this->pageTranslationRepository = $pageTranslationRepo;
        $this->languageRepository = $languageRepo;
        $this->ModelName = 'pages';
        $this->BreadCrumbName = 'Page';
    }

    /**
     * Display a listing of the Page.
     *
     * @param PageDataTable $pageDataTable
     * @return Response
     */
    public function index(PageDataTable $pageDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $pageDataTable->render('admin.pages.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new Page.
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.pages.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created Page in storage.
     *
     * @param CreatePageRequest $request
     *
     * @return Response
     */
    public function store(CreatePageRequest $request)
    {
        $page = $this->pageRepository->saveRecord($request);
        Flash::success('Page saved successfully.');

        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.pages.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.pages.edit', $page->id));
        } else {
            $redirect_to = redirect(route('admin.pages.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Display the specified Page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $page = $this->pageRepository->findWithoutFail($id);
        if (empty($page)) {
            Flash::error('Page not found');
            return redirect(route('admin.pages.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $page);
        return view('admin.pages.show')->with([
            'title' => $this->BreadCrumbName,
            'page'  => $page
        ]);
    }

    /**
     * Show the form for editing the specified Page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $page = $this->pageRepository->findWithoutFail($id);
        if (empty($page)) {
            Flash::error('Page not found');
            return redirect(route('admin.pages.index'));
        }

        $locales = $this->languageRepository->orderBy('updated_at', 'ASC')->findWhere(['status' => 1]);

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $page);
        return view('admin.pages.edit')
            ->with([
                'title'   => $this->BreadCrumbName,
                'page'    => $page,
                'locales' => $locales
            ]);
    }

    /**
     * Update the specified Page in storage.
     *
     * @param  int $id
     * @param UpdatePageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePageRequest $request)
    {
        $page = $this->pageRepository->findWithoutFail($id);
        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('admin.pages.index'));
        }

        $page = $this->pageRepository->updateRecord($request, $page);
        $this->pageTranslationRepository->updateRecord($request, $page);

        Flash::success('Page updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.pages.create'));
        } else {
            $redirect_to = redirect(route('admin.pages.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified Page from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $page = $this->pageRepository->findWithoutFail($id);
        if (empty($page)) {
            Flash::error('Page not found');
            return redirect(route('admin.pages.index'));
        }

        $this->pageRepository->deleteRecord($id);

        Flash::success('Page deleted successfully.');
        return redirect(route('admin.pages.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
