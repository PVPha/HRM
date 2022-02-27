<?php
class Database extends PDO
{
    public function __construct($connect, $user, $pass)
    {
        parent::__construct($connect, $user, $pass);
        // khai báo biến host
        // $hostName = 'localhost';
        // khai báo biến username
        // $userName = 'root';
        // khai báo biến password
        // $passWord = '';
        // khai báo biến databaseName
        // $databaseName = 'pdo_testphpmvc';
        // khởi tạo kết nối
        // try {
        //     $connect = new PDO('mysql:host=' . $hostName . ';dbname=' . $databaseName, $userName, $passWord);
        //     $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //     thành công
        //     echo 'thành công';
        // } catch (PDOException $e) {
        //     thất bại
        //     die($e->getMessage());
        // }
    }
    public function select($sql, $data = array(), $fetchStyle = PDO::FETCH_ASSOC)
    {
        $statement = $this->prepare($sql);
        // $sql = $sql = "SELECT * FROM $table";
        foreach ($data as $key => $value) {
            $statement->bindParam($key, $value);
        }
        $statement->execute();
        // return $statement->fetchAll();
        return $statement->fetchAll($fetchStyle);
    }
    public function dataChart($sql, $data = array(), $fetchStyle = PDO::FETCH_ASSOC)
    {
        $statement = $this->prepare($sql);
        // $sql = $sql = "SELECT * FROM $table";
        foreach ($data as $key => $value) {
            $statement->bindParam($key, $value);
        }
        $statement->execute();
        // return $statement->fetchAll();
        return $statement->fetchAll();
    }
    public function execute($sql)
    {
        // echo $sql;
        $statement = $this->prepare($sql);
        // $sql = $sql = "SELECT * FROM $table";
        return $statement->execute();
        // return $statement->fetchAll();
    }
    public function insert($table_name, $data)
    {
        $key = implode(',', array_keys($data));
        //echo $key . '<br>';
        $value = ':' . implode(', :', array_keys($data));
        // echo $value . '<br>';
        $sql = "INSERT INTO $table_name VALUES($value)";
        // echo $sql;
        $statement = $this->prepare($sql);
        foreach ($data as $key => $value) {
            //echo $value . '<br>';
            $statement->bindValue($key, $value);
        }
        // echo $statement;

        // $statement->bindParam(':title_category_test', $title_category_test);
        // $statement->bindParam(':desc_category_test', $desc_category_test);
        // echo 'insert thành công';
        return $statement->execute();
    }
    public function insertTimeKeep($table_name, $data)
    {
        // $key = '\'' . implode('\' , \'', array_keys($data[0])) . '\'';
        // // $key = '\'' . $key . '\'';
        // // echo $key . '<br>';
        // $str = '';
        // $key_temp = '';
        // foreach ($data as $key => $valueTemp) {
        //     $arr = $valueTemp;
        //     // $key_temp = implode('\' , \'', array_keys($valueTemp));
        //     // $value = '\' \' ,' .  '\'' . implode('\' ,  \'', array_values($valueTemp)) . '\'';
        //     // $value = '('  . $value . ') ,';
        //     // $str .= $value;
        //     $key_temp .= '\'' . $valueTemp['id_staff'] . '\' ,';
        //     foreach ($valueTemp as $key => $value) {
        //         // tk.setKPI = (CASE $caseSetKPI END),
        //         // "WHEN tk.id_staff =  $id_staff[$i] THEN $setKPI[$i] "

        //         $value_TK = 'tk.' . $key . '=' . '( CASE WHEN tk.id_staff = \'' . $valueTemp['id_staff'] . '\' THEN \'' . $value . '\' END ) ';
        //         $str .= $value_TK . ', ';
        //     }
        // }
        // $str = rtrim($str, " \,");
        // $key_temp = rtrim($key_temp, " \,");
        // $sql = "UPDATE  $table_name tk
        //         SET $str
        //         WHERE tk.id_staff IN ($key_temp) ";
        // echo $sql;

        // $statement = $this->prepare($sql);
        // return $statement->execute();
        // print_r(explode('/', $str));
        // print_r($value);
        // $str = rtrim($str, ',');
        // $sql = "INSERT INTO $table_name  VALUES $str";
        // echo $sql;
        // $statement = $this->prepare($sql);
        // return $statement->execute();

        $key = '\'' . implode('\' , \'', array_keys($data[0])) . '\'';
        $key = '(' . $key . ')';
        //echo $key . '<br>';
        // print_r(array_keys($data[0]));

        $str = '';
        $arr = '';
        $id_staff = '';
        $absent = '';
        $holiday = '';
        $mission = '';
        $workDay = '';
        $overtime = '';
        $early  = '';
        $late = '';
        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $id_staff .= '\'' . $data[$i]['id_staff'] . '\' ,';
            $absent .= '\'' . $data[$i]['absent'] . '\' ,';
            $holiday .= '\'' . $data[$i]['holiday'] . '\' ,';
            $mission .= '\'' . $data[$i]['mission'] . '\' ,';
            $workDay .= '\'' . $data[$i]['workDay'] . '\' ,';
            $overtime .= '\'' . $data[$i]['overtime'] . '\' ,';
            $early .= '\'' . $data[$i]['early'] . '\' ,';
            $late .= '\'' . $data[$i]['late'] . '\' ,';
        }
        // $key = array_keys($data[0]);
        // print_r($key);

        $id_staff = rtrim($id_staff, " \,");
        $id_staff_temp = '(' . $id_staff . ')';
        $id_staff = explode(',', $id_staff);
        // print_r($id_staff);

        $absent = rtrim($absent, " \,");
        $absent = explode(',', $absent);
        // print_r($setKPI);

        $holiday = rtrim($holiday, " \,");
        $holiday = explode(',', $holiday);
        // print_r($achieveKPI);

        $mission = rtrim($mission, " \,");
        $mission = explode(',', $mission);
        // print_r($classification);

        $workDay = rtrim($workDay, " \,");
        $workDay = explode(',', $workDay);

        $overtime = rtrim($overtime, " \,");
        $overtime = explode(',', $overtime);

        $early = rtrim($early, " \,");
        $early = explode(',', $early);

        $late = rtrim($late, " \,");
        $late = explode(',', $late);
        // echo $id_staff . '/';
        // echo $valueSetKPI . '/';
        // echo $valueAchieveKPI . '/';
        // echo $valueClassification;
        $sql = '';
        $caseAbsent = '';
        $caseHoliday = '';
        $caseMission = '';
        $caseWorkDay = '';
        $caseOvertime = '';
        $caseEarly = '';
        $caseLate = '';
        for ($i = 0; $i < $count; $i++) {
            $caseAbsent .= "WHEN tk.id_staff =  $id_staff[$i] THEN $absent[$i] ";
            $caseHoliday .= "WHEN tk.id_staff =  $id_staff[$i] THEN $holiday[$i] ";
            $caseMission .= "WHEN tk.id_staff =  $id_staff[$i] THEN $mission[$i] ";
            $caseWorkDay .= "WHEN tk.id_staff =  $id_staff[$i] THEN $workDay[$i] ";
            $caseOvertime .= "WHEN tk.id_staff =  $id_staff[$i] THEN $overtime[$i] ";
            $caseEarly .= "WHEN tk.id_staff =  $id_staff[$i] THEN $early[$i] ";
            $caseLate .= "WHEN tk.id_staff =  $id_staff[$i] THEN $late[$i] ";
        }
        $sql = "UPDATE  $table_name tk
                SET tk.absent = (CASE $caseAbsent END),
                    tk.holiday = (CASE $caseHoliday END),
                    tk.mission =  (CASE $caseMission END),
                    tk.workDay =  (CASE $caseWorkDay END),
                    tk.overtime =  (CASE $caseOvertime END),
                    tk.early =  (CASE $caseEarly END),
                    tk.late =  (CASE $caseLate END)
                WHERE tk.id_staff IN $id_staff_temp ";
        $statement = $this->prepare($sql);
        return $statement->execute();
    }
    public function insertTimeKeepKPI($table_name, $data)
    {
        $key = '\'' . implode('\' , \'', array_keys($data[0])) . '\'';
        $key = '(' . $key . ')';
        //echo $key . '<br>';
        // print_r(array_keys($data[0]));

        $str = '';
        $arr = '';
        $id_staff = '';
        $setKPI = '';
        $achieveKPI = '';
        $classification = '';
        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $id_staff .= '\'' . $data[$i]['id_staff'] . '\' ,';
            $setKPI .= '\'' . $data[$i]['setKPI'] . '\' ,';
            $achieveKPI .= '\'' . $data[$i]['achieveKPI'] . '\' ,';
            $classification .= '\'' . $data[$i]['classification'] . '\' ,';
        }
        // $key = array_keys($data[0]);
        // print_r($key);

        $id_staff = rtrim($id_staff, " \,");
        $id_staff_temp = '(' . $id_staff . ')';
        $id_staff = explode(',', $id_staff);
        // print_r($id_staff);

        $setKPI = rtrim($setKPI, " \,");
        $setKPI = explode(',', $setKPI);
        // print_r($setKPI);

        $achieveKPI = rtrim($achieveKPI, " \,");
        $achieveKPI = explode(',', $achieveKPI);
        // print_r($achieveKPI);

        $classification = rtrim($classification, " \,");
        $classification = explode(',', $classification);
        // print_r($classification);

        // echo $id_staff . '/';
        // echo $valueSetKPI . '/';
        // echo $valueAchieveKPI . '/';
        // echo $valueClassification;
        $sql = '';
        $caseSetKPI = '';
        $caseAchieveKPI = '';
        $caseClassification = '';
        for ($i = 0; $i < $count; $i++) {
            $caseSetKPI .= "WHEN tk.id_staff =  $id_staff[$i] THEN $setKPI[$i] ";
            $caseAchieveKPI .= "WHEN tk.id_staff =  $id_staff[$i] THEN $achieveKPI[$i] ";
            $caseClassification .= "WHEN tk.id_staff =  $id_staff[$i] THEN $classification[$i] ";
        }
        $sql = "UPDATE  $table_name tk
                SET tk.setKPI = (CASE $caseSetKPI END),
                    tk.achieveKPI = (CASE $caseAchieveKPI END),
                    tk.classification =  (CASE $caseClassification END)
                WHERE tk.id_staff IN $id_staff_temp ";
        $statement = $this->prepare($sql);
        return $statement->execute();
        // print_r($sql);
        // foreach ($data as $key => $valueTemp) {
        //     $arr = $valueTemp;
        //     // print_r($data[$key]['setKPI']);
        //     // echo $valueTemp['setKPI'];
        //     // $value = ':' . implode(', :', array_keys($valueTemp));
        //     // $value =  '\'' . implode('\' , \'', array_values($valueTemp)) . '\'';
        //     $value =  '\'' . implode('\' , \'', $valueTemp['setKPI']) . '\'';
        //     $value =  $value . ', ';
        //     // $value = rtrim($value, '/,');

        //     $str .= $value;
        //     // foreach ($valueTemp as $key => $value) {
        //     //     $statement->bindValue($key, $value);
        //     // }

        // }

        // $str = rtrim($str, " \,");
        // echo $str;
        // $str = explode(',', $str);
        // print_r($str);
        // print_r($arr);


        // echo strlen($str);

        // echo $sql;

    }
    public function insertTimeKeepSale($table_name, $data)
    {
        $key = '\'' . implode('\' , \'', array_keys($data[0])) . '\'';
        $key = '(' . $key . ')';
        //echo $key . '<br>';
        // print_r(array_keys($data[0]));

        $str = '';
        $arr = '';
        $id_staff = '';
        $setSale = '';
        $achieveSale = '';
        $missingSale = '';
        $exceedSale = '';
        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $id_staff .= '\'' . $data[$i]['id_staff'] . '\' ,';
            $setSale .= '\'' . $data[$i]['setSales'] . '\' ,';
            $achieveSale .= '\'' . $data[$i]['achieveSales'] . '\' ,';
            $missingSale .= '\'' . $data[$i]['missingSales'] . '\' ,';
            $exceedSale .= '\'' . $data[$i]['exceedSales'] . '\' ,';
        }
        // $key = array_keys($data[0]);
        // print_r($key);

        $id_staff = rtrim($id_staff, " \,");
        $id_staff_temp = '(' . $id_staff . ')';
        $id_staff = explode(',', $id_staff);
        // print_r($id_staff);

        $setSale = rtrim($setSale, " \,");
        $setSale = explode(',', $setSale);
        // print_r($setKPI);

        $achieveSale = rtrim($achieveSale, " \,");
        $achieveSale = explode(',', $achieveSale);
        // print_r($achieveKPI);

        $missingSale = rtrim($missingSale, " \,");
        $missingSale = explode(',', $missingSale);
        // print_r($classification);

        $exceedSale = rtrim($exceedSale, " \,");
        $exceedSale = explode(',', $exceedSale);
        // print_r($classification);

        // echo $id_staff . '/';
        // echo $valueSetKPI . '/';
        // echo $valueAchieveKPI . '/';
        // echo $valueClassification;
        $sql = '';
        $caseSetSale = '';
        $caseAchieveSale = '';
        $caseMissingSale = '';
        $caseExceedSale = '';
        for ($i = 0; $i < $count; $i++) {
            $caseSetSale .= "WHEN tk.id_staff =  $id_staff[$i] THEN $setSale[$i] ";
            $caseAchieveSale .= "WHEN tk.id_staff =  $id_staff[$i] THEN $achieveSale[$i] ";
            $caseMissingSale .= "WHEN tk.id_staff =  $id_staff[$i] THEN $missingSale[$i] ";
            $caseExceedSale .= "WHEN tk.id_staff =  $id_staff[$i] THEN $exceedSale[$i] ";
        }
        $sql = "UPDATE  $table_name tk
                SET tk.setSales = (CASE $caseSetSale END),
                    tk.achieveSales = (CASE $caseAchieveSale END),
                    tk.missingSales =  (CASE $caseMissingSale END),
                    tk.exceedSales =  (CASE $caseExceedSale END)
                WHERE tk.id_staff IN $id_staff_temp ";
        // print_r($sql);
        $statement = $this->prepare($sql);
        return $statement->execute();
    }
    public function insertSalaryFromTK($table_name, $data)
    {
        // print_r($data);
        // echo "insertSalaryFromTK";
        $key = '\'' . implode('\' , \'', array_keys($data[0])) . '\'';
        $key = '(' . $key . ')';
        // echo $key . '<br>';
        // print_r(array_keys($data[0]));

        $str = '';
        $arr = '';
        $id_staff = '';
        $workDay = '';
        $overtime = '';
        $count = count($data);
        for ($i = 0; $i < $count; $i++) {
            $id_staff .= '\'' . $data[$i]['id_staff'] . '\' ,';
            $workDay .= '\'' . $data[$i]['workDay'] . '\' ,';
            $overtime .= '\'' . $data[$i]['overtime'] . '\' ,';
        }
        // $key = array_keys($data[0]);
        // print_r($key);

        $id_staff = rtrim($id_staff, " \,");
        $id_staff_temp = '(' . $id_staff . ')';
        $id_staff = explode(',', $id_staff);
        // print_r($id_staff);

        $workDay = rtrim($workDay, " \,");
        $workDay = explode(',', $workDay);
        // print_r($workDay);

        $overtime = rtrim($overtime, " \,");
        $overtime = explode(',', $overtime);
        // print_r($overtime);

        $sql = '';
        $caseWorkDay = '';
        $caseOvertime = '';
        for ($i = 0; $i < $count; $i++) {
            $caseWorkDay .= "WHEN sl.id_staff =  $id_staff[$i] THEN $workDay[$i] ";
            $caseOvertime .= "WHEN sl.id_staff =  $id_staff[$i] THEN $overtime[$i] ";
        }
        $sql = "UPDATE  $table_name sl
                SET sl.workDay = (CASE $caseWorkDay END),
                    sl.overtime = (CASE $caseOvertime END)
                WHERE sl.id_staff IN $id_staff_temp ";
        // print_r($sql);
        $statement = $this->prepare($sql);
        return $statement->execute();
    }

    public function insertSchedule($table_name, $data)
    {
        $key = implode(',', array_keys($data));
        // echo $key . '<br>';
        $value = ':' . implode(', :', array_keys($data));
        // echo $value . '<br>';
        $sql = "INSERT INTO $table_name ($key) VALUES($value)";
        $statement = $this->prepare($sql);
        foreach ($data as $key => $value) {
            // echo $value . '<br>';
            $statement->bindValue($key, $value);
        }
        // var_dump($statement);
        // $statement->bindParam(':title_category_test', $title_category_test);
        // $statement->bindParam(':desc_category_test', $desc_category_test);
        // echo 'insert thành công';
        return $statement->execute();
    }

    public function update($table_name, $data, $cond)
    {
        $updatekey = '';
        foreach ($data as $key => $value) {
            $updatekey .= "`$key`=:$key,";
        }
        $updatekey = rtrim($updatekey, ',');
        // print_r($updatekey);
        $sql = "UPDATE $table_name SET $updatekey WHERE $cond";
        //echo $sql;
        $statement = $this->prepare($sql);
        foreach ($data as $key => $value) {
            $statement->bindValue($key, $value);
        }
        // print_r($statement);
        return $statement->execute();
    }
    public function delete($table_name, $cond, $limit = 1)
    {
        $sql = "DELETE FROM $table_name WHERE $cond LIMIT $limit";
        return $this->exec($sql);
    }
    public function affectedRows($sql, $username, $password)
    {
        $statement = $this->prepare($sql);
        $statement->execute(array($username, $password));
        return $statement->rowCount();
    }
    public function selectUser($sql, $username, $password)
    {
        $statement = $this->prepare($sql);
        $statement->execute(array($username, $password));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}