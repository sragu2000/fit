<br>
<div class="container">
    <form id="updateArticle" method="POSt">
        <input type="text" class="form-control" id="heading" placeholder="Heading" required><p></p>
        <p></p>
        <div id="toolbar"></div>
        <div id="editor"></div>
        <p></p>
        <input type="submit" class="btn btn-lg- btn-outline-success form-control"><p></p>
        <input type="reset" class="btn btn-lg- btn-outline-warning form-control">
    </form>
</div>
<script>
    var toolbarOptions =[
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline','strike'],
        [ 'blockquote','code-block'],
        [{'list':'ordered'},{'list':'bullet'}],
        [{'script':'sub'},{'script':'super'}],
        ['link','formula','image','video'],
        [{'color':[]},{'background':[]}],
        [{'font':[]}],
        [{'align':[]}],
    ];
    var quill = new Quill('#editor', {
        modules: {
            toolbar: toolbarOptions
        },
        placeholder: 'Type Your Text Here...',
        theme: 'snow'
    });

    var articleid=<?php echo $articleid; ?>;
    fetch("<?php echo base_url('articles/fetchArticle/')?>"+articleid,{method:'GET',mode: 'no-cors',cache: 'no-cache'})
    .then(response => {
        if (response.status == 200) {return response.json();}
        else {console.log('Backend Error..!');console.log(response.text());}
    })
    .then(data => {
        if (data.length>0) {
            data.forEach(function(item){
                $("#heading").val(item.heading);
                item.lesson =JSON.parse(item.lesson);
                quill.setContents(item.lesson);
            });
        }
    })
    .catch((e) => {console.log(e);});

    $(document).on("submit","#updateArticle",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('heading',$("#heading").val());
        toServer.append('articletext',JSON.stringify(quill.getContents()));
        toServer.append('aid',articleid);
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