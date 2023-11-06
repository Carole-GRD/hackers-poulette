

<form action="post">
    <h1>Contact us</h1>
    <div class="form-group">
        <div class="input-group">
            <label for="firstname">Firstname</label>
            <input type="text" name="firstname" placeholder="Firstname" required>
        </div>
        <div class="input-group">
            <label for="lastname">Lastname</label>
            <input type="text" name="lastname" placeholder="Lastname" required>
        </div>
        <div class="input-group">
            <label>Gender</label>
            <div class="radio-container">
                <div class="radio-group">
                    <input type="radio" name="gender" value="man" required>
                    <label for="man">M</label>
                </div>
                <div class="radio-group">
                    <input type="radio" name="gender" value="woman" required>
                    <label for="woman">F</label>
                </div>
            </div>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email" required>
        </div>
        <div class="input-group">
            <label for="country">Country</label>
            <input type="text" name="country" placeholder="Country" required>
        </div>
        <div class="input-group">
            <label for="subject">Subject</label>
            <select name="subject" >
            <option value='other' selected>Choose ...</option>
                <?php $subjects = ['computer','learn','teach']; ?>

                <?php foreach ($subjects as $value) { ?>
                    <option value='<?php echo $value; ?>'><?php echo ucfirst($value); ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="input-group">
            <label for="message">Message</label>
            <textarea name="message" cols="30" rows="10" placeholder="Your message ..."></textarea>
        </div>
    </div>

    <div class="button-group">
        <button type="submit">Send</button>
    </div>
</form>