 <?php
    require 'conn.php';
    $categories = '';
    $msg = '';
    if (isset($_GET['id']) && $_GET['id'] != '') {
        $id = $_GET['id'];
        $res = mysqli_query($con, "select * from categories where id='$id'");
        $check = mysqli_num_rows($res);
        if ($check > 0) {
            $row = mysqli_fetch_assoc($res);
            $categories = $row['categories'];
        } else {
            header('location:categories.php');
            die();
        }
    }
    if(isset($_POST['submit'])){
        $categories = $_POST['categories'];
        $result = "select * from categories where categories='$categories'";
        $query = mysqli_query($con,$result);
        $count = mysqli_num_rows($query);
        if($count>0){
            if(isset($_GET['id']) && $_GET['id'] != ''){
                $geData = mysqli_fetch_assoc($query);
                if ($id == $getData['id']) {
                } else {
                    $msg = "Categories already exist";
                }
            } else {
                $msg = "Categories already exist";
            }
        }
        if($msg == ''){
            if(isset($_GET['id']) && $_GET['id'] != ''){
                mysqli_query($con, "update categories set categories='$categories' where id='$id'");
            }else{
                mysqli_query($con, "insert into categories(categories,status) values('$categories','1')");
            }
            header('location:category.php');
		die();
        }
    }
?>
<?php include_once 'includes/head.php'; ?>

<div class="content pb-0 container mt-5">
    <div class="animated fadeIn">
        <div class="row container">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                    <form method="post" class="container">
                        <div class="card-body card-block col-lg-6 align-center">
                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Categories</label>
                                <input type="text" name="categories" placeholder="Enter categories name" class="form-control" required value="<?php echo $categories ?>">
                            </div>
                            <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            <div class="field_error"><?php echo $msg ?></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>