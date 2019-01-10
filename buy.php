<?php
  require_once('GMSdb/connect.inc.php');
  connect();
  $product = array();
  $amount = array();

  if(isset($_POST['action']) && $_POST['action']== 'addproduct' ){
    $product[] = $_POST['product'];
    $amount[] = $_POST['amount'];
  }


  for($i = 0; $i<count($product); $i++){
    $sql = "SELECT *  FROM PRODUCT  WHERE PRO_ID = \"$product[$i]\"";
    $sql_query = mysql_query($sql) or die(mysql_error());
    $result = mysql_fetch_array($sql_query);

    echo "<tr>";
    echo "<td>".($i+1)."</td>";
    echo "<td>".$result['PRO_ID']."</td>";
    echo "<td>".$result['PRO_NAME']."</td>";
    echo "<td>".$result['PRO_SELLPRICE']."</td>";
    echo "<td>".$amount[$i]."</td>";
    echo "<td>".($result['PRO_SELLPRICE']*$amount[$i])."</td>";
    echo "</tr>";


  }

  disconnect();
 ?>
