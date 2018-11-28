<?php
class Database 
{
     private $con;
      public function __construct()
      {
          $this->con = $this->Connect();  // To Connect With Database 
      }
      //Connect Database
      public function Connect()
      {
       $localhost="localhost";
       $root="root";
       $password="";
       $db_name = "clinicmvc";
       $conn = mysqli_connect($localhost,$root,$password,$db_name);
     if($conn)
     {
        mysqli_query($conn,"SET character_set_results=utf8");
        mb_language('uni'); 
        mb_internal_encoding('UTF-8');
        mysqli_query($conn,"set names 'utf8'");
        return $conn;
     }
     else
     {
         echo"error To Connect With Database"; 
     }
     }
     //Close Database
     public function Close()
     {
         mysqli_close();
     }
    
     //Delete
     public function Delete($TableName,$ID,$where='id')
    {
        $Query ="DELETE FROM `$TableName` WHERE `$where`='$ID'"; 
        $Sql = mysqli_query($this->con,$Query);
        if($Sql)  return TRUE;
        else  throw new Exception("Sql Not Deleted");   
    }
    
     public function DeleteQuery($query)
    {
        $Sql = mysqli_query($this->con,$query);
        if($Sql)  return TRUE;
        else  throw new Exception("Sql Not Deleted");   
    }

    
    
    //Add   
   public function Add($TableName,$Data)
    {
        foreach ($Data as $key => $value)
        {
        $Keys[] = $key;
        $Values[] = $value;
        }
        $Names = implode($Keys,",");
        $Record = '"'.implode($Values,'","').'"';        
        $Query = "INSERT INTO $TableName ($Names) VALUES ($Record)";
        $Sql = mysqli_query($this->con,$Query);
        //echo $Query;
        if($Sql)
            return mysqli_insert_id($this->con);
    }
    
    //Update
    public function Update($TableName,$Data,$ID,$where="id")
     {
        if(is_array($Data))
        { 
        $Query="UPDATE `$TableName` SET ";
        foreach ($Data as $key => $value) 
        {
         $Query .="`".$key."` = '".$value."' ,";            
        }
        $Pat="+-0/*";
        $Query .=$Pat;
        $Query = str_replace(",".$Pat," ",$Query);
        $Query .=" WHERE `$where`=$ID";
        $Sql = mysqli_query($this->con,$Query);
        if(!$Sql) echo  $Query;
        else  return true;
        }
        else  throw new Exception("Data Is No Array"); 
     }
     
   
    public function get_all_assoc($result){
        $array=array();
        while($row= mysqli_fetch_assoc($result)){
            $array[]=$row;
        }
        return $array;  
    }     
    
       public function Select($table, $Date = "", $where = "")
       {
       $q="";
       $w="";
       if($where!=""){
           foreach ($where as $key=>$value){
           $w.="$key='$value'";}
           $w= "where ".rtrim($w,",");
       }
       if($Date!=""){
       foreach ($Date as $key){
           $q.="$key,";
       }
       $q=  rtrim($q,",");
       }
       else
       {
           $q="*";
       }
       
       $Query="SElECT $q FROM $table $w ORDER BY id DESC";
       $sql=  mysqli_query($this->con,$Query);
       if($sql){
          return $this->get_all_assoc($sql);      
       }
       else{
          return FALSE;  
       }
   }
  
   //to select query
    public function Select_Query($Query)
    {
       $Sql = mysqli_query($this->con,$Query);
        if(!$Sql){
            //print_r($Query);
            //throw new Exception("Error : Sql Cannot Excuted Query .");
            
        }
        $Num = mysqli_num_rows($Sql);
      
        if($Num >= 0)
        {
             for($i=0;$i<$Num;$i++)
             {
                 $Data[$i] = @mysqli_fetch_array($Sql);
             }
        }
        return @$Data; 
    }
    public function Upload($file,$maxsize,$extensions,$path)
    {
        $Filename=$file['name'];
        $FileExtension= @strtolower(end(explode(".",$Filename)));
        $FileSize=$file['size'];
        $FileTmp=$file['tmp_name'];
        if(in_array($FileExtension,$extensions) == FALSE OR $maxsize<$FileSize)
        {
            return FALSE;
        }
        else 
        {
        $random = rand(0,9999);
        $Url =$path."_".$random.$Filename;
        $upload=move_uploaded_file($FileTmp,$Url);
        }
        return $Url;
    }
    

    //Login
    public function Login($UserName,$Password)
    {
      $Query ="SELECT * FROM `users` WHERE username ='$UserName' and password = '$Password' and state = 1";
      $Sql = mysqli_query($this->con,$Query);
      $Num = mysqli_num_rows($Sql);
      if($Num == 1) 
      {
          $row= mysqli_fetch_assoc($Sql);
          $_SESSION['id']       = $row['id'];
          $_SESSION['name']     = $row['name'];
          $_SESSION['email']    = $row['email'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['password'] = $row['password'];
          $_SESSION['photo']    = $row['photo'];
          $_SESSION['type']     = $row['type'];
          session_start();
          return TRUE;
      }
      else return FALSE;
    }

    
    public function Activation($id,$activecode,$table)
    {
        if($activecode == 0)
        {
            $Data = array("state"=>1);
        }
        else
        {
            $Data = array("state"=>0);
        }
        $check= $this->Update($table,$Data,$id);
        if($check)
            return true;
    }
    
}
