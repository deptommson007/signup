<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Registration Form</title>
         
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
          <script src="https://kit.fontawesome.com/71be018af0.js" crossorigin="anonymous"></script>
          
        <link href="otp.css" type="text/css" rel="stylesheet">
    </head>
    <body>

        <?php
        include 'dbcon.php';
        if(isset($_POST["submit"])){
            $name = mysqli_real_escape_string($con,$_POST["name"]);
            $district = mysqli_real_escape_string($con,$_POST["district"]);
            $number = mysqli_real_escape_string($con,$_POST["number"]);
            $otp = rand(100000, 999999);

            $stmt = $con->prepare("Insert into registration(otp) values(?)");
            $stmt->bind_param("i", $otp);

            // if($stmt->execute()) {
            //     echo "OTP Submitted successfully!";
            // }else{
            //     echo "Error: " .$con->error;
            // }

            $numberquery = " select * from registration where number='$number' ";
            $query = mysqli_query($con,$numberquery);

            $numbercount = mysqli_num_rows($query);

            if($numbercount>0){
                echo "number already exists";
            }elseif($stmt->execute()){
                $stmt = $con->prepare("Insert into registration(otp) values(?)");
                $stmt->bind_param("i", $otp); 
                // echo "OTP Submitted successfully!";
            }else{
                     echo "Error: " .$con->error;
            }
                $insertquery = "insert into registration(Name,District, Number,otp) values('$name','$district','$number','$otp')";

                if($con->query($insertquery)===true){
                    header("location:otp_verification.php");
                    exit;
                }else{
                    echo "Error: " . $insertquery . "<br/>". $con->error;
                
                    echo "OTP verification failed.";
                }
            }
        
        ?>



        <div class="container-fluid bg-light p-5" style="height: 550px;">
            <div class="container bg-primary rounded" style="width: 400px;">
               <h2 class="pt-5" style="text-align: center;color: white;">Registration Form</h2>
                <form action="" method="post">
                    <div class="row d-flex mx-auto mt-5">
                        <div class="col px-auto pt-3 pb-3">
                            <div class="input-group">
                                <span class="input-group-text" style="padding:0 8px !important;height:3rem !important;margin: 16px 0px !important;">
                                    <i class="fa-solid fa-user" ></i>
                                </span>
                                <input class="form-control form-control-lg bg-light mt-3 mb-3" type="text" id="name" name="name"  placeholder="Enter Username" required>
                                <!-- <span class="error"> <?php echo $nameErr;?></span> -->
                            </div>
                            <div class="input-group">
                                <span class="input-group-text" style="padding:0 7px !important;height:3rem !important;margin: 16px 0px opx 0px !important;">
                                    <i class="fa-solid fa-house"></i>
                                </span>
                                <input class="form-control form-control-lg bg-light mb-3" type="text" id="district" name="district"  placeholder="Enter District Name" required>
                                <!-- <span class="error"> <?php echo $dstErr;?></span> -->
                            </div>
                            <div class="input-group">
                                    <span class="input-group-text" style="padding:0 7px !important;height:3rem !important;margin: 16px 0px opx 0px !important;">
                                        <i class="fa-solid fa-phone"></i></span>
                                    <input class="form-control form-control-lg bg-light mb-3" type="number" id="number" name="number" value="number" placeholder="Enter Mobile Number" required>
                                    <!-- <span class="error"> <?php echo $monNoErr;?></span> -->
                            </div>
                            <button type="submit" name="submit" class="btn btn-dark mb-3 text-white btn-lg" style="margin-left: 120px;">Submit</button>
                            
                        </div>
                    </div>
            
            </div>
        </div>
        
    </body>
</html>