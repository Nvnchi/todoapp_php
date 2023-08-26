<?php
  namespace MyApp;
  use Exception;
  include_once(__DIR__ . "/Db.php");

class TaskList{
        private $tasklist_id;
        private $user_id;
        private $name;

                /**
         * Get the value of tasklist_id
         */ 
        public function getTaskListid()
        {
                return $this->tasklist_id;
        }

        /**
         * Set the value of tasklist_id
         *
         * @return  self
         */ 
        public function setTaskListid($tasklist_id)
        {
            if(empty($tasklist_id)){
                throw new Exception("TaskList_id can't be empty");
            }
            $this->tasklist_id = $tasklist_id;

                return $this;
        }

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
            if(empty($name)){
                throw new Exception("Name can't be empty");
            }
            $this->name = $name;

                return $this;
        }

        public function getTaskLists($user_id){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          $statement = $db->prepare("SELECT * FROM tasklist WHERE user_id = ?");
          $statement->execute([$user_id]);

          $taskData = $statement->fetchAll();

          $db->close();
          if ($taskData) {
            return $taskData;
          } else {
            return null;
          }
        }

        public function createTaskList(){
            // create database class and start the connection.
            $db = new Db();
            $db->__construct();

            // insert query
            $statement = $db->prepare("insert into tasklist(`tasklist_id`, `user_id`, `name`) values (:tasklist_id, :user_id, :name)");

            $statement->bindValue(":tasklist_id", $this->tasklist_id);
            $statement->bindValue(":user_id", $this->user_id);
            $statement->bindValue(":name", $this->name);
            

            $result = $statement->execute();

            // close database connection
            $db->close();
            return $result;

        }
}
?>