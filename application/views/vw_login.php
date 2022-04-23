<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('images/app.ico');?>">
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    <!-- Font Awesome-->
    <script src="https://kit.fontawesome.com/eeb684813e.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <br>
        <center><img src="<?php echo base_url("images/logo.png");?>" height="150"></center><br>
        <!-- login Start -->
        <div id="result"></div>
        <form id="loginForm" post>
        <div class="card border-dark">
            <!-- card header -->
            <div class="card-header form-control-lg"><strong><center>Login</center></strong></div>
            <!-- card body -->
            <div class="card-body">
            <input type="text" class="form-control-lg form-control rounded-3" required placeholder="Index Number" id="indnum">&nbsp;
            <input type="password" class="form-control-lg form-control rounded-3" required placeholder="Password" id="password">&nbsp;
            <hr>
            <div class="row"> <!--Button Set-->
                <div class="col-6"><button type="submit" class="btn btn-outline-success btn-lg form-control">Login</button></div>
                <div class="col-6"><button type="reset" class="btn btn-outline-danger btn-lg form-control">Clear</button></div>
            </div>
            </div>  
        </div>
        </form><br>
    <a href="<?php echo base_url('authenticate/forgotpassword');?>" id="forgot" class="btn btn-outline-warning btn-lg form-control">Forgot Password ? </a> <br><br>
        <a href="<?php echo base_url('authenticate/signup');?>" class="btn form-control btn-lg btn-outline-primary">Signup here</a>
        <!-- Login End --><br><br>
    </div>
    <script>
        $(document).on("submit","#loginForm",(e)=>{
        e.preventDefault();
            var toServer=new FormData();
            toServer.append('indnum',$("#indnum").val());
            toServer.append('password',$("#password").val());
            fetch("<?php echo base_url('authenticate/usersignin');?>",{
                method:'POST',
                body: toServer,
                mode: 'no-cors',
                cache: 'no-cache'})
            .then(response => {
                if (response.status == 200) {
                    return response.json();            
                }
                else {
                    alert('Backend Error..!');window.location.reload();
                   
                }
            })
            .then(data => {
                if(data.result==true){
                    document.getElementById("result").innerHTML="";
                    var htmltext=`<div class="alert alert-success" role="alert">${data.message}</div>`;
                    $("#result").append(htmltext);
                    if(data.url==null){
                        location.href="<?php echo base_url('dashboard'); ?>";
                    }else{
                        location.href=data.url;
                    }
                    
                }else{
                    document.getElementById("result").innerHTML="";
                    var htmltext=`<div class="alert alert-danger" role="alert">${data.message}</div>`;
                    $("#result").append(htmltext);
                }
                
            })
            .catch((e) => {
                console.log(e);
                alert("Reloading");
                window.location.reload();
            });
        })
    </script>
</body>
</html>