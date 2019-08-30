<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreatePageAPIRequest;
use App\Http\Requests\Api\UpdatePageAPIRequest;
use App\Models\Page;
use App\Repositories\Admin\LanguageRepository;
use App\Repositories\Admin\PageRepository;
use App\Repositories\Admin\PageTranslationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class PageController
 * @package App\Http\Controllers\Api
 */
class PageAPIController extends AppBaseController
{
    /** @var  PageRepository */
    private $pageRepository;

    /** @var  LanguageRepository */
    private $languageRepository;

    /** @var  PageTranslationRepository */
    private $pageTranslationRepository;

    public function __construct(PageRepository $pageRepo, LanguageRepository $languageRepo, PageTranslationRepository $pageTranslationRepo)
    {
        $this->pageRepository            = $pageRepo;
        $this->languageRepository        = $languageRepo;
        $this->pageTranslationRepository = $pageTranslationRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/pages",
     *      summary="Get a listing of the Pages.",
     *      tags={"Page"},
     *      description="Get all Pages",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="orderBy",
     *          description="Pass the property name you want to sort your response. If not found, Returns All Records in DB without sorting.",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="sortedBy",
     *          description="Pass 'asc' or 'desc' to define the sorting method. If not found, 'asc' will be used by default",
     *          type="string",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="limit",
     *          description="Change the Default Record Count. If not found, Returns All Records in DB.",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *     @SWG\Parameter(
     *          name="offset",
     *          description="Change the Default Offset of the Query. If not found, 0 will be used.",
     *          type="integer",
     *          required=false,
     *          in="query"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Page")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->pageRepository->pushCriteria(new RequestCriteria($request));
        $this->pageRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pages = $this->pageRepository->all();

        return $this->sendResponse($pages->toArray(), 'Pages retrieved successfully');
    }

    /**
     * @param CreatePageAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/pages",
     *      summary="Store a newly created Page in storage",
     *      tags={"Page"},
     *      description="Store Page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Page that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Page")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Page"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePageAPIRequest $request)
    {
        $page = $this->pageRepository->saveRecord($request);
        return $this->sendResponse($page->toArray(), 'Page saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/pages/{id}",
     *      summary="Display the specified Page",
     *      tags={"Page"},
     *      description="Get Page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Page",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Page"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        $page = $this->pageRepository->findWithoutFail($id);
        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        return $this->sendResponse($page->toArray(), 'Page retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePageAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/pages/{id}",
     *      summary="Update the specified Page in storage",
     *      tags={"Page"},
     *      description="Update Page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Page",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Page that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Page")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Page"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePageAPIRequest $request)
    {
        $page = $this->pageRepository->findWithoutFail($id);
        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        $page = $this->pageRepository->updateRecord($request, $page, $this->languageRepository, $this->pageTranslationRepository);
        return $this->sendResponse($page->toArray(), 'Page updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/pages/{id}",
     *      summary="Remove the specified Page from storage",
     *      tags={"Page"},
     *      description="Delete Page",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
     *      ),
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Page",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        $page = $this->pageRepository->findWithoutFail($id);
        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        $this->pageRepository->deleteRecord($id);
        return $this->sendResponse($id, 'Page deleted successfully');
    }
}