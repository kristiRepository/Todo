<link rel="stylesheet" type="text/css" href="/views/asset/styles/edit-createTodo.css">


<div class="popup">
    <div class="popup-content">
        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']);
        }  ?>
        <img src="/views/partials/x.png" class="close">
        <form id="form" action="/add" method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" placeholder="Enter Todo name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" placeholder="Enter Todo description" name="description" rows="4" cols="50" required></textarea>
            </div>
            <div class="box">
                <select name="priority">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="form-group">
                <label>Deadline</label>
                <input type="date" name="deadline" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Create Todo</button>
            <input type="hidden" name="user_id" value=<?php echo $_SESSION['id']; ?>>
        </form>
    </div>
</div>



<script>
    document.getElementById("button").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "flex";
    });
    document.querySelector(".close").addEventListener("click", function() {
        document.querySelector(".popup").style.display = "";
    });
</script>