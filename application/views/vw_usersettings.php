<div class="container">
    <br><hr width="100%">
    <h2> User Details</h2>
    <hr width="100%">
    Name : <input type="text" disabled id="name" class="form-control"><p></p>
    Index Number : <input type="text" disabled id="index" class="form-control"><p></p>
    E-Mail : <input type="text" disabled id="email" class="form-control"><p></p>
    Course : <input type="text" disabled id="course" class="form-control"><p></p>
    <a href="<?php echo base_url('dashboard/deleteuser');?>" id="del" class="btn btn-danger form-control btn-lg"><i class="fa-solid fa-user-xmark"></i> DELETE MY ACCOUNT</a>
</div>
<script>
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
</script>