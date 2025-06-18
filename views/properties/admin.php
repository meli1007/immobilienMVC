<main class="container section">
    <h1>Adminstrator</h1>
    
    <?php 
        if($result) {
            $message = showNotifications(intval($result));
            if($message) { ?>
                <p class="alert success">
                    <?php echo s($message); ?>
                </p>
    <?php }
        }
    ?>
    
    <a href="/properties/create" class="button button-green">Neue Immobilie</a>
    <a href="/sellers/create" class="button button-green">Neue Verkäufer/-in</a>

    <h2>Immobilien</h2>
    <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titel</th>
                <th>Bild</th>
                <th>Preis</th>
                <th>Aktien</th>
            </tr>
        </thead>

        <tbody> <!-- show the results -->
            <?php foreach($properties as $property): ?>
            <tr>
                <td><?php echo $property->id; ?></td>
                <td><?php echo $property->title; ?></td>
                <td> <img src="/images/<?php echo $property->images; ?>" class="image-table" alt="Haus Bild Anzeige"></td>
                <td><?php echo $property->price; ?>€</td>
                <td>
                    <form method="POST" class="w-100" action="/properties/delete">
                        <input type="hidden" name="id" value="<?php echo $property->id; ?>">
                        <input type="hidden" name="type" value="property">
                        <input type="submit" class="button-red-block" value="Löschen">
                    </form>
                    <a href="/properties/update?id=<?php echo $property->id; ?>" class="button-yellow-block">Aktualisieren</a>
                </td>
            </tr>
            <?php  endforeach; ?>
        </tbody>
    </table>

    <h2>Verkäufer</h2>
    
        <table class="properties">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Telefonnummer</th>
                <th>Aktionen</th>
            </tr>
        </thead>

        <tbody> <!-- show the results -->
            <?php foreach($sellers as $seller): ?>
            <tr>
                <td><?php echo $seller->id; ?></td>
                <td><?php echo $seller->firstName . " " . $seller->lastName; ?></td>
                <td><?php echo $seller->phone;?></td>
                <td>
                    <form method="POST" class="w-100" action="/sellers/delete">
                        <input type="hidden" name="id" value="<?php echo $seller->id; ?>">
                        <input type="hidden" name="type" value="seller">
                        <input type="submit" class="button-red-block" value="Löschen">
                    </form>
                    <a href="/sellers/update?id=<?php echo $seller->id; ?>" class="button-yellow-block">Aktualisieren</a>
                </td>
            </tr>
            <?php  endforeach; ?>
        </tbody>
    </table>
</main>
