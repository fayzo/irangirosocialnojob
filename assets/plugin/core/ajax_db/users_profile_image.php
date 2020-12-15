<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

error_reporting(E_ALL);
ini_set('display_errors', 1);

if(!empty($_FILES['picture']['name'])){

    $id= $_POST['edit_profile'];
    $files = $_FILES['picture'];
    $uploadDir = DOCUMENT_ROOT.'/assets/image/users_profile_cover/';
    // $fileName = time().'_'.basename($_FILES['picture']['name']);
    $fileNames= basename($files['name']);
    $fileExt = explode('.', $fileNames);
    $fileActualExt = strtolower(end($fileExt));

    $fileName = (strlen($fileNames) > 10)? 
    strtolower(rand(100,1000).substr($fileNames,0,4).".".$fileActualExt):
    strtolower(rand(100,1000).$fileNames);
   	$fileTmpName = $files['tmp_name'];
    $targetPath = $uploadDir.$fileName;
    // $path="image\users_profile_cover";
    // chdir($path);
    // $targetPath = getcwd().DIRECTORY_SEPARATOR.$fileName;
    // FILES TO DELETE ON ITS DESTINATIONS
    move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath);
        // FILES TO DELETE ON ITS DESTINATIONS
        $query= $db->query("SELECT profile_img FROM users WHERE user_id= $id ");
        $rows= $query->fetch_assoc();
        $files= $uploadDir.$rows['profile_img'];
        // $files= getcwd().DIRECTORY_SEPARATOR.$rows['profile_img'];
        $filename = 'defaultprofileimage.png';
         if (file_exists($files) == true && $filename == $rows['profile_img']) { 
              link($files);
            //   echo "<script>alert('file was uploaded')</script>";
            }else{
                unlink($files);
                // echo "<script>alert('file deleted')</script>";
         }
        $update = $db->query("UPDATE users SET profile_img = '{$fileName}' AND profile_img_crop = '{$fileName}' WHERE user_id = $id");
        
        //Update status
        if($update){
            $result = $id ;
            // $result = 2;
        }
        
     var_dump($update);
     var_dump($_FILES['picture']);
    //Load JavaScript function to show the upload status
    $path= DOCUMENT_ROOT.'/assets/image/users_profile_cover/'.$fileName.'';
    $strpos_countsTo = strpos($path, 'assets/image/users_profile_cover/'.$fileName.'');
    $path_replace= substr_replace($path,'', 0,$strpos_countsTo);
    echo '<script type="text/javascript">window.top.window.completeUpload(' . $result . ',\'' .$path_replace. '\');</script>  ';
}


if(!empty($_FILES['cover_picture']['name'])){
    $id= $_POST['edit_cover'];
    $files = $_FILES['cover_picture'];
    $uploadDir = DOCUMENT_ROOT.'/assets/image/users_profile_cover/';
    // $coverName = time().'_'.basename($_FILES['cover_picture']['name']);
    $coverNames= basename($files['name']);
    $fileExt = explode('.', $coverNames);
    $fileActualExt = strtolower(end($fileExt));

    $coverName = (strlen($coverNames) > 10)? 
    strtolower(rand(100,1000).substr($coverNames,0,4).".".$fileActualExt):
    strtolower(rand(100,1000).$coverNames);
   	$fileTmpName = $files['tmp_name'];
    $targetPath = $uploadDir.$coverName;
    // $path="image\users_profile_cover";
    // chdir($path);
    // $targetPath = getcwd().DIRECTORY_SEPARATOR.$coverName;
    // FILES TO DELETE ON ITS DESTINATIONS
    move_uploaded_file($_FILES['cover_picture']['tmp_name'], $targetPath);
        // FILES TO DELETE ON ITS DESTINATIONS
        $query= $db->query("SELECT cover_img FROM users WHERE user_id= $id ");
        $rows= $query->fetch_assoc();
        $files= $uploadDir.$rows['cover_img'];
        // $files= getcwd().DIRECTORY_SEPARATOR.$rows['cover_img'];
		$covername = 'defaultCoverImage.png';

		if (file_exists($files) == true && $covername == $rows['cover_img']) { 
              link($files);
            //   echo "<script>alert('file was uploaded')</script>";
            }else{
                unlink($files);
                // echo "<script>alert('file deleted')</script>";
         }
        $update = $db->query("UPDATE users SET cover_img = '".$coverName."' WHERE user_id = $id");
        
        //Update status
        if($update){
            $result = $id ;
            // $result = 2;
        }
    var_dump($update);
    var_dump($_FILES['cover_picture']);
    //Load JavaScript function to show the upload status
    $path= DOCUMENT_ROOT.'/assets/image/users_profile_cover/'.$coverName.'';
    $strpos_countsTo = strpos($path, 'assets/image/users_profile_cover/'.$coverName.'');
    $path_replace= substr_replace($path,'', 0,$strpos_countsTo);
    echo '<script type="text/javascript">window.top.window.cover_completeUpload(' . $result . ',\'' .$path_replace. '\');</script>  ';
}

?>