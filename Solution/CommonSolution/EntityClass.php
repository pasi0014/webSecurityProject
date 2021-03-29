<?php
class User {
    private $userId;
    private $firstName;
    private $lastName;
    private $userName;
    private $email;
    private $phone;

    public function __construct($userId, $firstName, $lastName, $userName, $phone, $email)
    {
        $this->userId = $userId;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->phone = $phone;
        $this->email = $email;
    }


    public function getUserId() {
        return $this->userId;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getFullName(): string
    {
        return $this->firstName." ".$this->lastName;
    }

    public function getFirstName(): string{
        return $this->firstName;
    }

    public function getLastName(): string{
        return $this->lastName;
    }

    public function getPhone() {
        return $this->phone;
    }
}
