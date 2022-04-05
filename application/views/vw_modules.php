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
        var newCourseID,newCourse;
        if(newCourseName != null && newCourseName.trim()!=""){
            newCourseID = prompt("Module ID : ", moduleID);
        }
        if(newCourseID != null && newCourseID.trim()!=""){
            newCourse = prompt("For Course(IT or ITM or BOTH) : ", forcourse);
        }
        if(newCourse != null && newCourse.trim()!=""){
            if(confirm("New Course Name : "+newCourseName+"\nNew Course ID : "+newCourseID+"\nFor Course : "+newCourse)){
                var urltext="<?php echo base_url('admin/editModule/'); ?>"+moduleID+"/"+newCourseName+"/"+newCourseID+"/"+newCourse;
                $.getJSON(urltext, function(data) {
                    if (data.result==true){
                        alert("Module Edited Successfully!");
                        window.location.reload();
                    }else{
                        alert("Module Editing Failed ");
                    }
                });
            }
        }
        
    }

    function deleteModule(moduleID){
        if(confirm("Are you sure to delete?")){
            var urltext="<?php echo base_url('admin/deleteModule/'); ?>"+moduleID;
            $.getJSON(urltext, function(data) {
                if (data.result==true){
                    alert("Module deleted Successfully!");
                    window.location.reload();
                }else{
                    alert("Cannot delete module");
                }
            });
        }
    }
    
    $(document).on("click","#createModule",()=>{
        var modulename, moduleid, forcourse;
        modulename=prompt("Enter Module Name : ")
        if(modulename != null && modulename.trim()!=""){
            moduleid=prompt("Enter Module ID : ")
        }
        else if(moduleid != null  && moduleid.trim()!=""){
            forcourse=prompt("For Course(IT or ITM or BOTH) : ")
        }
        else if(forcourse != null && forcourse.trim()!=""){
            var text="Module Name : "+modulename+"\nModule ID : "+moduleid+"\nFor Course : "+forcourse;
            if(confirm(text+"\nDo you want to Create Module ?")){
                var addurl="<?php echo base_url('admin/createModule/')?>"+modulename+"/"+moduleid+"/"+forcourse
                $.getJSON(addurl, function(data) {
                    if (data.result==true){
                        alert("Module Created");
                        window.location.reload();
                    }else{
                        alert("Module Failed : "+data.message);
                    }
                });
            }else{
                alert("Module Creation Cancelled");
            }
        }else{
            alert("Inputs cannot be blank");
        }
    })
</script>

