<?php


class Task
{
    public $id;
    public $project_id;
    public $user_id;
    public $name;
    public $opis;
    public $date_start;
    public $date_end;

    public function load()
    {
        $this->project_id = $_GET['pid'];
        $this->name = $_POST['name'];
        $this->opis = $_POST['opis'];
        $this->user_id = $_POST['user_id'];
        $this->date_start = $_POST['date_start'];
        $this->date_end = $_POST['date_end'];
    }

    public function task()
    {
        $_SESSION['project_id'] = $this->id;
    }

    public static function findById($id)
    {

        return DB::query("SELECT * FROM task WHERE id= $id");

    }


    public static function findByIdInObject($id)
{

    $taskData = DB::query("SELECT * FROM task WHERE id= $id");

    $task = new Task();
    $task->id = $taskData['id'];
    $task->project_id = $taskData['project_id'];
    $task->user_id = $taskData['user_id'];
    $task->name = $taskData['name'];
    $task->opis = $taskData['opis'];
    $task->date_start = $taskData['date_start'];
    $task->date_end = $taskData['date_end'];

    return $task;
}


    public function addTask()
    {
        $connection = DB::connection();

        $sql = "INSERT INTO task(project_id, user_id, name, opis, date_start, date_end) VALUE
        (" . $this->project_id . " , " . $this->user_id . ", '" . $this->name . "', '" . $this->opis . "', '" . $this->date_start . "', '" . $this->date_end . "')";

        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return self::findById($last_id);
        } else {
            echo "Error:" . $sql . "<br>" . $connection->error;
        }
        return null;
    }

    public function editTask($tid)
    {

        $p = Task::findById($tid);

        $connection = DB::connection();
        $sql =
            "UPDATE task SET user_id='{$this->user_id}', name='{$this->name}', opis='{$this->opis}', date_start='{$this->date_start}', date_end='{$this->date_end}' WHERE $tid=task.id;";

        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return self::findById($last_id);
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }

    public static function deleteTask($tid)
    {
        $p = Task::findById($tid);

        $connection = DB::connection();
        $sql =
            "DELETE FROM task WHERE $tid=task.id;";

        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return self::findById($last_id);
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }

    public function validate()
    {
        $errors = [];
        if (empty($this->opis)) {
            $errors[$this->opis] = 'Empty';
        }
        return $errors;
    }

    public static function addUserToTask($pId, $uId)
    {
        $connection = DB::connection();

        $sql = "INSERT INTO project_team(project_id, user_id)  VALUE ($pId, $uId)";

        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return true;
        } else {
            return false;
        }

    }


}