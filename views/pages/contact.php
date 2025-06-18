<main class="container section">
    <h1>Kontaktiere uns!</h1>

    <?php if($message) { ?>
            <p class='alert success'><?php echo $message; ?></p>
        
    <?php } ?>

    <picture>
        <source srcset="build/img/destacada3.avif" type="image/avif" />
        <source srcset="build/img/destacada3.webp" type="image/webp" />
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Bilb Kontakt" />
    </picture>
    <h2>Füllen Sie das Kontaktformular aus</h2>
    <form class="form" action="/contact" method="POST">
        <fieldset>
            <legend>persönliche Information</legend>

            <label for="name">Name</label>
            <input id="name" type="text" placeholder="Name"  name="contact[name]" required />

            <label for="message">Nachricht</label>
            <textarea id="message" name="contact[message]" required></textarea>
        </fieldset>
        <fieldset>
            <legend>Informationen zur Immobilie</legend>

            <label for="options">kaufen oder verkaufen:</label>
            <select id="options" name="contact[type]" required>
                <option value="" disabled selected>--Auswählen--</option>
                <option value="kaufen">kaufen</option>
                <option value="verkaufen">verkaufen</option>
            </select>

            <label for="budget">Budget oder Preis</label>
            <input id="budget" type="number" placeholder="Budget oder Preis" name="contact[price]" required/>

        </fieldset>

        <fieldset>
            <legend>Informationen zur Immobilie</legend>

            <p>Wie möchten Sie gerne kontaktiert werden?</p>

            <div class="form-contact">
                <label for="contact-tel">Telefon</label>
                <input id="contact-tel" type="radio" value="telefon" name="contact[contact]" required/>

                <label for="contact-email">E-mail</label>
                <input id="contact-email" type="radio" value="email" name="contact[contact]" required/>
            </div>

            <div id="contact"></div>

        </fieldset>

        <input type="submit" value="Nachricht senden" class="button-green">
    </form>
</main>