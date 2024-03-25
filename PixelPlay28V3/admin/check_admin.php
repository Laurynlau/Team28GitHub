<?php
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    $admins = $db->query("SELECT * FROM users WHERE user_role = 'admin'");
    $is_admin = false;

    if (isset($_SESSION["user_id"])) {
        foreach ($admins as $admin) {
            if ($_SESSION["user_id"] == $admin["user_id"]) {
                $is_admin = true;
            }
        }
    }

    if (!$is_admin) {
        echo "You are not an admin and cannot access this page.";
        exit;
    }

} else {
    echo "You are not an admin and cannot access this page.";
    exit;
}
?>