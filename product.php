<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values


 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
   
        $product_name = trim($_POST["product_name"]);
        $product_price = trim($_POST["product_price"]);
        $cat_id = trim($_POST["cat_id"]);

        $sql = "INSERT INTO product (product_name, product_price,cat_id) VALUES ('".$_POST["product_name"]."','".$_POST["product_price"]."','".$_POST["cat_id"]."')";
         
         
       // $query = mysqli_query($link, $sql);
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute(mysqli_prepare($link, $sql))){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
         }
         
        // Close statement
       // mysqli_stmt_close($stmt);
  
    
    // Close connection
    //mysqli_close($link);

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
                        <h2>Product</h2>
                    </div>
                    <p>Please fill this form and submit</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="">
                            
                        </div>
                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" name="product_price" class="form-control" value="">
                            
                        </div>
                         <div class="form-group">
                            <label>Category</label>
                            <select name="cat_id" class="form-control">
                                <option value="">Select Category</option>
                                <?php
                                $sql2 = mysqli_query($link, 'SELECT id, cat_name FROM category'); 
                                  while($row = mysqli_fetch_array($sql2)) {
                                    echo '<option value="'.$row['id'].'">'.$row['cat_name'].'</option>';
                                  }
                                ?> 
                            </select>
                        </div>
                        
        

                        <input type="submit" name="save" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>