<div class="container">
    <h2><?php echo "Module Number : ",$courseId; ?></h2>
    <hr width="100%">
    <div id="articles"></div>
</div>
<script>
    var urlText="<?php echo base_url('module/showArticles/').$courseId;?>"
    $.getJSON(urlText, function(data) {
        data.forEach(function(item){
            var htmlText=`
                <div class="card">
                    <div class="card-header">
                        <h3>${item.heading}</h3><br><i class="fa-solid fa-file-pen"></i> ${item.user}
                    </div>
                    <div class="card-body">
                        ${item.lesson}
                    </div>
                </div>
                <p></p>
            `;
            $("#articles").append(htmlText);
        });
    });
</script>