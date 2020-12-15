<?php 
include('../init.php');
// $users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (!isset($_SESSION['keys'])) {
     header('location: '.LOGIN.'');
    exit();
}

if (isset($_POST['key']) == 'lockscreen') {
    
    $password = $users->test_input($_POST['password']);
    $sql= $db->query("SELECT user_id ,username,approval,chat FROM users WHERE user_id= $_SESSION[keys] AND password='{$password}' ");
    $row= $sql->fetch_assoc();

    if ($sql->num_rows > 0) {
        $datetime= date('Y-m-d H-i-s');
        $db->query("UPDATE users SET last_login = '$datetime'  WHERE user_id= $_SESSION[keys] AND password= '$password' ");
        $db->query("UPDATE users SET counts_login=counts_login + 1 WHERE user_id= $_SESSION[keys] AND password= '$password' ");
        $db->query("UPDATE users SET chat = 'on' WHERE user_id= $_SESSION[keys] AND password= '$password' ");
        $_SESSION['key'] = $row['user_id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['approval'] = $row['approval'];
        $_SESSION['chat'] = $row['chat'];
        exit ('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Success</strong> </div>');
    }else{
        exit ('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Please Try Again ...!!!</strong> </div>');
    }
    $users->forgotUsernameCountsTodelete('users',
          array('forgotUsernameCounts' => 0, ),$_SESSION['keys']);
  } 

?>

<?php

if (isset($_POST['login_id']) && !empty($_POST['login_id'])) {
    $login_id= $_POST['login_id']; 
    ?>
<style>

.img-popup-wrapLogin1{
	border-radius: 4px;
	background: #fff;
	max-width: 400px;
	max-height: 245px;
	position: relative;
	top: 5%;
	margin: 20px auto;
    padding: 0px;
    z-index: 10001;
}

.img-popup-bodys {
    border-radius: 4px;
    overflow: hidden;
}

    .body-center1 {
        font-family: 'Montserrat', sans-serif;
        background: #f6f5f7;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        /* height: 100vh; */
    }

    .h10 {
        font-weight: bold;
        margin: 0;
        /* font-size: 15px; */
    }

    .p0 {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: .5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 12px;
    }

    .alink {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    .containers1 {
        background: #f6f5f7;
        border-radius: 10px;
        box-shadow: 0 14px 28px rgba(0, 0, 0, .25), 0 10px 10px rgba(0, 0, 0, .22);
        width: 500px;
        max-width: 100%;
        min-height: 250px;
        padding: 10px 50px;
        height: 70%;
        text-align: center
    }

    .form-container1 {
        position: relative;
        margin-top: 2%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-size: small;
    }

    .form-container1 input {
        background: rgb(238, 238, 238);
        border: none;
        padding: 15px 15px;
        margin: 10px 0;
        width: 100%;
        border-radius: 10px;
        outline: none;
        height: 45px
    }
    .lockscreen-credentials1 {
       margin-left: 78px;
    }

    .lockscreen-item1 {
        border-radius: 4px;
        padding: 0;
        position: relative;
        margin: 50px auto 30px auto;
        width: 300px;
    }
    .input-group-text{
        margin-top: 9px !important;
        border: none !important;
    }
   
    .containers1 .btn {
        border-radius: 0px !important;
    }

     /* User image */

    .lockscreen-image1 {
        border-radius: 50%;
        position: absolute;
        left: -10px;
        top: -20px;
        z-index: 10;
    }
    #_white .lockscreen-image1>img {
        border-radius: 50%;
        background: #fff;
        padding: 5px;
        width: 100px;
        height: 100px;
    }

    #_green .lockscreen-image1>img {
        border-radius: 50%;
        background: rgb(27, 168, 22);
        padding: 5px;
        width: 100px;
        height: 100px;
    }
    #_green .input-group-text{
        background-color: rgb(27, 168, 22);
    }
    #_green .text-muted {
        color: #f3f6f9!important;
    }
    #_red .lockscreen-image1>img {
        border-radius: 50%;
        background: rgb(240, 94, 94);
        padding: 5px;
        width: 100px;
        height: 100px;
    }
    #_red .input-group-text{
        background-color: #f05e5e;
    }
    #_red .text-muted {
        color: #f3f6f9!important;
    }

</style>

<div class="login-popup">
    <div class="wrap6" id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrapLogin1" id="popupEnd">
        	<div class="img-popup-bodys">

        <div class="body-center1">
        <div class="containers1 container" id="container">
                <h1 class="mb-3 h10">Menya.com</h1>
                <div id="response"></div>

                <div class="form-container1">
                    <h4><?php echo $_SESSION['username'] ;?></h4>
                    <!-- START LOCK SCREEN ITEM -->
                    <div class="lockscreen-item1">
                        <!-- lockscreen image -->
                        <div class="lockscreen-image1">
                        <?php if(!empty($_SESSION['profile_img'])){ ?>
                            <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$_SESSION['profile_img'] ;?>" alt="User Image">
                        <?php }else{ ?>
                            <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL; ?>" alt="User Image">
                        <?php } ?>
                        </div>
                        <form class="lockscreen-credentials1">
                            <div class="input-group">
                                <input type="password" id="Password" class="form-control" placeholder="Password">
                                <div class="input-group-append">
                                    <span class="input-group-text btn" onclick="lockscreen('lockscreen')" aria-label="Username"
                                        aria-describedby="basic-addon1"><i class="fa fa-arrow-right text-muted"></i></span>
                                </div>
                            </div>
                        </form>
                        <p class="p0" id="errors"></p>
                        <!-- <p id="response"></p> -->
                        <div class="help-block text-center">
                            Enter your password
                        </div>
                        <div class="help-block text-center">
                            or
                        </div>
                        <div class="text-center">
                            <a class="alink" href="<?php echo LOGOUT;?>">Sign in as a different User</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

         </div><!-- img-popup-body -->
        </div><!-- user-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->
<script>
    $('.body-center1').attr("id", '_white');
     
    function lockscreen(key) {
        var password = $("#Password");
        //   use 1 or second method to validaton
        if (isEmpty0(password)) {
            //    alert("complete register");
            $.ajax({
                url: "core/ajax_db/lockscreen_add.php",
                method: "POST",
                dataType: "text",
                data: {
                    key: key,
                    password: password.val(),
                },
                success: function(response) {
                    $("#response").html(response);
                    console.log(response);
                    if (response.indexOf('Success') >= 0) {
                       setInterval(() => {
                            $(".login-popup").hide();
                        }, 1500);
                        setInterval(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        isEmptys0(password);
                    }
                }
            });
        }
    }

    function isEmpty0(caller) {
        if (caller.val() == "") {
            caller.css("border", "1px solid red");
            $('#error').html("Please fill in ...?").css("color", "_red");
            $('.body-center1').attr("id", '_red');
            return false;
        } else {
            caller.css("border", "1px solid green");
            $('.body-center1').attr("id", '_green');
            $('#error').html("Success").css("color", "_green");
        }
        return true;
    }

    function isEmptys0(caller) {
        if (caller.val() != "") {
            caller.css("border", "1px solid red");
            $('#error').html("Please Try Again ...?").css("color", "_red");
            $('.body-center1').attr("id", '_red');
            return false;
        }
        return true;
    }
</script>
<?php }  ?>
  