<?php
//connection to database
  session_start();
  $connect = mysqli_connect('localhost','root','','contact');

    if(isset($_POST["add_to_favorite"]))
    {
      if(isset($_SESSION["numb"]))
      {
        $item_array_id = array_column($_SESSION["numb"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
          $count = count($_SESSION["numb"]);
    //get all item detail
            $item_array = array(
                      'item_id'       =>   $_GET["id"],
                      'item_Name'     =>   $_POST["hidden_Name"],
                      'item_number'    =>   $_POST['hidden_number'],

            );
            $_SESSION["numb"][$count] = $item_array;
        }
        else
        {
          //product added then this block 
          echo '<script>alert("Item allready added ")</script>';
          echo '<script>window.location = "index.php"</script>';
        }
      }
      else
      {
        //cart is empty excute this block
         $item_array = array(
                      'item_id'       =>   $_GET["id"],
                      'item_Name'     =>   $_POST["hidden_Name"],
                      'item_number'    =>   $_POST['hidden_number'],

            );
           $_SESSION["numb"][0] = $item_array;
      }
    }
//Remove item in cart 
    if(isset($_GET["action"]))
    {
      if($_GET["action"] == "delete")
      {
        foreach($_SESSION["numb"] as $key=>$value)
            {
              if($value["item_id"] == $_GET["id"])
              {
                unset($_SESSION["numb"][$key]);
                echo '<script>alert("Item removed")</script>';
                echo '<script>window.location="index.php</script>';
              }
            }
      }
    }

?>
<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Task 2</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:700px;">  
                <h3 align="center">Simple PHP Mysql Shopping Cart</h3><br />  
                  <?php
                    $qury = "SELECT * FROM nubmers ORDER BY id ASC";
                    $result = mysqli_query($connect,$qury);
                    if(mysqli_num_rows($result) >0)
                    {
                      while($row = mysqli_fetch_array($result))
                      {

                  ?>
                <div class="col-md-4">  
                     <form method="post" action="index.php?action=add&id=<?php echo $row["id"];?>">  
                          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">  
                               <h4 class="text-info"><?php echo $row['Name'];?></h4>  
                               <h4 class="text-danger"><?php echo $row['number'];?></h4>  
                            <input type="hidden" name="hidden_Name" value="<?php echo $row['Name'] ?>" />
                            <input type="hidden" name="hidden_number" value="<?php echo $row['number'];?>">

                               <input type="submit" name="add_to_favorite" style="margin-top:5px;" class="btn btn-success" value="Add to favorite" />  
                          </div>  
                     </form>  
                </div>  
                  <?php } } ?>
                <div style="clear:both"></div>  
                <br />  
                <div class="table-responsive">  
                     <table class="table table-bordered">  
                          <tr> 
                               <th width="40%">Name</th>  
                               <th width="50%">Number</th>  
                               <th width="10%">Action</th>  
                          </tr>  
                             <?php 
                           if(!empty($_SESSION["numb"]))
                           {
                            $total = 0;
                            foreach($_SESSION["numb"] as $key => $value)
                           {

                             ?>
                          <tr> 
                             
                               <td><?php echo $value['item_Name'];?></td>  
                               <td><?php echo $value['item_number'];?></td>  
                               <td><?php echo number_format($value["item_number"]);?></td>  
                               <td><a href="index.php?action=delete&id=<?php  echo $value['item_id'];?>"><span class="btn btn-danger">Remove</span></a></td>  
                          </tr>  
                          <?php $total = $total +$value['item_number'];
                        }
                        ?>
                        
                          <?php } ?> 
                           
                     </table>  
                </div>  
           </div>  
           <br />  
      </body>  
 </html>