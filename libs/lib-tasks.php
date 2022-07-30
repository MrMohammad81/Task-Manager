<?php defined('BASE_PATH')  or die("Permision Denied");

/*---------------------------------- Folders Function -----------------------------*/
# get folder as database
function getFolders()
{
    global $pdo;
    $current_user_id = getCurrentUserId();
    $sql = "SELECT * FROM folders  where user_id = $current_user_id";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    $records = $stmt -> fetchAll(PDO::FETCH_OBJ);
    return $records;
}

# delete folder
function deleteFolder($folder_id): int
{
    global $pdo;
    $sql = "DELETE folders,tasks FROM folders JOIN tasks ON folders.ID = tasks.Folder_ID WHERE folders.ID = $folder_id";
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
    $folder = $_GET['folder_id'] ?? null;
    $folderCondition = '';
    if (isset($folder) && is_numeric($folder))
    {
        $folderCondition = " and Folder_id=$folder";
    }
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * FROM tasks WHERE User_ID = $currentUserId $folderCondition ";
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
   $get_user_id = getCurrentUserId();
   $sql = "INSERT INTO tasks (Title , User_ID , Folder_ID) VALUES (:title , :user_id , :folder_id)";
   $stmt = $pdo -> prepare($sql);
   $stmt -> execute([':title' => $taskTitle , ':user_id' => $get_user_id , ':folder_id' => $folder_id ]);
   return $stmt -> rowCount();
}

# delete all task
function deleteAll(){
    global $pdo;
    $sql = "TRUNCATE tasks";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute();
    return $stmt -> rowCount();
}

# check task status
function checkTaskStatus($task_id)
{
    global $pdo;
    $get_user_id = getCurrentUserId();
    $sql = "UPDATE tasks SET is_done = 1 - is_done WHERE ID = :tsk_id AND User_ID = :user_id";
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([':tsk_id' => $task_id , ':user_id' => $get_user_id]);
    return  $stmt -> rowCount();

}