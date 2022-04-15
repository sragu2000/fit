<div class="container"><br><br>
    <form method="post" id="resetPass">
        <input type="password" placeholder="Enter new password" class="form-control" id="newpass">
        <p></p>
        <button type="submit" class="btn btn-lg btn-success form-control">Reset Password</button>
    </form>
</div>
<script>
    $(document).on("submit","#resetPass",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('newpassword',$("#newpass").val());
        fetch("<?php echo base_url('authenticate/submitPass') ?>",{
            method:'POST',
            body: toServer,
            mode: 'no-cors',
            cache: 'no-cache'})
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
            if(data.result==true){
                location.href="<?php echo base_url('authenticate');?>";
            }
        })
        .catch(() => {
            console.log("Network connection error");
            alert("Reloading");
        });
    })
</script>