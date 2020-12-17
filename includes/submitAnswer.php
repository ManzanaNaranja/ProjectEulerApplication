
<?php

if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == 'POST' && (!in_array($_GET['id'], $_SESSION['completed']))) { // second part prevents against html injection, checks if challege is not completed
   $ans =  trim($_POST['answer']);
   $ans_err = "";
   if(empty($ans)) {
      $ans_err = "Your answer is empty!";
   } 
  
   if(empty($ans_err)) {
      
      $sql = "SELECT answer FROM challenges WHERE answer = '$ans' AND id =".$_GET['id'];
      $result = mysqli_query($conn, $sql);
      if($result && mysqli_num_rows($result) == 1) { // MAKE SURE TO CHECK RESULT FIRST OTHERWISE WON'T WORK
         echo "<div class=\"success\">CORRECT</div>";
         
        // $_SESSION['completed']

         array_push($_SESSION['completed'], " ".$_GET['id']); // updates completed sessions so input box is removed
         
         
         if($loggedin) {
            $sql = "UPDATE users SET completed = concat(completed, ' ".$_GET['id']."') WHERE id=".$_SESSION['id']; // updates completed numbers in database
            $result = mysqli_query($conn, $sql);
            // UPDATE users SET completed = concat(completed, ' a') WHERE id=2
         }


         // if($row = mysqli_fetch_assoc($result)) {
         //    $row['']
         // }  

        
      } else {
         echo "<div class=\"error\">WRONG</div>";
      }
   }
}
?>


<!-- 
<input type="text" name="answer" placeholder="answer">
       <input type="submit" name="submit" value="Submit"> -->

<form action="<?php echo $_SERVER["PHP_SELF"]."?id=".$_GET['id']; ?>" method="post">
<?php
   if(!empty($ans_err)) {
      echo "<div class=\"error\">$ans_err</div>";
   }

   if($loggedin && !in_array($_GET['id'], $_SESSION['completed'])) { // if not completed then submit box should be visible
      echo "<input type=\"text\" name=\"answer\" placeholder=\"answer\">";
      echo "<input type=\"submit\" name=\"submit\" value=\"Submit\">";
      
   } elseif($loggedin) {
      $sql = "SELECT answer FROM challenges WHERE id=".$_GET['id'];
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) == 1) {
         if($row = mysqli_fetch_assoc($result)) {
            $answer = $row['answer'];
            echo "<div class=\"answer\">answer: $answer </div>";
         }
      }
      
   } else {
      echo "<div class=\"answer\">login to submit an answer</div>";
   }
?>

   
   
</form>