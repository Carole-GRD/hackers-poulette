

<?php 

    function sanitizeString($string) {
        $trim_string = trim($string);
        $stripslashes_string = stripslashes($trim_string);
        $preg_replace_string = preg_replace('/<[^>]*>/', '', $stripslashes_string);
        $cleaned_string = htmlspecialchars($preg_replace_string, ENT_QUOTES, 'UTF-8');
        return $cleaned_string;
    }

?>