<br><br>
<div class="container">
    <button type="button" id="createModule" class="btn btn-outline-primary btn-lg form-control"><i class="fa-solid fa-circle-plus"></i> Create Module</button>
    <hr width="100%">
    <h3>Available Courses</h3>
    <hr width="100%">
    <div id="courselist"></div>
</div>

<script>
    $.getJSON("<?php echo base_url('dashboard/getcourses');?>", function(data) {
        console.log(data);
        data.forEach(function(item){
            var htmlText=`
            <div class="row m-3">
                <div class="col-md-2">${item.moduleid}</div>    
                <div class="col-md-6">${item.modulename}</div>  
                <div class="col-md-2">
                    <button type="button" class="btn  btn-outline-primary form-control" onclick="editModule('${item.moduleid}','${item.modulename}','${item.forcourse}')"><i class="fa-regular fa-pen-to-square"></i> Edit</button>    
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn  btn-outline-danger form-control" onclick="deleteModule('${item.moduleid}')"><i class="fa-solid fa-trash"></i> Delete</button>    
                </div>
            </div> 
            <hr width="100%">
            ` 
            $("#courselist").append(htmlText);
            
        });
    });
    function editModule(moduleID,moduleName,forcourse){
        let newCourseName = prompt("Module Name : ", moduleName);
        let newCourseID = prompt("Module ID : ", moduleID);
        let newCourse = prompt("For Course(IT or ITM or BOTH) : ", forcourse);
        swal({
            title: "Are you sure to edit ?",
            text: "New Course Name : "+newCourseName+"\nNew Course ID : "+newCourseID+"\nFor Course : "+newCourse,
            icon: "warning",buttons: true,dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                location.href="<?php echo base_url('admin/editModule/'); ?>"+moduleID+"/"+newCourseName+"/"+newCourseID+"/"+newCourse;
                swal("Module Edited",{icon: "success",});
            } else {
                swal("Your Module is safe!");
            }
        });
    }
    function deleteModule(moduleID){
        swal({
            title: "Are you sure to delete? Once deleted, It can't be undone. Articles related to the module willbe also deleted.",
            icon: "warning",buttons: true,dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                location.href="<?php echo base_url('admin/deleteModule/'); ?>"+moduleID;
                swal("Module Deleted",{
                icon: "success",
                });
            } else {
                swal("Your Module is safe!");
            }
        });
    }
    
    $(document).on("click","#createModule",()=>{
        var modulename, moduleid, forcourse;
        modulename=prompt("Enter Module Name : ")
        moduleid=prompt("Enter Module ID : ")
        forcourse=prompt("For Course(IT or ITM or BOTH) : ")
        var text="Module Name : "+modulename+"\nModule ID : "+moduleid+"\nFor Course : "+forcourse;
        if(confirm(text+"\nDo you want to Create Module ?")){
            var addurl="<?php echo base_url('admin/createModule/')?>"+modulename+"/"+moduleid+"/"+forcourse
            $.getJSON(addurl, function(data) {
                if (data.result==true){
                    alert("Module Created");
                    window.location.reload();
                }else{
                    alert("Module Failed");
                }
            });
        }else{
            alert("Module Creation Cancelled");
        }
    })
</script>

