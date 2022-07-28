
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Task manager</title>

    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">

  <!----------------------------------------------------   src file --------------------------------------->

 <script  src="<?= asset('src/script.js') ?>"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel"><i class="fa fa-chevron-down"></i><span class="username">John Doe </span><img src="<?= asset('img/Screenshot_20210927-003328_PicsArt.jpg') ?>" width="40" height="40" alt=""/ ></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">FOLDERS</div>
          <ul class="folder-list">
             <li class="<?= isset($_GET['folder_id']) ? '' : 'active' ?>">
              <a href="<?= site_url() ?>"> <i class="fa fa-folder"></i>ALL</a>
             </li>
            <?php foreach ($folders as $folder):?>
                <li class="<?=isset($_GET['folder_id']) && $_GET['folder_id'] == $folder -> ID ? 'active' : '' ?>">
                    <a href="<?= site_url("?folder_id=$folder->ID") ?>"><i class="fa fa-folder"></i><?=$folder->Name?></a>
                    <a href="?delete_folder=<?=$folder->ID?>" onclick="return confirm('Are You Sure to delete this Item?\n<?=$folder->Name?>');"><i class="fa fa-remove" id="trash"></i></a>
                </li>
            <?php endforeach; ?>
        </ul>
      </div>
        <div>
            <input type="text" id="addNewFolder" placeholder="Add New Folder">
            <button id="addFolderBtn" class="btn">+</button>
        </div>
    </div>
    <div class="view">
      <div class="viewHeader">
          <div class="title" style="width: 50%;">
              <input type="text" id="taskNameInput" style="width: 100%;margin-left:3%;line-height: 30px;" placeholder="Add New Task">
          </div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
              <?php foreach ($tasks as $task): ?>
            <li class="<?= $task -> is_done ? 'checked' : '' ?>"><i class="fa <?= $task -> is_done ? 'fa-check-square-o' : 'fa-square-o'; ?>"></i><span><?= $task -> Title ?></span>
              <div class="info">
                <div class="created-at"></div><span>Created At <?= $task -> created_at ?> </span>
                  <a href="?delete_task=<?= $task -> ID ?>"><i class="fa fa-remove" id="trash"></i></a>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
<script>
    $(document).ready(function (){
        var inputFolder = $('#addNewFolder');
        var btnAddFolder = $('#addFolderBtn');
        btnAddFolder.click(function (e)
        {
            $.ajax({
                url : 'process/ajaxHandler.php',
                method : 'post',
                data : {action : "addFolder" , folderName : inputFolder.val()},
                success : function (response){
                    if(response == '1'){
                        $('<li> <a href="#"><i class="fa fa-folder"></i>'+inputFolder.val()+'</a></li>').appendTo('ul.folder-list');
                        location.reload();
                    }else{
                        alert(response);
                    }
                }
            });
        });

        /*------------- Add Task -------------*/
        var tskInput = $('#taskNameInput');
        tskInput.on('keypress',function (e){
            e.stopPropagation();
            if (e.which == 13)
            {
                $.ajax({
                    url : 'process/ajaxHandler.php',
                    method : 'post',
                    data : {action : "addTask" , Folder_id : <?= $_GET['folder_id'] ?> , taskName : tskInput.val()},
                    success : function (response){
                        location.reload();
                    }
                });
            }
        });
    });
</script>
</body>
</html>
