<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="<?php echo base_url("dashboard") ?>">
        <img src="<?php echo base_url('images/logo.png') ?>" width="30" height="30" alt="">
      </a>
    </nav>

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

      </ul>

      <a class="nav-link active text-danger" href="<?php echo base_url('dashboard/logout'); ?>">
        <i class="fas fa-power-off"></i> &nbsp;Logout</a>
      <!-- <button class="btn" id="theme"><i class="fa-solid fa-moon"></i></button> -->
      <!-- <script>
        localStorage.setItem("themeVal", "light");
        $(document).on("click","#theme",()=>{
          if(! DarkReader.isEnabled() || localStorage.getItem("themeVal")=="dark"){
            localStorage.setItem("themeVal", "dark");
            DarkReader.setFetchMethod(window.fetch)
            DarkReader.enable({
              brightness: 100,
              contrast: 90,
              sepia: 10
            });
            document.getElementById("theme").innerHTML="";
            $("#theme").append("<i class='fa-regular fa-sun'>");
          }else{
            DarkReader.disable();
            document.getElementById("theme").innerHTML="";
            $("#theme").append("<i class='fa-solid fa-moon'>");
          }
        })
      </script> -->
    </div>
  </div>
</nav>