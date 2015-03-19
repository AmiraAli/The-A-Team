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
    </head>


    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand pull-left" >The-A-Team</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li ><a href="<?php echo $this->baseUrl()?>/controlar/action/" >Home</a></li>
                <li ><a href=""> about </a></li>
                <li ><a href="<?php echo $this->baseUrl()?>#" > settings</a></li>
                <li ><a href="<?php echo $this->baseUrl()?>#" > Requests </a></li>
                <li ><a href="<?php echo $this->baseUrl()?>/Users/listuserid" > Profile </a></li>
            </ul>
    </nav>
