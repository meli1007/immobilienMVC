<main class="container section">
        <h1>Neue Verkäufer/-in registrieren</h1>

        <a href="/admin" class="button button-green">Züruck gehen</a>

        <?php foreach( $errors as $error ) : ?>
        <div class="alert error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>
        
        <form class="form" method="POST" action="/sellers/create">
            <?php include 'form.php'; ?>
            <input type="submit" value="Verkäufer/-in registrieren" class="button button-green">

        </form>
    </main>