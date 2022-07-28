<?php
include_once "../Boostrap/init.php";

# check request type
if (!isAjaxRequest())
{
    diePage("Invalid Request");
}

# check ajax action add Folder
if (!isset($_POST['action']) || empty($_POST['action']))
{
    diePage("Invalid Action!");
}
switch ($_POST['action'])
{
    case 'addFolder':
        if (!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3)
        {
            echo "The folder name must be greater than 3 letters !!";
            die();
        }
        echo addFolder($_POST['folderName']);
        break;

        /*--- Add Task ----*/
    case "addTasks" :
        $taskTitle = $_POST['taskTitle'];
        $folderId = $_POST['folderId'];
        if (!isset($folderId) || empty($folderId) > 3)
        {
            echo "Please Select a Folder!! !!";
            die();
        }
        echo addTask($taskTitle , $folderId);
        break;

        /*-- Delete Task --*/
    case 'addTask' :
        $tskTitle = $_POST['taskName'];
        $folder_id = $_POST['Folder_id'];
        if (!isset($folder_id) || empty($folder_id))
        {
            echo "Please select folder !!";
            die();
        }
        if (empty($tskTitle) || strlen($tskTitle) < 3)
        {
            echo "The Task value must be greater than 3 letters !!";
            die();
        }
        echo addTask($tskTitle , $folder_id);
        break;

        /* ---- Delete All Task ---*/
    case 'deleteAll' :
      if (!sizeof(getTask()))
      {
          echo "There is no task to delete !!";
          die();
      }
      deleteAll();
      break;
    default:
        diePage("Invalid Request");
}