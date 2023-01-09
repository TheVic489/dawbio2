<?php
            if (isset($_SESSION["username"])) {  //user valid
                session_destroy();
                echo "<p>Logout done.</p>";
            }
            else {  //user not logged yet.
                echo "<p>Not logged!</p>";
            }
        ?>    

