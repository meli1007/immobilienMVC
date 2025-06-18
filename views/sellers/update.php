<main class="container section">
    <h1>Verkäufer/-in aktualisieren</h1>

    <a href="/admin" class="button button-green">Züruck gehen</a>

    <?php foreach( $errors as $error ) : ?>
    <div class="alert error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>
    
    <form class="form" method="POST">
        <?php  include 'form.php'; ?>

        <input type="submit" value="Verkäufer/-in Daten aktualisieren" class="button button-green">
    </form>
</main>