<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\Api\ChangePasswordAPIRequest;
use App\Http\Requests\Api\ForgotPasswordCodeRequest;
use App\Http\Requests\Api\LoginAPIRequest;
use App\Http\Requests\Api\RegistrationAPIRequest;
use App\Http\Requests\Api\SocialLoginAPIRequest;
use App\Http\Requests\Api\UpdateForgotPasswordRequest;
use App\Http\Requests\Api\VerifyCodeRequest;
use App\Models\Role;
use App\Repositories\Admin\SocialAccountRepository;
use App\Repositories\Admin\UDeviceRepository;
use App\Repositories\Admin\UserDetailRepository;
use App\Repositories\Admin\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class AuthAPIController
 * @package App\Http\Controllers\Api
 */
class AuthAPIController extends AppBaseController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var UserDetailRepository
     */
    protected $userDetailRepository;

    /**
     * @var UDeviceRepository
     */
    protected $uDevice;

    /**
     * @var SocialAccountRepository
     */
    protected $socialAccountRepository;

    /**
     * AuthAPIController constructor.
     * @param UserRepository $userRepo
     * @param UserDetailRepository $userDetailRepo
     * @param UDeviceRepository $uDeviceRepo
     * @param SocialAccountRepository $socialAccountRepo
     */
    public function __construct(UserRepository $userRepo, UserDetailRepository $userDetailRepo, UDeviceRepository $uDeviceRepo, SocialAccountRepository $socialAccountRepo)
    {
        $this->userRepository          = $userRepo;
        $this->userDetailRepository    = $userDetailRepo;
        $this->uDevice                 = $uDeviceRepo;
        $this->socialAccountRepository = $socialAccountRepo;
    }

    /**
     * @param RegistrationAPIRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     *
     * @SWG\Post(
     *      path="/register",
     *      summary="Register a new user.",
     *      tags={"Authorization"},
     *      description="Register User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Register")
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
     *                  ref="#/definitions/Register"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function register(RegistrationAPIRequest $request)
    {
        try {
            $user = $this->userRepository->saveRecord($request);
            $this->userDetailRepository->saveRecord($user->id, $request);

            // check if device token exists
//            if (property_exists($request, 'device_token')) {
//                $this->uDevice->saveRecord($user->id, $request);
//            }

            //attach role to user....
            $this->userRepository->attachRole($user->id, [Role::ROLE_USER]);

            $credentials = [
                'email'    => $request->email,
                'password' => $request->password
            ];

            if (!$token = auth()->guard('api')->attempt($credentials)) {
                return $this->sendErrorWithData(["Invalid Login Credentials"], 403);
            }
            return $this->respondWithToken($token, $request);

            /*DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
              $subject = "Please verify your email address.";
              Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
                  function($mail) use ($email, $name, $subject){
                      $mail->from(getenv('FROM_EMAIL_ADDRESS'), "From User/Company Name Goes Here");
                      $mail->to($email, $name);
                      $mail->subject($subject);
                  });*/
        } catch (\Exception $e) {
            return $this->sendError([$e->getMessage()], 500);
        }
    }

    /**
     * @param LoginAPIRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *      path="/login",
     *      summary="Login a user.",
     *      tags={"Authorization"},
     *      description="Login User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="User that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Login")
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
     *                  ref="#/definitions/Login"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function login(LoginAPIRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return $this->sendErrorWithData([
                "loginFailed" => "Invalid Login Credentials"
            ], 403, []);
        }

        return $this->respondWithToken($token, $request);
    }

    /**
     * @param SocialLoginAPIRequest $request
     * @return mixed
     *
     * @SWG\Post(
     *      path="/social_login",
     *      summary="Login With Social Account.",
     *      tags={"Authorization"},
     *      description="Login With Social Account.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Login With Social Account.",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/SocialAccounts")
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
     *                  ref="#/definitions/SocialAccounts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function socialLogin(SocialLoginAPIRequest $request)
    {
        $user    = false;
        $input   = $request->all();
        $account = $this->socialAccountRepository->findWhere(['platform' => $input['platform'], 'client_id' => $input['client_id'], 'deleted_at' => null])->first();

        if ($account) {
            // Account found. generate token;
            $user = $account->user;
        } else {
            // Check if email address already exists. if yes, then link social account. else register new user.
            if (property_exists($input, 'email')) {
                $user = $this->userRepository->findWhere(['email' => $input['email']])->first();
            }

            if (!$user) {
                // Register user with only social details and no password.
                $userData             = [];
                $userData['name']     = $input['username'] ?? "user_" . $input['client_id'];
                $userData['email']    = $input['email'] ?? $input['client_id'] . '_' . $input['platform'] . '@' . config('app.name') . '.com';
                $userData['password'] = bcrypt(substr(str_shuffle(MD5(microtime())), 0, 12));
                $user                 = $this->userRepository->create($userData);

                $userDetails['user_id']    = $user->id;
                $userDetails['first_name'] = $user->name;
                $userDetails['image']      = null;
                if ($request->hasFile('image')) {
                    $file                 = $request->file('image');
                    $userDetails['image'] = Storage::putFile('users', $file);
                }
                $userDetails['email_updates']   = 1;
                $userDetails['is_social_login'] = 1;
                $this->userDetailRepository->create($userDetails);
            }
            // Add social media link to the user
            $this->socialAccountRepository->saveRecord($user->id, $request);
        }

        if (property_exists($input, 'username')) {
            $user->name = $input['username'];
            $user->save();
        }

        if (!$token = JWTAuth::fromUser($user)) {
            return $this->sendError(['Invalid credentials, please try login again']);
        }

        return $this->respondWithToken($token, $request);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *      path="/me",
     *      summary="user profile.",
     *      tags={"Authorization"},
     *      description="user profile.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
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
     *
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function me()
    {
        return $this->sendResponse(auth()->user(), 'My Profile');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     * @SWG\Post(
     *      path="/refresh",
     *      summary="refresh auth token.",
     *      tags={"Authorization"},
     *      description="refresh auth token.",
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
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
     *
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function refresh(Request $request)
    {
        // FIXME: Find a better fix. This is not a good workaround. but working fine.
        auth()->guard('api')->factory()->setTTL(config('jwt.refresh_ttl'));

        return $this->respondWithToken(auth()->guard('api')->refresh(), $request);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *      path="/logout",
     *      summary="logout user.",
     *      tags={"Authorization"},
     *      description="logout user.",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="User Auth Token{ Bearer ABC123 }",
     *          type="string",
     *          required=true,
     *          default="Bearer ABC123",
     *          in="header"
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
     *
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function logout()
    {
        auth()->guard('api')->logout();

        return $this->sendResponse([], 'Successfully logged out');
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @param array $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token, Request $request)
    {
        $user = auth()->guard('api')->setToken($token)->user()->toArray();

        // check if device token exists
        if ($request->has('device_token')) {
            $this->uDevice->saveRecord($user['id'], $request);
        }
        $user = array_merge($user, [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth()->guard('api')->factory()->getTTL() * 60
        ]);
        return $this->sendResponse(['user' => $user], 'Logged in successfully');
    }

    /**
     * @param ForgotPasswordCodeRequest $request
     * @return mixed
     *
     * @SWG\Get(
     *      path="/forget-password",
     *      summary="Forget password request.",
     *      tags={"Passwords"},
     *      description="Register User",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="email",
     *          description="User email",
     *          type="string",
     *          required=true,
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
     *
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function getForgetPasswordCode(ForgotPasswordCodeRequest $request)
    {
        $user = $this->userRepository->getUserByEmail($request->email);
        if (!$user) {

            return $this->sendErrorWithData(["Email" => "Your email address was not found."], 403);
        }

        $code = rand(1111, 9999);

        $subject = "Forgot Password Verification Code";
        try {
            $email = $user->email;
            $name  = $user->name;

            $check = DB::table('password_resets')->where('email', $email)->first();
            if ($check) {
                DB::table('password_resets')->where('email', $email)->delete();
            }

            DB::table('password_resets')->insert(['email' => $email, 'code' => $code, 'created_at' => Carbon::now()]);
            Mail::send('email.verify', ['name' => $user->name, 'verification_code' => $code],
                function ($mail) use ($email, $name, $subject) {
                    $mail->from(getenv('MAIL_FROM_ADDRESS'), getenv('APP_NAME'));
                    $mail->to($email, $name);
                    $mail->subject($subject);
                });
        } catch (\Exception $e) {
            return $this->sendErrorWithData([$e->getMessage()], 403);
        }
        return $this->sendResponse([], 'Verification Code Send To Your Email');
    }

    /**
     * @param VerifyCodeRequest $request
     * @return mixed
     *
     * @SWG\Post(
     *      path="/verify-reset-code",
     *      summary="verify forget password request code.",
     *      tags={"Passwords"},
     *      description="verify code",
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          name="verification_code",
     *          description="verification code",
     *          type="integer",
     *          required=true,
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
     *
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function verifyCode(VerifyCodeRequest $request)
    {
        $code = $request->verification_code;

        $check = DB::table('password_resets')->where('code', $code)->first();
        if (!is_null($check)) {
            $data['email'] = $check->email;
            $data['code']  = "valid";
//            DB::table('password_resets')->where('code', $check->email)->delete();
            return $this->sendResponse(['user' => $data], 'Verified');
        } else {
            return $this->sendErrorWithData(['Code Is Invalid'], 403);
        }
    }

    /**
     * @param UpdateForgotPasswordRequest $request
     * @return mixed
     *
     * @SWG\Post(
     *      path="/reset-password",
     *      summary="Reset password.",
     *      tags={"Passwords"},
     *      description="Reset password.",
     *      produces={"application/json"},
     *     @SWG\Parameter(
     *          name="email",
     *          description="user email ",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
     *     @SWG\Parameter(
     *          name="verification_code",
     *          description="verification code",
     *          type="integer",
     *          required=true,
     *          in="query"
     *      ),@SWG\Parameter(
     *          name="password",
     *          description="new password",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),@SWG\Parameter(
     *          name="password_confirmation",
     *          description="confirm password",
     *          type="string",
     *          required=true,
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
     *
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function updatePassword(UpdateForgotPasswordRequest $request)
    {
        $code = $request->verification_code;

        $check = DB::table('password_resets')->where(['code' => $code, 'email' => $request->email])->first();
        if (!is_null($check)) {
            $postData['password'] = bcrypt($request->password);
            try {
                $data = $this->userRepository->getUserByEmail($request->email);
                $user = $this->userRepository->update($postData, $data->id);
                DB::table('password_resets')->where(['code' => $code, 'email' => $request->email])->delete();

                return $this->sendResponse(['user' => $user], 'Password Changed');
            } catch (\Exception $e) {
                return $this->sendErrorWithData([$e->getMessage()], 403);
            }
        } else {
            return $this->sendErrorWithData(['Code Is Invalid'], 403);
        }
    }

    /**
     * @param ChangePasswordAPIRequest $request
     * @return mixed
     *
     * @SWG\Post(
     *      path="/change-password",
     *      summary="Change password.",
     *      tags={"Passwords"},
     *      description="Change Password password.",
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
     *          name="current_password",
     *          description="Current Password",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="password",
     *          description="new password",
     *          type="string",
     *          required=true,
     *          in="query"
     *      ),
     *      @SWG\Parameter(
     *          name="password_confirmation",
     *          description="confirm password",
     *          type="string",
     *          required=true,
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
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function changePassword(ChangePasswordAPIRequest $request)
    {
        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            $this->userRepository->update(['password' => bcrypt($request->password)], $user->id);
            return $this->sendResponse($user, 'Password Successfully Updated');
        }
        return $this->sendError(['Wrong password'], 403);
    }
}