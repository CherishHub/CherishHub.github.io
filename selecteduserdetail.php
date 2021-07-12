<?php
include 'contact.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'] ?? "";
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from users where id='$from'";
    $query = mysqli_query($conn,$sql) ?? "";
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from users where id='$to'";
    $query = mysqli_query($conn,$sql)?? "";
    $sql2 = mysqli_fetch_array($query);



    
    if (($amount)<0)
   {
        echo "<script type='text/javascript'>";
        echo " alert('Oops! Negative values cannot be transferred')";
        echo "</script>";
    }


  
    
    else if(!$amount > $sql1['balance']) 
    {
        
        echo "<script type='text/javascript'>";
        echo " alert('Bad Luck! Insufficient Balance')"; 
        echo "</script>";
    }
    


   
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE users set balance=$newbalance where id='$from'";
                mysqli_query($conn,$sql);
             

                
                $newbalance = $sql2['balance'] + $amount;
                $sql = "UPDATE users set balance=$newbalance where id='$to'";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
                $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
                $query=mysqli_query($conn,$sql);

                if($query){
                     echo "<script> alert('Transaction Successful');
                                     window.location='transfermoney.php';
                           </script>";
                    
                }

                $newbalance= 0;
                $amount =0;
        }
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/footers.css">
        <link rel="stylesheet" href="css/img.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="icon" href="img/banklogo.ico" type="image/x-icon">
        <title>User Details | CBV BANK</title>
        <nav class="navbar">
         <div class="container-fluid">
           <div class="navbar-header">
               <a class="navbar-brand" data-toggle="tooltip" title="CBV Banklogo"><img src="img/banklogo.ico" alt="CBV Bank" height="20px"></a>
           </div>
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tooltip" title="Homepage" href="index.html">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tooltip" title="Transaction History" href="transactionhistory.php">HISTORY</a>
                </li>
                <li class="active nav-item">
                    <a class="nav-link" data-toggle="tooltip" title="Transfer Money" href="transfermoney.php">TRANSFER</a>
                </li>
            </ul>
         </div>
        </nav>
        <div class="navh">
            
            <h1 style="font-size:100px"><b><i>CBV BANK</i></b></h1>
        </div>
        <style type="text/css">
    	
            button{
                border:none;
                background: #d9d9d9;
            }
            button:hover{
                background-color:#777E8B;
                transform: scale(1.1);
                color:white;
            }
    
        </style>
    </head>
    <body>
        <div class="container">
            <h2 class="text-center pt-4">Transaction</h2>
            <?php
                include 'contact.php';
                $sid=$_GET['id'] ?? "";
                $sql = "SELECT * FROM  users where id='$sid'";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
            <div>
                <table class="table table-striped table-condensed table-bordered">
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Balance</th>
                    </tr>
                    <tr>
                        <td class="py-2"><?php echo $rows['id']?? ""?></td>
                        <td class="py-2"><?php echo $rows['name']?? ""?></td>
                        <td class="py-2"><?php echo $rows['email']?? ""?></td>
                        <td class="py-2"><?php echo $rows['balance']?? ""?></td>
                    </tr>
                </table>
            </div>
            <br><br><br>
        <label>Transfer To:</label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'contact.php';
                $sid=$_GET['id'] ?? "";
                $sql = "SELECT * FROM users where id!='$sid'";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
            <option class="table" value="<?php echo $rows['id'];?>" >
                
                <?php echo $rows['name'] ;?> (Balance: 
                <?php echo $rows['balance'] ;?> ) 
           
            </option>
            <?php 
                } 
            ?>
            <div>
            </select>
            <br>
            <br>
                <label>Amount:</label>
                <input type="number" class="form-control" name="amount" required>   
                <br><br>
                    <div class="text-center" >
                <button class="btn mt-3" name="submit" type="submit" id="myBtn">Transfer</button>
                </div>
            </form>
        </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    </body>
        <footer>    
            <div class="footer1">
                 <p><b>NOTE:</b><em> This page is solely for educational purposes. Please <b>DO NOT</b> provide or mention any personal/sensitive info anywhere in this website. Any unforeseen if happened, will not held the author of this site accountable.</em></p>
            </div>
                          
            <div class="col-md-12 footer" style="text-align:center">
             <div>
              <p class="copyright">Copyright © 2021&nbsp&nbsp
                &nbspThis project is developed by CHERISH VAIDYA</p>
             </div>
            </div> 
    </footer>
</html>