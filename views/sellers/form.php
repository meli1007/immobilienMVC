<fieldset>

    <legend>Information</legend>

    <label for="firstName">Vorname:</label>
    <input type="text" id="firstName" name="seller[firstName]" placeholder="Vorname des Verkäufers" value="<?php echo s($seller->firstName); ?>">
    
    <label for="lastName">Nachname:</label>
    <input type="text" id="lastName" name="seller[lastName]" placeholder="Nachname des Verkäufers" value="<?php echo s($seller->lastName); ?>">
  
</fieldset>
<fieldset>

    <legend>Extra Information</legend>

    <label for="phone">Telefonnummer:</label>
    <input type="number" id="phone" name="seller[phone]" placeholder="Telefonnummer des Verkäufers" value="<?php echo s($seller->phone); ?>">
    
</fieldset>