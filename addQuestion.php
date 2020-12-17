<?php require('includes/header.php'); 

if(isset($_GET['deleteLast'])) {

    $sql = "SELECT id FROM challenges";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $rows = mysqli_num_rows($result);
    }


    $sql = "DELETE FROM challenges WHERE ID > ".($rows-$_GET['deleteLast']);
    $result = mysqli_query($conn, $sql);

    $sql = "ALTER TABLE challenges DROP COLUMN ID";
    $result = mysqli_query($conn, $sql);
  
    $sql = "ALTER TABLE challenges ADD ID int(11) AUTO_INCREMENT PRIMARY KEY";
    $result = mysqli_query($conn, $sql);


    header('location: index.php');
}

if(isset($_GET['random'])) { // adds 10 random questions

    // $file = fopen("randomquestions.txt", "r");
    // $newfile = fopen("newquestions.txt", "w");
    // while(!feof($file)) {
    //    // echo fgets($file) . "<br>";
    //    $txt = fgets($file);
    //    if(!empty(trim($txt))) {

    //         $pieces = explode(" ", $txt);
    //         array_shift($pieces);
    //         $txt = implode(" ", $pieces);
    //        fwrite($newfile, $txt);

    //    }
    // }
    // fclose($newfile);


    // fclose($file);

    for($i = 0; $i < $_GET['random']; $i++) {
        $lines = file("newquestions.txt");
        $numberOfLines = count($lines);
        $rand = rand(0, $numberOfLines-1); // arrays start at 0

        
        $pieces = explode(" ", $lines[$rand]); // splits string by " " on random line

        $name = $pieces[0]." ".$pieces[1]." ".$pieces[2];
        $question = $lines[$rand];
        $answer = $rand;

        $sql = "INSERT INTO challenges (name, question, answer) VALUES ('$name', '$question', '$answer')";
        $result = mysqli_query($conn, $sql);

        $sql = "SELECT id FROM challenges";
        $result = mysqli_query($conn, $sql);
      
        
        // header('location: index.php');
    }
    if(mysqli_num_rows($result) >= 0) {
        $lastpage =  floor((mysqli_num_rows($result) / 10 + 1));
        header('location: index.php?page='.$lastpage);
    }


}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $question = trim($_POST['question']);
    $answer = trim($_POST['answer']);

    $sql = "INSERT INTO challenges (name, question, answer) VALUES ('$name', '$question', '$answer')";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo "Success!";
    } else {
        echo "Fail!";
    }
}

?>






<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<input name="name" placeholder="name"><br>
<textarea name="question" rows="5" cols="40" placeholder="question"></textarea><br>
<input name="answer" placeholder="answer"><br>
<input name="submit" type="submit" value="Submit">
</form>