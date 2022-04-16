<br>
<style>
img {
    max-width: 100%;
    height: auto;
}
</style>
<div class="container" id="target">
<div id="quesdet"></div>
<div id="editor"></div>
</div>
<script>
    $.getJSON("<?php echo base_url('articles/postRead/').$articleid;?>", function(data) {
        if(data.length > 0) {
            data.forEach(function(item){
                var htmlText=`
                <h2>${item.heading}</h2>
                <h4>${item.date}</h4>
                <h5>Under Module: ${item.mid} - ${item.mname}</h5>
                <hr width="100%">
                `;
                $("#quesdet").append(htmlText);

                var quill = new Quill('#editor', {
                    modules: {toolbar: false},
                    readOnly: true,
                });
                const obj=JSON.parse(item.lesson);
                quill.setContents(obj);
            });
        }else{
            var htmlText=`
                <div class='alert alert-danger'>Article Not Found</div>
                `;
                $("#quesdet").append(htmlText);
        }
    });
    
</script>