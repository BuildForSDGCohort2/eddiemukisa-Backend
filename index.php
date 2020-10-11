<?php



include_once('db/connect.php');
include_once('functions.php');

        $text        = $_REQUEST["text"];//= $_REQUEST["text"]; // = $_SESSION["text"];
        $sessionId   = $_REQUEST["sessionId"];
        $serviceCode = $_REQUEST["serviceCode"];
        $phoneNumber = $_REQUEST["phoneNumber"];

        $level = explode("*", $text);
        $count = count($level);

        $levelss = (['level'=>$level]);  //THIS DISPLAYS 2 ARRAYS, AN ARRAY INSIDE THE LEVEL ARRAY...  the 'level' is a whole new array
  // var_dump($levelss);
 //
  //var_dump(['count'=>$count]);


        if($level['0'] == 0 && $count == 1){



             $response  = "CON Welcome to Mental Auti-Awareness USSD Services. \n";
             $response .= "1. Primary Care Provider \n";    //without the RESPONSE .= ,then the latest RESPONSE OVERRIDES the previous RESPONSE.
             $response .= "2. Register with us for updates \n";
             $response .= "3. Mental Health Awareness Info \n";
             $response .= "4. GET HELP NOW? \n";
             $response .= "5. Partake in Screening Tests \n";
             $response .= "6. Want to Partner with us? \n";
             $response .= "7. Contact Us for more Info";



 //SELECTION 1
          }
          else if ($level['0'] == 1 && $count == 1){

            $response  = "CON Choose; \n";
            $response .= "1. Hospital/Clinic Centres \n";    //without the RESPONSE .= ,then the latest RESPONSE OVERRIDES the previous RESPONSE.
            $response .= "2. Verify Your Doctor ";



        }else if($level['0'] == 1 && $count == 2 && $level['1'] == 1){

          $response = "CON Please enter your area in county form(E.g. Nairobi or Nakuru) ";

          }

          else if($level['0'] == 1 && $count == 3 && $level['1'] == 1 && (!empty($level['2']))){

            $response = "CON What facility do you need? \n";
            $response .= "1.  Mental Health \n";
            $response .= "2.  Rehabilitation ";

              if (intval($level['2'])) {
              // code...
                $response = 'END Input Relevant County!';
                die($response);

                }


}else if($level['0'] == 1 && $count == 4 && $level['1'] == 1 && (!empty($level['2'])) && $level['3'] == 1){


            $county_hosi = $level['2'];

             $level['3'] = "Mental Health";
             $centres_hosi = $level['3'];


           $selectionquery = "SELECT `hospitals_hosi`,`centres_phoneNumber`  FROM `hospitals_clinics` WHERE `county_hosi` = '$county_hosi' AND `centres_hosi` = '$centres_hosi'";


          if ($dbaseresult=$db->query($selectionquery)){
           if($dbaseresult->num_rows) {

            while($rows = $dbaseresult->fetch_assoc()){

              //$doctor_name = $rows['doctor_name'];

              $hospitals_hosi = $rows['hospitals_hosi'];
              //$specialist = $rows['specialist'];
              $centres_phoneNumber = $rows['centres_phoneNumber'];
              //$centres_hosi = $rows['centres_hosi'];


            $rowRespons .= $hospitals_hosi.': '.$centres_phoneNumber."\n";
            $response = 'END '.$rowRespons;

              }
           }else{
            $response = 'END None found in your area.';
           }
          }
        }else if($level['0'] == 1 && $count == 4 && $level['1'] == 1 && (!empty($level['2'])) && $level['3'] == 2){

           $county_hosi = $level['2'];

            $level['3'] = "Rehabilitation";
            $centres_hosi = $level['3'];


          $selectionquery = "SELECT `hospitals_hosi`,`centres_phoneNumber`  FROM `hospitals_clinics` WHERE `county_hosi` = '$county_hosi' AND `centres_hosi` = '$centres_hosi'";


       if ($dbaseresult=$db->query($selectionquery)){
          if($dbaseresult->num_rows) {

           while($rows = $dbaseresult->fetch_assoc()){

             //$doctor_name = $rows['doctor_name'];

             $hospitals_hosi = $rows['hospitals_hosi'];
             //$specialist = $rows['specialist'];
             $centres_phoneNumber = $rows['centres_phoneNumber'];
             //$centres_hosi = $rows['centres_hosi'];



           $rowRespons .= $hospitals_hosi.': '.$centres_phoneNumber."\n";
           $response = 'END '.$rowRespons;


             }
          }else{
           $response = 'END None found in your area.';
          }
       }


            }else if ($level['0'] == 1 && $count == 2 && $level['1'] == 2){

                $response = 'CON Enter doctor id: ';


            }else if ($level['0'] == 1 && $count == 3 && $level['1'] == 2 && (!empty($level['2']))){

              if (!intval($level['2'])) {
              // code...
                $response = 'END Input Relevant ID Numbers!';
                die($response);

                }

                $doctor_id = $level['2'];

                $selectionquery = "SELECT `doctor_name`,`doctor_phoneNumber`,`specialist`,`hospital`,`county` FROM `doctors` WHERE `doctor_id` = '$doctor_id'";



            if ($dbaseresult=$db->query($selectionquery)){
               if($dbaseresult->num_rows) {

                while($rows = $dbaseresult->fetch_assoc()){

                 $doctor_name = $rows['doctor_name'];
                 $doctor_phoneNumber = $rows['doctor_phoneNumber'];
                 $specialist = $rows['specialist'];
                 $hospital = $rows['hospital'];
                 $county = $rows['county'];


                  //echo '<pre>';
                 $response = 'END Your doctors name is '.$doctor_name.', phone number '.$doctor_phoneNumber.'. A '.$specialist.' at '.$hospital.' hospital in '.$county.' county.';

                  }
               }else{
                $response = 'END Doctor details NOT found.';
               }
            }





           }
//SELECTION 2
            else if($level['0'] == 2 && $count == 1){
              $response = "CON Please enter First name and Surname: (E.g John Doe)";    //name is entered here...

          }
            else if($level['0'] == 2 && $count == 2 && (!empty($level['1']))){

              if (intval($level['1'])) {
                // code...

                $response = 'END Input Letters!';
                die($response);

              }

              $response = "CON Please enter National id: ";

            }

             else if($level['0'] == 2 && $count == 3 && (!empty($level['1'])) && (!empty($level['2']))){  //count 3 after name is input

               if (!intval($level['2'])) {
               // code...
                 $response = 'END Input Relevant ID Numbers!';
                 die($response);

                 }
            

               $response = "CON Please enter your area in county form(E.g. Nairobi or Nakuru): ";

            }

            else if($level['0'] == 2 && $count == 4 && (!empty($level['1'])) && (!empty($level['2'])) && (!empty($level['3']))){

              if (intval($level['3'])) {
              // code...
                $response = 'END Input Relevant County!';
                die($response);

                }



              $level['1'] = strtolower($level['1']);
              $level['1'] = ucwords($level['1']);


              $level['3'] = strtolower($level['3']);
              $level['3'] = ucwords($level['3']);
              //ucfirst() strtoupper() uppercase first letter and uppercase whole of string.

              $response = "END Thank you ".$level['1']." for registering. Your national id is ".$level['2']." and your area is ".$level['3'].".";

              sleep(1);

              //$phoneNumber = $_POST['phoneNumber'];
              $fullname = $level['1'];
              $national_id = $level['2'];
              $area = $level['3'];



            $withinquery = "INSERT INTO `patients` (`id`, `phoneNumber`, `fullname`, `area`, `national_id`, `subject`, `created`)
            VALUES (NULL, '$phoneNumber', '$fullname', '$area', '$national_id', '$subject', NOW());";


              $db->query($withinquery);

               // if (!$db->query($withinquery)){
               //   $response = 'END DB ERROR!!';
               //
               // }

            }

//EXIT AND BACK...

// 3rd level Mental Health Information
            else if ($level['0'] == 3 && $count == 1){

                $response = "CON Want to know more about Mental Health and Disorders?  \n";
                $response .= "1.   Mental Health \n";        //The numbering doesn't matter at all..
                $response .= "2.   Mental Health Disorders \n";
                $response .= "3.   Stigma \n";
                $response .= "4.   Harmful Effects of Stigma \n";
                $response .= "5.   Coping with Stigma \n";
                $response .= "6.   Main Common Categories \n";
                $response .= "7.   Other Categories Of Disorders \n";
                $response .= "8.   Signs and Symptoms \n";
                $response .= "9.   Causes \n";
                $response .= "10.  Risk Factors \n";
                $response .= "11.  Prevention \n";
                $response .= "12.  Recovery \n";
                $response .= "13.  Diagnosis \n";
                $response .= "14.  Treatment \n";
                $response .= "15.  Screening Tests \n";
                $response .= "16.  References and External Links \n";
                $response .= "17.  Diagnostic and Statistical Manual of Mental Disorders (DSM-5)\n";
                $response .= "18.  Dis/Advantages of the (DSM-5)";


            }else if($level['0'] == 3 && $count == 2 && $level['1'] == 1){

                $a =  selectionNumber($db, 1, awareness_id);
                $response = 'END '.$a;

            }else if($level['0'] == 3 && $count == 2 && $level['1'] == 2){

              $a =  selectionNumber($db, 2, awareness_id);
              $response = 'END '.$a;

            }else if($level['0'] == 3 && $count == 2 && $level['1'] == 3){

              $a =  selectionNumber($db, 3, awareness_id);
              $response = 'END '.$a;

            }else if($level['0'] == 3 && $count == 2 && $level['1'] == 4){


              $a =  selectionNumber($db, 4, awareness_id);
              $response = 'END '.$a;

            }else if($level['0'] == 3 && $count == 2 && $level['1'] == 5){

              $a =  selectionNumber($db, 5, awareness_id);
              $response = 'END '.$a;


            }else if($level['0'] == 3 && $count == 2 && $level['1'] == 6){

            $response = "CON Main Common Disorders  \n";
            $response .= "1.   Neurodevelopmental disorders  \n";        //The numbering doesn't matter at all..
            $response .= "2.   Depressive disorders \n";
            $response .= "3.   Bipolar and related disorders  \n";
            $response .= "4.   Anxiety disorders  \n";
            $response .= "5.   Obsessive-compulsive and related disorders  \n";
            $response .= "6.   Schizophrenia spectrum and other psychotic disorders  \n";
            $response .= "7.   Trauma and stressor-related disorders ";




    }else if ($level['0'] == 3 && $count == 3 && $level['1'] == 6 && $level['2'] == 1){

        $a =  selectionNumber($db, 1, awareness_id2);
        $response = 'END '.$a;
    }
    else if ($level['0'] == 3 && $count == 3 && $level['1'] == 6 && $level['2'] == 2){

      $a =  selectionNumber($db, 2, awareness_id2);
      $response = 'END '.$a;
    }
    else if ($level['0'] == 3 && $count == 3 && $level['1'] == 6 && $level['2'] == 3){

      $a =  selectionNumber($db, 3, awareness_id2);
      $response = 'END '.$a;
    }else if ($level['0'] == 3 && $count == 3 && $level['1'] == 6 && $level['2'] == 4){

      $a =  selectionNumber($db, 4, awareness_id2);
      $response = 'END '.$a;

    }else if ($level['0'] == 3 && $count == 3 && $level['1'] == 6 && $level['2'] == 5){

      $a =  selectionNumber($db, 5, awareness_id2);
      $response = 'END '.$a;

    }else if ($level['0'] == 3 && $count == 3 && $level['1'] == 6 && $level['2'] == 6){

      $a =  selectionNumber($db, 6, awareness_id2);
      $response = 'END '.$a;

    }else if ($level['0'] == 3 && $count == 3 && $level['1'] == 6 && $level['2'] == 7){

      $a =  selectionNumber($db, 7, awareness_id2);
      $response = 'END '.$a;

    }

    else if($level['0'] == 3 && $count == 2 && $level['1'] == 7){

            $response = "CON Other Common Disorders  \n";
            $response .= "1.   Dissociative disorders  \n";        //The numbering doesn't matter at all..
            $response .= "2.   Somatic symptom and related disorders \n";
            $response .= "3.   Elimination disorders  \n";
            $response .= "4.   Sleep-wake disorders  \n";
            $response .= "5.   Sexual dysfunctions  \n";
            $response .= "6.   Gender dysphoria  \n";
            $response .= "7.   Disruptive, impulse-control and conduct disorders \n";
            $response .= "8.   Substance-related and addictive disorders  \n";
            $response .= "9.   Neurocognitive disorders  \n";
            $response .= "10.   Personality disorders  \n";
            $response .= "11.   Paraphilic disorders  \n";
            $response .= "12.   Other mental disorders  ";





          }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 1){

            $a =  selectionNumber($db, 8, awareness_id2);
            $response = 'END '.$a;

          }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 2){

          $a =  selectionNumber($db, 9, awareness_id2);
          $response = 'END '.$a;

          }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 3){

            $a =  selectionNumber($db, 10, awareness_id2);
            $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 4){

          $a =  selectionNumber($db, 11, awareness_id2);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 5){

            $a =  selectionNumber($db, 12, awareness_id2);
            $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 6){

          $a =  selectionNumber($db, 13, awareness_id2);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 7){

            $a =  selectionNumber($db, 14, awareness_id2);
            $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 8){

          $a =  selectionNumber($db, 15, awareness_id2);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 9){
          $a =  selectionNumber($db, 16, awareness_id2);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 10){

          $a =  selectionNumber($db, 17, awareness_id2);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 11){

          $a =  selectionNumber($db, 18, awareness_id2);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 3 && $level['1'] == 7 && $level['2'] == 12){

          $a =  selectionNumber($db, 19, awareness_id2);
          $response = 'END '.$a;

        }


        else if($level['0'] == 3 && $count == 2 && $level['1'] == 8){

          $a =  selectionNumber($db, 8, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 9){

          $a =  selectionNumber($db, 9, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 10){

          $a =  selectionNumber($db, 10, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 11){

          $a =  selectionNumber($db, 11, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 12){

          $a =  selectionNumber($db, 12, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 13){

          $a =  selectionNumber($db, 13, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 14){

          $a =  selectionNumber($db, 14, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 15){

          $a =  selectionNumber($db, 15, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 16){

          $a =  selectionNumber($db, 16, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 17){

          $a =  selectionNumber($db, 17, awareness_id);
          $response = 'END '.$a;

        }else if($level['0'] == 3 && $count == 2 && $level['1'] == 18){

          $a =  selectionNumber($db, 18, awareness_id);
          $response = 'END '.$a;

        }
//SELECTION 4 GET HELP
          else if ($level['0'] == 4 && $count == 1){

              $response = "END If you believe your life/someone elses life is in danger/distress, Call Hotline(Free); \n";
              $response .= ".  Police: 999 \n";        //The numbering doesn't matter at all..
              $response .= ".  Mental Health Support: +254... \n";
              $response .= ".  Suicide: +254... \n";
              $response .= ".  Drug and Alcohol Abuse: +254... ";

          }

          else if ($level['0'] == 5 && $count == 1){

              $response = "END Let us all encourage one another to do Screening Tests. \n";
              $response .= ".  Visit a nearby mental health centre today through our services. \n";        //The numbering doesn't matter at all..
              $response .= ".  Use our services for awareness and convenience. \n";
              $response .= ".  Do not self diagnose, get the help of a mental health professional. ";



        }  else if ($level['0'] == 6 && $count == 1){

              $response = "END To support and take part in this great project. Reach out via; \n";
              $response .= ".  Facebook Messenger: Mental Auti-Awareness \n";        //The numbering doesn't matter at all..
              $response .= ".  Website: Mental Auti-Awareness \n";
              $response .= ".  Phone Number: +254... \n";
              $response .= ".  E-Mail: e...m@...com \n";
              $response .= ".  Social Media: @...on Instagram ";

          } else if ($level['0'] == 7 && $count == 1){

                $response = "END For more Information and Services Visit Us On; \n";
                $response .= ".  Facebook Messenger: Mental Auti-Awareness \n";        //The numbering doesn't matter at all..
                $response .= ".  Website: Mental Auti-Awareness Website \n";
                $response .= ".  Phone Number: +254... \n";
                $response .= ".  E-Mail: e...m@...com \n";
                $response .= ".  Social Media: @...on Instagram ";

            }




          else{
            $response = 'END Sorry, Kindly Input Relevant Data!';
          }

            header('Content-type: text/plain');
            echo $response;











?>
