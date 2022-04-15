<br>
<div class="container">
    <form id="submitArticle" method="post">
        <select class="form-control" id="course" required>
            <option value="" disabled selected>Select Module here..</option>
        </select>
        <p></p>
        <input type="text" required class="form-control" id="heading" placeholder="Heading"><p></p>
        
        <p></p> 

        <div id="toolbar"></div>
        <div id="editor" style="height:375px;"></div>
        <p></p>
        <input type="submit" class="btn btn-lg- btn-outline-success form-control"><p></p>
        <input type="reset" class="btn btn-lg- btn-outline-warning form-control">
    </form>
</div>
<script>
    $.getJSON("<?php echo base_url('dashboard/getcourses');?>", function(data) {
        data.forEach(function(item){
            var htmlText=`
                <option value="${item.moduleid}">
                    ${item.moduleid} | ${item.modulename}
                </option>
            `;
            $("#course").append(htmlText);
        });
    });
    $(document).on("submit","#submitArticle",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('heading',$("#heading").val());
        toServer.append('module',$("#course").val());
        toServer.append('articletext',JSON.stringify(quill.getContents()));
        fetch("<?php echo base_url('module/submitarticle');?>",{method:'POST',body: toServer,mode: 'no-cors',cache: 'no-cache'})
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
            window.location.reload();
            //window.location.href="<?php echo base_url('home') ?>";
        })
        .catch((e) => {
            console.log("From catch");
            console.log(e);
            alert("Reloading");
        });
    });
    

    var toolbarOptions =[
        [{ header: [1, 2, false] }],
        ['bold', 'italic', 'underline','strike'],
        [ 'blockquote','code-block'],
        [{'list':'ordered'},{'list':'bullet'}],
        [{'script':'sub'},{'script':'super'}],
        ['link','formula','image'],
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
</script>