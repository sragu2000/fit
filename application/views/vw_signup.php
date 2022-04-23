<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/x-icon" href="<?php echo base_url('images/app.ico');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
    <!-- Jquery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

    <!-- Font Awesome-->
    <script src="https://kit.fontawesome.com/eeb684813e.js" crossorigin="anonymous"></script>

    <!-- SweetAlert For windows -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <div class="container">
        <!-- signup start -->
        <br>
        <center>
            <img src="<?php echo base_url('images/new-user.png');?>" height="150">
        </center><br>
        <form id="signup" method="post">
            <div class="card border-dark">
                <!-- card header -->
                <div class="card-header  form-control-lg">
                    <strong><center>SignUp</center></strong>
                </div>
                <!-- card body -->
                <div class="card-body">
                    <input type="text" class="form-control-lg form-control rounded-3" required placeholder="User Name" id="spusername"> &nbsp;
                    <input type="text" class="form-control-lg form-control rounded-3" required placeholder="Index Number" id="spindnum">&nbsp;
                    <select name="corurse" required id="spcoursename" class="form-control-lg form-control rounded-3">
                        <option value="" disabled selected>Select your Course</option>
                        <option value="IT">IT</option>
                        <option value="ITM">ITM</option>
                    </select>&nbsp;
                    <input type="email" class="form-control-lg form-control rounded-3" required placeholder="Email"
                        id="spemail">&nbsp;
                    <input type="password" class="form-control-lg form-control rounded-3" required
                        placeholder="Password" id="sppassword">&nbsp;

                    <div class="row">
                        <div class="col-12">
                            <div class="form-control form-control-lg">
                                <input type="checkbox" id="spagree" class="form-check-input" required> &nbsp;
                                I agree <a href="#">Terms and Conditions</a>
                            </div>&nbsp;
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <!--Button Set-->
                        <div class="col-6"><button type="submit"
                                class="btn btn-outline-success btn-lg form-control">SignUp</button></div>
                        <div class="col-6"><button type="reset"
                                class="btn btn-outline-danger btn-lg form-control">Clear</button></div>
                    </div>
                </div>
            </div>
        </form>
        <!-- signup end -->
        <br>
        <a href="<?php echo base_url('authenticate/login');?>" class="btn form-control btn-lg btn-outline-primary">Login
            here</a>
        <br><br>
    </div>
    <script>
        
        $(document).on("submit","#signup",(e)=>{
            e.preventDefault();
            var toServer=new FormData();
            toServer.append('username',$("#spusername").val());
            toServer.append('indnum',$("#spindnum").val());
            toServer.append('course',$("#spcoursename").val());
            toServer.append('email',$("#spemail").val());
            toServer.append('password',$("#sppassword").val());
            fetch("<?php echo base_url('authenticate/signupuser');?>",{
                method:'POST',
                body: toServer,
                mode: 'no-cors',
                cache: 'no-cache'})
            .then(async response => {
                try {
                    const data = await response.json()
                    console.log('response data', data);
                    return data;
                }catch(err) {
                    console.log('Error happened here!')
                    console.error(err)
                }
            })
            .then(data => {
                if(data.result==true){
                    alert("Signup Success. You can Login Now");
                    if(data.url==null){
                        location.href="<?php echo base_url('dashboard'); ?>";
                    }else{
                        location.href=data.url;
                    }
                }else{
                    alert(data.message);
                }
            })
            .catch((e) => {
                console.log(e);
                alert("Reloading");
            });
        })
    </script>
</body>

</html>