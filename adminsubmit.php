


    <!-- <script>
        <button>SUBMIT</button>
        //document.getElementsByTagName('input')[0].click();
    </script> -->
    <button id="update">UPDATE</button>
    <script>
    document.getElementById('update').addEventListener('click', () => {
        
        let txt = document.getElementsByClassName('question')[0].innerHTML;
        // console.log(txt);
        document.cookie = "txt=" + txt;
        document.getElementById("admin-update-button").click(); // click the real php button

    });
    </script>


    <form action="<?php echo $_SERVER['PHP_SELF']."?id=".$_GET['id']; ?>" method="post"> <!-- 
        once form submitted, it is processed by index.php page and sql is updated. -->
    <input id="admin-update-button" type="submit" name="update" value="update" style="visibility: hidden;">
    </form>
