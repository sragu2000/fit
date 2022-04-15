<div class="container">
    <br><br>
    <form id="forgotpass" method="post">
        <input type="email" placeholder="Enter your email here..." id="useremail" class="form-control">
        <p></p>
        <button type="submit" class="btn btn-lg btn-outline-warning form-control">
            Recover My Password
        </button>
    </form> <br>
    <div id="messageid" class="alert alert-info"></div>

</div>
<script>
    $(document).on("submit", "#forgotpass", (e) => {
        e.preventDefault();
        var toServer = new FormData();
        toServer.append('email', $("#useremail").val());
        fetch("<?php echo base_url('authenticate/resetpass') ?>", {
            method: 'POST',
            body: toServer,
            mode: 'no-cors',
            cache: 'no-cache'
        })
            .then(response => {
                if (response.status == 200) {
                    return response.json();
                }
                else {
                    alert('Backend Error..!');
                    console.log(response.text());
                }
            })
            .then(data => {
                alert(data.message);
                document.getElementById("messageid").innerHTML = data.message
                if(data.result==true){
                    location.href="<?php echo base_url('authenticate'); ?>"
                }
            })
            .catch(() => {
                console.log("Network connection error");
                alert("Reloading");
            });
    })
</script>