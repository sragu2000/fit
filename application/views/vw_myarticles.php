<br>
<div class="container">
    <div id="myarticles"></div>
</div>
<script>
    function deleteans(val){
        if(confirm("do you want to delete this Article ?")){
            location.href="<?php echo base_url('articles/deletearticle/');?>"+val
        }
    }
    $(document).ready(function() {
        fetch("<?php echo base_url('articles/myarticles') ?>",{method:'GET',mode: 'no-cors',cache: 'no-cache'})
        .then(response => {
            if (response.status == 200) {return response.json();}
            else {console.log('Backend Error..!');console.log(response.text());}
        })
        .then(data => {
            if (data.length>0) {
                console.log(data);
                data.forEach(function(item){
                    
                    var htmlText=`
                    <div class="row">
                        <div class="col-sm-6 pt-2">${item.heading}<br>${item.date}</div>
                        <div class="col-sm-2 pt-2">
                            <a href="<?php echo base_url('articles/readarticle/');?>${item.id}" 
                            class="btn btn-outline-primary form-control">
                                <i class="fa-solid fa-eye"></i> View
                            </a>
                        </div>
                        <div class="col-sm-2 pt-2"><a href="<?php echo base_url('articles/editarticle/');?>${item.id}" class="btn btn-outline-warning form-control"><i class="fa-solid fa-file-pen"></i> Edit</a></div>
                        <div class="col-sm-2 pt-2"><button onclick="deleteans('${item.id}')" class="btn btn-outline-danger form-control"><i class="fa-solid fa-trash-can"></i> Delete</button></div>
                    </div><hr width='100%'>
                    `;
                    $("#myarticles").append(htmlText);
                });
            }else{
                var htmlText=`
                    <div class="alert alert-danger">No articles found<br>If you want, you can Write some articles under : <a href="<?php echo base_url('module/addarticles') ?>">Add Articles</a></div>  
                    `;
                    $("#myarticles").append(htmlText);
            }
        })
        .catch(() => {console.log("Network connection error");});
    });
</script>