<br>
<div class="container">
    <h1><u>IT and IT&M</u></h1>
    <div class="row" id="both"></div>
    <br>
    <h1><u>IT</u></h1>
    <div class="row" id="it"></div>
    <br>
    <h1><u>IT&M</u></h1>
    <div class="row" id="itm"></div>
    <br>
</div>
<script>
    $.getJSON("<?php echo base_url('dashboard/getcourses');?>", function(data) {
        console.log(data);
        data.forEach(function(item){
            var htmlText=`
            <div class="col-sm-4 mt-2">
                <div class="card border border-dark">
                    <div class="card-header">
                        <center>${item.moduleid}</center>
                    </div>
                    <div class="card-body">
                        ${item.modulename}
                    </div>
                    <div class="card-footer">
                        <a href="<?php echo base_url('view/module/${item.moduleid}');?>" class="btn btn-success form-control">
                            <i class="fa-solid fa-book-open-reader"></i> &nbsp;
                            Read
                        </a>
                    </div>
                </div>
            </div>
            `;
            if(item.forcourse=="BOTH"){
                $("#both").append(htmlText);
            }
            if(item.forcourse=="IT"){
                $("#it").append(htmlText);
            }
            if(item.forcourse=="ITM"){
                $("#itm").append(htmlText);
            }
        });
    });
</script>
</body>
</html>


