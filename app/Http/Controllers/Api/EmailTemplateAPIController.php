<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CreateEmailTemplateAPIRequest;
use App\Http\Requests\Api\UpdateEmailTemplateAPIRequest;
use App\Models\EmailTemplate;
use App\Repositories\Admin\EmailTemplateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Http\Response;

/**
 * Class EmailTemplateController
 * @package App\Http\Controllers\Api
 */
class EmailTemplateAPIController extends AppBaseController
{
    /** @var  EmailTemplateRepository */
    private $emailTemplateRepository;

    public function __construct(EmailTemplateRepository $emailTemplateRepo)
    {
        $this->emailTemplateRepository = $emailTemplateRepo;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     * @return Response
     *
     * @SWG\Get(
     *      path="/email-templates",
     *      summary="Get a listing of the EmailTemplates.",
     *      tags={"EmailTemplate"},
     *      description="Get all EmailTemplates",
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
     *                  @SWG\Items(ref="#/definitions/EmailTemplate")
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
        $emailTemplates = $this->emailTemplateRepository
            ->pushCriteria(new RequestCriteria($request))
            ->pushCriteria(new LimitOffsetCriteria($request))
            ->all();

        return $this->sendResponse($emailTemplates->toArray(), 'Email Templates retrieved successfully');
    }

    /**
     * @param CreateEmailTemplateAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/email-templates",
     *      summary="Store a newly created EmailTemplate in storage",
     *      tags={"EmailTemplate"},
     *      description="Store EmailTemplate",
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
     *          description="EmailTemplate that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EmailTemplate")
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
     *                  ref="#/definitions/EmailTemplate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEmailTemplateAPIRequest $request)
    {
        $emailTemplates = $this->emailTemplateRepository->saveRecord($request);

        return $this->sendResponse($emailTemplates->toArray(), 'Email Template saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/email-templates/{id}",
     *      summary="Display the specified EmailTemplate",
     *      tags={"EmailTemplate"},
     *      description="Get EmailTemplate",
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
     *          description="id of EmailTemplate",
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
     *                  ref="#/definitions/EmailTemplate"
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
        /** @var EmailTemplate $emailTemplate */
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            return $this->sendErrorWithData(['Email Template not found']);
        }

        return $this->sendResponse($emailTemplate->toArray(), 'Email Template retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEmailTemplateAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/email-templates/{id}",
     *      summary="Update the specified EmailTemplate in storage",
     *      tags={"EmailTemplate"},
     *      description="Update EmailTemplate",
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
     *          description="id of EmailTemplate",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="EmailTemplate that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/EmailTemplate")
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
     *                  ref="#/definitions/EmailTemplate"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEmailTemplateAPIRequest $request)
    {
        /** @var EmailTemplate $emailTemplate */
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            return $this->sendErrorWithData(['Email Template not found']);
        }

        $emailTemplate = $this->emailTemplateRepository->updateRecord($request, $emailTemplate);

        return $this->sendResponse($emailTemplate->toArray(), 'EmailTemplate updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/email-templates/{id}",
     *      summary="Remove the specified EmailTemplate from storage",
     *      tags={"EmailTemplate"},
     *      description="Delete EmailTemplate",
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
     *          description="id of EmailTemplate",
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
        /** @var EmailTemplate $emailTemplate */
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            return $this->sendErrorWithData(['Email Template not found']);
        }

        $this->emailTemplateRepository->deleteRecord($id);

        return $this->sendResponse($id, 'Email Template deleted successfully');
    }
}
