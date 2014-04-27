<?php
  
  // logout.php - Steve Hadfield - 3/24/2011
  // destroys the current session and redirects back to index.html

  session_start();
  session_destroy();

  header("location:index.html");

?>