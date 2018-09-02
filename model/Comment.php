<?php


class Comment {

    public $id;
    public $task_id;
    public $user_id;
    public $comment;
    public $created;

    /**
     * Comment constructor.
     * @param $task_id
     * @param $user_id
     * @param $comment
     */
    public function __construct($task_id, $user_id, $comment) {
        $this->task_id = $task_id;
        $this->user_id = $user_id;
        $this->comment = strip_tags($comment);
    }

    public static function findById($id) {
        return DB::query("SELECT * FROM comment WHERE id= $id");
    }


    public function add() {
        $stmt = "INSERT INTO comment(task_id, user_id, comment)  VALUE  ('%s', '%s', '%s')";
        $sql = sprintf($stmt, $this->task_id, $this->user_id, $this->comment);

        $connection = DB::connection();

        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return $last_id;
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }

        return 0;
    }

    public static function delete($cid, $uid) {
        DB::query("DELETE FROM comment WHERE user_id = $uid AND id = $cid");
    }

}