
<div id="mini-nav">

    <?php 
    $sql = "SELECT COUNT(id) FROM challenges";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $data =  $row['COUNT(id)'];

    $page = ceil($data / 10); // ten items per page

    for($i = 1; $i <= $page; $i++) {
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $i == $_GET['page']) { // if page is the current nav bar number
            echo  "<a href=\"?page=$i\"><div class='num active'>$i</div></a>"; 
        } elseif ($i == 1 && (!isset($_GET['page']) || !is_numeric($_GET['page']))) {
            echo  "<a href=\"?page=$i\"><div class='num active'>$i</div></a>";
        } else {
            echo  "<a href=\"?page=$i\"><div class='num'>$i</div></a>";
        }
        
    }
    
    ?>


</div>








<table>
    <tr>
        <th>ID</th>
        <th>Title / Description</th>
        <th>Solved By</th>
    </tr>



