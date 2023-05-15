<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
  <h3 class="mb-0 h-font">관리자 페이지</h3>
  <a href="../logout.php" class="btn btn-light btn-sm">로그아웃</a>
</div>

<div class="col-lg-2 bg-dark border-top border-3 border-secondary" id="dashboard-menu">
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid flex-lg-column align-items-stretch">
      <h4 class="mt-2 text-light">메뉴</h4>
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="adminDropdown">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link text-white" href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="items.php">상품 관리</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="orders.php">주문 현황</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="users.php">회원 관리</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="settings.php">Settings</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
