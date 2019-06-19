<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Xóa câu lạc bộ</title>

  <!-- Custom fonts for this template-->
  <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="./css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
    <?php
        require_once('./asset/database.class.php');
        $maclb=$_GET["maclb"];
        $tenclb=$_GET["tenclb"];
    ?>
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Xóa câu lạc bộ</div>
      <div class="card-body">
        <form method="post">
            <Label>Bạn muốn xóa câu lạc bộ "<?php echo $tenclb;?>"</Label>
            <button class="btn btn-primary btn-block" type="submit" name="btn-submit">Xóa</button>
        </form>
        <?php
        if(isset($_POST['btn-submit'])){
            $data=new db();
            $sql="DELETE FROM caulacbo WHERE MaCLB ='".$maclb."'";
            $kq=$data->query_execute($sql);
            if($kq){
                echo "<script>alert('Xóa câu lạc bộ thành công');</script>";
                sleep(2);
                echo "<script> window.location = 'caulacbo.php'; </script>";
            } else{
                echo "<script>alert('Xóa câu lạc bộ không thành công');</script>";
                sleep(2);
                echo "<script> window.location = 'caulacbo.php'; </script>";
            }
        }
        ?>
        <div class="text-center">
          <a class="d-block small mt-3" href="caulacbo.php">Hủy</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="./vendor/jquery/jquery.min.js"></script>
  <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>