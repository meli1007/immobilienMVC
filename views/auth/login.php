<main class="container section content-center">
<h1>Willkommen zurück! Logge dich ein</h1>

<?php foreach( $errors as $error ) : ?>
<div class="alert error">
    <?php echo $error; ?>
</div>
<?php endforeach; ?>

<form method="POST" class="form" action="/login">
    <fieldset>
        <legend>E-mail & Password</legend>

        <label for="email">E-mail</label>
        <input id="email" name="email" type="email" placeholder="E-mail" />

        <label for="password">Password</label>
        <input id="password" name="password" type="password" placeholder="Password" />

    </fieldset>

    <input type="submit" value="Einloggen" class="button button-green">
</form>
</main>