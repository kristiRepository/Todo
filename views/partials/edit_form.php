<link rel="stylesheet" type="text/css" href="/views/asset/styles/edit-createTodo.css">


<div class="edit-popup">
    <div class="edit-popup-content">
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']);
        }  ?>
        <img src="/views/partials/x.png" class="edit-close">
        <form id="form" action="/edit" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input id="edit-name" name="name" type="text" class="form-control" value="" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="edit-description" class="form-control" placeholder="Enter Todo description" name="description" rows="4" cols="50" required></textarea>
            </div>
            <div class="box">
                <select id="edit-priority" name="priority">
                    <option id="low" value="low">Low</option>
                    <option id="medium" value="medium">Medium</option>
                    <option id="high" value="high">High</option>
                </select>
            </div>
            <div class="form-group">
                <label>Deadline</label>
                <input id="edit-deadline" type="date" name="deadline" class="form-control" value="" ?>
            </div>
            <button type="submit" class="btn btn-primary">Edit Todo</button>
            <input type="hidden" id="task_id" name="task_id" value="">

        </form>
        <form action="/delete" method="POST">
            <input type="hidden" id="delete_id" name="delete_id">
            <input type="submit" style="width:130px;" class="btn btn-danger mt-3" value="Delete">
    </form>
    </div>
</div>



<script>
    document.querySelector(".edit-close").addEventListener("click", function() {
        document.querySelector(".edit-popup").style.display = "";
    });
</script>