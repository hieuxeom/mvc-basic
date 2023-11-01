<?php

class HomeModel extends BaseModel
{
    const TABLE = "users";

    public function getAllUser() {
        return $this->getAll(table: self::TABLE);
    }

    public function addNewUser($fullName, $birthDay, $score) {
        return $this->insert(table: self::TABLE, data: [
            "fullname" => $fullName,
            "birthday" => $birthDay,
            "score" => $score
        ]);
    }
}