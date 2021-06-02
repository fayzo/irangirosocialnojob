<?php 
include "../../core/init.php";

if (isset($_SESSION['key'])) {
    header('location: '.BASE_URL_PRIVATE.'indexx.php');
    exit();
}

if (isset($_SESSION['keys']) && isset($_SESSION['username']) && isset($_SESSION['email'])) {
    header('location: '.LOCKSCREEN_LOGIN_PRIVATE.'');
    exit();
}

 if (isset($_POST['key']) == 'login') {
    $conn = $db;
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $datetime= date('Y-m-d H-i-s');

    $user_admin->login($username,$email,$password,$datetime);
    
  } 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?php echo BASE_URL_LINK ;?>dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL_LINK ;?>dist/css/signin.css" rel="stylesheet">
    <title>Signin Template for Bootstrap</title>
  </head>

  <body class="text-center">
    <form class="form-signin">
      <img class="mb-4" src="" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <div class="form-group">
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="Username" class="form-control mb-3" placeholder="Username" >
      </div>

        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control mb-3" placeholder="Email address">

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="text" id="inputPassword" class="form-control" placeholder="Password" >

        <div class="checkbox mb-3">
           <label>
             <input type="checkbox" value="remember-me"> Remember me
           </label>
        </div>
      <button class="btn btn-lg btn-primary btn-block" onclick="manage('login')" type="button">Sign in</button>
       <div class="mt-2 h4" id='response'></div>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
    

    <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script>
<script>
  function manage(key){
      var username = $("#Username");
      var email = $("#inputEmail");
      var password = $("#inputPassword");
       //   use 1 or second method to validaton
     if (isEmpty(username) && isEmpty(email) && isEmpty(password) ) {
    //    alert("complete register");
       $.ajax({
           url: "login.php",
           method: "POST",
           dataType: "text",
           data:{ 
               key: key,
               username: username.val(),
               email: email.val(),
               password: password.val(),
           }, 
           success: function(response){
               $("#response").html(response);
                console.log(response);
                if (response.indexOf('Success') >= 0 ) {  
                  window.location = '../indexx.php';
                }else if(response.indexOf('Fail') >= 0 ){
                  setInterval(() => {
                    window.location =  'lockscreen.php';
                  }, 1000);
                  isEmptys(password);
               }else{
                   isEmptys(username) || isEmptys(email) || isEmptys(password) ;
               }
             }
       });
    }
}
function isEmpty(caller){
   if (caller.val() =="") {
      caller.css("border","1px solid red");
      return false;
    }else{
         caller.css("border","1px solid green");
    }
      return true;
}

function isEmptys(caller){
   if (caller.val() !="") {
      caller.css("border","1px solid red");
      return false;
    }
      return true;
}
</script>
</body>
</html>