<?php
class BaseModel extends Database
{
    protected $conn;
    public function __construct()
    {
        $this->conn = $this->getConnection();
    }

    public function getAll($table, $limit = null, $arraySelect = ['*'], $conditions = [], $order = null, $likeConditions = [])
    {
        $result = $this->_query($table, $arraySelect, $conditions, $limit, $order, $likeConditions);

        return $result;
    }

    public function getOne($table, $conditions = [], $arraySelect = ['*'])
    {
        $rs = $this->_queryOne($table, $arraySelect, $conditions);
        return $rs;
    }

    public function getTwoTable($table1, $table2, $joinColumn, $table1Select = [], $table2Select = [], $conditions = [], $limit = null, $order = null)
    {
        return $this->_queryWithJoin($table1, $table2, $joinColumn, $table1Select, $table2Select, $conditions, $limit, $order);
    }

    public function insert($table, $data = null)
    {
        if ($data === null) {
            return null;
        } else {
            return $this->_insertData($table, $data);
        }
    }

    public function delete($table, $conditions = [])
    {
        if (empty($conditions)) {
            return null;
        } else {
            return $this->_deleteData($table, $conditions);
        }
    }

    public function update($table, $data = [], $conditions = [])
    {
        if (empty($data) || empty($conditions)) {
            return null;
        } else {
            return $this->_updateData($table, $data, $conditions);
        }
    }

    private function _query($table, $arraySelect = ['*'], $conditions = [], $limit = null, $order = null, $likeConditions = [])
    {
        try {
            // Prepare the list of columns to select
            $column = implode(', ', $arraySelect);

            // SQL Start
            $sql = "SELECT $column FROM $table";

            // Check if conditions are provided and build the WHERE clause
            if (!empty($conditions)) {
                $sql .= " WHERE ";
                $conditionsArray = [];
                foreach ($conditions as $column => $value) {
                    $conditionsArray[] = "$column = :$column";
                }
                $sql .= implode(' AND ', $conditionsArray);
            }

            // Add LIKE conditions if provided
            if (!empty($likeConditions)) {
                if (!empty($conditions)) {
                    $sql .= " AND ";
                } else {
                    $sql .= " WHERE ";
                }
                $likeArray = [];
                foreach ($likeConditions as $column => $value) {
                    $likeArray[] = "$column LIKE :$column";
                }
                $sql .= implode(' AND ', $likeArray);
            }

            // Add ORDER BY clause if provided
            if ($order != null || !empty($order)) {
                $sql .= " ORDER BY ";
                $orderArray = [];
                foreach ($order as $key => $value) {
                    $orderArray[] = "$key $value";
                }
                $sql .= implode(', ', $orderArray);
            }

            // Add LIMIT clause if provided
            if ($limit != null) {
                $sql .= " LIMIT $limit";
            }

            // Prepare and execute the SQL statement
            $stmt = $this->conn->prepare($sql);

            // Bind parameters if conditions are provided
            if (!empty($conditions)) {
                foreach ($conditions as $column => $value) {
                    $stmt->bindValue(":$column", $value);
                }
            }

            // Bind LIKE parameters if provided
            if (!empty($likeConditions)) {
                foreach ($likeConditions as $column => $value) {
                    $stmt->bindValue(":$column", "%$value%", PDO::PARAM_STR);
                }
            }

            // Execute
            $stmt->execute();

            // Return the result as an associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Return false if query Error;
            return false;
        }
    }



    private function _queryOne($table, $arraySelect = ['*'], $conditions = [])
    {
        try {
            $column = implode(', ', $arraySelect);

            $sql = "SELECT $column FROM $table";

            // Check if conditions are provided and build the WHERE clause
            if (!empty($conditions)) {
                $sql .= " WHERE ";
                $conditionsArray = [];
                foreach ($conditions as $column => $value) {
                    $conditionsArray[] = "$column = :$column";
                }
                $sql .= implode(' AND ', $conditionsArray);
            }

            $stmt = $this->conn->prepare($sql);

            // Bind parameters if conditions are provided
            if (!empty($conditions)) {
                foreach ($conditions as $column => $value) {
                    $stmt->bindValue(":$column", $value);
                }
            }

            $stmt->execute();
            // Return the result as an associative array
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                return [];
            }
        } catch (PDOException $e) {
            // Handle any exceptions (e.g., database errors)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    private function _queryWithJoin($table1, $table2, $joinColumn, $table1Select = [], $table2Select = [], $conditions = [], $limit = null, $order = null)
    {
        try {
            $columns1 = $table1 . '.' . implode(", $table1.", $table1Select);
            $columns2 = $table2 . '.' . implode(", $table2.", $table2Select);
            $sql = "SELECT $columns1, $columns2 FROM $table1 
                    INNER JOIN $table2 ON $table1.$joinColumn = $table2.$joinColumn";

            // Check if conditions are provided and build the WHERE clause
            if (!empty($conditions)) {
                $sql .= " WHERE ";
                $conditionsArray = [];
                foreach ($conditions as $column => $value) {
                    $conditionsArray[] = "$table1.$column = :$column";
                }
                $sql .= implode(' AND ', $conditionsArray);
            }

            if ($limit !== null) {
                $sql .= " LIMIT $limit";
            }

            if ($order !== null) {
                $sql .= " ORDER BY ";
                foreach ($order as $key => $value) {
                    $sql .= " $table1.$key $value";
                }
            }

            $stmt = $this->conn->prepare($sql);

            // Bind parameters if conditions are provided
            if (!empty($conditions)) {
                foreach ($conditions as $column => $value) {
                    $stmt->bindValue(":$column", $value);
                }
            }

            $stmt->execute();

            // Return the result as an associative array
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle any exceptions (e.g., database errors)
            echo "Error: " . $e->getMessage();
            return [];
        }
    }




    private function _insertData($table, $data = [])
    {
        try {
            $columns = implode(', ', array_keys($data));
            $placeholders = ':' . implode(', :', array_keys($data));
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            foreach ($data as $param => $value) {
                $stmt->bindValue(':' . $param, $value);
            }

            // Execute the INSERT statement
            $result = $stmt->execute();

            // Return true if insertion was successful, otherwise false
            return $result;
        } catch (PDOException $e) {
            // Handle any exceptions (e.g., database errors)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    private function _deleteData($table, $condition = [])
    {
        try {
            $whereClause = '';
            if (!empty($condition)) {
                $whereClause = ' WHERE ';
                $conditions = [];
                foreach ($condition as $column => $value) {
                    $conditions[] = "$column = :$column";
                }
                $whereClause .= implode(' AND ', $conditions);
            }

            $sql = "DELETE FROM $table $whereClause";

            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            foreach ($condition as $column => $value) {
                $stmt->bindValue(':' . $column, $value);
            }

            // Execute the DELETE statement
            $result = $stmt->execute();

            // Return true if deletion was successful, otherwise false
            return $result;
        } catch (PDOException $e) {
            // Handle any exceptions (e.g., database errors)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    private function _updateData($table, $data = [], $conditions = [])
    {
        try {
            // Create SET clause for updating columns
            $setClause = '';
            foreach ($data as $column => $value) {
                $setClause .= "$column = :$column, ";
            }
            // Remove trailing comma and space
            $setClause = rtrim($setClause, ', ');

            // Create WHERE clause for conditions
            $whereClause = '';
            foreach ($conditions as $column => $value) {
                $whereClause .= "$column = :cond_$column AND ";
            }
            // Remove trailing "AND" and space
            $whereClause = rtrim($whereClause, 'AND ');

            // SQL query to update data
            $sql = "UPDATE $table SET $setClause WHERE $whereClause";

            $stmt = $this->conn->prepare($sql);

            // Bind parameters for SET clause
            foreach ($data as $param => $value) {
                $stmt->bindValue(':' . $param, $value);
            }

            // Bind parameters for WHERE clause
            foreach ($conditions as $param => $value) {
                $stmt->bindValue(':cond_' . $param, $value);
            }

            // Execute the UPDATE statement
            $result = $stmt->execute();

            // Return true if update was successful, otherwise false
            return $result;
        } catch (PDOException $e) {
            // Handle any exceptions (e.g., database errors)
            echo "Error: " . $e->getMessage();
            return false;
        }
    }


}


?>