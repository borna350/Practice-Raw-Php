<?php
// Include config file
require_once "config.php";
 

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
        $cat_name = trim($_POST["cat_name"]);
    
    
    
        $sql = "INSERT INTO category (cat_name) VALUES ('".$_POST["cat_name"]."')";
      
           if(mysqli_stmt_execute(mysqli_prepare($link, $sql))){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
       
         
       
    }

    
    // Close connection
    mysqli_close($link);

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>For practice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Category</h2>
                    </div>
                    <p>Please fill this form and submit</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="cat_name" class="form-control" value="">
                           
                        </div>
                       
                        
                        

                        

                       

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>