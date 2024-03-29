<div class="container">
    <br>
    <h4><?php echo "Module Number : ",$courseId; ?></h4>
    <hr width="100%">
    <div id="articles"></div>
</div>

<script>
    var urlText="<?php echo base_url('module/showArticles/').$courseId;?>"
    $.getJSON(urlText, function(data) {
        if(data.length > 0){
            data.forEach(function(item){
                item.lesson = item.lesson;
                textURL="<?php echo base_url('articles/readarticle/')?>"+item.aid;
                var htmlText=`
                    <div class="card">
                        <div class="card-header">
                            <h3>${item.heading}</h3>
                            <i class="fa-solid fa-file-pen"></i>
                            <a href="<?php echo base_url('dashboard/showuser/'); ?>${item.userid}">${item.username}</a>
                        </div>
                        <div class="card-body">
                            <a href="${textURL}" class="btn form-control btn-outline-dark" target="_blank"><i class="fa-solid fa-book-open"></i> &nbsp; Read More..</a>
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
        }else{
            var htmlText=`
                    <div class="alert alert-danger">No articles found..<br>
                    But you can Contribute
                    <br>
                    If you want, you can Write some articles under : <a href="<?php echo base_url('module/addarticles') ?>">Add Articles</a>
                    </div>
                `;
                $("#articles").append(htmlText);
        }

    });
    function share(aid){
        var wpurl="https://wa.me/?text="+"<?php echo base_url('articles/readarticle/')?>"+aid;
	location.href=wpurl;
    }
</script>