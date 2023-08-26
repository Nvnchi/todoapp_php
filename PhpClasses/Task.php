<?php
  namespace MyApp;
  use Exception;
  include_once(__DIR__ . "/Db.php");
class Task{
        private $task_id;
        private $user_id;
        private $name;
        private $description;
        private $duedate;
        private $isdone;
        private $tasklist_name;

                /**
         * Get the value of task_id
         */ 
        public function getTaskid()
        {
                return $this->task_id;
        }

        /**
         * Set the value of task_id
         *
         * @return  self
         */ 
        public function setTaskid($task_id)
        {
            if(empty($task_id)){
                throw new Exception("Task_id can't be empty");
            }
            $this->task_id = $task_id;

                return $this;
        }

                        /**
         * Get the value of user_id
         */ 
        public function getUserid()
        {
                return $this->user_id;
        }

        /**
         * Set the value of user_id
         *
         * @return  self
         */ 
        public function setUserid($user_id)
        {
            if(empty($user_id)){
                throw new Exception("user_id can't be empty");
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

                 /**
         * Get the value of description
         */ 
        public function getDescription()
        {
                return $this->description;
        }

        /**
         * Set the value of description
         *
         * @return  self
         */ 
        public function setDescription($description)
        {
            if(empty($description)){
                throw new Exception("Description can't be empty");
            }
            $this->description = $description;

                return $this;
        }

                         /**
         * Get the value of duedate
         */ 
        public function getDuedate()
        {
                return $this->duedate;
        }

        /**
         * Set the value of duedate
         *
         * @return  self
         */ 
        public function setDuedate($duedate)
        {
            $this->duedate = $duedate;

                return $this;
        }

                                 /**
         * Get the value of isdone
         */ 
        public function getIsDone()
        {
                return $this->isdone;
        }

        /**
         * Set the value of isdone
         *
         * @return  self
         */ 
        public function setIsDone($isdone)
        {
            if(empty($isdone)){
                throw new Exception("Isdone can't be empty");
            }
            $this->isdone = $isdone;

                return $this;
        }

                                 /**
         * Get the value of tasklist_name
         */ 
        public function getTaskListName()
        {
                return $this->tasklist_name;
        }

        /**
         * Set the value of tasklist_name
         *
         * @return  self
         */ 
        public function setTaskListName($tasklist_name)
        {
            $this->tasklist_name = $tasklist_name;

                return $this;
        }

        public function getAllTodoTasks($user_id){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          // select all from asks, checking on user id and if it's todo. Order by duedate, but when the duedate is empty or null, return 1 otherwise 0, depending on where you want it in *ordered* list.
          $statement = $db->prepare("SELECT * FROM tasks WHERE user_id = ? and isdone = 0 ORDER BY CASE WHEN duedate = '' or duedate IS NULL THEN 1 ELSE 0 END, duedate ASC");
          $statement->execute([$user_id]);

          $taskData = $statement->fetchAll();

          $db->close();
          if ($taskData) {
            return $taskData;
          } else {
            return null;
          }
        }

        public function getAllTodoTasksFilterByName($user_id){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          // select all from asks, checking on user id and if it's todo. Order by duedate, but when the duedate is empty or null, return 1 otherwise 0, depending on where you want it in *ordered* list.
          $statement = $db->prepare("SELECT * FROM tasks WHERE user_id = ? and isdone = 0 ORDER BY CASE WHEN duedate = '' or duedate IS NULL THEN 1 ELSE 0 END, tasklist_name ASC");
          $statement->execute([$user_id]);

          $taskData = $statement->fetchAll();

          $db->close();
          if ($taskData) {
            return $taskData;
          } else {
            return null;
          }
        }


        public function getAllDoneTasks($user_id){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          $statement = $db->prepare("SELECT * FROM tasks WHERE user_id = ? and isdone = 1");
          $statement->execute([$user_id]);

          $taskData = $statement->fetchAll();

          $db->close();
          if ($taskData) {
            return $taskData;
          } else {
            return null;
          }
        }


        public function getTaskByid($user_id, $task_id){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          $statement = $db->prepare("SELECT * FROM tasks where user_id = ? and task_id = ?");
          $statement->execute([$user_id, $task_id]);

          $taskData = $statement->fetch();

          $db->close();
          if ($taskData) {
            return $taskData;
          } else {
            return null;
          }
        }

        public function getTaskByNameCheckifExistsInList($tasklist_name, $name){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          $statement = $db->prepare("SELECT * FROM tasks where tasklist_name = ? and name = ?");
          $statement->execute([$tasklist_name, $name]);

          $taskData = $statement->fetch();

          $db->close();
          if ($taskData) {
            return $taskData;
          } else {
            return null;
          }
        }




        public function deleteTask($task_id){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          $statement = $db->prepare("DELETE FROM tasks where task_id = ?");
          $result = $statement->execute([$task_id]);

          if ($result !== null) {
            $statement = $db->prepare("DELETE FROM taskcomments where task_id = ?");
            $result = $statement->execute([$task_id]);
          }

          $db->close();
          return $result;
        }

        public function updateTaskTodo($task_id, $todostate){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          $statement = $db->prepare("UPDATE tasks SET isdone = ? where task_id = ?");
          $statement->execute([$todostate, $task_id]);

          $taskData = $statement->fetch();

          $db->close();
          if ($taskData) {
            return $taskData;
          } else {
            return null;
          }
        }


        public function createTask(){
            // create database class and start the connection.
            $db = new Db();
            $db->__construct();

            // insert query
            $statement = $db->prepare("insert into tasks(`task_id`, `user_id`, `name`, `description`, `duedate`, `isdone`, `tasklist_name`) values (:task_id, :user_id, :name, :description, :duedate, :isdone, :tasklist_name)");

            $statement->bindValue(":task_id", $this->task_id);
            $statement->bindValue(":user_id", $this->user_id);
            $statement->bindValue(":name", $this->name);
            $statement->bindValue(":description", $this->description);
            $statement->bindValue(":duedate", $this->duedate);
            $statement->bindValue(":isdone", false);
            $statement->bindValue(":tasklist_name", $this->tasklist_name);
            

            $result = $statement->execute();

            // close database connection
            $db->close();
            return $result;

        }
}
?>