<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use InfyOm\Generator\Utils\ResponseUtil;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel APIs Generator ",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    /**
     * @param $result
     * @param $message
     * @return mixed
     */
    public function sendResponse($result, $message)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result));
    }

    /**
     * @param $errors
     * @param int $code
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($errors, $code = 404, $data = [])
    {
        $dataErrors = [];
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                $dataErrors[] = [
                    'label'   => $key,
                    'message' => $error
                ];
            }
        }
        return response()->json($this->makeError('Not Found', $data, $dataErrors), $code);
    }

    /**
     * @param array $errors
     * @param int $code
     * @param array $data
     * @return mixed
     */
    public function sendErrorWithData(array $errors = [], $code = 404, $data = [])
    {
        $dataErrors = [];
        if (!empty($errors)) {
            foreach ($errors as $key => $error) {
                $dataErrors[] = [
                    'label'   => $key,
                    'message' => $error
                ];
            }
        }
        /*if (empty($data)) {
            $data = ['errors' => $error];
        }*/
        return response()->json($this->makeError($dataErrors[0]['message'], $data, $dataErrors), $code);
    }

    /**
     * @param string $message
     * @param array $data
     * @param array $errors
     * @return array
     */
    public static function makeError($message, array $data = [], array $errors = [])
    {
        return [
            'success' => false,
            'message' => $message,
            'data'    => $data,
            'errors'  => $errors,
        ];
    }
}