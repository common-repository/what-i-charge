<?php
    if(isset($_GET['edit'])&&$_GET['edit']=="new"){
        $isNewService = true;
        include __DIR__."/admin_edit_view.php";
    }else if(isset($_GET['edit'])){
        $isNewService = false;
        $currentService = get_post($_GET['edit']);
        include __DIR__ ."/admin_edit_view.php";
    }else{
        include __DIR__ ."/admin_edit_view_post.php";
        include __DIR__."/admin_services_list.php";
    }
?>



