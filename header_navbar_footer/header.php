

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <!-- <link rel="stylesheet" href="bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/dataTables.bootstrap4.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>plugin/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>icon/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>icon/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>plugin/skins/_all-skins.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/main.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/profile.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/profileEdit.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/follow.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/dashboard.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/imagePopup.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/login.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/whoTofollow.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/style.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/message.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/cardboxChat.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/jquery.Jcrop.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/mailbox.css">
  <!-- <link rel="stylesheet" href="<?php echo BASE_URL_LINK;?>dist/css/follow.css"> -->


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!-- <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->

<!-- image-gallery10 -->
<?php include('header_image_slide.php') ;?>
<style>
    	#image-gallery10{
			list-style: none outside none;
		    padding-left: 0;
            margin: 0;
		}
        .demo .item{
            margin-bottom: 60px;
        }
		.content-slider li{
		    background-color: #ed3020;
		    text-align: center;
		    color: #FFF;
		}
		.content-slider h3 {
		    margin: 0;
		    padding: 70px 0;
		}
		.demo{
			width: 800px;
		}
</style>
<!-- END image-gallery10 -->
<script>
  
  function follow_FecthRequest(id,user_id,follow_id) {
        var xhr = new XMLHttpRequest();
        // Add any event handlers here...
        xhr.open('POST', 'core/ajax_db/follow_FecthPaginat.php?pages=' + id +'&user_id=' + user_id +'&follow_id=' + follow_id , true);
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                switch (id) {
                    case id:
                         var pagination = document.getElementById('Follow-view');
                         pagination.innerHTML = xhr.responseText;
                        break;
                   
                }
            }
        };
          xhr.addEventListener('progress',function(e){
             var progress= Math.round((e.loaded/e.total)*100);
             $('.progress-navbar').show();
             $('#progress_width').css('width',progress +'%');
             $('#progress_width').html(progress +'%');
         }, false);

        xhr.addEventListener('load', function (e) { 
            $('.progress-bar').removeClass('bg-info').addClass('bg-danger').html('<span> completed  <span class="fa fa-check"></span></span>');
            setInterval(function () {
                $(".progress-navbar").fadeOut();
            }, 2000);
        }, false);
    }

</script>
</head>
<?php if (isset($_SESSION['key'])){ ?>
  
  <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
  <body class="hold-transition skin-blue fixed sidebar-mini-expand-feature sidebar-mini">
  <!-- Site wrapper -->
<?php }else{ ?>

  <!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
  <body class="hold-transition skin-blue fixed sidebar-collapse">
  <!-- Site wrapper -->

<?php } ?>
<div class="wrapper">
    <!-- =============================================== -->
    <!-- navbar path -->
    <?php include 'navbar.php'; ?>
    <!-- navbar path -->
    <?php include 'siderbar.php'; ?>
   <!-- navbar path -->
    <!-- =============================================== -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">