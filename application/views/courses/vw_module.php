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
                        <h3>${item.heading}</h3><i class="fa-solid fa-file-pen"></i> ${item.user}
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn form-control btn-outline-dark" data-bs-toggle="collapse" data-bs-target="#d${item.aid}"><i class="fa-solid fa-book-open"></i> &nbsp; Read More..</button>
			            <p></p>
                        <div id="d${item.aid}" class="collapse">${item.lesson}</div>   
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-2">
                                <a class="btn btn-dark text-white form-control btn-disabled">
                                    <i class="fa-solid fa-share-nodes"></i>
                                </a>
                            </div>
                            <div class="col-10">
                                <button onclick="share('${item.aid}')" class="btn btn-outline-success form-control ">
                                <i class="fa-brands fa-whatsapp"></i> Whatsapp
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <p></p>

            `;

            $("#articles").append(htmlText);

        });

    });
    function share(aid){
        var wpurl="https://wa.me/?text="+"<?php echo base_url('articles/readarticle/')?>"+aid;
	location.href=wpurl;
    }
</script>