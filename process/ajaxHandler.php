<?php
include_once "../Boostrap/init.php";

# check request type
if (!isAjaxRequest())
{
    diePage("Invalid Request");
}

# check ajax action
if (!isset($_POST['action']) || empty($_POST['action']))
{
    diePage("Invalid Action!");
}
switch ($_POST['action'])
{
    /*------ Add Folder -----*/
    case 'addFolder':
        if (!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3)
        {
            echo "The folder name must be greater than 3 letters !!";
            die();
        }
        echo addFolder($_POST['folderName']);
        break;

        /*--- Add Task ----*/
    case "addTask" :
        $taskTitle = $_POST['taskName'];
        $folderId = $_POST['Folder_id'];
        if (!isset($folderId) || ($folderId) == 0)
        {
            echo "Please Select a Folder!! !!";
            die();
        }
        if (!isset($taskTitle) || strlen($taskTitle) < 3)
        {
            echo "The Task value must be greater than 3 letters !!";
            die();
        }
        echo addTask($taskTitle , $folderId);
        break;

        /*-- Add Task btn --*/
    case 'add_Task_btn' :
        $tskTitle = $_POST['taskName'];
        $folder_id = $_POST['Folder_id'];
       if (!isset($folder_id) || empty($folder_id))
        {
            echo "Please select folder !!";
            die();
        }
        if (strlen($tskTitle) < 3)
        {
            echo "The Task value must be greater than 3 letters !!";
            die();
        }
        echo addTask($tskTitle, $folder_id );
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

      /*------ Check Task Status --*/
    case 'doneSwitch' :
        $isDone = $_POST['taskId'];
        if (!isset($isDone) || !is_numeric($isDone))
        {
            echo "The task id is invalid";
            die();
        }
        checkTaskStatus($isDone);
        break;
    default:
        diePage("Invalid Request");
}