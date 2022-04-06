<br>
<style>
img {
    max-width: 100%;
    hegiht: auto;
}
</style>
<div class="container" id="target">
<div id="quesdet"></div>
<div id="editor"></div>
</div>
<script>
    $.getJSON("<?php echo base_url('articles/postRead/').$articleid;?>", function(data) {
        console.log(data);
        data.forEach(function(item){
            var htmlText=`
               <h2>${item.heading}</h2>
               <h4>${item.date}</h4>
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
    });
    
</script>