<?php
namespace Models;

class User {
	private int $id;
    private string $firstname;
    private string $lastname;
    private string $postcode;
    private string $address; 
    private string $birthdate;
    private string $email;
    private string $password;
    private bool $isAdmin;
}

?>