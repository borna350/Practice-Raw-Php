<?php
// Include config file
require_once "config.php";

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    $id =  trim($_GET["id"]);

    $sql = "SELECT product.id, category.id, product.cat_id, product.product_name, product.product_price, category.cat_name from product INNER JOIN category on product.cat_id=category.id WHERE product.id = $id";

    $query = mysqli_query($link, $sql);
    $data = mysqli_fetch_assoc($query);

} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                       <div class="form-group ">
                            <label>Product Name</label>
                            <input type="text" name="product_name" class="form-control" value="<?php echo $data['product_name']; ?>">
                            
                        </div>
                        <div class="form-group ">
                            <label>Product Price</label>
                            <input type="text" name="product_price" class="form-control" value="<?php echo $data['product_price']; ?>">
                            
                        </div>
                         <div class="form-group ">
                            <label>Category</label>
                            <select name="cat_id" class="form-control">
                                <?php
                                $sql2 = mysqli_query($link, 'SELECT id, cat_name FROM category'); 
                                  while($row = mysqli_fetch_array($sql2)) {
                                    $selected = ($data['cat_id']==$row['id'])?'selected':'';
                                    echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['cat_name'].'</option>';
                                  }
                                ?> 
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>