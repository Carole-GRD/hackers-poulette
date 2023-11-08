<?php 

    $user = array();

    if (! ($_SERVER["REQUEST_METHOD"] == "POST") ) {
        $user['firstname'] = isset($_POST['firstname']) ? $_POST['firstname'] : '';
        $user['lastname'] = isset($_POST['lastname']) ? $_POST['lastname'] : '';
        $user['gender'] = isset($_POST['gender']) ? $_POST['gender'] : '';
        $user['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $user['country'] = isset($_POST['country']) ? $_POST['country'] : '';
        $user['subject'] = isset($_POST['subject']) ? $_POST['subject'] : '';
        $user['message'] = isset($_POST['message']) ? $_POST['message'] : '';


        echo '$user';
        echo '<pre>';
        print_r($user);
        echo '</pre>';
    }

?>