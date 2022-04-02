<div class="container">
    <h2><?php echo "Module Number : ",$courseId; ?></h2>
    <hr width="100%">
    <div id="articles"></div>
</div>
<script>
    var urlText="<?php echo base_url('module/showArticles/').$courseId;?>"
    $.getJSON(urlText, function(data) {
        data.forEach(function(item){
            item.lesson = decodeURIComponent(item.lesson);
            var htmlText=`
                <div class="card">
                    <div class="card-header">
                        <h3>${item.heading}</h3><br><i class="fa-solid fa-file-pen"></i> ${item.user}
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-lg form-control btn-primary" data-bs-toggle="collapse" data-bs-target="#d${item.aid}">Read More..</button>
                        <div id="d${item.aid}" class="collapse">${item.lesson}</div>   
                    </div>
                </div>
                <p></p>
            `;
            $("#articles").append(htmlText);
        });
    });
</script>