<?php

    $user = array();

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

            // 1. Sanitisation
            $user['firstname'] = $_POST['firstname'];
            $user['lastname'] = $_POST['lastname'];
            $user['gender'] = $_POST['gender'];
            $user['email'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $user['country'] = $_POST['country'];
            $user['subject'] = $_POST['subject'];
            $user['message'] = $_POST['message'];

            // 2. Validation
            if (false === filter_var($user['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'This address is invalid.';
                echo '<pre>';
                print_r($errors);
                echo '</pre>';
            }



            // 3. execution
            // if (count($errors)> 0){
            //     echo "There are mistakes!";
            //     print_r($errors);
            //     exit;
            // }

            // If we get here, it's because everything's fine, we can record
            // $bdd = new PDO('mysql:host=localhost;dbname=test','root', '');
            //...

            // 4. Display the response interface.


            echo '<pre>';
            print_r($user);
            echo '</pre>';
        }
    }

?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
                required>
        </div>
        <div class="input-group">
            <label for="lastname">Lastname</label>
            <input 
                type="text" 
                name="lastname" 
                placeholder="Lastname" 
                minlength="2" 
                maxlength="40" 
                required>
        </div>
        <div class="input-group">
            <label>Gender</label>
            <div class="radio-container">
                <div class="radio-group">
                    <input 
                        type="radio"
                        name="gender" 
                        value="man" 
                        required>
                    <label for="man">M</label>
                </div>
                <div class="radio-group">
                    <input 
                        type="radio" 
                        name="gender" 
                        value="woman" 
                        required>
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
                required>
        </div>
        <div class="input-group">
            <label for="country">Country</label>
            <input 
                type="text" 
                name="country" 
                placeholder="Country" 
                minlength="2" 
                maxlength="40" 
                required>
        </div>
        <div class="input-group">
            <label for="subject">Subject</label>
            <select id="subjectSelect" name="subject">
                <option value='other'>Choose ...</option>
                <?php $subjects = ['computer','learn','teach']; ?>

                <?php foreach ($subjects as $value) { ?>
                    <option value='<?php echo $value; ?>'><?php echo ucfirst($value); ?></option>
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
                required></textarea>
        </div>
    </div>

    <div class="button-group">
        <button type="submit">Send</button>
    </div>
</form>


<!-- Veuillez inclure "@" dans l'adresse e-mail il manque un symbole "@" dans "...".-->