<?php


class User
{

    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $passwordTwo;
    public $role_id;


    public function load()
    {
        $this->first_name = $_POST['first_name'];
        $this->last_name = $_POST['last_name'];
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
        $this->passwordTwo = $_POST['passwordTwo'];
        $this->role_id = $_POST['role_id'];

    }

    public function login()
    {
        $_SESSION['user_id'] = $this->id;
    }

    public static function findById($id)
    {

        $connection = DB::connection();

        $query = mysqli_query($connection, "SELECT * FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($query);


        mysqli_close($connection);

        return $row;
    }

    public static function findByIdInObject($id)
    {

        $userData = DB::query("SELECT * FROM user WHERE id=$id");

        $user = new User();
        $user->id = $userData['id'];
        $user->first_name = $userData['first_name'];
        $user->email = $userData['email'];
        $user->last_name = $userData['last_name'];
        $user->password = $userData['password'];
        $user->role_id = $userData['role_id'];

        return $user;
    }


    public function addUser()
    {

        $connection = DB::connection();
        $sql =
            "INSERT INTO user(first_name, last_name, email, password, role_id) VALUE ('" . $this->first_name .
            "', '" . $this->last_name . "', '" . $this->email . "', '" . $this->password . "', " . $this->role_id . ")";


        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return self::findById($last_id);
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;

        }

        return null;
    }

    public function editUser($uid)
    {

        $connection = DB::connection();
        $sql =
            "UPDATE user SET first_name='{$this->first_name}', email='{$this->email}', last_name='{$this->last_name}', password='{$this->password}' WHERE $uid=id;";

        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return self::findById($last_id);
        } else {
            echo mysqli_error($connection);
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }

    public static function deleteUser($uid)
    {
        $connection = DB::connection();
        $sql =
            "DELETE FROM user WHERE $uid=user.id";

        if ($connection->query($sql) === TRUE) {
            $last_id = $connection->insert_id;

            mysqli_close($connection);

            return self::findById($last_id);
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;

        }

        return null;
    }

    public function validate()
    {
        $errors = [];

        if (empty($this->first_name)) {
            $errors['first_name'] = 'Empty';
        }


        return $errors;
    }


    public static function getUsersByProject($pid)
    {
        $sql = "SELECT u.id, concat(u.first_name, ' ', u.last_name) as username FROM project_team pt
              inner join user u on pt.user_id = u.id
            where pt.project_id = $pid;";


        $result = DB::queryAll($sql);

        $users = [];
        foreach ($result as $row) {
            $users[$row['id']] = $row['username'];
        }


        return $users;
    }


    public function isAdmin(){
        return $this->role_id == self::ROLE_ADMIN;
    }

}