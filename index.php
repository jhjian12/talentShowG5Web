<html>
<head>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> 
    <script  src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> 
</head>
<body>
    <?php require_once('process.php'); ?>

    <?php if(isset($_SESSION['message'])):?>
    <div class="alert alert-<?php $_SESSION['msg_type']?>">
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']); 
        ?>
    </div>
    <?php endif ?>
    <div class="container">
    <?php
        $mysqli = new mysqli('localhost','root','','test') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM product") or die($mysqli -> error);
        // pre($result);
        // pre($result -> fetch_assoc());
    ?>
    <div class="row jsutify-content-center">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>product name</th>
                    <th>quantity</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php while($row = $result -> fetch_assoc()):?>
                <tr>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['quantity']?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id'];?>" class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id'];?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
    <?php
        function pre($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
    ?>
    <div class="row justify-content-center">
    <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id?>">
            <div class="form-group">
                <label>product</label>
                <input type="text" name="name" class="form-control" placeholder="Enter product" value="<?php echo $name?>">
            </div>
            <div class="form-group">
                <label>quantity</label> 
                <input type="number" name="quantity" class="form-control" placeholder="Enter quantity" value="<?php echo $quantity?>">
            </div>
            <div class="form-group">
            <?php if($update == true):
            ?>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
            <?php else:?>
                    <button type="submit" class="btn btn-primary" name="save">Save</button>
            <?php endif; ?>
            </div>
    </form>
    </div>
    <div class="container">
    <iframe width="1024" height="1060" src="https://app.powerbi.com/view?r=eyJrIjoiZTlhYTgxODgtNWI4ZC00OTMxLTg5NWMtNDAzNjczYjRjNGQ2IiwidCI6IjQyMjI4MDNhLTAxYzYtNDBiOS04ZTM0LTNkODllZDViMWQ3OCIsImMiOjEwfQ%3D%3D&pageName=ReportSection" frameborder="0" allowFullScreen="true"></iframe>
    </div>
</body>
</html>