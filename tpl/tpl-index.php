
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Task manager</title>

    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">

  <!----------------------------------------------------   src file --------------------------------------->

 <script  src="<?= asset('src/script.js') ?>"></script>

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
        <ul>
          <li class="active"> <i class="fa fa-folder"></i>ALL</li>
            <?php foreach ($folders as $folder):?>
          <li> <i class="fa fa-folder"></i><?= $folder->Name?></li>
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

            <li class="checked"><i class="fa fa-check-square-o"></i><span>Update team page</span>
              <div class="info">
                <div class="created-at"></div><span>Complete by 25/04/2014</span>
              </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->

</body>
</html>
