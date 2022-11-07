<?php

class SignupQuery 
{
    private $con;
    public function __construct($con)
    {
        $this->con = $con;
    }

    public function checkMail($email)
    {
        $query = $this->con->prepare("SELECT * FROM emp_record WHERE email=:em");
        $query->bindValue(":em",$email);
        $query->execute();
        if($query->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function insertData($name, $reg_no, $email, $password, $phone, $profileType, $hobbie, $file)
    {
        $query = $this->con->prepare("INSERT INTO emp_record(name,registration_no,email,password,phone,profiletype,hobbies,file) VALUES(:nm,:reg_no,:em,:pass,:ph,:profType,:hb,:fl)");
        
        $query->bindValue(":nm",$name);
        $query->bindValue(":reg_no",$reg_no);
        $query->bindValue(":em",$email);
        $query->bindValue(":pass",$password);
        $query->bindValue(":ph",$phone);
        $query->bindValue(":profType",$profileType);
        $query->bindValue(":hb",$hobbie);
        $query->bindValue(":fl",$file);

        return $query->execute();
    }
    public function updateData($id,$name, $reg_no, $email, $password, $phone, $profileType, $hobbie)
    {
        $query = $this->con->prepare("UPDATE emp_record SET name=?, registration_no=?, email=?, password=?, phone=?, profiletype=?, hobbies=? WHERE id=$id");
        
        $query->bindValue(1,$name);
        $query->bindValue(2,$reg_no);
        $query->bindValue(3,$email);
        $query->bindValue(4,$password);
        $query->bindValue(5,$phone);
        $query->bindValue(6,$profileType);
        $query->bindValue(7,$hobbie);

        return $query->execute();
    }

    public function getType()
    {
        $Type = array( "Web Developer","Designer","QA","None");
        return $Type;
    }
    public function Hobbies()
    {
        $Hobbies = array( "Dancing","Singing");
        return $Hobbies;
    }

    public function getRecord()
    {
        $result = array();
       $query = $this->con->prepare("SELECT * FROM emp_record");
       $query->execute();
       $res = $query->fetchAll();
       array_push($result,$res);
       return $result;
    }

    public function deleteRecord($id)
    {
        $query = $this->con->prepare("DELETE FROM emp_record WHERE id=:id");
        $query->bindValue(":id",$id);
        return $query->execute();
    }
    public function detailRecord($id)
    {
        $query = $this->con->prepare("SELECT * FROM emp_record where id=:id");
        $query->bindValue(":id",$id);
        $query->execute();
        $result = $query->fetch();
        return $result;
    }
}