<?php

require '../db/connect.php';

 		$phoneNumber=$_POST['phoneNumber'];
        $fullname=$_POST['fullname'];
        $electoral_ward=$_POST['electoral_ward'];
        $national_id=$_POST['national_id'];

       // UPDATE `tryout` SET `postaBoxNumber` = '9797', `postaBalance` = '1000' WHERE `tryout`.`id` = 57


         $selectionquery = "SELECT `fullname`, `electoral_ward` FROM `tryout` WHERE `national_id` = '$national_id'";



            if ($dbaseresult=$db->query($selectionquery)){
               if($dbaseresult->num_rows) {
                //echo 'Success. <br>';
                //$response = "CON Success! \n";

                while($rows = $dbaseresult->fetch_assoc()){
                 // $rows['national_id', 'electoral_ward'];
                 //$national_id = $rows['national_id'];
                 $fullname = $rows['fullname'];
                  $electoral_ward = $rows['electoral_ward'];
                  echo '<pre>';

                  print_r($rows);








 $withinquery = "INSERT INTO `tryout` (`id`, `phoneNumber`, `postaBoxNumber`, `postaBalance`, `fullname`, `electoral_ward`, `national_id`) VALUES (NULL, '$phoneNumber', '{$postaBoxNumber}', '{$postaBalance}', '$fullname', '$electoral_ward', '$national_id')";



 $withinquery = "INSERT INTO `tryout` (`id`, `phoneNumber`, `postaBoxNumber`, `postaBalance`, `fullname`, `electoral_ward`, `national_id`, `created`) VALUES (NULL, '$phoneNumber', '{$postaBoxNumber}', '{$postaBalance}', '$fullname', '$electoral_ward', '$national_id', NOW())";


            $selectionquery = "SELECT `national_id`, `electoral_ward` FROM `tryout` WHERE `fullname` = '$fullname'";

            if ($dbaseresult=$db->query($selectionquery)){
               if($dbaseresult->num_rows) {
                echo 'Success. <br>';

                while($rows = $dbaseresult->fetch_assoc()){
                 // $rows['national_id', 'electoral_ward'];
                 $national_id = $rows['national_id'];
                  $electoral_ward = $rows['electoral_ward'];

                  echo 'Your national id is '.$national_id.' and electoral ward is '.$electoral_ward.'. <br>';

                  //echo('Your national id is' .national_id.'and electoral ward is '.electoral_ward.'. <br>');
                }

            }else{
              echo '<br> Connection failed';

               }
            }
            exit;

 	header('Location: ../index.php?insertion=success');

?>