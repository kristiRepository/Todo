<?php include('views/partials/header.php');   ?>
<?php include('views/partials/navbar.php');   ?>
<?php include('views/partials/create_form.php');   ?>
<?php include('views/partials/edit_form.php');   ?>
<link rel="stylesheet" type="text/css" href="/views/asset/styles/main.css">

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


<?php if (isset($_SESSION['error'])) { ?>
    <script>
        $(document).ready(function() {
            document.querySelector(".popup").style.display = "flex";
        });
    </script>
<?php unset($_SESSION['error']);
}  ?>



<div class="container" id="container" style="z-index:-1; ">
    <h2 class="pb-2 pt-5">My Todo list</h2>
    <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
    <?php unset($_SESSION['success']);
    }  ?>
    <?php if (isset($_SESSION['delete'])) { ?>
        <div class="alert alert-danger"><?php echo $_SESSION['delete']; ?></div>
    <?php unset($_SESSION['delete']);
    }  ?>
    <?php if (!empty($tasks)) { ?>
        <ul id="sortable" style="list-style: none; max-height:550px;" class="list-group task">
            <?php foreach ($tasks as $task) { ?>
                <li class="list-group-item <?php if ($task['priority'] == "low") echo "list-group-item-success";
                                            elseif ($task['priority'] == "medium") echo "list-group-item-warning";
                                            else echo "list-group-item-danger";
                                            ?>">
                    <h4><?php echo $task['name'] . "(" . $task['deadline'] . ")"; ?><div style="float:right; margin-top:10px;">
                    <?php if ($task['priority'] == "low") echo "<img style='padding-right:5px; width:40px;' src='/views/asset/img/low1.jpg' />";
                                            elseif ($task['priority'] == "medium") echo "<img style='padding-right:5px; width:40px;' src='/views/asset/img/medium3.png' />";
                                            else echo "<img style='padding-right:5px; width:40px;' src='/views/asset/img/high.png' />";?>
                                            <img onclick="show($(this).attr('task_id'),$(this).attr('name'),$(this).attr('description'),$(this).attr('priority'),$(this).attr('deadline'));" task_id=<?php echo $task['id']; ?> name=<?php echo $task['name']; ?> description=<?php echo $task['description']; ?> priority=<?php echo $task['priority']; ?> deadline=<?php echo $task['deadline']; ?> id="edit" style="float:right; width:40px; padding-top:9px;" src="https://img.icons8.com/android/48/000000/menu.png" /><button onclick="markAsDone($(this).attr('id'));" id=<?php echo $task['id']; ?> class="button">Done</button>
                            <div>
                    </h4>
                    <p><?php echo $task['description']; ?></p>
                <li><?php } ?>
        </ul>
    <?php } else { ?>
        <h6>There are no tasks yet</h6>
    <?php } ?>
</div>


<script type="text/javascript" src="/views/asset/styles/js/main.js"></script>




<?php include('views/partials/footer.php');  ?>