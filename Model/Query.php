<?php
require_once 'PDO.php';

class Query extends PDOConnect
{
    protected $sql = '';
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
        $this->sql .= 'SELECT ' .  $columnName;
        return $this;
    }
    // tên column name
    function from($rowName)
    {
        $this->sql .= ' FROM ' . $rowName;
        return $this;
    }
    function where($value1, $condition, $value2)
    {
        $this->sql .= " WHERE $value1 $condition $value2";
        return $this;
    }
    // lấy tất cả dữ liệu
    function all()
    {
        return parent::query($this->sql)->fetchAll();
    }
    // lấy một dữ liệu
    function first()
    {
        return parent::query($this->sql)->fetch(PDO::FETCH_ASSOC);
    }
    // check cơ sở dữ liệu
    function execute()
    {
        return parent::query($this->sql);
    }
}
