<?php

include_once '../database/dbconnection.php';

class Employee extends Databases {

    public function insert($name, $email, $address, $phone_no, $skills, $salary) {
        $ret = mysqli_query($this->con, "insert into employee(name,email,address,phone_no,skills,salary) values('$name','$email','$address','$phone_no','$skills','$salary')");
        return $ret;
    }

}

class display extends Databases {

    public function select($table_name) {
        $array = array();
        $query = "select *from " . $table_name . "";
        $result = mysqli_query($this->con, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $array[] = $row;
        }

        return $array;
    }

}

class database extends Databases {

    public function required_validation($field) {
        $count = 0;
        foreach ($field as $key => $value) {
            if (empty($value)) {
                $count++;
                $this->error .= "<p>" . $key . " is required</p>";
            }
        }
        if ($count == 0) {
            return true;
        }
    }

    public function can_login($table_name, $where_condition) {
        $condition = '';
        foreach ($where_condition as $key => $value) {
            $condition .= $key . " = '" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $query = "SELECT * FROM " . $table_name . " WHERE " . $condition;
        $result = mysqli_query($this->con, $query);
        if (mysqli_num_rows($result)) {
            return true;
        } else {
            $this->error = "Wrong Data";
        }
    }

}

class update extends Databases {

    public function select_record($table, $where) {
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            $condition .= $key . " = '" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $sql = "SELECT * FROM " . $table . " WHERE " . $condition;

        $query = mysqli_query($this->con, $sql);
        $row = mysqli_fetch_array($query);
        return $row;
    }

    public function update_record($table, $where, $fields) {

        $sql = "";
        $condition = "";

        foreach ($where as $key => $value) {
            $condition .= $key . " = '" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        foreach ($fields as $key => $value) {
            $sql .= $key . "='" . $value . "', ";
        }
        $sql = substr($sql, 0, -2);
        $sql = "UPDATE " . $table . " SET " . $sql . " WHERE " . $condition;
        echo $sql;

        if (mysqli_query($this->con, $sql)) {

            return true;
        }
    }

    public function delete_record($table, $where) {
        $sql = "";
        $condition = "";
        foreach ($where as $key => $value) {
            $condition .= $key . "='" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        $sql = "DELETE FROM " . $table . " WHERE " . $condition;
        if (mysqli_query($this->con, $sql)) {
            return true;
        }
    }

}

?>