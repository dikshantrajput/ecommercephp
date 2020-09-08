<?php include "dashboard.php";?>



<div class="col-lg-9 mt-5 p-4">
    <div class="row bg-light p-3 mb-3">
        <div class="col-lg-9"><h1>Users</h1></div>
    </div>
    <div class="row bg-light table-responsive-md p-3">
        <table class="table bordered" id="table">
        </table>
    </div>
</div>


<script>
$(document).ready(()=>{

    $(".categories").removeClass("active")
    $(".users").addClass("active")


const loadData = ()=>{
    $.ajax({
        url:'loadUsersData.php',
        type:'post',
        success:(data)=>{
            $('#table').html(data)
        }
    })
}
loadData();


$(document).on("click",".dltbtn",(e)=>{
    let id = e.target.dataset.id
    $.ajax({
        url:'deleteUsers.php',
        type:'post',
        data:{id:id},
    })
    loadData()
})
})
</script>