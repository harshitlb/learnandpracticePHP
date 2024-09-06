<html>
<body>

Welcome <?php echo $_GET["name"]; ?><br>
Your email address is: <?php echo $_GET["email"]; ?>
<?php 
   function getDatabase(){
      $Name = $_GET["name"];
      $Email = $_GET["email"];
      echo "$Name $Email";
   }
   getDatabase()
?>
</body>
</html>
