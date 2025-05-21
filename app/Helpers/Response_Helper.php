<?php

/**
 * Default response
 */
function responseError($message, $errors = [], $data = [])
{
    log_message('error', '[AI Error] {$message}');
    return array(
        'error'   => true,
        'message' => $message,
        'errors'  => $errors,
        'data'    => $data
    );
}

function responseSuccess($message, $errors = [], $data = [], $redirectPath = false)
{
    return array(
        'error'        => false,
        'message'      => $message,
        'errors'       => $errors,
        'data'         => $data,
        'redirectPath' => $redirectPath
    );
}
?>