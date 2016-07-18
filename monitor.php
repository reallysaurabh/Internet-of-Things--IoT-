<!DOCTYPE html>
<html lang="en">
<head>
  <title>Outage Monitor</title>
  <meta charset="utf-8">
  <meta http-equiv="refresh" content="5">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container">
    <h2>Tata Power DDL</h2>
    <p>Real Time Outage Monitor</p>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>CA number</th>
          <th>Connection Status</th>
          <th>Time Stamp</th>
          <th>Remark</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      
      <?php 

      include("connect.php");
      
      $link=Connection();

      $query = "SELECT a.* FROM val a INNER JOIN ( SELECT MAX(sno) max_ID FROM val GROUP BY CA ) b ON a.sno = b.max_ID "; 



      $res=mysql_query($query,$link);



      while( $row=mysql_fetch_array($res)){
      ?>

      


      <tr>
        <td><?php echo $row['CA'] ; ?></td>
        <?php

        if( $row['val']==0){

        ?>  
        <td style="background: red;" ></td>
        <?php
      }else{
      ?> 

      <td style="background: green;" ></td>

      <?php
    }


    ?>
    


    
    <td><?php echo $row['timestamp'] ; ?></td>
    <td><?php echo $row['remark'] ; ?></td>

  </tr>

  <?php
}
mysql_close($link);



?>



</tbody>
</table>
</div>

</body>
</html>

