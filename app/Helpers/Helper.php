<?php
if (!function_exists('printJson')) {
     function printJson($data, $statusObject = null, $lang = null){
        if($statusObject == null){
            $statusObject = buildStatusObject('HTTP_OK');
        };
        $response = [];
        $response['status'] = $statusObject->code;
        $response['status_code'] = $statusObject->status_code;
        $response['message'] = ($lang == 'en') ? $statusObject->message_en : $statusObject->message;
        $response['data'] = $data;
        return response()->json($response);
    }
}
if (!function_exists('buildStatusObject')) {
    function buildStatusObject($status){
        $statusCodeObject = app('StatusCodeObjectClass')->getObject($status);
        return $statusCodeObject;
    }
}