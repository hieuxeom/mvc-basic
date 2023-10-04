<?php
class AuthModel extends BaseModel
{
    const USER_TABLE = 'users';

    public function logout()
    {
        unset($_SESSION['permission']);
        unset($_SESSION['is_login']);
    }

    public function createAccount($fullname, $username, $email, $password)
    {
        $checkExistEmail = $this->checkExistEmail($email);
        $checkExistUsername = $this->checkExistUsername($username);

        if ($checkExistEmail) {
            return 3;
        } else if ($checkExistUsername) {
            return 4;
        } else {
            return $this->insert(self::USER_TABLE, [
                'fullname' => $fullname,
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ]);
        };
    }

    public function signIn($username, $password) {
        $querryAccount = $this->getOne('users', ['username' => $username]);

        if (empty($querryAccount)) {
            return false;
        }
        if (password_verify($password, $querryAccount['password'])) {
            $_SESSION['permission'] = $querryAccount['role'];
            $_SESSION['user_id'] = $querryAccount['user_id'];
            $_SESSION['is_login'] = true;
            return true;
        } else {
            return false;
        }

        
    }

    private function checkExistEmail($email)
    {
        $queryEmail = $this->getOne('users', ['email' => $email]);
        if (empty($queryEmail)) {
            return false;
        } else {
            return true;
        }
    }
    
    private function checkExistUsername($username)
    {
        $queryUsername = $this->getOne('users', ['username' => $username]);
        if (empty($queryUsername)) {
            return false;
        } else {
            return true;
        }
    }
}