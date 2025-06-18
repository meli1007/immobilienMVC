<main class="container section">
        <h2>Mehr über uns</h2>

        <?php include 'icons.php'; ?>
    </main>

    <section class="section container">
        <h2>Häuser & Wohnungen zu verkaufen</h2>

        <?php include 'list.php'; ?>

        <div class="align-right">
            <a href="listings" class="button-green">Alle anzeigen</a>
        </div>
    </section>

    <section class="image-contact">
        <h2>Finde dein Traumhaus</h2>
        <p>Fülle das Formular aus und ein Berater wird sich schnell mit dir in Verbindung setzen.</p>
        <a href="contact.php" class="button-yellow">Jetzt kontaktieren</a>
    </section>
    <div class="container section section-lower">
        <section class="blog">
            <h3>Unser Blog</h3>

            <article class="entry-blog">
                <div class="image">
                    <picture>
                        <source srcset="build/img/blog1.avif" type="image/avif" />
                        <source srcset="build/img/blog1.webp" type="image/webp" />
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Bild Blog" />
                    </picture>
                </div>
                <div class="text-entry">
                    <a href="entry">
                        <h4>Eigene Terrasse zu Hause</h4>
                        <p class="meta-information">Verfasst von: <span>Admin</span> am: <span>22/05/2025</span></p>
                        <p>So baust du deine Traumterrasse – hochwertig und kostengünstig</p>
                    </a>
                </div>
            </article>
            <article class="entry-blog">
                <div class="image">
                    <picture>
                        <source srcset="build/img/blog2.avif" type="image/avif" />
                        <source srcset="build/img/blog2.webp" type="image/webp" />
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Bild Blog" />
                    </picture>
                </div>
                <div class="text-entry">
                    <a href="entry">
                        <h4>So richtest du dein Zuhause stilvoll ein</h4>
                        <p class="meta-information">Verfasst von: <span>Admin</span> am: <span>22/05/2025</span></p>
                        <p>Maximiere den Platz in deinem Zuhause mit diesem Leitfaden – lerne, Möbel und Farben zu kombinieren und bring Leben in deine Räume.</p>
                    </a>
                </div>
            </article>
        </section>

        <section class="opinions">
            <h3>Kundenmeinungen</h3>
            <div class="opinion">
                <blockquote>
                    Von der ersten Beratung bis zur Schlüsselübergabe war alles perfekt organisiert. Die Qualität der Ausstattung ist hervorragend, und die Terrasse mit Pool ist einfach traumhaft. Ich hätte mir kein besseres Zuhause wünschen können!
                    <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-quote"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" /><path d="M18 5a2 2 0 0 1 2 2v6c0 3.13 -1.65 5.193 -4.757 5.97a1 1 0 1 1 -.486 -1.94c2.227 -.557 3.243 -1.827 3.243 -4.03v-1h-3a2 2 0 0 1 -1.995 -1.85l-.005 -.15v-3a2 2 0 0 1 2 -2z" /></svg>
                </blockquote>
                <p>- Laura M., Berlin</p>
            </div>
        </section>
    </div>
</main>