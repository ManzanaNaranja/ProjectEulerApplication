<?php require('includes/header.php'); ?>






    <?php

    if($admin && isset($_GET['delete'])) { // ADMIN WANTS TO DELETE A QUESTION
        $sql = "DELETE FROM challenges WHERE ID=".$_GET['delete'];
        $result = mysqli_query($conn, $sql);

        $sql = "ALTER TABLE challenges DROP COLUMN ID";
        $result = mysqli_query($conn, $sql);
      
        $sql = "ALTER TABLE challenges ADD ID int(11) AUTO_INCREMENT PRIMARY KEY";
        $result = mysqli_query($conn, $sql);

        //ALTER TABLE challenges DROP COLUMN ID; ALTER TABLE challenges ADD ID int(11) AUTO_INCREMENT PRIMARY KEY



    }
    
    if($admin && isset($_POST['update'])) {  // THIS IS WHEN ADMIN SUBMITS A CHANGE
       // echo $_COOKIE['txt'];
        $sql = "UPDATE challenges SET question = '".$_COOKIE['txt']."' WHERE id=".$_GET['id'];
        $result = mysqli_query($conn, $sql);

        $sql = "UPDATE users SET completed = concat(completed, ' ".$_GET['id']."') WHERE id=".$_SESSION['id']; // updates completed numbers in database

    }
    

    if(isset($_GET['id'])) { // there was a request to view a question
        // echo "<pre><h1>".$_GET['id']."</h1></pre>";
        $sql = "SELECT question FROM challenges WHERE ID =".$_GET['id'];
        $result = mysqli_query($conn, $sql);


        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            echo "<div class=\"container\">";
            echo "<div class=\"question\">".$row['question']."</div>";
            
            require('includes/submitAnswer.php'); 
            echo "</div>";
            if($loggedin && $_SESSION['role'] == 'admin') {
                echo "<script>document.getElementsByClassName('question')[0].contentEditable = true</script>";
                include('adminsubmit.php');
            }
            

        } else { // no such question number
            header("location: index.php");
        }
    } else {

        require('includes/tablehead.php');

        if(!isset($_GET['page'])) {
            $page = 1;
        } elseif (is_numeric($_GET['page'])) {
            $page = $_GET['page'];
        }

        $sql = "SELECT id, name, solvedBy FROM challenges WHERE id >= $page * 10 - 9 AND id < $page*10 + 1";
        $result = mysqli_query($conn, $sql);

        // $completed = [];

        if($loggedin) {
            $sql = "SELECT completed FROM users WHERE id = ".$_SESSION['id'];
            $result2 = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result2) > 0) {
                if($row = mysqli_fetch_assoc($result2)) {
                    $completed = explode(" ", $row['completed']);
                    $_SESSION['completed'] = $completed;
                   // echo print_r($row); // prints query row
                }
            }
        }
 



        // $abc = in_array(1, $completed);
       

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td><a href=\"?id=".$row["id"]."\">".$row["name"]."</a></td>";
                echo "<td>".$row["solvedBy"]."</td>";
                if($loggedin && in_array($row["id"], $completed)) { // if question was completed
                    $comp = "COMPLETED";
                } else {
                    $comp = "";
                }
                echo "<td>".$comp."</td>";
                if($admin) {
                    if(isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    echo "<td><a href=?page=".$page."&delete=".$row["id"].">DELETE</a></td>";
                }
                echo "</tr>";
            }
        }

        echo "</table>";
       

        if($admin) {
            echo "<a href=\"addQuestion.php\"><button id=\"admin-add-question\">ADD QUESION</button></a>";  
            echo "<a href=\"addQuestion.php?random=10\"><button>ADD 10 Random Questions</button></a>";  
            echo "<a href=\"addQuestion.php?deleteLast=10\"><button>DELETE Last 10 Questions</button></a>";  
        }

    }




// $file = fopen("upload.txt", "r") or die ("Unable to open file!");
//     while(!feof($file)) {
//         echo "[".trim(fgets($file))."]<br>";

//         $data = trim(fgets($file));
//         $sql = "INSERT INTO challenges (name) VALUES ('$data')";
        
        
//         if (mysqli_query($conn, $sql)) {
//             echo "New record created successfully";
//           } else {
//             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//           }
//     }
//     fclose($file);

?>

    <!-- <tr>
        <td>1</td>
        <td>Potato Challenge</td>
        <td>1232</td>
    </tr>
    <td>223</td>
        <td>Risky Bounce</td>
        <td>10210</td>
    </tr> -->

    






</body>
</html>