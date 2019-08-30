<?php

namespace App\Http\Controllers\Admin;

use App\Helper\BreadcrumbsRegister;
use App\DataTables\Admin\NotificationDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateNotificationRequest;
use App\Http\Requests\Admin\UpdateNotificationRequest;
use App\Repositories\Admin\NotificationRepository;
use App\Repositories\Admin\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

/**
 * Class NotificationController
 * @package App\Http\Controllers\Admin
 */
class NotificationController extends AppBaseController
{
    /** ModelName */
    private $ModelName;

    /** BreadCrumbName */
    private $BreadCrumbName;

    /** @var  NotificationRepository */
    private $notificationRepository;

    /** @var  UserRepository */
    private $userRepository;

    /**
     * NotificationController constructor.
     * @param NotificationRepository $notificationRepo
     * @param UserRepository $userRepo
     */
    public function __construct(NotificationRepository $notificationRepo, UserRepository $userRepo)
    {
        $this->notificationRepository = $notificationRepo;
        $this->userRepository = $userRepo;
        $this->ModelName = 'notifications';
        $this->BreadCrumbName = 'Notification';
    }

    /**
     * Display a listing of the Notification.
     *
     * @param NotificationDataTable $notificationDataTable
     * @return Response
     */
    public function index(NotificationDataTable $notificationDataTable)
    {
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return $notificationDataTable->render('admin.notifications.index');
    }

    /**
     * Show the form for creating a new Notification.
     *
     * @return Response
     */
    public function create()
    {
        $users = $this->userRepository->all()->pluck('name', 'id');
        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName);
        return view('admin.notifications.create')->with('users', $users);
    }

    /**
     * Store a newly created Notification in storage.
     *
     * @param CreateNotificationRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationRequest $request)
    {
        $input = $request->all();
        $input['sender_id'] = Auth::id();

        $notification = $this->notificationRepository->create($input);
        $notification->users()->attach($input['send_to']);

        if (isset($input['push'])) {
            #Sent Push Notification

            $data['status'] = 1;
            $this->notificationRepository->update($data, $notification->id);
        }
        Flash::success('Notification saved successfully.');
        return redirect(route('admin.notifications.index'));
    }

    /**
     * Display the specified Notification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('admin.notifications.index'));
        }

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $notification);
        return view('admin.notifications.show')->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified Notification.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('admin.notifications.index'));
        }

        if ($notification->status == 1) {
            Flash::error('Notification has been sent. Unable to be edited');

            return redirect(route('admin.notifications.index'));
        }
        $users = $this->userRepository->all()->pluck('name', 'id');

        BreadcrumbsRegister::Register($this->ModelName, $this->BreadCrumbName, $notification);
        return view('admin.notifications.edit')->with('notification', $notification)->with('users', $users);
    }

    /**
     * Update the specified Notification in storage.
     *
     * @param  int $id
     * @param UpdateNotificationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificationRequest $request)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);
        if (empty($notification)) {
            Flash::error('Notification not found');
            return redirect(route('admin.notifications.index'));
        }

        $notification = $this->notificationRepository->update($request->all(), $id);

        $existingMembers = $notification->users->pluck('id')->toArray();
        $selectedMembers = $request->send_to;
        $newMembers = array_diff($selectedMembers, $existingMembers);
        $membersToBeDeleted = array_diff($existingMembers, $selectedMembers);

        $notification->users()->attach($newMembers);
        $notification->users()->detach($membersToBeDeleted);

        if (isset($request->push)) {
            #Sent Push Notification

            $this->notificationRepository->update(['status' => 1], $id);
        }

        Flash::success('Notification updated successfully.');

        return redirect(route('admin.notifications.index'));
    }

    /**
     * Remove the specified Notification from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notification = $this->notificationRepository->findWithoutFail($id);

        if (empty($notification)) {
            Flash::error('Notification not found');

            return redirect(route('admin.notifications.index'));
        }

        $this->notificationRepository->delete($id);

        Flash::success('Notification deleted successfully.');
        return redirect(route('admin.notifications.index'));
    }
}
