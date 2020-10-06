<?php

namespace Core;

class Request {

    public $header;
    public $method;
    public $ip;
    public $params;
    public $files;
    public $uri;

    public function __construct()
    {
        $this->setHeader();
        $this->setMethod();
        $this->setUri();
        $this->setIp();
        $this->setParams();
        $this->setFiles();
    }

    public function setHeader($headers = null)
    {
        if (!is_null($headers)) {
            return $this->headers = $headers;
        }

        return $this->header = getallheaders();
    }

    public function setMethod($method = null)
    {
        if (!is_null($method)) {
            return $this->method = strtolower($method);
        }

        return $this->method = strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function setIp($ip = null)
    {
        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(!empty($_SERVER['HTTP_X_FORWARDED']))
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(!empty($_SERVER['HTTP_FORWARDED']))
            $ip = $_SERVER['HTTP_FORWARDED'];
        else if(!empty($_SERVER['REMOTE_ADDR']))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = 'UNKNOWN';

        return $this->ip = $ip;
    }

    public function setParams($params = null)
    {
        if (!is_null($params)) {
            return $this->params = $params;
        }

        switch ($this->method) {
            case 'get':
                return $this->params = ['queryString' => $_GET];
                break;
            case 'post':
                return $this->params = ['queryString' => $_GET, 'body' => $_POST];
                break;
            case 'put':
            case 'patch':
            case 'delete':
                parse_str(file_get_contents("php://input"), $vars);
                return $this->params = ['queryString' => $_GET, 'body' => $vars];
                break;
            default:
                return $this->params;
                break;
        }
    }

    public function setFiles($files = null)
    {
        if (!is_null($files)) {
            return $this->files = $files;
        }

        return $this->files = $_FILES;
    }

    public function setUri($uri = null)
    {
        if (!is_null($uri)) {
            return $this->uri = strtolower($uri);
        }

        $requestUri = $_SERVER['REQUEST_URI'];
        $requestUri = preg_replace('/\?.*/', '', $requestUri);

        if ($requestUri != '/') {
            $requestUri =  rtrim($requestUri, '/');
        }

        return $this->uri = strtolower($requestUri);
    }

    public function param($name)
    {
        if (isset($this->params[$name])) {
            return $this->params[$name];
        }

        return null;
    }
}
