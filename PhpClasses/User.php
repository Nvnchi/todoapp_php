<?php
  namespace MyApp;
  use Exception;
  include_once(__DIR__ . "/Db.php");
  use PDO;

class User{
        private $user_id;
        private $username;
        private $firstname;
        private $lastname;
        private $email;
        private $password;

                /**
         * Get the value of username
         */ 
        public function getUserid()
        {
                return $this->user_id;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUserid($user_id)
        {
            if(empty($user_id)){
                throw new Exception("User_id can't be empty");
            }
            $this->user_id = $user_id;

                return $this;
        }

        /**
         * Get the value of username
         */ 
        public function getUsername()
        {
                return $this->username;
        }

        /**
         * Set the value of username
         *
         * @return  self
         */ 
        public function setUsername($username)
        {
            if(empty($username)){
                throw new Exception("⚠️ Please fill in an username.");
            }
            $this->username = $username;

                return $this;
        }

        /** met een getter willen we eerst informatie krijgen, een setter zal dan de informatie "setten" in het huidig object (= $this) */

        public function getLastname()
        {
                return $this->lastname;
        }

        /**
         * Set the value of lastname
         *
         * @return  self
         */ 

        public function setLastname($lastname)
        {
            if(empty($lastname)){
                throw new Exception("⚠️ Please fill in your last name.");
            }
            $this->lastname = $lastname;

                return $this;
        }

        public function getFirstname()
        {
                return $this->firstname;
        }

        /**
         * Set the value of firstname
         *
         * @return  self
         */ 

        public function setFirstname($firstname)
        {
            if(empty($firstname)){
                throw new Exception("⚠️ Please fill in your first name.");
            }
            $this->firstname = $firstname;

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

        public function getUserByUsername($username){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          $statement = $db->prepare("SELECT * FROM users WHERE username = :username");
          $statement->bindParam(':username', $username, PDO::PARAM_STR);
          $statement->execute();

          $userData = $statement->fetch(PDO::FETCH_ASSOC);

          $db->close();
          if ($userData) {
            return $userData;
          } else {
            return null;
          }
        }

        public function createUser(){
            // create database class and start the connection.
            $db = new Db();
            $db->__construct();

            // insert query
            $statement = $db->prepare("insert into users(`user_id`, `username`, `password`, `firstname`, `lastname`, `email`) values (:user_id, :username, :password, :firstname, :lastname, :email)");

            $statement->bindValue(":user_id", $this->user_id);
            $statement->bindValue(":username", $this->username);
            $statement->bindValue(":email", $this->email);
            $statement->bindValue(":firstname", $this->firstname);
            $statement->bindValue(":lastname", $this->lastname);
            $statement->bindValue(":password", $this->password);
            

            $result = $statement->execute();

            // close database connection
            $db->close();
            return $result;

        }
}
?>