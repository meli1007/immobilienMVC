<fieldset>

                <legend>Information</legend>

                <label for="title">Titel:</label>
                <input type="text" id="title" name="property[title]" placeholder="Immobilie Title" value="<?php echo s($property->title); ?>">

                <label for="price">Preis:</label>
                <input type="text" id="price" name="property[price]" placeholder="Immobilie Preis" value="<?php echo s($property->price); ?>">

                <label for="image">Bild:</label>
                <input type="file" id="image" accept="image/jpeg, image/png" name="property[image]">

                <?php if($property->images):?>
                    <img src="/images/<?php echo $property->images ?>" class="image-small">
                <?php endif; ?>
                <label for="description">Beschreibung:</label>
                <textarea id="description" name="property[description]"><?php echo s($property->description); ?></textarea>

            </fieldset>

            <fieldset>

                <legend>Immobilien Information</legend>

                <label for="rooms">Zimmer:</label>
                <input type="number" id="rooms" name="property[rooms]" placeholder="z.B: 3" min="1" max="9" value="<?php echo s($property->rooms); ?>">

                <label for="wc">Badezimmer:</label>
                <input type="number" id="wc" name="property[wc]" placeholder="z.B: 3" min="1" max="9" value="<?php echo s($property->wc); ?>">

                <label for="parking">Parkingplatz:</label>
                <input type="number" id="parking" name="property[parking]" placeholder="z.B: 3" min="1" max="9" value="<?php echo s($property->parking); ?>">

            </fieldset>

           <fieldset>
                <legend>Verkäufer</legend>

                <select name="property[sellers_id]" id="seller">
                    <label for="seller"></label>
                    <option selected value="">-- Bitte Auswählen -- </option>
                    <?php foreach($sellers as $seller): ?>
                        <option 
                            <?php echo $property->sellers_id === $seller->id ? 'selected' : ''; ?>
                            value="<?php echo s($seller->id) ?>"><?php echo s($seller->firstName) . " " . s($seller->lastName); ?></option>
                    <?php endforeach; ?>
                </select>
            </fieldset>