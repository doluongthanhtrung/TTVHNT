<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="vi">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Thêm nhân viên</title>

  <!-- Custom fonts for this template-->
  <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="./vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="./css/sb-admin.css" rel="stylesheet">
  <link href="./css/main1.css" rel="stylesheet" media="all">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

  <a class="navbar-brand mr-1" href="index.php">Admin</a>

<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
  <i class="fas fa-bars"></i>
</button>

<!-- Navbar Search -->
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

</form>

<!-- Navbar -->
<ul class="navbar-nav ml-auto ml-md-0">
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-user-circle fa-fw"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
      <a class="dropdown-item">Chào <?php echo $_SESSION['user'];?></a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
    </div>
  </li>
</ul>

</nav>

<div id="wrapper">

<!-- Sidebar -->
<ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
        <i class="fas fa-user-graduate"></i>
          <span>Danh sách sinh viên</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="nhanvien.php">
          <i class="fas fa-users"></i>
          <span>Danh sách nhân viên</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="giangvien.php">
          <i class="fas fa-chalkboard-teacher"></i>
          <span>Danh sách giảng viên</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="caulacbo.php">
        <i class="fas fa-list-alt"></i>
          <span>Câu lạc bộ</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="taikhoan.php">
        <i class="fas fa-user-shield"></i>
          <span>Tài khoản</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="danhmuciso.php">
        <i class="fas fa-book"></i>
          <span>Danh mục ISO</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="nhatkysinhhoat.php">
          <i class="fas fa-calendar-alt"></i>
          <span>Nhật ký sinh hoạt</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">Thêm nhân viên</li>
        </ol>

        <!-- Page Content -->
        <?php
            require_once('./asset/database.class.php');
            if(isset($_POST['btn-submit'])){
              $manv=$_POST['txt_manv'];
              $hoten=$_POST['txt_hoten'];
              $sdt=$_POST['txt_SDT'];
              $cv=$_POST['txt_CV'];
              if($manv==""||$hoten==""){
                  echo "<script>alert('Vui lòng nhập thông tin đầy đủ');</script>";
              } else{ 
                $db=new db();
                $sql="INSERT INTO nhanvien (MaNV, HoTen, ChucVu, SDT) VALUES ('".$manv."', '".$hoten."', '".$cv."', '".$sdt."')";
                $kq=$db->query_execute($sql);
                if($kq){
                    echo "<script>alert('Thêm nhân viên thành công');</script>";
                    if($cv=="CTV"){
                      echo "<script> window.location = 'nhanvien.php'; </script>";
                    } else {
                      echo "<script> window.location = 'giangvien.php'; </script>";
                    }
                } else{
                    echo "<script>alert('Lỗi Thêm nhân viên ');</script>";
                }

              }
            } 
        ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-row" >
                <div class="name">Mã nhân viên</div>
                <div class="value">
                    <input class="input--style-6" type="text" name="txt_manv" value=""> 
                </div>
            </div>
            <div class="form-row" >
                <div class="name">Họ tên</div>
                <div class="value">
                    <div class="input-group">
                      <input class="input--style-6" type="text" name="txt_hoten" value=""> 
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="name">SĐT</div>
                <div class="value">
                    <div class="input-group">
                      <input class="input--style-6" type="number" name="txt_SDT" value=""> 
                    </div>
                </div>
            </div>
            <div class="form-row" >
                <div class="name">Chức vụ</div>
                <div class="value">
                  <select class="input-group" name='txt_CV'>
                    <?php 
                        $loai=$_GET["id"];
                        if ($loai=="ctv"){
                            echo "<option value='CTV' selected>Cộng tác viên</option>;
                                  <option value='GV'>Giảng viên</option>";        
                        } else{
                            echo "<option value='CTV'>Cộng tác viên</option>;
                                  <option value='GV' selected>Giảng viên</option>";
                        }
                    ?>
                    </select>
                </div>
            </div>
            <div class="card-footer">
            <button class="btn btn--radius-2 btn--blue-2" type="submit" name="btn-submit">Thêm</button>
            </div> 
        </form>
      </div>
      <!-- /.container-fluid -->

      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Thanh Trung 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Bạn muốn đăng xuất?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Chọn nút "Đăng xuất" để kết thúc phiên làm việc của bạn</div>
        <div class="modal-footer">
          <a class="btn btn-primary" href="logout.php">Đăng xuất</a>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="./vendor/jquery/jquery.min.js"></script>
  <script src="./vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="./vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="./js/sb-admin.min.js"></script>
  <script src="./js/global.js"></script>

</body>

</html>
