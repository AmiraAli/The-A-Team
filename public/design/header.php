<?php
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
?>

<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src ="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        <!--dont delete-->        
        <script type="text/javascript" src="../js/jquery.leanModal.min.js"></script>
        <script type="text/javascript" src="../js/jquery.popupwindow.js"></script>
        <!--dont delete-->
        <style>
            .warning_alert{
                color: #FFFFFF;
                background: #b92c28;
            }
            #alert,#join{
                background-color:#123456; 
                color: #FFFFFF;
            }
            .title{
                color:#123456;
            }
        </style>
    </head>


    <nav class="navbar navbar-inverse" id="alert">
        <div class="container-fluid">
                <div class="navbar-header"> The-A-Team</div>
                <div>
                    <ul class="nav navbar-nav pull-right">
                    <?php
                 $auth = Zend_Auth::getInstance();
                $storage = $auth->getStorage();
                $sessionRead = $storage->read();
                    if (!empty($sessionRead)) {
                    ?>
                        <li><a href="<?php echo $this->baseUrl() ?>/Users/logout" class="navbar-btn pull-right" > Logout </a></li>
                        <?php
                    }else{
                    ?>
                        <li><a href="<?php echo $this->baseUrl() ?>/Users/login" class="navbar-btn pull-right"  >Login </a>
                        <li><a href="<?php echo $this->baseUrl() ?>/Users/add" class="navbar-btn pull-right" >Sin Up </a>
                <?php
                    }
                    if (!empty($sessionRead)) {
                    ?>
                    <img src="<?php
                    if (!empty($sessionRead)) {
                        $image= $sessionRead->image;
                        echo "/The-A-Team/public/images/users/" . $image;
                    } 
                    ?>" class="pull-right" width="50px" height="50px">
                    <p class="navbar-text pull-right" style="color:#FFFFFF;"> Welcome 
                        <?php
                        if (!empty($sessionRead)) {
                            $name= $sessionRead->name;
                            echo " ".$name;
                        } 
                    }
                        ?>
                         </p>
                    </ul>
                </div>
                

                <ul class="nav navbar-nav">
                        <li class=""><a  navbar-brand href="<?php echo $this->baseUrl() ?>/home/home" >Home</a></li>
                <?php

                if (!empty($sessionRead)) {

                    $type = $sessionRead->type;
                    if ($type == "Admin") {
                        ?>
                        <li ><a href="<?php echo $this->baseUrl() ?>/control-room/admin" > settings</a></li>
                        <?php
                    }
                }
                ?>
                <li ><a href="<?php echo $this->baseUrl() ?>/Requests/list" > Requests </a></li>
                <?php
                if (!empty($sessionRead)) {

                    $type = $sessionRead->type;
                    if ($type == "Student" || $type == "Instructor") {
                        ?>
                        <li ><a href="<?php echo $this->baseUrl() ?>/Users/listuserid" > Profile </a></li>
                        <?php
                    }
                }
                
                    ?>
                    
            </ul>
        </div>
        </div>
    </nav>
