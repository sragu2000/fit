<div class="container">
    <br>
    <br>
    <h4 class="bg-dark text-white p-2 ">User Bio</h4>
    <table class="table table-success table-bordered">
        <tbody>
            <tr>
                <th scope="row" style="text-align:center">User Name</th>
                <td id="username" style="text-align:center"></td>
            </tr>
            <tr>
                <th scope="row" style="text-align:center">Course</th>
                <td id="course" style="text-align:center"></td>
            </tr>
        </tbody>
    </table>
    <h4 class="bg-dark text-white p-2">Articles</h4>
    <div id="articlearea">
    <hr width="100%">
    </div>
</div>

<script>
    var url="<?php echo base_url('dashboard/viewprofile/').$userid;?>";
    fetch(url,{method:'GET',mode: 'no-cors',cache: 'no-cache'})
    .then(response => {
        if (response.status == 200) {return response.json();}
        else {console.log('Backend Error..!');console.log(response.text());}
    })
    .then(data => {
        $("#username").append(data["userdetails"][0]["name"]);
        $("#course").append(data["userdetails"][0]["course"]);
        data["articles"].forEach(function(item){
            var htmlText=`
                <div class="row">
                    <div class="col-md-8"><h5>${item.heading}</h5></div>
                    <div class="col-md-2 align-middle"><h5>${item.module}</h5></div>
                    <div class="col-md-2 align-middle">
                        <a href="<?php echo base_url('articles/readarticle/');?>${item.aid}" class="btn btn-outline-info form-control">Read</a>
                    </div>
                </div>
                <hr width="100%">
            `;
            $("#articlearea").append(htmlText);
        });
    })
    .catch(() => {console.log("Network connection error");});
</script>
