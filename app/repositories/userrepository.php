<?php

namespace Repositories;

use PDO;
use PDOException;
use Models\User;
use Repositories\Repository;

class UserRepository extends Repository
{
    function checkUsernamePassword($email, $password)
    {
        try {
            // retrieve the user with the given username
            $stmt = $this->connection->prepare("SELECT id, firstname,lastname, isAdmin,address,postcode,birthdate,password, email FROM User WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();

            if (!$user)
                return false;

            // verify if the password matches the hash in the database
            $result = $this->verifyPassword($password, $user->password);

            if (!$result)
                return false;

            // do not pass the password hash to the caller
            $user->password = "";

            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function registerUser(User $user)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO User (firstname, lastname,email, password, isAdmin, address,postcode, birthdate) 
                                                    VALUES ( :firstname,:lastname, :email, :password, :isAdmin, :address, :postcode, :birthdate);');

            $stmt->bindValue(':email', $user->email, PDO::PARAM_STR);
            $stmt->bindValue(':address', $user->address, PDO::PARAM_STR);
            $stmt->bindValue(':password', $this->hashPassword($user->password), PDO::PARAM_STR);
            $stmt->bindValue(':postcode', $user->postcode, PDO::PARAM_STR);
            $stmt->bindValue(':lastname', $user->lastname, PDO::PARAM_STR);
            $stmt->bindValue(':firstname', $user->firstname, PDO::PARAM_STR);
            $stmt->bindValue(':birthdate', $user->birthdate, PDO::PARAM_STR);
            $stmt->bindValue(':isAdmin', $user->isAdmin, PDO::PARAM_BOOL);

             $stmt->execute();
            $movieId=$this->connection->lastInsertId();
            return $this->getOne($movieId);
           
        } catch (PDOException $e) {
            echo "Registering user failed: " . $e->getMessage();
        }


    }

    // hash the password (currently uses bcrypt)
    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // verify the password hash
    function verifyPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }

    function getAllUsers($limit = NULL, $offset = NULL)
    {
        try {
            $query = "SELECT * FROM User";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $users = array();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) !== false) {
                $users[] = $this->rowToUser($row);
            }

            return $users;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function rowToUser($row)
    {
        $user = new User();
        $user->id = $row['id'];
        $user->firstname = $row['firstname'];
        $user->lastname = $row['lastname'];
        $user->email = $row['email'];
        $user->address = $row['address'];
        $user->postcode = $row['postcode'];
        $user->birthdate = $row['birthdate'];
        $user->isAdmin = $row['isAdmin'];
        return $user;
    }
    public function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM User WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();

            return $user;

        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function updateUser($id,$user)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE User SET firstname = :firstname, lastname = :lastname, email = :email, address = :address, postcode = :postcode, birthdate = :birthdate WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':firstname', $user->firstname);
            $stmt->bindParam(':lastname', $user->lastname);
            $stmt->bindParam(':email', $user->email);
            $stmt->bindParam(':address', $user->address);
            $stmt->bindParam(':postcode', $user->postcode);
            $stmt->bindParam(':birthdate', $user->birthdate);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function deleteUser($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM User WHERE id = :id");
            $stmt->bindParam(':id', $id);
           return $stmt->execute();
             
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function checkAdmin($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT isAdmin FROM User WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();
            return $user;

        } catch (PDOException $e) {
            echo $e;
        }
    }


}