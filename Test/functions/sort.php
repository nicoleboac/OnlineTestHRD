<?php


switch($_GET['dir']){

  case "last_name":
    $orderBy = " ORDER BY last_name DESC"
    break;

  case "first_name":
    $orderBy = " ORDER BY first_name DESC"
    break;

   case "department":
    $orderBy = " ORDER BY department DESC"
    break;
      
  default:
    $orderBy = " ORDER BY last_name ASC"
    break;
}

$sql = "SELECT last_name, first_name, department from users" . $orderBy;

?>