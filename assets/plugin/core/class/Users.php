<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Users{
   
    protected $database;
    static protected $databases;

    static public function getconstruct($db)
    {   
       return self::$databases= $db;
    }

    public function __construct()
    {
        global $db;
        $this->database=$db;
    }

     public function preventUsersAccess($request,$currentfile,$currently)
    {
       if ($request == 'GET' && $currentfile == $currently) {
            header('Location: '.LOGIN.'');
        }
    }

     public function login($email,$password,$datetime)
    {
       $mysqli= $this->database;
       $sql= $mysqli->query("SELECT user_id,username ,approval, chat FROM users WHERE username ='{$email}' AND password='{$password}' OR email ='{$email}'and password='{$password}' ");
       $sql1= $mysqli->query("SELECT user_id ,username,profile_img ,approval, chat FROM users WHERE username ='{$email}' or email ='{$email}'");

        $row= $sql->fetch_assoc();
        $rows= $sql1->fetch_assoc();
    
        if ($sql->num_rows > 0) {
            $_SESSION['key'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['approval'] = $row['approval'];
            $_SESSION['chat'] = $row['chat'];
            $mysqli->query("UPDATE users SET counts_login= counts_login + 1 WHERE email='{$email}' AND password= '{$password}' OR username ='{$email}' AND password='{$password}' ");
            $mysqli->query("UPDATE users SET last_login = '{$datetime}'  WHERE email='{$email}' AND password= '{$password}' OR username ='{$email}' AND password='{$password}' ");
            $mysqli->query("UPDATE users SET chat = 'on'  WHERE email='{$email}' AND password= '{$password}' OR username ='{$email}' AND password='{$password}' ");
            exit ('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');

        }else if($sql1->num_rows > 0){
            $_SESSION['keys'] = $rows['user_id'];
            $_SESSION['username'] = $rows['username'];
            $_SESSION['profile_img'] = $rows['profile_img'];
            $_SESSION['approval'] = $rows['approval'];
            $_SESSION['chat'] = $rows['chat'];
            exit ('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail Password</strong>
                </div>');

        }else{
            exit ('<div class="alert alert-danger alert-dismissible fade show text">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>TRY AGAIN !!! </strong>
                </div>');
        }
    }

     public function domesticslogin($username,$email,$password,$datetime)
    {
       $mysqli= $this->database;
       $sql= $mysqli->query("SELECT domestics_id,username ,email FROM domestics WHERE username ='{$username}' AND email ='{$email}' AND password='{$password}' ");
       $sql1= $mysqli->query("SELECT domestics_id ,username,email FROM domestics WHERE username ='{$username}' or password='{$password}'");

        $row= $sql->fetch_assoc();
        $rows= $sql1->fetch_assoc();
    
        if ($sql->num_rows > 0) {
            $_SESSION['domestics'] = $row['domestics_id'];
            exit ('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');

        }else if($sql1->num_rows > 0){
            $_SESSION['domestics'] = $row['domestics_id'];
            exit ('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail Password</strong>
                </div>');

        }else{
            exit ('<div class="alert alert-danger alert-dismissible fade show text">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>TRY AGAIN !!! </strong>
                </div>');
        }
    }
    
     public function employersdomesticslogin($username,$email,$password,$datetime)
    {
       $mysqli= $this->database;
       $sql= $mysqli->query("SELECT employers_id,username ,email FROM employersdomestics WHERE username ='{$username}' AND email ='{$email}' AND password='{$password}' ");
       $sql1= $mysqli->query("SELECT employers_id ,username,email FROM employersdomestics WHERE username ='{$username}' or password='{$password}'");

        $row= $sql->fetch_assoc();
        $rows= $sql1->fetch_assoc();
    
        if ($sql->num_rows > 0) {
            $_SESSION['employers'] = $row['employers_id'];
            exit ('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');

        }else if($sql1->num_rows > 0){
            $_SESSION['employers'] = $row['employers_id'];
            exit ('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail Password</strong>
                </div>');

        }else{
            exit ('<div class="alert alert-danger alert-dismissible fade show text">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>TRY AGAIN !!! </strong>
                </div>');
        }
    }

    public function domesticsloggedin()
    {
        if (isset($_SESSION['domestics'])) {
            return true;
        }else {
            return false;
        }
    }
    
     public function employersloggedin()
    {
        if (isset($_SESSION['employers'])) {
            return true;
        }else {
            return false;
        }
    }

    public function checkPassword($password)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT password FROM users WHERE password= '$password' ");
        $count=$query->num_rows;
        if ($count > 0) {
            return true;
        }else {
            return false;
        }
    }

    public function InboxDelete($table,$id,$datetime)
    {
        $mysqli= $this->database;
        $sql = "INSERT INTO $table (cv_id, firstname0, middlename0, lastname0, email0, address0, telephone, degree,
        field, uploadfilecv, uploadfilecertificates, addition_information, user_id0, job_id0, business_id0, 
        email_sent_for, email_sent_to, subject_composer, type_of_email, email_status,
        created_on0) SELECT cv_id, firstname0, middlename0, lastname0, email0, address0, 
        telephone, degree, field, uploadfilecv, uploadfilecertificates, addition_information, user_id0, job_id0, business_id0,
        email_sent_for, email_sent_to, subject_composer, type_of_email, email_status, created_on0 FROM apply_job WHERE cv_id= $id";
        
        // $sql = "INSERT INTO $table  (SELECT * FROM apply_job WHERE cv_id= $id )";
        $query= $mysqli->query($sql);
        var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
    }

    public function TrashDelete($table,$id,$datetime)
    {
        $mysqli= $this->database;
        $sql = "DELETE FROM $table WHERE trash_id= $id ";
        
        $query= $mysqli->query($sql);
        var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
    }

    
    public function TrashAllDelete($table,$id,$datetime)
    {
        $mysqli= $this->database;
        $i=1;
        while ($i < count($id)) { 

            $id_= $id[$i];
        $sql = "DELETE FROM $table WHERE cv_id= $id_";

        $query1= "SELECT * FROM $table  WHERE cv_id= $id_ ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['uploadfilecertificates'])){
            $file=$rows['uploadfilecv'].'='.$rows['uploadfilecertificates'];
            $expodefile = explode("=",$file);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','ocx','lsx'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$file);
                $uploadDir = DOCUMENT_ROOT.'/uploads/jobs/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/jobs/';
                      unlink($uploadDir.$file);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/jobs/';
                      unlink($uploadDir.$file);
            }
        }
        
        $query= $mysqli->query($sql);
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
            $i++ ;

       }
    }

    public function Postsjobscreates($table,$fields=array())
    {
        $mysqli= $this->database;
        function addQuotes($str){
            return "'$str'";
        }
         $valued = array();
        # Surround values by quotes
        foreach ($fields as $key => $value) {
            $valued[] = addQuotes($value);
        }
        
        # Build the column
        $columns = implode(",", array_keys($fields));
        
        # Build the values
        $values = implode(",", array_values($valued));
        # Build the insert query
        $queryl = "INSERT INTO $table (".$columns.") VALUES (".$values.")";
        $query= $mysqli->query($queryl);
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
    }

    public function creates($table,$fields=array())
    {
        $mysqli= $this->database;
        function addQuotes($str){
            return "'$str'";
        }
         $valued = array();
        # Surround values by quotes
        foreach ($fields as $key => $value) {
            $valued[] = addQuotes($value);
        }
        
        # Build the column
        $columns = implode(",", array_keys($fields));
        
        # Build the values
        $values = implode(",", array_values($valued));
        # Build the insert query
        $queryl = "INSERT INTO $table (".$columns.") VALUES (".$values.")";
        $query= $mysqli->query($queryl);

        // if($query){
        //         exit('<div class="alert alert-success alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>SUCCESS</strong> </div>');
        //     }else{
        //         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>Fail input try again !!!</strong>
        //         </div>');
        // }
        $row= json_encode($mysqli->insert_id);
        var_dump($queryl,$query);
        return $row;
    }

    static  public function createss($table,$fields=array())
    {
        $mysqli= self::$databases;

         $valued = array();
        # Surround values by quotes
        foreach ($fields as $key => $value) {
            $valued[] = "'$value'";
        }
        
        # Build the column
        $columns = implode(",", array_keys($fields));
        
        # Build the values
        $values = implode(",", array_values($valued));

        # Build the insert query
        $queryl = "INSERT INTO $table (".$columns.") VALUES (".$values.")" ;
        $query= $mysqli->query($queryl);
        $row= json_encode($mysqli->insert_id);
        // $query1= "DELETE FROM notification WHERE notification_id= $row AND type= 'retweet' ";
        // $mysqli->query($query1);

        // if($query){
        //         exit('<div class="alert alert-success alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>SUCCESS</strong> </div>');
        //     }else{
        //         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>Fail input try again !!!</strong>
        //         </div>');
        // }
        
    }

    public function createsComment($table,$fields=array())
    {
        $mysqli= $this->database;
        function addQuotes($str){
            return "'$str'";
        }
         $valued = array();
        # Surround values by quotes
        foreach ($fields as $key => $value) {
            $valued[] = addQuotes($value);
        }
        
        # Build the column
        $columns = implode(",", array_keys($fields));
        
        # Build the values
        $values = implode(",", array_values($valued));
        # Build the insert query
        $queryl = "INSERT INTO $table (".$columns.") VALUES (".$values.")";
        $query= $mysqli->query($queryl);
    }

    public function runQuery($query) {
        $mysqli= $this->database;
		$result = $mysqli->query($query);
		while($row=$result->fetch_assoc()) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	public function numRows($query) {
		$mysqli= $this->database;
		$result = $mysqli->query($query);
		$rowcount = $result->num_rows;
		return $rowcount;	
	}

    public function UserEmailalreadyTookenSettings($table,$arrayselects=array(),$conditions = array())
    {
        $mysqli= $this->database;
        //  username Already Tooken
        $sql = 'SELECT ';
        $select="";
        $select= array_keys($arrayselects);
        $select = $select[0];
        $sql .= (!empty($select))?$select:'*';
        $sql .= ' FROM '.$table;
        $sql .= ' WHERE ';
        $condition= $conditions;
        $condition = array_diff_key($condition, [
            'email' => 'email', 
            ]);
        $i= 0;
        foreach($condition as $key => $value){
             $pre = ($i > 0)?' OR ':'';
             $sql .= $pre.$key." = '".$value."'";
             $i++;
         }
         $query= $mysqli->query($sql);
         $row = $query->fetch_assoc();

         //  Email Already Tooken

        $sql1 = 'SELECT ';
        $select="";
        $select= array_keys($arrayselects);
        $select = $select[1];
        $sql1 .= (!empty($select))?$select:'*';
        $sql1 .= ' FROM '.$table;
        $sql1 .= ' WHERE ';
        $conditionz= $conditions;
        $conditionz = array_diff_key($conditionz, [
            'username' => 'username', 
            ]);
        $i= 0;
        foreach($conditionz as $key => $value){
             $pre = ($i > 0)?' OR ':'';
             $sql1 .= $pre.$key." = '".$value."'";
             $i++;
         }
         $querys= $mysqli->query($sql1);
         $rows = $querys->fetch_assoc();
        //  var_dump($sql1);
        // $b= array_keys($conditions);
        // var_dump($conditions['username'][0]);
        // var_dump($b[0]);
        
        if(!empty($row['username'])){
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Username Already Tooken ???</strong> </div>');
        }else if(!empty($rows['email'])){
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Email Already Tooken ???</strong> </div>');
        }else{
              $this->update($table,$conditions,$id);
        }
    } 

    public function alreadyUseEmail($table,$arrayselects=array(),$conditions = array())
    {
        $mysqli= $this->database;
        //  username Already Tooken
        $sql = 'SELECT ';
        $select="";
        $select= array_keys($arrayselects);
        $select = $select[0];
        $sql .= (!empty($select))?$select:'*';
        $sql .= ' FROM '.$table;
        $sql .= ' WHERE ';
        $condition= $conditions;
        $condition = array_diff_key($condition, [
            'firstname' => 'firstname', 
            'lastname' => 'lastname', 
            'email' => 'email', 
            'gender' => 'gender', 
            'country' => 'country', 
            'password' => 'password', 
            'date_birth' => 'date_birth',
            'date_registry' => 'date_registry', 
            'last_login' => 'datetime', 
            'color' => 'black', 
            'approval' => 'off',
            ]);
        $i= 0;
        foreach($condition as $key => $value){
             $pre = ($i > 0)?' OR ':'';
             $sql .= $pre.$key." = '".$value."'";
             $i++;
         }
         $query= $mysqli->query($sql);
         $row = $query->fetch_assoc();

         //  Email Already Tooken

        $sql1 = 'SELECT ';
        $select="";
        $select= array_keys($arrayselects);
        $select = $select[1];
        $sql1 .= (!empty($select))?$select:'*';
        $sql1 .= ' FROM '.$table;
        $sql1 .= ' WHERE ';
        $conditionz= $conditions;
        $conditionz = array_diff_key($conditionz, [
            'firstname' => 'firstname', 
            'lastname' => 'lastname', 
            'username' => 'username', 
            'gender' => 'gender', 
            'country' => 'country', 
            'password' => 'password', 
            'date_birth' => 'date_birth',
            'date_registry' => 'date_registry', 
            'last_login' => 'datetime', 
            'color' => 'black',
            'approval' => 'off',  
            ]);
        $i= 0;
        foreach($conditionz as $key => $value){
             $pre = ($i > 0)?' OR ':'';
             $sql1 .= $pre.$key." = '".$value."'";
             $i++;
         }
         $querys= $mysqli->query($sql1);
         $rows = $querys->fetch_assoc();
        //  var_dump($sql);
        // $b= array_keys($conditions);
        // var_dump($conditions['username'][0]);
        // var_dump($b[0]);
        
        if(!empty($row['username'])){
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Username Already Tooken ???</strong> </div>');
        }else if(!empty($rows['email'])){
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Email Already Tooken ???</strong> </div>');
        }else{
             $this->Postsjobscreates('users',$conditions);
        }
    } 

     public function update($table,$fields=array(),$conditions=array())
     {
        $mysqli= $this->database;
        $columns="";
        $column="";
        $select="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = '{$value}'";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

        $sql = "UPDATE ";
        $sql .= $table.' SET '.$columns;
        $sql .= ' WHERE ';
         $i = 0;
         foreach($conditions as $key => $value){
             $pre = ($i > 0)?' AND ':'';
               $sql .= $pre.$key." = '".$value."'";
             $i++;
         }

        $query= $mysqli->query($sql);
        // var_dump($sql);
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $select .= "{$key}";
            if ($i++ < count($fields)) {
                # code...
                 $select .= ',';
            }
        }
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $column .= "{$key} = '{$value}'";
            if ($i++ < count($fields)) {
                # code...
                 $column .= 'AND ';
            }
        }
        $sql1 = 'SELECT ';
        $sql1 .= (!empty($select))?$select:'*';
        $sql1 .= ' FROM '.$table;
        $sql1 .= ' WHERE ';
        $i = 0;
         foreach($conditions as $key => $value){
             $pre = ($i > 0)?' AND ':'';
               $sql1 .= $pre.$key." = '".$value."'";
             $i++;
         }

        $query= $mysqli->query($sql1);
        $row = $query->fetch_assoc();
        // var_dump($sql1);
        if($row){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
    }

     public function updates($table,$fields=array(),$user_id)
     {
        $mysqli= $this->database;
        $columns="";
        $column="";
        $select="";
        $i= 1;
        $field= $fields;
        $field = array_diff_key($field, ['user_id' => 'xy']);
        foreach ($field as $key => $value) {
            # code...
            $columns .= "{$key} = '{$value}'";
            if ($i++ < count($field)) {
                # code...
                 $columns .= ',';
            }
        }

        $sql="UPDATE $table SET {$columns} WHERE user_id='$user_id'";
        $query= $mysqli->query($sql);
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $select .= "{$key}";
            if ($i++ < count($fields)) {
                # code...
                 $select .= ',';
            }
        }
        $i= 1;
        $fiel = array_diff_key($fields, ['user_id' => 'xy']);
        foreach ($fiel as $key => $value) {
            # code...
            $column .= "{$key} = '{$value}'";
            if ($i++ < count($fiel)) {
                # code...
                 $column .= 'AND ';
            }
        }

        $sql="SELECT $select FROM $table WHERE user_id='$user_id' AND {$column} ";
        $query= $mysqli->query($sql);
        $row = $query->fetch_assoc();
        var_dump($sql);
         return $row['user_id'];

    }

    public function updateReal($table,$fields=array(),$conditions=array())
     {
        $mysqli= $this->database;
        $columns="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = '{$value}'";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

        $sql = "UPDATE ";
        $sql .= $table.' SET '.$columns;
        $sql .= ' WHERE ';
         $i = 0;
         foreach($conditions as $key => $value){
             $pre = ($i > 0)?' AND ':'';
               $sql .= $pre.$key." = '".$value."'";
             $i++;
         }

        $query= $mysqli->query($sql);
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        // var_dump($sql);
         if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
    }

     public function selects($table,$arrayselects=array(),$conditions = array())
     {
        $mysqli= $this->database;
        $sql = 'SELECT ';
        $select="";
        $i= 1;
        foreach ($arrayselects as $key => $value) {
            # code...
            $select .= "{$key}";
            if ($i++ < count($arrayselects)) {
                # code...
                 $select .= ',';
            }
        }

        $sql .= (!empty($select))?$select:'*';
        $sql .= ' FROM '.$table;
        $sql .= ' WHERE ';
         $i = 0;
         foreach($conditions as $key => $value){
             $pre = ($i > 0)?' AND ':'';
               $sql .= $pre.$key." = '".$value."'";
             $i++;
         }
        $query= $mysqli->query($sql);
        $row = $query->fetch_assoc();

            // if($row){
            //     exit('<div class="alert alert-success alert-dismissible fade show text-center">
            //         <button class="close" data-dismiss="alert" type="button">
            //             <span>&times;</span>
            //         </button>
            //         <strong>SUCCESS NOW LOGIN</strong> </div>');
            // }else{
            //     exit('<div class="alert alert-danger alert-dismissible fade show">
            //         <button class="close" data-dismiss="alert" type="button">
            //             <span>&times;</span>
            //         </button>
            //         <strong>Fail input try again !!!</strong>
            //     </div>');
            //  }
        return $row;
    }

     public function forgotpassword($table,$arrayselects=array(),$conditions = array())
     {
        $mysqli= $this->database;
        $sql = 'SELECT ';
        $select="";
        $i= 1;
        foreach ($arrayselects as $key) {
            # code...
            $select .= "{$key}";
            if ($i++ < count($arrayselects)) {
                # code...
                 $select .= ',';
            }
        }
        $sql .= (!empty($select))?$select:'*';
        $sql .= ' FROM '.$table;
        $sql .= ' WHERE ';
         $i = 0;
         foreach($conditions as $key => $value){
             $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
             $i++;
         }
        $query_username= $mysqli->query($sql);
        $row = $query_username->fetch_assoc();
        
        $sql= $mysqli->query("SELECT * FROM users WHERE user_id = '{$row['user_id']}' ");
        $rows= $sql->fetch_assoc();

        if ($sql->num_rows > 0) {
            $_SESSION['keycreate'] = $rows['user_id'];
            $_SESSION['username'] = $rows['username'];
            $_SESSION['profile_img'] = $rows['profile_img'];
        }

         if($row){
             exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS NOW CREATE PASSWORD</strong> </div>');
        }
     }

     public function forgotUsername($table,$arrayselects=array(),$conditions = array())
     {
         $mysqli= $this->database;
         $sql1 = 'SELECT ';
         $select="";
         $i= 1;
         foreach ($arrayselects as $key) {
            # code...
            $select .= "{$key}";
            if ($i++ < count($arrayselects)) {
                # code...
                 $select .= ',';
            }
        }
         $sql1 .= (!empty($select))?$select:'*';
         $sql1 .= ' FROM '.$table;
         $sql1 .= ' WHERE ';
         
         $i = 0;
         $conditions = array_diff_key($conditions, ['username' => 'xy']);
         foreach($conditions as $key => $value){
             $pre = ($i > 0)?' AND ':'';
             $sql1 .= $pre.$key." = '".$value."'";
             $i++;
         }
        $query= $mysqli->query($sql1);
        $row = $query->fetch_assoc();

            return $row['user_id'];
    }

        public function forgotUsernameCountsTimesHeCreates($table,$fields=array(),$user_id)
    {
        $columns="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = {$value}";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

        $mysqli= $this->database;
        $sql="UPDATE $table SET {$columns} WHERE user_id='$user_id'";
        $query= $mysqli->query($sql);
        // var_dump($sql);
        
    }
        public function forgotUsernameCountsTimesHeCreatespassword($table,$fields=array(),$user_id)
    {
        $columns="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = {$value}";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

         $mysqli= $this->database;
        $sql="UPDATE $table SET {$columns} WHERE user_id='$user_id'";
        $query= $mysqli->query($sql);
    }
        public function forgotUsernameCountsTodelete($table,$fields=array(),$user_id)
    {
        $columns="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = {$value}";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

        $mysqli= $this->database;
        $sql="UPDATE $table SET {$columns} WHERE user_id='$user_id'";
        $query= $mysqli->query($sql);
    }

        public function CountViewIn_profile($table,$fields=array(),$user_id)
    {
        $columns="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = {$value}";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

        $mysqli= $this->database;
        $sql="UPDATE $table SET {$columns} WHERE user_id='$user_id'";
        $query= $mysqli->query($sql);
    }

    public function forgotUsernameCountsTo3Update($table,$fields=array(),$user_id)
    {
        $columns="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = {$value}";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

        $mysqli= $this->database;
        $sql="UPDATE $table SET {$columns} WHERE user_id='$user_id'";
        $query= $mysqli->query($sql);
        $sql="SELECT * FROM $table WHERE user_id='$user_id'";
        $query= $mysqli->query($sql);
        $row= $query->fetch_assoc();
        // var_dump($sql);

        

         if ($row['forgotUsernameCounts'] == 3){
             
               if ($query->num_rows > 0) {
                $_SESSION['keycreate'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['profile_img'] = $row['profile_img'];
              }

             exit('<div class="alert alert-danger  alert-dismissible fade show">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Create Password !!!</strong>
               <input type="hidden" id="countsforgots" value="'.$row['forgotUsernameCounts'].'">
               </div> <script> setInterval(() => {
                               window.location = "createpassword.php";
                            }, 2000);</script>');
         }else if ($row['forgotUsernameCounts']){
             exit('<div class="alert alert-danger alert-dismissible fade show">
             <button class="close" data-dismiss="alert" type="button">
             <span>&times;</span>
             </button>
             <strong>Fail Username input try again '.$row['forgotUsernameCounts'].' / 3 Times!!!</strong>
             <input type="hidden" id="countsforgots" value="'.$row['forgotUsernameCounts'].'">
             </div><script>if(document.getElementById("countsforgots").value == 2){
                           $("#submit").click(function(){
                               $("#submit").hide();
                           });}
                           </script>');
             
         } else{
            exit('<div class="alert alert-danger alert-dismissible fade show">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Fail input try again !!!</strong>
               </div>');
         }
    }

    public function user_id($user_id)
    {
      $mysqli= $this->database;
      $sql= $mysqli->query("SELECT user_id, username ,profile_img FROM users WHERE user_id ='{$user_id}'");
      $rows= $sql->fetch_assoc();
      var_dump($rows);
        if ($sql->num_rows > 0) {
            $_SESSION['keycreate'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['profile_img'] = $row['profile_img'];
            if (isset($_SESSION['keycreate'])){
                header('location: '.CREATE_PASSPOWRD.'');
                exit();
             }
        }
    }


     public function loggedin()
    {
        if (isset($_SESSION['key'])) {
            return true;
        }else {
            return false;
        }
    }

    static public function loggedins()
    {
        if (isset($_SESSION['key'])) {
            return true;
        }else {
            return false;
        }
    }

     public function test_input($data)
    {
        $mysqli=$this->database;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = $mysqli->real_escape_string($data);
        return $data;
    }
          
    public function countUSERS()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM users');
        $row_users = $sql->fetch_array();
        $total_user= array_shift($row_users);
        $array= array(0,$total_user);
        $total_users= array_sum($array);
        echo $total_users;
    }

    public function countPOSTS()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM tweets');
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }

    public function countApprovalBusiness()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM users WHERE approval = "on" ');
        $row_comment = $sql->fetch_array();
        $total_comment= array_shift($row_comment);
        $array= array(0,$total_comment);
        $total_comments= array_sum($array);
        echo $total_comments;
    }

    public function countUnApprovalBusiness()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM users WHERE approval = "off" ');
        $row_comment = $sql->fetch_array();
        $total_comment= array_shift($row_comment);
        $array= array(0,$total_comment);
        $total_comments= array_sum($array);
        echo $total_comments;
    }

    public function jobCountbusiness()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM jobs WHERE turn = "on" ');
        $row_comment = $sql->fetch_array();
        $total_comment= array_shift($row_comment);
        $array= array(0,$total_comment);
        $total_comments= array_sum($array);
        echo $total_comments;
    }

    public function countApprovalCOMMENTS()
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM comment WHERE approved='on'");
        $row_approval = $sql->fetch_array();
        $total_approvalcomm= array_shift($row_approval);
        $array= array(0,$total_approvalcomm);
        $total_approval= array_sum($array);
        echo $total_approval;
    }

    public function countUnapprovalCOMMENTS()
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM comment WHERE approved='off'");
        $row_unapproval = $sql->fetch_array();
        $total_unapprovalcomm= array_shift($row_unapproval);
        $array= array(0,$total_unapprovalcomm);
        $total_unapproval= array_sum($array);
        echo $total_unapproval;
    }

    public function countPages()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM pages');
        $row_pages = $sql->fetch_array();
        $total_page= array_shift($row_pages);
        $array= array(4200,$total_page);
        $total_pages= array_sum($array);
        echo $total_pages;

    }

    public function countVISITORS()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM visitors');
        $row_visitors = $sql->fetch_array();
        $total_visitor= array_shift($row_visitors);
        $array= array(20234,$total_visitor);
        $total_visitors= array_sum($array);
        echo $total_visitors;

    }

    public function table_USERS_Activities()
    {
        $db =$this->database;
		$increment= 1;
        $result= $db->query("SELECT * FROM add_admin");
		 if ($result->num_rows > 0) {

           while($row= $result->fetch_array()){ 

         echo '  <tr>
                     <td> '.$increment++.' </td>
                     <td class="text-center">
                         <div class="avatar">
                        '.((!empty($row["profile_image"]))?
                             '<img class="img-avatar"
                                 src="assets/image/users/user_image_profile/'.$row["profile_image"].'"
                                 width="80px" alt="'.$row["email"].'">'
                             :
                            ' <img class="img-avatar" src="assets/image/users/user_image_profile/defaultprofileimage.png"
                                 width="80px" alt="'.$row["email"].'">'
                             ).'
                             <span class="avatar-status badge-success"></span>
                         </div>
                     </td>
                     <td>
                         <div>'.$row["lastname"].'</div>
                         <div class="small text-muted">
                             <span>'. $this->lengths($this->timeAgo($row["date"])).' |Registered :'.$this->timeAgo($row["date"]).'
                             </span>
                         </div>
                         <!-- -Jan 1, 2015 -->
                     </td>
                     <td class="text-center">
                         <!-- <i class="flag-icon flag-icon-rw h4 mb-0" id="us" title="us"></i> -->
                         <i class="flag-icon flag-icon-'.$row["country"].' h4 mb-0"
                             id="'.strtolower($row["country"]).'" title="us"></i>
                     </td>
                     <td>
                         <div class="clearfix">
                             <div class="text-center">
                                 <strong>'.$row["counts_login"].'%</strong>
                             </div>
                             <div>
                                 <small class="text-muted">'.date('M j, Y',strtotime($row["date"])).'-'.date('M j, Y',strtotime($row["last_login"])).'</small>
                                 <!-- Jun 11, 2015 - Jul 10, 2015 -->
                             </div>
                         </div>
                         <div class="progress progress-xs">
                            '.$this->Users_usage_dashboard($row["counts_login"]).' 
                         </div>
                     </td>
                     <td class="text-center">
                         <i class="fa fa-cc-mastercard" style="font-size:24px"></i>
                     </td>
                     <td>
                         <div class="small text-muted">Last login</div>
                         <small>'.$this->timeAgo($row["last_login"]).'</small>
                     </td>
                 </tr>';

                 } 
           }
     }


    public function timeAgo($datetime)
    {
        $time= strtotime($datetime);
        $current= time($datetime);
        $second= $current - $time;
        $minute= round($second / 60);
        $hour= round($second / 3600);
        $week= round($second / 86400);
        $month= round($second / 2600640);

        $date = date('d/m/Y', $time);

        $Date  = date('Y-m-d', $time);
        $now  = date('Y-m-d');
        $datetime1 = new DateTime($Date);
        $datetime2 = new DateTime($now);
        $interval = $datetime1->diff($datetime2);
        // $interval->format('%R%a days');

        if ($second <= 60) {
            # code...
             if ($second == 0 ) {
                 # code...
                 return 'now'; 
              }else {
                  # code...
                  return $second.'s ago'; 
              }

        }elseif ($minute <= 60) {
            # code...
             return $minute.'m ago'; 
        }elseif ($hour <= 24 ) {
            # code...
             return $hour.'h ago'; 

        }elseif ($week == 1 ) {
            # code...
             return  'yesterday'; 
        }elseif ($week <= 7) {
            # code...
             return  $interval->format('%a days').' ago'; 
        }elseif ($month <= 12) {
            # code...
             return date('M j',$time); 

        }else { 
            # code...
             return date('M j, Y',$time); 
        }
        
    }

    public function copyright($start_year)
    {
        $current_year = date('Y');
        if($start_year < $current_year){
            return "&copy; $start_year&ndash;$current_year Company Name";
        }else{
            return "&copy; $start_year";
        }
    } 

    public function get_timeago( $ptime )
    {
        $estimate_time = time() - $ptime;
    
        if( $estimate_time < 1 ) {
            return 'less than 1 second ago';
        }

        $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
        );

       foreach( $condition as $secs => $str ) {
        $d = $estimate_time / $secs;

        if( $d >= 1 ) {
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
      }
    }

    public function lengths($date){
        if(strlen($date) == 11  || strlen($date) == 10) {
            return '<p class="btn btn-danger btn-sm">Old</p>';
        }else{
            return '<p class="btn btn-primary btn-sm">New</p>';
        }
    }

    public function lengthsOfusers($datetime){
        $time= strtotime($datetime);
        $Date  = date('Y-m-d', $time);
        $now  = date('Y-m-d');
        $datetime1 = new DateTime($Date);
        $datetime2 = new DateTime($now);
        $interval = $datetime1->diff($datetime2);
        // $interval->format('%R%a days');
        if($interval->format('%R%a') <= 30){
            return '<p class="btn btn-success btn-sm">New</p>';
        }
    }

    public function lengthsOfWhoNewCome($datetime){
        $time= strtotime($datetime);
        $Date  = date('Y-m-d', $time);
        $now  = date('Y-m-d');
        $datetime1 = new DateTime($Date);
        $datetime2 = new DateTime($now);
        $interval = $datetime1->diff($datetime2);
        // $interval->format('%R%a days');
        if($interval->format('%R%a') <= 7){
            return '<p class="btn btn-primary btn-sm py-0 px-1">New</p>';
        }
    }

    function Users_usage_dashboard($usage){
        if($usage == 0){
            $variable = 1;
        }else{
            $variable = $usage;
        }

    switch ($variable) {
        case $variable <= 100 :
            # code...
            return '<div class="progress-bar bg-danger" role="progressbar"
                    style="width: '.($variable * 100 / 1000).' %" aria-valuenow="'.($variable * 100 / 1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable * 100 / 1000).'%</div>';
            break;
        case $variable <= 200 :
            # code...
            return '<div class="progress-bar bg-danger" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 300 :
            # code...
            return '<div class="progress-bar bg-danger" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 350:
            # code...
            return '<div class="progress-bar bg-warning" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 400:
            # code...
            return '<div class="progress-bar bg-info" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 500:
            # code...
            return '<div class="progress-bar bg-info" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 600:
            # code...
            return '<div class="progress-bar bg-info" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 750:
            # code...
            return '<div class="progress-bar bg-primary" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        default:
            # code...
            return '<div class="progress-bar bg-success" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        }
    } 

    function Users_donationMoneyRaising($money_raising,$money_to_target){
        if($money_raising == 0){
            $variable = 0;
        }else{
            $variables = $money_raising * 100 / $money_to_target;
            $variable = number_format($variables,2,'.','');
        }

    switch ($variable) {
        case $variable <= 10 :
            # code...
            return '<div class="progress-bar bg-danger" role="progressbar"
                    style="width: '.($variable ).' %" aria-valuenow="'.($variable).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable).'%</div>';
            break;
        case $variable <= 20 :
            # code...
            return '<div class="progress-bar bg-danger" role="progressbar"
                    style="width: '.($variable).'%" aria-valuenow="'.($variable).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable).'%</div>';
            break;
        case $variable <= 30 :
            # code...
            return '<div class="progress-bar bg-danger" role="progressbar"
                    style="width: '.($variable).'%" aria-valuenow="'.($variable).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable).'%</div>';
            break;
        case $variable <= 35:
            # code...
            return '<div class="progress-bar bg-warning" role="progressbar"
                    style="width: '.($variable).'%" aria-valuenow="'.($variable).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable).'%</div>';
            break;
        case $variable <= 40:
            # code...
            return '<div class="progress-bar bg-info" role="progressbar"
                    style="width: '.($variable).'%" aria-valuenow="'.($variable).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable).'%</div>';
            break;
        case $variable <= 50:
            # code...
            return '<div class="progress-bar bg-info" role="progressbar"
                    style="width: '.($variable).'%" aria-valuenow="'.($variable).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable).'%</div>';
            break;
        case $variable <= 60:
            # code...
            return '<div class="progress-bar bg-info" role="progressbar"
                    style="width: '.($variable).'%" aria-valuenow="'.($variable).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable).'%</div>';
            break;
        case $variable <= 75:
            # code...
            return '<div class="progress-bar bg-primary" role="progressbar"
                    style="width: '.($variable).'%" aria-valuenow="'.($variable).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable).'%</div>';
            break;
        default:
            # code...
            return '<div class="progress-bar bg-success" role="progressbar"
                    style="width: '.($variable).'%" aria-valuenow="'.($variable).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable).'%</div>';
            break;
        }
    } 

    function donationPercetangeMoneyRaimaing($money_raising,$money_to_target){
            $variable = $money_raising * 100 / $money_to_target;
              return  number_format($variable,2,'.','');
    }

} 

$users = new Users();
global $db;
Users::getconstruct($db);

/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
use PHP Version 5.6.1 > 7.3.20  
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)787384312 / (250)787384312
E-mail : shemafaysal@gmail.com

*/
?>