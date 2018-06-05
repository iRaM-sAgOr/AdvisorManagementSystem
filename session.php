 <?php

            session_start();


            if(!isset( $_SESSION['created'] ) || (time() - $_SESSION['created']) > 6000) {

                session_destroy();

                echo "-1";

            } else {

                echo "1";

            }

        ?>