<?php

class ProfileModel extends BaseModel
{
    const USER_TABLE = "users";

    public function getUserInfo($user_id)
    {
        $userInfo = $this->getOne(self::USER_TABLE, [
            'user_id' => $user_id,
        ]);

        if (empty($userInfo)) {
            return false;
        } else {
            return $userInfo;
        }
    }

    public function changeUserInfo($user_id, $username, $fullname, $email)
    {
        $checkUpdate = $this->update(self::USER_TABLE, [
            "username" => $username,
            "fullname" => $fullname,
            "email" => $email,
        ], [
            "user_id" => $user_id
        ]);
        return true;
    }

    public function changePassword($user_id, $newPassword)
    {
        $checkUpdate = $this->update(self::USER_TABLE, [
            "password" => password_hash($newPassword, PASSWORD_DEFAULT)
        ], [
            "user_id" => $user_id,
        ]);
    }

    public function checkDiffPassword($user_id, $newPassword)
    {
        $hashOldPassword = $this->getUserInfo($user_id)["password"];
        if (password_verify($newPassword, $hashOldPassword)) {
            return false;
        } else {
            return true;
        }
    }

    public function verifyOldPassword($user_id, $oldPassword)
    {
        $hashOldPassword = $this->getUserInfo($user_id)["password"];
        echo "con acc gi v troi: " . (password_verify($hashOldPassword, $oldPassword));
        if (password_verify($oldPassword, $hashOldPassword)) {
            return true;
        } else {
            return false;
        }
    }

    public function isMatchPassword($newPassword, $reNewPassword)
    {
        if ($newPassword == $reNewPassword) {
            return true;
        } else {
            return false;
        }
    }
}