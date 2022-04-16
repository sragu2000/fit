<nav class="navbar navbar-expand-lg navbar-light bg-light border border-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo base_url("dashboard") ?>"><i class="fas fa-home"></i>&nbsp;Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="<?php echo base_url('module/addarticles'); ?>"><i class="fas fa-plus"></i>&nbsp;Add Articles</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="<?php echo base_url('view/myarticles'); ?>">
            <i class="fa-solid fa-file-signature"></i></i>&nbsp;My Articles</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active" href="<?php echo base_url('dashboard/viewuserdetails'); ?>">
            <i class="fa-solid fa-gear"></i></i></i>&nbsp;My Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-danger" href="<?php echo base_url('dashboard/logout'); ?>">
            <i class="fas fa-power-off"></i> &nbsp;Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>