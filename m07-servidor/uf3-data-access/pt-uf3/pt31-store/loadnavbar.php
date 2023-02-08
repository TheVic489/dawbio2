<?php
/**
 * navigation bar 
 */
$menupath = "views/mainmenu.php"; //default value.
if (isset($_SESSION['role'])) {
    $role = filter_var($_SESSION['role']);
    if ($role) {
        switch ($role) {
            case "admin":
                $menupath = "views/admin/adminmenu.php";
                break;    
            case "staff":
                $menupath = "views/admin/adminmenu.php";
                //$menupath = "views/admin/staffmenu.php"; // asjidAOISDJAOISdfjoifu weasdfljkASfijAIPFjefpf
        }
    }
}
//ensure to show admin menu (only for testing).
//$menupath = "views/admin/adminmenu.php";
//include proper menu.
include $menupath;