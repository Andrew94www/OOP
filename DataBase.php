<?php
class DatabaseShell
{
    private $link;
    private $arr;
    private $get;

    public function __construct($host, $user, $password, $database)
    {
        $this->link = mysqli_connect($host, $user, $password, $database);
        mysqli_query($this->link, "SET NAMES 'utf8'"); // устанавливаем кодировку
    }

    public function save($table, $data)
    {
        $name = $data['name'];
        $age = $data['age'];
        $salary = $data['salary'];
        $query = "INSERT INTO `$table` (`id`, `name`, `age`, `salary`) VALUES (NULL, '$name',  '$age ', '$salary')";
        mysqli_query($this->link, $query) or die(mysqli_error($this->link));
        // сохраняет запись в базу
    }

    public function del($table, $id)
    {
        $query = "DELETE FROM `$table` WHERE id =$id";
        mysqli_query($this->link, $query) or die(mysqli_error($this->link));    // удаляет запись по ее id
    }

    public function delAll($table, $ids)
    {
        if (!empty($ids)) {
            foreach ($ids as $id) {                                                             // удаляет записи по их id
                $query = "DELETE FROM `$table` WHERE id =$id";
                mysqli_query($this->link, $query) or die(mysqli_error($this->link));
            }
        }
    }

    public function get($table, $id)
    {
        $query = "SELECT * FROM $table WHERE id ='$id'";
        $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link)); // получает одну запись по ее id
        $this->get =  mysqli_fetch_assoc($result);
        return  $this->get;
    }

    public function getAll($table, $ids)    // получает массив записей по их id
    {
        if (!empty($ids)) {

            foreach ($ids as $id) {
                $query = "SELECT * FROM $table WHERE id ='$id'";
                $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));
                $this->arr[] =  mysqli_fetch_assoc($result);
            }
        }
        return $this->arr;
    }

    public function selectAll($table, $condition)
    {
        // получает массив записей по условию
    }
}
