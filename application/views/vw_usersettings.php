<div class="container">
    <br><hr width="100%">
    <h2> User Details</h2>
    <hr width="100%">
    Name : <input type="text" disabled id="name" class="form-control"><p></p>
    Index Number : <input type="text" disabled id="index" class="form-control"><p></p>
    E-Mail : <input type="text" disabled id="email" class="form-control"><p></p>
    Course : <input type="text" disabled id="course" class="form-control"><p></p>
    <a id="del" class="btn btn-danger form-control btn-lg"><i class="fa-solid fa-user-xmark"></i> Delete My Account</a>

    <hr width="100%">
    <h2>Change Password</h2>
    <hr width="100%">
    <form id="changePassword" method="post">
        <input type="password" required placeholder="Current Password..." class="form-control" id="currpass"><p></p>
        <input type="password" required placeholder="New Password..." class="form-control" id="newpass"><p></p>
        <button type="submit" class="btn btn-primary btn-lg form-control">
            <i class="fa-solid fa-key"></i> Change My Password
        </button>
    </form>
    <br><br>
    <br><br>

</div>
<script>
    $(document).on("click","#del",()=>{
        if(confirm("Are you sure you want to delete this account ?")){
            location.href="<?php echo base_url('dashboard/deleteuser')?>";
        }
    });

    var user="<?php echo $user; ?>";
    fetch("<?php echo base_url('dashboard/getuserprofile')?>",{method:'GET',mode: 'no-cors',cache: 'no-cache'})
    .then(response => {
        if (response.status == 200) {return response.json();}
        else {console.log('Backend Error..!');console.log(response.text());}
    })
    .then(data => {
        data=data[0];
        $("#name").val(data["name"]);
        $("#index").val(data["indnum"]);
        $("#email").val(data["email"]);
        $("#course").val(data["course"]);
    })
    .catch(() => {console.log("Network connection error");});

    $(document).on("submit","#changePassword",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('oldpass',$("#currpass").val());
        toServer.append('newpass',$("#newpass").val());
        fetch("<?php echo base_url('dashboard/changePassword'); ?>",{
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
        })
        .catch(() => {
            console.log("Network connection error");
            alert("Reloading"); 
        });
    })
</script>