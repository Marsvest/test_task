<?php
class Categories
{
    public $conn;

    function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", 'testdb2');
        if ($this->conn->connect_error) {
            die("Ошибка: " . $this->conn->connect_error);
        }
    }

    function Process_query($sql)
    {
        $result = $this->conn->query($sql);
        if ($result) {
            return $result;
        } else {
            echo "Ошибка: " . $this->conn->error;
        }
    }

    function Get_category(): array
    {
        $result = $this->Process_query("SELECT id, name, alias, parent_id FROM Categories");

        $data = array();

        if ($result->num_rows > 0) {
            // Fetch each row and add it to the data array
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        } else {
            echo "0 results";
        }
        return $data;
    }

    function Insert_category($id, $name, $alias, $parent_id): void
    {
        $this->Process_query("INSERT INTO Categories (id, name, alias, parent_id) VALUES ('$id', '$name', '$alias', '$parent_id')");
    }

    function __destruct()
    {
        $this->conn->close();
    }
}
