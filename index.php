<?php

include "Boostrap/init.php";

# logOut
if (isset($_GET['logout']))
{
    loggedOut();
}

if (!isLogedIn())
{
    redirect(site_url('auth.php'));
}

# get suer
$user = getLoggedInUser();

# delete folder
if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder']))
{
    $deletedCount =  deleteFolder($_GET['delete_folder']);
}

# delete Tasks
if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task']))
{
    $deletedTask = deleteTask($_GET['delete_task']);
}

# show folders
$folders = getFolders();

#show tasks
$tasks = getTask();

include "tpl/tpl-index.php";