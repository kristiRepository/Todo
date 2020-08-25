function markAsDone(id) {
    var id = id;
    $.ajax({
        url: "done",
        method: "POST",
        data: {
            id: id,

        },
        success: function(data) {
            $('.list-group').html($(data).find('.list-group'));
            
        }
    
    });
}


function show(task_id, name, description, priority, deadline) {
    document.querySelector(".edit-popup").style.display = "flex";
    document.querySelector("#edit-name").value = name;
    document.querySelector("#edit-description").value = description;
    document.getElementById(priority).selected = true;
    document.querySelector("#edit-deadline").value = deadline;
    document.querySelector("#task_id").value = task_id;
    document.querySelector("#delete_id").value = task_id;
}


$("#sortable").sortable();