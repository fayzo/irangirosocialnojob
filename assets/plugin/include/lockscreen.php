<?php 
include "../core/init.php";

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
          array('forgotUsernameCounts' => 'forgotUsernameCounts +1', ),$_SESSION['keys']);
  } 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>welcome</title>
    <link href="<?php echo BASE_URL_LINK ;?>dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL_LINK ;?>icon/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script src="<?php echo BASE_URL_LINK ;?>icon/fontawesome_5_4/js/all.js"></script>

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
    integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> -->
    <style>
    body {
        font-family: 'Montserrat', sans-serif;
        background: #f6f5f7;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 20px 0 50px;
    }

    h1 {
        font-weight: bold;
        margin: 0;
        /* font-size: 15px; */
    }

    p {
        font-size: 14px;
        font-weight: 100;
        line-height: 20px;
        letter-spacing: .5px;
        margin: 20px 0 30px;
    }

    span {
        font-size: 12px;
    }

    a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
        margin: 15px 0;
    }

    .container {
        background: #f6f5f7;
        border-radius: 10px;
        box-shadow: 0 14px 28px rgba(0, 0, 0, .25), 0 10px 10px rgba(0, 0, 0, .22);
        width: 768px;
        max-width: 100%;
        min-height: 480px;
        padding: 10px 50px;
        height: 70%;
        text-align: center
    }

    .form-container {
        position: relative;
        margin-top: 2%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        font-size: small;
    }

    .form-container input {
        background: rgb(238, 238, 238);
        border: none;
        padding: 15px 15px;
        margin: 10px 0;
        width: 100%;
        border-radius: 10px;
        outline: none;
        height: 45px
    }
    .lockscreen-credentials {
       margin-left: 78px;
    }

    .lockscreen-item {
        border-radius: 4px;
        padding: 0;
        position: relative;
        margin: 50px auto 30px auto;
        width: 300px;
    }
    .input-group-text{
        margin-top: 9px;
        border: none;
    }
   
     /* User image */

    .lockscreen-image {
        border-radius: 50%;
        position: absolute;
        left: -10px;
        top: -20px;
        z-index: 10;
    }
    #white .lockscreen-image>img {
        border-radius: 50%;
        background: #fff;
        padding: 5px;
        width: 100px;
        height: 100px;
    }

    #green .lockscreen-image>img {
        border-radius: 50%;
        background: rgb(27, 168, 22);
        padding: 5px;
        width: 100px;
        height: 100px;
    }
    #green .input-group-text{
        background-color: rgb(27, 168, 22);
    }
    #green .text-muted {
        color: #f3f6f9!important;
    }
    #red .lockscreen-image>img {
        border-radius: 50%;
        background: rgb(240, 94, 94);
        padding: 5px;
        width: 100px;
        height: 100px;
    }
    #red .input-group-text{
        background-color: #f05e5e;
    }
    #red .text-muted {
        color: #f3f6f9!important;
    }

/* 
#green .lockscreen-image>img {
    border-radius: 50%;
    width: 70px;
    height: 70px;
}
#green .lockscreen-image {
    border-radius: 50%;
    position: absolute;
    left: -10px;
    top: -25px;
    background: rgb(27, 168, 22);
    padding: 5px;
    z-index: 10;
}

#red .lockscreen-image>img {
    border-radius: 50%;
    width: 70px;
    height: 70px;
}
#red .lockscreen-image {
    border-radius: 50%;
    position: absolute;
    left: -10px;
    top: -25px;
    background: rgb(240, 94, 94);
    padding: 5px;
    z-index: 10;
} */

    </style>
</head>

<body id=white>
    <div class="container" id="container">
        <h1 class="mb-3">Menya.com</h1>
        <div id="response"></div>

        <div class="form-container">
            <h4><?php echo $_SESSION['username'] ;?></h4>
            <!-- START LOCK SCREEN ITEM -->
            <div class="lockscreen-item">
                <!-- lockscreen image -->
                <div class="lockscreen-image">
                <?php if(!empty($_SESSION['profile_img'])){ ?>
                    <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$_SESSION['profile_img'] ;?>" alt="User Image">
                <?php }else{ ?>
                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL; ?>" alt="User Image">
                <?php } ?>
                </div>
                <form class="lockscreen-credentials">
                    <div class="input-group">
                        <input type="password" id="Password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <span class="input-group-text btn" onclick="lockscreen('lockscreen')" aria-label="Username"
                                aria-describedby="basic-addon1"><i class="fa fa-arrow-right text-muted"></i></span>
                        </div>
                    </div>
                </form>
                <p id="errors"></p>
                <!-- <p id="response"></p> -->
                <div class="help-block text-center">
                    Enter your password
                </div>
                <div class="help-block text-center">
                    or
                </div>
                <div class="text-center">
                    <a href="logout.php">Sign in as a different User</a>
                </div>
            </div>

        </div>
    </div>

    <script src="<?php echo BASE_URL_LINK ;?>dist/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/popper.min.js"></script>
    <script src="<?php echo BASE_URL_LINK ;?>dist/js/bootstrap.min.js"></script>
     <script>
    function lockscreen(key) {
        var password = $("#Password");
        //   use 1 or second method to validaton
        if (isEmpty(password)) {
            //    alert("complete register");
            $.ajax({
                url: "lockscreen.php",
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
                            window.location = '../home.php';
                        }, 1000);
                    } else {
                        isEmptys(password);
                    }
                }
            });
        }
    }

    function isEmpty(caller) {
        if (caller.val() == "") {
            caller.css("border", "1px solid red");
            $('#error').html("Please fill in ...?").css("color", "red");
            $('body').attr("id", 'red');
            return false;
        } else {
            caller.css("border", "1px solid green");
            $('body').attr("id", 'green');
            $('#error').html("Success").css("color", "green");
        }
        return true;
    }

    function isEmptys(caller) {
        if (caller.val() != "") {
            caller.css("border", "1px solid red");
            $('#error').html("Please Try Again ...?").css("color", "red");
            $('body').attr("id", 'red');
            return false;
        }
        return true;
    }
    $('body').attr("id", 'white');
    </script>
</body>
</html>