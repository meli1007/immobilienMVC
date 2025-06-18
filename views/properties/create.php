<main class="container section">
    <h1>Erstellen</h1>

    <?php foreach( $errors as $error ) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>
    
    <a href="/admin" class="button button-green">Züruck gehen</a>

    <form class="form" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/form.php'; ?>

        <input type="submit" value="Immobilien erstellen" class="button button-green">
    </form>
</main>