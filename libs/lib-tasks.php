<?php defined('BASE_PATH')  or die("Permision Denied");

# get User Id
function getCurrentUserId()
{
    return 1;
}
/*---------------------------------- Folders Function -----------------------------*/
# get folder as database
function getFolders()
{
    global $pdo;
    $sql = "SELECT * FROM folders";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    $records = $stmt -> fetchAll(PDO::FETCH_OBJ);
    return $records;
}

# delete folder
function deleteFolder($folder_id): int
{
    global $pdo;
    $sql = "DELETE FROM  folders WHERE id = $folder_id";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    return $stmt -> rowCount();
}

# Add Folder
function addFolder($folder_name)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO folders (name,User_ID) VALUES (:Folder_Name , :User_id)";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([':Folder_Name' => $folder_name , ':User_id' => $currentUserId]);
    return $stmt -> rowCount();
}

/*--------------------------------------------------- Task Functions ----------------------------------*/
# get task as database in folders
function getTask()
{
    global $pdo;
 /*  $folder = $_GET['folder_id'] ?? null;
    $folderCondition = '';
    if (isset($folder) && is_numeric($folder))
    {
        $folderCondition = " and folder_id=$folder";
    }
    $currentUserId = getCurrentUserId();*/
    $sql = "SELECT * FROM tasks /*WHERE User_ID = currentUserId folderCondition*/ ";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    $records = $stmt -> fetchAll(PDO::FETCH_OBJ);
    return $records;
}

# delete Tasks
function deleteTask($task_id)
{
    global $pdo;
    $sql = "DELETE FROM tasks WHERE ID = $task_id";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    return $stmt -> rowCount();
}

function addTask($taskTitle , $folder_id)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO `tasks` (Title , User_ID , Folder_ID) VALUES (:taskTitle, :User_id ,:Folder_id );";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([':taskTitle' => $taskTitle , ':User_ID' => $currentUserId , ':Folder_id' => $folder_id ]);
    return $stmt -> rowCount();
}