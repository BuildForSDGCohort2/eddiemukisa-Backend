<?php




function selectionNumber($dbs,int $m, string $aware)
{
  // code...


$selectionquery = "SELECT `definition` FROM `awareness` WHERE `$aware` = '$m'";


          if ($dbaseresult=$dbs->query($selectionquery)){
           if($dbaseresult->num_rows) {

            while($rows = $dbaseresult->fetch_assoc()){

             $definition = $rows['definition'];

               }
            }else{
             $definition = 'DB access error!';
             //return $definition;
            }
         }
     return $definition;

}






 ?>
