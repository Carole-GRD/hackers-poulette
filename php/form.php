<?php 

    require 'userArray.php';

?>

<form method="post" action="">
    <h1>Contact Us</h1>
    <div class="form-group">
        <div class="input-group">
            <label for="firstname">Firstname</label>
            <input 
                type="text" 
                name="firstname" 
                placeholder="Firstname" 
                minlength="2" 
                maxlength="40" 
                required
                <?php if(isset($_POST['firstname'])) {
                    echo 'value="' . $_POST['firstname'] . '"';
                } ?>
            >
        </div>
        <div class="input-group">
            <label for="lastname">Lastname</label>
            <input 
                type="text" 
                name="lastname" 
                placeholder="Lastname" 
                minlength="2" 
                maxlength="40" 
                required
                <?php if(isset($_POST['lastname'])) {
                    echo 'value="' . $_POST['lastname'] . '"';
                } ?>
            >
        </div>
        <div class="input-group">
            <label>Gender</label>
            <div class="radio-container">
                <div class="radio-group">
                    <input 
                        type="radio"
                        name="gender" 
                        value="man" 
                        required
                        <?php if(isset($_POST['gender']) == "man" ) echo 'checked'; ?>>
                    <label for="man">M</label>
                </div>
                <div class="radio-group">
                    <input 
                        type="radio" 
                        name="gender" 
                        value="woman" 
                        required
                        <?php if(isset($_POST['gender']) == "woman" ) echo 'checked'; ?>>
                    <label for="woman">F</label>
                </div>
            </div>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input 
                type="email" 
                name="email" 
                placeholder="Email" 
                required
                <?php if(isset($_POST['email'])) {
                    echo 'value="' . $_POST['email'] . '"';
                } ?>
            >
        </div>
        <div class="input-group">
            <label for="country">Country</label>
            <input 
                type="text" 
                name="country" 
                placeholder="Country" 
                minlength="2" 
                maxlength="40" 
                required
                <?php if(isset($_POST['country'])) {
                    echo 'value="' . $_POST['country'] . '"';
                } ?>
            >
        </div>
        <div class="input-group">
            <label for="subject">Subject</label>
            <select id="subjectSelect" name="subject">
                <option 
                    value='other'
                    <?php if(isset($_POST['subject']) == "other" ) echo 'selected'; ?>>
                    Choose ...
                </option>
                <?php $subjects = ['computer','learn','teach']; ?>

                <?php foreach ($subjects as $value) { ?>
                    <option 
                        value='<?php echo $value; ?>'
                        <?php if(isset($_POST['subject']) == $value ) echo 'selected'; ?>>
                        <?php echo ucfirst($value); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="input-group">
            <label for="message">Message</label>
            <textarea 
                name="message" 
                cols="30" 
                rows="10" 
                placeholder="Your message ..." 
                minlength="2" 
                maxlength="1000"
                required
            ><?php if(isset($_POST['message'])) { echo $_POST['message']; } ?></textarea>
        </div>
    </div>

    <div class="button-group">
        <button type="submit">Send</button>
    </div>
</form>


<?php

    // $user = array();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST['firstname']) 
            AND isset($_POST['lastname'])
            AND isset($_POST['gender'])
            AND isset($_POST['email'])
            AND isset($_POST['country'])
            AND isset($_POST['subject'])
            AND isset($_POST['message'])
        ) {
            // we initiate an array that will contain any potential errors.
            $errors = array();
            $body = '';

            // 1. Sanitisation

            // fonction pour nettoyer les chaînes de caractères
            function sanitizeString($string) {
                $trim_string = trim($string);
                $stripslashes_string = stripslashes($trim_string);
                $preg_replace_string = preg_replace('/<[^>]*>/', '', $stripslashes_string);
                $cleaned_string = htmlspecialchars($preg_replace_string, ENT_QUOTES, 'UTF-8');
                return $cleaned_string;
            }

            $user['firstname'] = sanitizeString($_POST['firstname']);
            $user['lastname'] = sanitizeString($_POST['lastname']);
            $user['gender'] = sanitizeString($_POST['gender']);
            $user['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $user['country'] = sanitizeString($_POST['country']);
            $user['subject'] = sanitizeString($_POST['subject']);
            $user['message'] = sanitizeString($_POST['message']);


            // 2. Validation

            // Validation "firstname"
            if (false === sanitizeString($_POST['firstname'])) 
            {
                $errors['firstname'] = 'Firstname invalid.';
            } 
            elseif (strlen($user['firstname']) < 2) 
            {
                $errors['firstname'] = 'Enter at least two characters !';
            }
            elseif (strlen($user['firstname']) > 40) 
            {
                $errors['firstname'] = 'Enter maximum forty characters !';
            }
            else {
                $body = 'Firstname : ' . sanitizeString($_POST['firstname']) . "\n";
            }
            
            // Validation "lastname"
            if (false === sanitizeString($_POST['lastname'])) 
            {
                $errors['lastname'] = 'Lastname invalid.';
            } 
            elseif (strlen($user['lastname']) < 2) 
            {
                $errors['lastname'] = 'Enter at least two characters !';
            }
            elseif (strlen($user['lastname']) > 40) 
            {
                $errors['lastname'] = 'Enter maximum forty characters !';
            }
            else {
                $body .= 'Lastname : ' . sanitizeString($_POST['lastname']) . "\n";
            }

            // Validation "gender"
            if (false === sanitizeString($_POST['gender'])) 
            {
                $errors['gender'] = 'Gender invalid.';
            } 
            elseif (!(($user['gender'] == 'man') OR ($user['gender'] == 'woman'))) 
            {
                $errors['gender'] = 'Only “Man” or “Woman” values are accepted !';
            }
            else {
                $body .= 'Gender : ' . sanitizeString($_POST['gender']) . "\n"; 
            }

            // Validation "email"
            if (false === filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'This address is invalid.';
            }
            else {
                $body .= 'Email : ' . sanitizeString($_POST['email']) . "\n"; 
            }
            
            // Validation "country"
            if (false === sanitizeString($_POST['country'])) 
            {
                $errors['country'] = 'Country invalid.';
            } 
            elseif (strlen($user['country']) < 2) 
            {
                $errors['country'] = 'Enter at least two characters !';
            }
            elseif (strlen($user['country']) > 40) 
            {
                $errors['country'] = 'Enter maximum forty characters !';
            }
            else {
                $body .= 'Country : ' . sanitizeString($_POST['country']) . "\n"; 
            }
            

            // Validation "subject"
            if (false === sanitizeString($_POST['subject'])) 
            {
                $errors['subject'] = 'Subject invalid.';
            } 
            elseif 
            (!(
                ($user['subject'] == 'other') 
                OR ($user['subject'] == 'learn') 
                OR ($user['subject'] == 'teach') 
                OR ($user['subject'] == 'computer')
            )) 
            {
                $errors['subject'] = 'Only "Learn" or "Teach" or "Computer" values are accepted !';
            }
            else {
                $body .= 'Subject : ' . sanitizeString($_POST['subject']) . "\n"; 
            }
            
            // Validation "message"
            if (false === sanitizeString($_POST['message'])) 
            {
                $errors['message'] = 'Message invalid.';
            } 
            elseif (strlen($user['message']) < 2) 
            {
                $errors['message'] = 'Enter at least two characters !';
            }
            elseif (strlen($user['message']) > 1000) 
            {
                $errors['message'] = 'Enter maximum thousand characters !';
            }
            else {
                $body .= 'Message : ' . sanitizeString($_POST['message']) . "\n"; 
            }



            // 3. execution
            if (count($errors) > 0){
                echo '<br><br>';
                echo 'count($errors) > 0  ->  $errors';
                echo '<pre>';
                print_r($errors);
                echo '</pre>';
                exit;
            }


            
            // If we get here, it's because everything's fine, we can record
            // $bdd = new PDO('mysql:host=localhost;dbname=test','root', '');
            // echo $bdd;
            

            // 4. Display the response interface.


            // Envoyer un email
            require 'mail.php';

            

            // Si le formulaire est bien soumis... vider les champs
            // $user['firstname'] = '';
            // $user['lastname'] = '';
            // $user['gender'] = '';
            // $user['email'] = '';
            // $user['country'] = '';
            // $user['subject'] = '';
            // $user['message'] = '';

            echo '<br><br>';
            echo '$user';
            echo '<pre>';
            print_r($user);
            echo '</pre>';
        }
    }

?>

