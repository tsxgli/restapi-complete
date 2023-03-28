<?php
namespace Services;

use Repositories\UserRepository;

class UserService {

    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function checkUsernamePassword($email, $password) {
        return $this->repository->checkUsernamePassword($email, $password);
    }
    public function hashPassword($password) {
        return $this->repository->hashPassword($password);
    }

    public function registerUser($user) {
        return $this->repository->registerUser($user);
    }
    public function getUser($id) {
        return $this->repository->getUser($id);
    }
    public function updateUser($id, $firstname, $lastname, $email, $address, $postcode, $birthdate) {
        return $this->repository->updateUser($id, $firstname, $lastname, $email, $address, $postcode, $birthdate);
    }
    public function deleteUser($id) {
        return $this->repository->deleteUser($id);
    }
    public function getAllUsers($limit = NULL, $offset = NULL) {
        return $this->repository->getAllUsers( $limit, $offset);
    }
}

?>