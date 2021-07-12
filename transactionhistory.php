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
        <title>History | CBV BANK</title>
        <nav class="navbar">
         <div class="container-fluid">
           <div class="navbar-header">
               <a class="navbar-brand" data-toggle="tooltip" title="CBV Banklogo"><img src="img/banklogo.ico" alt="CBV Bank" height="20px"></a>
           </div>
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tooltip" title="Homepage" href="index.html">HOME</a>
                </li>
                <li class="active nav-item">
                    <a class="nav-link" data-toggle="tooltip" title="Transaction History" href="transactionhistory.php">HISTORY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tooltip" title="Transfer Money" href="transfermoney.php">TRANSFER</a>
                </li>
            </ul>
         </div>
        </nav>
    </head>

        <div class="navh">
            
            <h1 style="font-size:100px"><b><i>CBV BANK</i></b></h1>
        </div>
   
    <body>
        <div class="container">
            <h2 class="text-center pt-4">Transaction History</h2>
            
           <br>
           <div class="table-responsive-sm">
        <table class="table table-hover table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Sender</th>
                    <th class="text-center">Receiver</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Date & Time</th>
                </tr>
            </thead>
            <tbody>
                <?php

            include 'contact.php';

            $sql ="SELECT * from transaction";

            $query =mysqli_query($conn, $sql);

            while($rows = mysqli_fetch_assoc($query))
            {
        ?>
                <tr>
                    <td class="py-2"><?php echo $rows['sender']?? "";?></td>
                    <td class="py-2"><?php echo $rows['receiver'];?></td>
                    <td class="py-2"><?php echo $rows['balance'];?> </td>
                    <td class="py-2"><?php echo $rows['datetime'];?> </td>
                </tr>
                <?php
            }

        ?>
            </tbody>  
        </table>
        </div>
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