<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\EmailTemplateDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateEmailTemplateRequest;
use App\Http\Requests\Admin\UpdateEmailTemplateRequest;
use App\Repositories\Admin\EmailTemplateRepository;
use App\Http\Controllers\AppBaseController;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;

class EmailTemplateController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  EmailTemplateRepository */
    private $emailTemplateRepository;

    public function __construct(EmailTemplateRepository $emailTemplateRepo)
    {
        $this->emailTemplateRepository = $emailTemplateRepo;
        $this->ModelName = 'email-templates';
        $this->BreadCrumbName = 'Email Templates';
    }

    /**
     * Display a listing of the EmailTemplate.
     *
     * @param EmailTemplateDataTable $emailTemplateDataTable
     * @return Response
     */
    public function index(EmailTemplateDataTable $emailTemplateDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return $emailTemplateDataTable->render('admin.email_templates.index', ['title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for creating a new EmailTemplate.
     *
     * @return Response
     */
    public function create()
    {
        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName);
        return view('admin.email_templates.create')->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Store a newly created EmailTemplate in storage.
     *
     * @param CreateEmailTemplateRequest $request
     *
     * @return Response
     */
    public function store(CreateEmailTemplateRequest $request)
    {
        $emailTemplate = $this->emailTemplateRepository->saveRecord($request);

        Flash::success($this->BreadCrumbName . ' saved successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.email-templates.create'));
        } elseif (isset($request->translation)) {
            $redirect_to = redirect(route('admin.email-templates.edit', $emailTemplate->id));
        } else {
            $redirect_to = redirect(route('admin.email-templates.index'));
        }
        return $redirect_to->with([
            'title' => $this->BreadCrumbName
        ]);
    }

    /**
     * Display the specified EmailTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.email-templates.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $emailTemplate);
        return view('admin.email_templates.show')->with(['emailTemplate' => $emailTemplate, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Show the form for editing the specified EmailTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.email-templates.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName,$this->BreadCrumbName, $emailTemplate);
        return view('admin.email_templates.edit')->with(['emailTemplate' => $emailTemplate, 'title' => $this->BreadCrumbName]);
    }

    /**
     * Update the specified EmailTemplate in storage.
     *
     * @param  int              $id
     * @param UpdateEmailTemplateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmailTemplateRequest $request)
    {
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.email-templates.index'));
        }

        $emailTemplate = $this->emailTemplateRepository->updateRecord($request, $emailTemplate);

        Flash::success($this->BreadCrumbName . ' updated successfully.');
        if (isset($request->continue)) {
            $redirect_to = redirect(route('admin.email-templates.create'));
        } else {
            $redirect_to = redirect(route('admin.email-templates.index'));
        }
        return $redirect_to->with(['title' => $this->BreadCrumbName]);
    }

    /**
     * Remove the specified EmailTemplate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            Flash::error($this->BreadCrumbName . ' not found');
            return redirect(route('admin.email-templates.index'));
        }

        $this->emailTemplateRepository->deleteRecord($id);

        Flash::success($this->BreadCrumbName . ' deleted successfully.');
        return redirect(route('admin.email-templates.index'))->with(['title' => $this->BreadCrumbName]);
    }
}
