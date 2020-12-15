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
        $update = $db->query("UPDATE users SET profile_img = '{$fileName}' WHERE user_id = $id");
        
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

// LOGO BUSINESS 

if(!empty($_FILES['pictureLogo']['name'])){

    $id= $_POST['edit_profileLogo'];
    $files = $_FILES['pictureLogo'];
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
    move_uploaded_file($_FILES['pictureLogo']['tmp_name'], $targetPath);
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
        $update = $db->query("UPDATE users SET profile_img = '{$fileName}' WHERE user_id = $id");
        
        //Update status
        if($update){
            $result = $id ;
            // $result = 2;
        }
        
     var_dump($update);
     var_dump($_FILES['pictureLogo']);
    //Load JavaScript function to show the upload status
    $path= DOCUMENT_ROOT.'/assets/image/users_profile_cover/'.$fileName.'';
    $strpos_countsTo = strpos($path, 'assets/image/users_profile_cover/'.$fileName.'');
    $path_replace= substr_replace($path,'', 0,$strpos_countsTo);
    echo '<script type="text/javascript">window.top.window.completeUploadLogo(' . $result . ',\'' .$path_replace. '\');</script>  ';
}


if(!empty($_FILES['cover_picture']['name'])){
    $id= $_POST['edit_cover'];
    $files = $_FILES['cover_picture'];
    $uploadDir = DOCUMENT_ROOT.'/assets/image/users_cover_profile/';
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
    $path= DOCUMENT_ROOT.'/assets/image/users_cover_profile/'.$coverName.'';
    $strpos_countsTo = strpos($path, 'assets/image/users_cover_profile/'.$coverName.'');
    $path_replace= substr_replace($path,'', 0,$strpos_countsTo);
    echo '<script type="text/javascript">window.top.window.cover_completeUpload(' . $result . ',\'' .$path_replace. '\');</script>  ';
}


if(!empty($_FILES['change_domestics']['name'])){
    $id= $_POST['domestics_id'];
    $files = $_FILES['change_domestics'];
    $uploadDir = DOCUMENT_ROOT.'/uploads/domestics/';
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
    move_uploaded_file($_FILES['change_domestics']['tmp_name'], $targetPath);
        // FILES TO DELETE ON ITS DESTINATIONS
        $query= $db->query("SELECT photo_ FROM domestics WHERE domestics_id= $id ");
        $rows= $query->fetch_assoc();
        $files= $uploadDir.$rows['photo_'];
        // $files= getcwd().DIRECTORY_SEPARATOR.$rows['cover_img'];
		$covername = 'defaultCoverImage.png';

		if (file_exists($files) == true && $covername == $rows['photo_']) { 
              link($files);
            //   echo "<script>alert('file was uploaded')</script>";
            }else{
                unlink($files);
                // echo "<script>alert('file deleted')</script>";
         }
        $update = $db->query("UPDATE domestics SET photo_ = '".$coverName."' WHERE domestics_id= $id");
        
        //Update status
        if($update){
            $result = $id ;
            // $result = 2;
        }
    // var_dump($update);
    // var_dump($_FILES['cover_picture']);
    //Load JavaScript function to show the upload status
    $path= DOCUMENT_ROOT.'/uploads/domestics/'.$coverName.'';
    $strpos_countsTo = strpos($path, 'uploads/domestics/'.$coverName.'');
    $path_replace= substr_replace($path,'', 0,$strpos_countsTo);
    echo '<script type="text/javascript">window.top.window.domestics_completeUpload(' . $result . ',\'' .$path_replace. '\');</script>  ';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['CROP']) ) {
    if($_REQUEST['CROP'] == 'CROP'){

         $targ_w = $targ_h = 150;
         $jpeg_quality = 90;
         
         $uploadDir = DOCUMENT_ROOT.'/assets/image/users_profile_cover/';
         $src = $uploadDir.$_POST['src'];
         $files= $src;
         $filename = 'defaultprofileimage.png';
        
         $img_r = imagecreatefromjpeg($src);
         $dst_r = ImageCreateTrueColor($targ_w,$targ_h );
         
         imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
         
         header('Content-type: image/jpeg');
         imagejpeg($dst_r,'../../assets/image/users_profile_cover/'.$_POST['src'], $jpeg_quality);
         // Remove from memory - don't forget this part
         imagedestroy($dst_r);
         
         exit('image save'); 
         
      }

    }
?>