<?php
  namespace MyApp;
  use Exception;
  include_once(__DIR__ . "/Db.php");

class TaskComment{
        private $task_id;
        private $comment_id;
        private $comment;

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
                  throw new Exception("Task Id can't be empty");
                }
                $this->task_id = $task_id;

                return $this;
        }

                        /**
         * Get the value of comment_id
         */ 
        public function getCommentid()
        {
                return $this->comment_id;
        }

        /**
         * Set the value of comment_id
         *
         * @return  self
         */ 
        public function setCommentid($comment_id)
        {
                if(empty($comment_id)){
                  throw new Exception("Comment Id can't be empty");
                }
                $this->comment_id = $comment_id;

                return $this;
        }

                        /**
         * Get the value of comment
         */ 
        public function getComment()
        {
                return $this->comment;
        }

        /**
         * Set the value of comment
         *
         * @return  self
         */ 
        public function setComment($comment)
        {
                if(empty($comment)){
                  throw new Exception("Comment can't be empty");
                }
                $this->comment = $comment;

                return $this;
        }

        public function getAllCommentsByTaskid($task_id){
          // create database class and start the connection.
          $db = new Db();
          $db->__construct();

          $statement = $db->prepare("SELECT * FROM taskcomments where task_id = ?");
          $statement->execute([$task_id]);

          $taskData = $statement->fetchAll();

          $db->close();
          if ($taskData) {
            return $taskData;
          } else {
            return null;
          }
        }

        public function createTaskComment(){
            // create database class and start the connection.
            $db = new Db();
            $db->__construct();

            // insert query
            $statement = $db->prepare("insert into taskcomments(`task_id`, `comment_id`, `comment`) values (:task_id, :comment_id, :comment)");

            $statement->bindValue(":task_id", $this->task_id);
            $statement->bindValue(":comment_id", $this->comment_id);
            $statement->bindValue(":comment", $this->comment);

            $result = $statement->execute();

            // close database connection
            $db->close();
            return $result;
        }
}
?>