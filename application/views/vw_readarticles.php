<br>
<div class="container" id="target">

</div>
<script>
    $.getJSON("<?php echo base_url('articles/postRead/').$articleid;?>", function(data) {
        data.forEach(function(item){
            var newText=decodeURIComponent(item.lesson);
            
            var htmlText=`
               <h2>${item.heading}</h2>
               <h4>${item.date}</h4>
               <hr width="100%">
               <p>${newText}</p>
            `;
            $("#target").append(htmlText);
        });
    });
</script>