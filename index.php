<?php
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>product List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Product Details</h2>
                        
                    </div>
                     <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                        <div class="form-group">
                           
                            <input type="text" name="search" class="form-control" placeholder="search by category">
                           

                           
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
                        <div class="form-group">
                            <label>Price Range</label>
                            <input type="text" name="min" class="form-control" placeholder="minimum price">
                            <input type="text" name="max" class="form-control" placeholder="maximum price">
                            
                        </div>



                         <input type="submit" class="btn btn-primary" value="Search">
                    </form>


                    <?php
                    // Include config file
                    require_once "config.php";

                    $condition = 1;
                    if (isset($_GET['search']) && $_GET['search']!='') {
                        $condition .= " AND product.product_name LIKE '%".$_GET['search']."%'";
                    }
                    if (isset($_GET['cat_id']) && $_GET['cat_id']!='') {
                        $condition .= " AND product.cat_id='".$_GET['cat_id']."'";
                    }
                    if (isset($_GET['min'], $_GET['max']) && $_GET['min']!='' && $_GET['min']!='') {
                        $condition .= " AND product.product_price>='".$_GET['min']."' AND product.product_price <='".$_GET['max']."'";
                    }
                    // if (isset($_GET['min'],$_GET['max']) && $_GET['min']!='' && $_GET['min']!='') {
                    //     $condition .= " AND product.product_price between ".$_GET['min']." AND ".$_GET['max'];
                    // }
                   
                    
                    // Attempt select query execution
                    $sql = "SELECT product.id, product.product_name, product.product_price, category.cat_name from product INNER JOIN category on product.cat_id=category.id where $condition";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                       echo "<th>#</th>";
                                        echo "<th>Product Name</th>";
                                        echo "<th>Product Price</th>";
                                        echo "<th>Category Name</th>";
                                        echo "<th>Action</th>";
                                       
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                         echo "<td>" . $row['id'] . "</td>";
                                       echo "<td>" . $row['product_name'] . "</td>";
                                       echo "<td>" . $row['product_price'] . "</td>";
                                        echo "<td>" . $row['cat_name'] . "</td>";
                                        echo "<td>";
                                         echo "<a href='update.php?id=". $row['id'] . " ' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                            echo "<a href='productDetails.php?id=". $row['id'] ."' title='view Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                             echo "<td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>