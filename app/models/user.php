<?php
namespace Models;

class User {
	public int $id;
     public string $firstname;
    public string $lastname;
    public string $postcode;
    public string $address; 
    public string $birthdate;
    public string $email;
    public string $password;
    public bool $isAdmin;
}

?>