<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.04.2018
 * Time: 16:47
 */

class LoginForm
{
    public $id;
    public $email;
    public $password;

    public function load()
    {
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
    }

    public function login()
    {
        $_SESSION['user_id'] = $this->id;

    }

    public function checkLogin()
    {

        $connection = DB::connection();

        $query = mysqli_query($connection, "SELECT * FROM user WHERE email = '$this->email' AND password = '$this->password'");
        $row = mysqli_fetch_assoc($query);


        mysqli_close($connection);

        return $row;
    }

    public function validate()
    {
        $errors = [];

        if (empty($this->email)) {
            $errors['email'] = 'Empty';
        }
        return $errors;
    }

}