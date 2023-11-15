<?php
require_once 'PDO.php';

class Query extends PDOConnect
{
    private $sql = '';
    private $table = '';
    // select input ['id', 'name' => 'name1' , 'description] => elector id , name1 , description form database,
    // cớ thể dùng chuổi để select
    // default lấy tất cả 
    // trả về this;

    // ví dụ select()->form('users')->all(); lấy tất cả database từ bản users
    function select($column = '*')
    {

        $columnName = '';
        if (is_array($column)) {
            $index = 0;
            foreach ($column as $key => $value) {
                gettype($key) == 'string' ? $columnName .=  $key . ' as ' . $value : $columnName .= $value;
                if ($index < count($column) - 1) $columnName .= ' , ';
                $index++;
            }
        } else {
            $columnName = $column;
        }
        $this->sql = "SELECT $columnName FROM $this->table " .  $this->sql;
        return $this;
    }
    // tên column name
    function table($table)
    {
        $this->table = $table;
        return $this;
    }
    function where($field, $compare, $value)
    {
        $this->sql .= " WHERE $field $compare  '$value'";
        return $this;
    }
    function and($field, $compare, $value)
    {
        $this->sql .= " AND $field $compare '$value'";
        return $this;
    }
    function or($field, $compare, $value)
    {
        $this->sql .= " OR $field $compare '$value'";
        return $this;
    }
    function delete()
    {
        $this->sql = "DELETE FROM $this->table" . $this->sql;
        $id = $this->execute($this->sql);
    }
    // vd $query->table('users')->insert(['name' => 'a' , password => 1234])
    // => sql = 'INSERT INTO users (name, password ) VALUES ('a',1234)';
    // output là col của users đã được tạo
    function insert($data)
    {
        $column = '';
        $valueCol = '';
        foreach ($data as $key => $value) {
            $column .= $key . ' ,';
            $valueCol  .= is_numeric($value) || gettype($value) == 'integer' ?  " $value  ," : " '$value' ,";
        }
        $sql = "INSERT INTO $this->table (" . substr($column, 0, -1) . ") VALUES (" . substr($valueCol, 0, -1) . ")";
        $id = $this->execute($sql);
        return $this->select()->where('id', '=', $id)->first();
    }
    function update($data)
    {
        $valueCol = '';
        foreach ($data as $key => $value) {
            $valueCol .= is_numeric($value) || gettype($value) == 'integer' ? " $key = $value ," : "$key = '$value' ,";
        }
        $sql = " UPDATE $this->table SET " . substr($valueCol, 0, -1) . " " . $this->sql;
        $this->execute($sql);
    }
    function orderBy($column, $direction = 'DESC')
    {
        $column = is_array($column) ? join(',', $column) : $column;
        $this->sql .= " ORDER BY " . $column . " " . $direction;
        return $this;
    }
    function limit($limit)
    {
        $this->sql .= " LIMIT  $limit";
        return $this;
    }
    function offset($offset)
    {
        $this->sql .= " OFFSET $offset";
        return $this;
    }
    function groupBy($column)
    {
        $this->sql .= " GROUP BY $column";
        return $this;
    }
    function join($tableJoin, $foreignKey, $primaryKey = 'id', $location = 'INNER')
    {
        $this->sql .= "$location JOIN $tableJoin ON  $this->table.$foreignKey = $tableJoin.$primaryKey";
        return $this;
    }
    // lấy tất cả dữ liệu
    function all()
    {
        try {
            $data = parent::query($this->sql)->fetchAll();
            $this->sql = '';
            return $data;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    // lấy một dữ liệu
    function first()
    {
        $stml = parent::query($this->sql);
        $this->sql = '';
        return $stml->fetch(PDO::FETCH_ASSOC);
    }

    // check cơ sở dữ liệu
    function execute($sql)
    {
        try {
            parent::query($sql);
            $this->sql = '';
            return $this->db->lastInsertId();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    function __destruct()
    {
        $this->sql = '';
    }
}
