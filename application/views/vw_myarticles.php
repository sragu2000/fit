<br>
<div class="container">
    <div id="myarticles"></div>
</div>
<script>
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
                        <div class="col-sm-2 pt-2"><a href="<?php echo base_url('articles/readarticle/');?>${item.id}" class="btn btn-outline-primary form-control"><i class="fa-solid fa-eye"></i> View</a></div>
                        <div class="col-sm-2 pt-2"><a href="<?php echo base_url('articles/editarticle/');?>${item.id}" class="btn btn-outline-warning form-control"><i class="fa-solid fa-file-pen"></i> Edit</a></div>
                        <div class="col-sm-2 pt-2"><a href="<?php echo base_url('articles/deletearticle/');?>${item.id}" class="btn btn-outline-danger form-control"><i class="fa-solid fa-trash-can"></i> Delete</a></div>
                    </div><hr width='100%'>
                    `;
                    $("#myarticles").append(htmlText);
                });
            }
        })
        .catch(() => {console.log("Network connection error");});
    });
</script>