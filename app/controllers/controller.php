<?php

namespace Controllers;

use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Controller
{
    function checkForJwt() {
         // Check for token header
         if(!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->respondWithError(401, "No token provided");
            return;
        }
        // Read JWT from header
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        // Strip the part "Bearer " from the header
        $arr = explode(" ", $authHeader);

        if(isset($arr[1])) {
            $jwt = $arr[1];
        } else {
            $this->respondWithError(401, "Invalid authorization header");
            return;
        }

        // Decode JWT
        $secret_key = "YOUR_SECRET_KEY";

        if ($jwt) {
            try {
                $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
                // username is now found in
                // echo $decoded->data->username;
                return $decoded;
            } catch (Exception $e) {
                $this->respondWithError(401, $e->getMessage());
                return;
            }
        }
        else{
            $this->respondWithError(401, "No token provided");
            return;
        }
    }

    function respond($data)
    {
        $this->respondWithCode(200, $data);
    }

    function respondWithError($httpcode, $message)
    {
        $data = array('errorMessage' => $message);
        $this->respondWithCode($httpcode, $data);
    }

     function respondWithCode($httpcode, $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpcode);
        echo json_encode($data);
    }

    function createObjectFromPostedJson($className)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $object = new $className();
        foreach ($data as $key => $value) {
            if(is_object($value)) {
                continue;
            }
            $object->{$key} = $value;
        }
        return $object;
    }
    protected function sanitize($data)
    {
        if (is_object($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    $data->$key = htmlspecialchars($value);
                }
            }
        } else if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (is_string($value)) {
                    $data[$key] = htmlspecialchars($value);
                }
            }
        }
        return $data;
    }
}
