<?php

class DataBase {
    private $conn;

    public function __construct($host, $user, $pass, $dbName){
        $this->conn = new mySQLi($host, $user, $pass, $dbName);
        if($this->conn->connect_error){
            die('Database Connection Error: ' . $this->conn->connect_error );
        }
    }

    private function executeQuery($sql, $data) {
        $stmt = $this->conn->prepare($sql);
        $value = array_values($data);
        $type = str_repeat('s', count($value));
        $stmt->bind_param($type, ...$value);
        $stmt->execute();
        return $stmt;
    }

    public function dd($value) { // to be deleted
        echo "<pre>", print_r($value, true), "</pre>";
        die();
    }

        
    public function selectAll($table, $conditions = [], $order = []) {
        $sql = "SELECT * FROM $table";
        
        if (empty($conditions)) {
            if(!empty($order)){
                foreach ($order as $key=> $value) {
                    $sql =  $sql . " ORDER BY " . $key . " " . $value;
                }
            }else{
                $sql =  $sql . " ORDER BY created_at DESC";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;
        }else{
            $i = 0;
            foreach ($conditions as $key=>$value)
            {
                if ($i === 0) {
                    $sql = $sql . " WHERE $key=?";
                } else {
                    $sql = $sql . " AND $key=?"; 
                }
                $i++;
            }
        }
        if(!empty($order)){
            foreach ($order as $key=> $value) {
                $sql =  $sql . " ORDER BY " . $key . " " . $value;
            }
        }else{
            $sql =  $sql . " ORDER BY created_at DESC";
        }
        $stmt = $this->executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
        
    public function selectAllLimits($table, $conditions = [], $start, $rpp, $order = []) {
        $sql = "SELECT * FROM $table ";
        
        if(empty($conditions)) {
            if(!empty($order)){
                foreach ($order as $key=> $value) {
                    $sql =  $sql . " ORDER BY " . $key . " " . $value . " LIMIT $start, $rpp";
                }
            }else{
                $sql =  $sql . " ORDER BY created_at DESC LIMIT $start, $rpp";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;
        }else{
            $i = 0;
            foreach($conditions as $key=>$value){
                if($i === 0){
                    $sql = $sql . " WHERE $key=?";
                }else{
                    $sql = $sql . " AND $key=?"; 
                }
                $i++;
            }
        }
        if(!empty($order)){
            foreach ($order as $key=> $value) {
                $sql =  $sql . " ORDER BY " . $key . " " . $value . " LIMIT $start, $rpp";
            }
        }else{
            $sql =  $sql . " ORDER BY created_at DESC LIMIT $start, $rpp";
        }
        $stmt = $this->executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
        
    public function selectOne($table, $conditions) {
        $sql = "SELECT * FROM $table";
    
        $i = 0;
        foreach($conditions as $key=>$value){
            if($i === 0){
                $sql = $sql . " WHERE $key=?";
            }else{
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        $sql = $sql . " LIMIT 1";
        $stmt = $this->executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_assoc();
        return $records;       
    }
        
    public function create($table, $data) {
        $sql = "INSERT INTO $table SET ";
        $i = 0;
        foreach($data as $key=>$value){
            if ($i === 0) {
                $sql = $sql . "$key=?";
            }else{
                $sql = $sql . ", $key=?";
            }
            $i++;   
        }
        $stmt = $this->executeQuery($sql, $data);
        $id = $stmt->insert_id;
        return $id;
    }
        
    public function update($table, $id, $data) {
        $sql = "UPDATE $table SET ";
        $i = 0;
        foreach($data as $key=>$value){
            if($i === 0){
                $sql = $sql . "$key=?";
            }else{
                $sql = $sql . ", $key=?";
            }
            $i++;   
        }
        $sql = $sql . " WHERE id=?";
        $data['id'] = $id;
        $stmt = $this->executeQuery($sql, $data);
        $id = $stmt->insert_id;
        return $id;
    }
        
    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id=?";
            
        $stmt = $this->executeQuery($sql, ['id' => $id]);
        return $stmt->affected_rows;
    }
        
    public function sum($table, $column, $conditions = []){
        $sql = "SELECT SUM($column) as total FROM $table";
        if (empty($conditions)){
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            return $result['total'];
        }else{
            $i = 0;
            foreach ($conditions as $key=>$value) {
                if ($i === 0) {
                    $sql = $sql . " WHERE $key=?";
                } else {
                    $sql = $sql . " AND $key=?";
                }
                $i++;
            }
        }
        $stmt = $this->executeQuery($sql, $conditions);
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
        
    public function avg($table, $column, $conditions = []){
        $sql = "SELECT AVG($column) as total FROM $table";
        if (empty($conditions)){
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            return $result['total'];
        }else{
            $i = 0;
            foreach ($conditions as $key=>$value) {
                if ($i === 0) {
                    $sql = $sql . " WHERE $key=?";
                } else {
                    $sql = $sql . " AND $key=?";
                }
                $i++;
            }
        }
        $stmt = $this->executeQuery($sql, $conditions);
        $result = $stmt->get_result()->fetch_assoc();
        return $result['total'];
    }
        
        function search($term) {
            $match = '%' . $term . '%';
            $sql = "SELECT p.*, u.firstname FROM posts AS p JOIN users AS u 
            ON p.user_id=u.id WHERE p.title LIKE ? OR p.body LIKE ?";
            $stmt = $this->executeQuery($sql, ['title' => $match, 'body' => $match]);
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;
        }

        function searchLimts($term, $s, $rpp) {
            $match = '%' . $term . '%';
            $sql = "SELECT p.*, u.firstname FROM posts AS p JOIN users AS u 
                    ON p.user_id=u.id WHERE p.title LIKE ? OR p.body LIKE ? ORDER BY p.id DESC LIMIT $s, $rpp";
        
            $stmt = $this->executeQuery($sql, ['title' => $match, 'body' => $match]);
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            
            return $records;
        }

    #Columns Selections
    public function colSelectAll($table, $col, $conditions = [], $order = []){
        //SELECT [$COL] FROM $TABLE WHERE [$CONDITIONS]
        $sql = 'SELECT ';
        $x = 0;
        foreach ($col as $key=>$value){
            if ($x === 0) {
                $sql = $sql . "$value";
            } else {
                $sql = $sql . ", $value";
            }
            $x++;
        }
        $sql = $sql . ' FROM ' . $table;
        if (empty($conditions)) {
            if(!empty($order)){
                foreach ($order as $key=> $value) {
                    $sql =  $sql . " ORDER BY " . $key . " " . $value;
                }
            }else{
                $sql =  $sql . " ORDER BY created_at DESC";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            return $records;
        }else{
            $i = 0;
            foreach ($conditions as $key=>$value) {
                if ($i === 0) {
                    $sql = $sql . " WHERE $key=?";
                } else {
                    $sql = $sql . " AND $key=?";
                }
                $i++;
            }
        }
        if(!empty($order)){
            foreach ($order as $key=> $value) {
                $sql =  $sql . " ORDER BY " . $key . " " . $value;
            }
        }else{
            $sql =  $sql . " ORDER BY created_at DESC";
        }
        $stmt = $this->executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }

    public function colSelectOne($table, $col, $conditions){
        //SELECT [$COL] FROM $TABLE WHERE [$CONDITIONS]
        $sql = 'SELECT ';
        $x = 0;
        foreach ($col as $key=>$value){
            if ($x === 0) {
                $sql = $sql . "$value";
            } else {
                $sql = $sql . ", $value";
            }
            $x++;
        }
        $sql = $sql . ' FROM ' . $table;
        $i = 0;
        foreach ($conditions as $key=>$value){
            if ($i === 0) {
                $sql = $sql . " WHERE $key=?";
            } else {
                $sql = $sql . " AND $key=?";
            }
            $i++;
        }
        $sql = $sql . " LIMIT 1";
        $stmt = $this->executeQuery($sql, $conditions);
        $records = $stmt->get_result()->fetch_assoc();
        return $records;
    }

    #JOIN TABLES
    #INNER JOIN 
    public function selectAllInner($table, $order = [], $orderTable = ''){
        //SELECT * FROM $table1/ INNER JOIN $table2 ON $table1.$joiner=$table2.$joiner/ INNER JOIN $table3 ON $table2.$joiner=$table3.$joiner;
        $sql = "SELECT * FROM ";
        $i = 0; $linker = "";
        foreach($table as $key => $value){
            if($i === 0){
                $sql = $sql . $key;
                $linker = "$key.$value";
                if($orderTable === ''){
                    $orderTable = $key;
                }
            }else{
                $linker = $linker . "=$key.$value";
                $sql = $sql . " INNER JOIN $key ON $linker";
                $linker = "$key.$value";
            }
            $i++;
        }
        if(!empty($order)){
            foreach ($order as $key=> $value) {
                $sql =  $sql . " ORDER BY $orderTable." . $key . " " . $value;
            }
        }else{
            $sql =  $sql . " ORDER BY $orderTable.created_at DESC";
        }
        print_r($sql);
    }
    
    public function selectAllColInner($table, $col, $order = [], $orderTable = ''){
        //SELECT * FROM $table1/ INNER JOIN $table2 ON $table1.$joiner=$table2.$joiner/ INNER JOIN $table3 ON $table2.$joiner=$table3.$joiner;
        $sql = "SELECT ";
        $v = 0;
        foreach($col as $key=>$value){
            if ($v === 0) {
                $sql = $sql . "$key.$value";
            }else{
                $sql = $sql . ", $key.$value";
            }
            $v++;
        }
        $sql = $sql . " FROM ";
        $i = 0; $linker = "";
        foreach($table as $key => $value){
            if($i === 0){
                $sql = $sql . $key;
                $linker = "$key.$value";
                if($orderTable === ''){
                    $orderTable = $key;
                }
            }else{
                $linker = $linker . "=$key.$value";
                $sql = $sql . " INNER JOIN $key ON $linker";
                $linker = "$key.$value";
            }
            $i++;
        }
        if(!empty($order)){
            foreach ($order as $key=> $value) {
                $sql =  $sql . " ORDER BY $orderTable." . $key . " " . $value;
            }
        }else{
            $sql =  $sql . " ORDER BY $orderTable.created_at DESC";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $records;
    }
}

include __DIR__ . '/data.php';
//DataBase::dd($data);

//$call = new DataBase('localhost', 'root', '', 'mazzy_dap');
