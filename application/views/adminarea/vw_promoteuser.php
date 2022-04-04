<br>
<div class="container">
    <form id="pro" method="post">
        <input list="users" name="user" id="user" class="form-control" required>
        <datalist id="users" required>
            <!-- <option value="EDGE"> -->
        </datalist><br>
        <select id="mode" class="form-control" required>
            <option value="Promote">Promote User </option>
            <option value="Demote">Demote User </option>
        </select><br>
        <button type="submit" class="btn btn-outline-success form-control">
            <i class="fa-solid fa-circle-check"></i></i>&nbsp;
            Apply Changes
        </button><br><br>
        <button type="reset" class="btn btn-outline-danger form-control">
            <i class="fa-solid fa-circle-xmark"></i>&nbsp;
            Clear
        </button>

    </form>
</div>

<script>
    $.getJSON("<?php echo base_url('admin/listuser'); ?>", function(data) {
        data.forEach(function(item) {
            var htmlText = `<option value="${item.usrname}:${item.indexnum}">`;
            $("#users").append(htmlText);
        });
    });
    $(document).on("submit","#pro",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('user',$("#user").val());
        toServer.append('mode',$("#mode").val());
        fetch("<?php echo base_url('admin/promote')?>",{method:'POST',body: toServer,mode: 'no-cors',cache: 'no-cache'})
        .then(async response => {
            try {
                const data = await response.json()
                return data;
            }catch(error) {
                console.log('Error happened here!')
                console.error(error)
            }
        })
        .then(data => {
            alert(data.message);
            window.location.reload();
            //window.location.href="<?php //echo base_url('home') ?>";
        })
        .catch((e) => {
            console.log("From catch");
            console.log(e);
            alert("Reloading");
        });
    });
</script>
</body>

</html>