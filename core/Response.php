<?php

namespace Core;

class Response
{
    public static function json($data, $status = 200, $allowOrigin = "*")
    {
        header('Content-Type: application/json, charset=utf-8');
        header("Access-Control-Allow-Origin: $allowOrigin");
        http_response_code($status);

        $json = json_encode($data);

        if ($json) {
            echo $json;
            return;
        }

        throw new \Exception('error to encode json');
    }

    public static function error($type, $view = null)
    {
        if ($type < 400 || $type > 599) {
            throw new \Exception("development error, $type is not a type of error");
        }

        http_response_code($type);
        die($type);
    }
}
