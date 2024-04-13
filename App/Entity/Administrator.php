<?php
namespace App\Entity;

use DateTime;

class Administrator
{
    protected string $name;
    protected string $firstName;
    protected string $email;
    protected string $password;
    protected DateTime $creationDate;

    public function __construct(
        $name, $firstName, $email, $password, $creationDate
    )
    {
        $this->name = $name;
        $this->firstName =  $firstName;
        $this->email =  $email;
        $this->password =  $password;
        $this->creationDate =  $creationDate;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of firstName
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */ 
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of creationDate
     */ 
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set the value of creationDate
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Verify the password
     *
     * @return  boolean true if the password is ok, false if it is wrong
     */ 
    public function verifyPassword(string $password): bool
    {
        if (password_verify($password, $this->password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if the user is connected
     * 
     * @return boolean true if the user is already logged in, false elseway
     */
    public static function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }
};


