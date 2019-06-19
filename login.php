<?php
        require_once("./asset/database.class.php");
        session_start();
        if(isset($_POST['btn-submit'])){
            $tendangnhap=$_POST['txttendangnhap'];
            $matkhau=$_POST['txtmatkhau'];
            //Kiểm tra đăng nhập
            $db=new db();
            $sql="SELECT * FROM taikhoan WHERE TenDangNhap='".$tendangnhap."' AND MatKhau='".$matkhau."'";
            $result=$db->query_execute($sql);
            if($result){
                $kt=mysqli_num_rows($result);
                if($kt==0){
                    ?>
                    <script>alert('Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng thử lại!');</script>
                    <?php
                } else{
                    $_SESSION['user']=$tendangnhap;
                    foreach ($result as $item) {
                      $_SESSION['MaPQ']=$item["MaPQ"];
                    }
                    sleep(1);
                    header("Location: index.php");
                }
            } else {
                ?>
                <script>alert('Lỗi truy xuất dữ liệu');</script>
                <?php
            }
        }
    ?>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Đăng nhập</title>

  <!-- Custom fonts for this template-->
  <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="./css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Đăng nhập</div>
      <div class="card-body">
        <form method="post">
          <div class="form-group">
            <label>Tên đăng nhập</label>
            <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" name="txttendangnhap" required autofocus="autofocus">
            </div>
          </div>
          <div class="form-group">
            <label>Mật khẩu</label>
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" name="txtmatkhau" placeholder="Password" required>
            </div>
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="btn-submit">Đăng nhập</button>
        </form>
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
