<?php

namespace Controllers;

use Exception;
use Services\UserService;
use \Firebase\JWT\JWT;

class UserController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new UserService();
    }

    public function login()
    {
        // read user data from request body
        $postedUser = $this->createObjectFromPostedJson("Models\\User");

        // get user from db
        $user = $this->service->checkUsernamePassword($postedUser->email, $postedUser->password);

        // if the method returned false, the username and/or password were incorrect
        if (!$user) {
            $this->respondWithError(401, "Invalid login");
            return;
        }

        // generate jwt
        $tokenResponse = $this->generateJwt($user);

        $this->respond($tokenResponse);
    }

    public function generateJwt($user)
    {
        $secret_key = "YOUR_SECRET_KEY";
        $issuer = "THE_ISSUER"; // this can be the domain/servername that issues the token
        $audience = "THE_AUDIENCE"; // this can be the domain/servername that checks the token

        $issuedAt = time(); // issued at
        $notbefore = $issuedAt; //not valid before 
        $expire = $issuedAt + 5000; // expire in 10 minutes

        // JWT expiration times should be kept short (10-30 minutes)
        // A refresh token system should be implemented if we want clients to stay logged in for longer periods

        // note how these claims are 3 characters long to keep the JWT as small as possible
        $payload = array(
            "iss" => $issuer,
            "aud" => $audience,
            "iat" => $issuedAt,
            "nbf" => $notbefore,
            "exp" => $expire,
            "data" => array(
                "id" => $user->id,
                "email" => $user->email,
                "firstname" => $user->firstname,
            )
        );

        $jwt = JWT::encode($payload, $secret_key, 'HS256');

        return
            array(
                "message" => "Successful login.",
                "jwt" => $jwt,
                "email" => $user->email,
                "id" => $user->id,
                "firstname" => $user->firstname,
                "expireAt" => $expire
            );
    }
    public function register()
    {
        try {
            $user = $this->createObjectFromPostedJson("Models\\User");
            $exists = $this->service->checkUsernamePassword($user->email, $user->password);

            if ($exists) {
                $this->respondWithError(500, "User already exists");
                return;
            }
            $this->respondWithCode(201, $user);
            $this->service->registerUser($user);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }

    }
    public function getAll()
    {
        try {
            $token = $this->checkForJwt();
            if (!$token)
                return;

            $offset = NULL;
            $limit = NULL;

            if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
                $offset = $_GET["offset"];
            }
            if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
                $limit = $_GET["limit"];
            }

            $users = $this->service->getAllUsers($limit, $offset);
            $this->respond($users);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }
    public function checkAdmin($id)
    {
        try {
            $token = $this->checkForJwt();
            if (!$token) {
                $this->respondWithError(401, "Invalid token");
                return;
            }

            $user = $this->service->checkAdmin($id);
            if (empty($user)) {
                $this->respondWithError(404, "User not found");
                return;
            }
            $this->respond($user);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }
    public function getOne($id)
    {
        try {
            $token = $this->checkForJwt();
            if (!$token) {
                return;
            }

            $user = $this->service->getOne($id);
            if (empty($user)) {
                $this->respondWithError(404, "User not found");
                return;
            }
            $this->respond($user);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }
    public function updateUser($id)
    {
        try {
            $token = $this->checkForJwt();
            if (!$token) {
                return;
            }
            $user = $this->createObjectFromPostedJson("Models\\User");
           
            $this->service->updateUser($id, $user);
            $this->respondWithCode(204, $user);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }
    public function deleteUser($id){
        try {
            $token = $this->checkForJwt();
            if (!$token) {
                return;
            }
            $user = $this->service->deleteUser($id);
            if (empty($user)) {
                $this->respondWithError(404, "User not found");
                return;
            }
            $this->respondWithCode(204, $user);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
    }
}