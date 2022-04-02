<br>
<div class="container">
    <form id="updateArticle" method="POSt">
        <input type="text" class="form-control" id="heading" placeholder="Heading"><p></p>
        <p></p>
        <textarea id="articletext" rows="10" cols="100" placeholder="Your Text here..." class="form-control"></textarea>
        <p></p>
        <input type="submit" class="btn btn-lg- btn-outline-success form-control"><p></p>
        <input type="reset" class="btn btn-lg- btn-outline-warning form-control">
    </form>
</div>
<script>
    var a=<?php echo $articledata; ?>;
    // console.log(a[0]);
    // var fetUrl="<?php //echo base_url('articles/postUpdate/');?>";
    // fetUrl+=a[0]["id"];
    // console.log(fetUrl);
    $("#heading").val(a[0]["heading"]);
    $("#articletext").val(decodeURIComponent(a[0]["lesson"]));
    $(document).on("submit","#updateArticle",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('heading',$("#heading").val());
        toServer.append('articletext',$("#articletext").val());
        toServer.append('aid',a[0]["id"]);
        console.log(toServer);
        fetch("<?php echo base_url('articles/postupdate')?>",{method:'POST',body: toServer,mode: 'no-cors',cache: 'no-cache'})
        .then(async response => {
            try {
                const data = await response.json()
                console.log('response data', data);
                return data;
            }catch(error) {
                console.log('Error happened here!')
                console.error(error)
            }
        })
        .then(data => {
            alert(data.message);
            if(data.result){
                window.location.href="<?php echo base_url('view/myarticles') ?>";
            }
        })
        .catch((e) => {
            console.log("From catch");
            console.log(e);
            alert("Reloading");
        });
    });
</script>