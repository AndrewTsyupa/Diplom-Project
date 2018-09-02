<?php


class Project
{
    public $id;
    public $name;
    public $date_start;
    public $date_stop;
    public $owner_id;


    public function load()
    {
        $this->name = $_POST['name'];
        $this->date_start = $_POST['date_start'];
        $this->date_stop = $_POST['date_stop'];
        $this->owner_id = $_SESSION['user']['id'];
    }

    public static function findByIdInObject($id)
    {

        $projectData = DB::query("SELECT * FROM project WHERE id= $id");

        $project = new Project();
        $project->id = $projectData['id'];
        $project->name = $projectData['name'];
        $project->date_start = $projectData['date_start'];
        $project->date_stop = $projectData['date_stop'];
        return $project;
    }


    public function project()
    {
        $_SESSION['project_id'] = $this->id;
    }

    public static function findById($id)
    {
        return DB::query("SELECT * FROM project WHERE id = $id");
    }

    public function addProject()
    {
        $connection = DB::connection();
        $sql =
            "INSERT INTO project(name, date_start, date_stop, owner_id) VALUE ('" . $this->name .
            "', '" . $this->date_start . "', '" . $this->date_stop . "', ". $this->owner_id .")";

        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return self::findById($last_id);
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;

        }

        return null;
    }

    public static function deleteProject($pid)
    {
        // project_team delete
        // task delete
        // project delete
        $connection = DB::connection();
        $sql =
            "DELETE project, task FROM project INNER JOIN task WHERE $pid=project.id AND $pid=task.project_id";

        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return self::findById($last_id);
        } else {
            echo "Error: " . $sql  . "<br>" . $connection->error;

        }

        return null;
    }

    public function editProject($pid)
    {

        $p = Project::findById($pid);



        $connection = DB::connection();
        $sql =
            "UPDATE project SET name='{$this->name}', date_start='{$this->date_start}', date_stop='{$this->date_stop}' WHERE $pid=project.id;";

        if ($connection->query($sql) === TRUE){
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

        if (empty($this->name)) {
            $errors['name'] = 'Empty';
        }
        return $errors;
    }

    public static function addUserToProject($pId, $uId)
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

