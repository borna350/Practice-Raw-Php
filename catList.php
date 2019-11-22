<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>product list by category</title>
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
                        <h2 class="pull-left">Product list by category</h2>
                        
                    </div>
                    
                            <table class='table table-bordered table-striped'>
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>Product ID</th>
                                        <th>Product Link</th>
                                         <th>Total Product in each cat</th>
                                         <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Include config file
                                    require_once "config.php";
                                    
                                    // Attempt select query execution
                                    $sql = "SELECT category.cat_name,category.id, COUNT(product.id) AS totalProduct, GROUP_CONCAT(product.product_name separator ' , ') as productNames, GROUP_CONCAT(product.id separator ' , ') as productIds from category LEFT JOIN product on product.cat_id=category.id GROUP BY product.cat_id ";
                                    if($result = mysqli_query($link, $sql)){
                                        if(mysqli_num_rows($result) > 0){
                                            while($row = mysqli_fetch_array($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['cat_name']; ?></td>
                                                <td><?php echo $row['productNames']; ?></td>
                                                <td><?php echo $row['productIds']; ?></td>
                                                <td>
                                                    <?php
                                                    $arrayId = explode(', ',$row['productIds']);
                                                    $arrayName = explode(', ',$row['productNames']);
                                                    foreach ($arrayName as $key => $val) {
                                                        echo '<a href="productDetails.php?id='.$arrayId[$key].'">'.$val.'</a>';
                                                    }
                                                    ?> 
                                                </td>
                                                <td><?php echo $row['totalProduct']; ?></td>
                                                <td>
                                                 <?php echo"<a href='catDelete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";?> 
                                            </td>
                                            </tr>
                                            <?php
                                            }
                                        ?>
                                        </tbody>                           
                            </table>
                            <?php
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