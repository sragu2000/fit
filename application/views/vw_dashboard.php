<br>
<div class="container">
    <h3>IT and IT&M</h3>
    <div class="row" id="both"><hr width="100%"></div>
    <br>
    <h3><u>IT</u></h3>
    <div class="row" id="it"><hr width="100%"></div>
    <br>
    <h3><u>IT&M</u></h3>
    <div class="row" id="itm"><hr width="100%"></div>
    <br>
</div>
<script>
    $.getJSON("<?php echo base_url('dashboard/getcourses');?>", function(data) {
        data.forEach(function(item){
            var htmlText=`
                    <h5>
                        <a href="<?php echo base_url('view/module/${item.moduleid}');?>">
                        <i class="fa-solid fa-arrow-up-right-from-square"></i> ${item.moduleid} : ${item.modulename}
                        </a>
                    </h5>
                    <hr width="100%">
            `;
            if((item.forcourse).toLowerCase()==("BOTH").toLowerCase()){
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


