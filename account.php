<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Project Worlds || TEST YOUR SKILL </title>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/bootstrap-theme.min.css" />
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/font.css">
  <script src="js/jquery.js" type="text/javascript"></script>


  <script src="js/bootstrap.min.js" type="text/javascript"></script>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
  <!--alert message-->
  <?php if (@$_GET['w']) {
    echo '<script>alert("' . @$_GET['w'] . '");</script>';
  }
  ?>
  <!--alert message end-->

</head>
<?php
include_once 'dbConnection.php';
?>

<body>
  <div class="header">
    <div class="row">
      <div class="col-lg-6">
        <span class="logo">Test Your Skill</span>
      </div>
      <div class="col-md-4 col-md-offset-2">
        <?php
        include_once 'dbConnection.php';
        session_start();
        if (!(isset($_SESSION['email']))) {
          header("location:index.php");
        } else {
          $name = $_SESSION['name'];
          $email = $_SESSION['email'];

          include_once 'dbConnection.php';
          echo '<span class="pull-right top title1" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Hello,</span> <a href="account.php?q=1" class="log log1">' . $name . '</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
        } ?>
      </div>
    </div>
  </div>
  <div class="bg">

    <!--navigation menu-->
    <nav class="navbar navbar-default title1">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><b>Netcamp</b></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li <?php if (@$_GET['q'] == 1) echo 'class="active"'; ?>><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
            <li <?php if (@$_GET['q'] == 2) echo 'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
            <li <?php if (@$_GET['q'] == 3) echo 'class="active"'; ?>><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Ranking</a></li>
            <li class="pull-right"> <a href="logout.php?q=account.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;&nbsp;Signout</a></li>
          </ul>
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Enter tag ">
            </div>
            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Search</button>
          </form>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav><!--navigation menu closed-->
    <div class="container"><!--container start-->
      <div class="row">
        <div class="col-md-12">

          <!--home start-->
          <?php if (@$_GET['q'] == 1) {

            $result = mysqli_query($con, "SELECT * FROM quiz ORDER BY date DESC") or die('Error');
            echo  '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
            $c = 1;
            while ($row = mysqli_fetch_array($result)) {
              $title = $row['title'];
              $total = $row['total'];
              $sahi = $row['sahi'];
              $time = $row['time'];
              $eid = $row['eid'];
              $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
              $rowcount = mysqli_num_rows($q12);
              if ($rowcount == 0) {
                echo '<tr><td>' . $c++ . '</td><td>' . $title . '</td><td>' . $total . '</td><td>' . $sahi * $total . '</td><td>' . $time . '&nbsp;min</td>
	<td><b><a href="account.php?q=quiz&step=2&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
              } else {
                echo '<tr style="color:#99cc32"><td>' . $c++ . '</td><td>' . $title . '&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>' . $total . '</td><td>' . $sahi * $total . '</td><td>' . $time . '&nbsp;min</td>
	<td><b><a href="update.php?q=quizre&step=25&eid=' . $eid . '&n=1&t=' . $total . '" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></td></tr>';
              }
            }
            $c = 0;
            echo '</table></div></div>';
          } ?>
          <!--<span id="countdown" class="timer"></span>
<script>
var seconds = 40;
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Buzz Buzz";
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval('secondPassed()', 1000);
</script>-->

          <!--home closed-->

          <!--quiz start-->
          <?php
          if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
            $eid = @$_GET['eid'];
            $sn = @$_GET['n'];
            $total = @$_GET['t'];
            $q = mysqli_query($con, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' ");
            echo '<div class="panel" style="margin:5%">';
            while ($row = mysqli_fetch_array($q)) {
              $qns = $row['qns'];
              $qid = $row['qid'];
              echo '<b>Question &nbsp;' . $sn . '&nbsp;::<br />' . $qns . '</b><br /><br />';
            }
            $q = mysqli_query($con, "SELECT * FROM options WHERE qid='$qid' ");
            echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST"  class="form-horizontal">
<br />';

            while ($row = mysqli_fetch_array($q)) {
              $option = $row['option'];
              $optionid = $row['optionid'];
              echo '<input type="radio" name="ans" value="' . $optionid . '">' . $option . '<br /><br />';
            }
            echo '<br /><button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form></div>';
            //header("location:dash.php?q=4&step=2&eid=$id&n=$total");
          }
          //result display
          if (@$_GET['q'] == 'result' && @$_GET['eid']) {
            $eid = @$_GET['eid'];
            $q = mysqli_query($con, "SELECT * FROM history WHERE eid='$eid' AND email='$email' ") or die('Error157');
            echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

            while ($row = mysqli_fetch_array($q)) {
              $s = $row['score'];
              $w = $row['wrong'];
              $r = $row['sahi'];
              $qa = $row['level'];
              echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>' . $qa . '</td></tr>
      <tr style="color:#99cc32"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>' . $r . '</td></tr> 
	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>' . $w . '</td></tr>
	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>' . $s . '</td></tr>';
            }
            $q = mysqli_query($con, "SELECT * FROM rank WHERE  email='$email' ") or die('Error157');
            while ($row = mysqli_fetch_array($q)) {
              $s = $row['score'];
              echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>' . $s . '</td></tr>';
            }
            echo '</table></div>';
          }
          ?>
          <!--quiz end-->
          <?php
          //history start
          if (@$_GET['q'] == 2) {
            $q = mysqli_query($con, "SELECT * FROM history WHERE email='$email' ORDER BY date DESC ") or die('Error197');
            echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
            $c = 0;
            while ($row = mysqli_fetch_array($q)) {
              $eid = $row['eid'];
              $s = $row['score'];
              $w = $row['wrong'];
              $r = $row['sahi'];
              $qa = $row['level'];
              $q23 = mysqli_query($con, "SELECT title FROM quiz WHERE  eid='$eid' ") or die('Error208');
              while ($row = mysqli_fetch_array($q23)) {
                $title = $row['title'];
              }
              $c++;
              echo '<tr><td>' . $c . '</td><td>' . $title . '</td><td>' . $qa . '</td><td>' . $r . '</td><td>' . $w . '</td><td>' . $s . '</td></tr>';
            }
            echo '</table></div>';
          }

          //ranking start
          if (@$_GET['q'] == 3) {
            $q = mysqli_query($con, "SELECT * FROM rank  ORDER BY score DESC ") or die('Error223');
            echo  '<div class="panel title"><div class="table-responsive">
<table class="table table-striped title1" >
<tr style="color:red"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Gender</b></td><td><b>College</b></td><td><b>Score</b></td></tr>';
            $c = 0;
            while ($row = mysqli_fetch_array($q)) {
              $e = $row['email'];
              $s = $row['score'];
              $q12 = mysqli_query($con, "SELECT * FROM user WHERE email='$e' ") or die('Error231');
              while ($row = mysqli_fetch_array($q12)) {
                $name = $row['name'];
                $gender = $row['gender'];
                $college = $row['college'];
              }
              $c++;
              echo '<tr><td style="color:#99cc32"><b>' . $c . '</b></td><td>' . $name . '</td><td>' . $gender . '</td><td>' . $college . '</td><td>' . $s . '</td><td>';
            }
            echo '</table></div></div>';
          }
          ?>



        </div>
      </div>
    </div>
  </div>
  <!--Footer start-->
  <div class="row footer">
    <div class="col-md-3 box">
      <a href="https://facebook.com/100004084146125">About us</a>
    </div>
    <div class="col-md-3 box">
      <a href="#" data-toggle="modal" data-target="#login">Admin Login</a>
    </div>
    <div class="col-md-3 box">
      <a href="#" data-toggle="modal" data-target="#developers">Developers</a>
    </div>
    <div class="col-md-3 box">
      <a href="feedback.php" target="_blank">Feedback</a>
    </div>
  </div>
  <!-- Modal For Developers-->
  <div class="modal fade title1" id="developers">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title" style="font-family:'typo' "><span style="color:orange">Developers</span></h4>
        </div>

        <div class="modal-body">
          <p>
          <div class="row">
            <div class="col-md-4">
              <img src="data:image/jpeg;base64,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" width=100 height=100 alt="Sunny Prakash Tiwari" class="img-rounded">
            </div>
            <div class="col-md-5">
              <a href="www.facebook.com/100004084146125" style="color:#202020; font-family:'typo' ; font-size:18px" title="Find on Facebook">Sourav Das</a>
              <h4 style="color:#202020; font-family:'typo' ;font-size:16px" class="title1">+91 8293575004</h4>
              <h4 style="font-family:'typo' ">souravdas75@rediffmail.com</h4>
              <h4 style="font-family:'typo' ">CTTC, Kolkata</h4>
            </div>
          </div>
          </p>
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!--Modal for admin login-->
  <div class="modal fade" id="login">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title"><span style="color:orange;font-family:'typo' ">LOGIN</span></h4>
        </div>
        <div class="modal-body title1">
          <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
              <form role="form" method="post" action="admin.php?q=index.php">
                <div class="form-group">
                  <input type="text" name="uname" maxlength="20" placeholder="Admin user id" class="form-control" />
                </div>
                <div class="form-group">
                  <input type="password" name="password" maxlength="15" placeholder="Password" class="form-control" />
                </div>
                <div class="form-group" align="center">
                  <input type="submit" name="login" value="Login" class="btn btn-primary" />
                </div>
              </form>
            </div>
            <div class="col-md-3"></div>
          </div>
        </div>
        <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!--footer end-->


</body>

</html>