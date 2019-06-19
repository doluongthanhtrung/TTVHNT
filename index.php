<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Location: login.php");
    } else{
      if(!isset($_SESSION['firsttime'])){
          $pq=$_SESSION['MaPQ'];
          echo "<script>alert('Đăng nhập thành công!');</script>";
          $_SESSION['firsttime']=1;
      }        
    }
?>
<!DOCTYPE html>
<html lang="vi">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin</title>

  <!-- Custom fonts for this template-->
  <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="./vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="./css/sb-admin.css" rel="stylesheet">

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
      <li class="nav-item active">
        <a class="nav-link" href="index.php">
        <i class="fas fa-user-graduate"></i>
          <span>Danh sách sinh viên</span></a>
      </li>
      <li class="nav-item">
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
          <li class="breadcrumb-item">
            <a href="themsinhvien.php"><i class="fas fa-user-plus"></i>Thêm sinh viên</a>
          </li>
        </ol>
        <!-- Quản lý sinh viên -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-user-graduate"></i>
              Quản lý sinh viên
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>SĐT</th>
                    <th>CLB</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>SĐT</th>
                    <th>CLB</th>
                    <th>Thao tác</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php
                     require_once("./asset/database.class.php");
                     $db=new db();
                     $sql="SELECT sinhvien.MSSV,sinhvien.HoTen,sinhvien.SDT,caulacbo.TenCLB FROM sinhvien,caulacbo WHERE sinhvien.MaCLB=caulacbo.MaCLB ";
                     $result=$db->select_to_array($sql);
                     foreach ($result as $item) {
                         echo "<tr>
                                    <td>".$item["MSSV"]."</td>
                                    <td>".$item["HoTen"]."</td>
                                    <td>".$item["SDT"]."</td>
                                    <td>".$item["TenCLB"]."</td>
                                    <td><a class='nav-link1' href='chinhsuasinhvien.php?mssv=".$item["MSSV"]."'><i class='fas fa-edit'></i></a>
                                    <a class='nav-link1' href='xoasinhvien.php?mssv=".$item["MSSV"]."&hoten=".$item["HoTen"]."'><i class='fas fa-trash-alt'></i></a>
                                    <a class='nav-link1' href='chitiet.php?mssv=".$item["MSSV"]."'><i class='fas fa-receipt'></i></a></td>
                                </tr>";
                     }
                ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">
            <!-- Updated at  -->
            <?php
                date_default_timezone_set("Asia/Bangkok"); //set timezone tại khu vực GMT +7
                $date=getdate();
                echo "Cập nhât ngày ".$date['mday']."/".$date['mon']."/".$date['year']." lúc ".$date['hours'].":".$date['minutes'].":".$date['seconds']; 
            ?>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
      
      <!-- Sticky Footer -->

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Thanh Trung 2019</span>
          </div>
        </div>
      </footer>
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

  <!-- Page level plugin JavaScript-->
  <script src="./vendor/datatables/jquery.dataTables.js"></script>
  <script src="./vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="./js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="./js/demo/datatables-demo.js"></script>

</body>

</html>
