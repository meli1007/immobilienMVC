document.addEventListener('DOMContentLoaded', function(){

    eventListeners();

    darkMode();
});

function darkMode() {

    const preferDarkMode = window.matchMedia('(prefers-color-scheme:dark)');

    // console.log(preferDarkMode);
    if(preferDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }

    preferDarkMode.addEventListener('change', function() {
        if(preferDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });

    const buttonDarkModus = document.querySelector('.dark-mode-button');
    buttonDarkModus.addEventListener('click', function() {
        //si la tiene la quita, y si no, la pone
        document.body.classList.toggle('dark-mode');
    });
}

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navigationResponsive);

    //show conditionals fields
    const methodContact = document.querySelectorAll('input[name="contact[contact]"]');
    methodContact.forEach(input => input.addEventListener('click', showMethodsContact));

}

function navigationResponsive() {
    const navigation = document.querySelector('.navigation');

    if(navigation.classList.contains('show')){
        navigation.classList.remove('show');
    }else {
        navigation.classList.add('show');
    }

    //another option
    //navigation.classList.toggle('show');
}

function showMethodsContact(e) {
    const contactDiv = document.querySelector('#contact');
    if(e.target.value === 'telefon') {
        contactDiv.innerHTML = `
            <label for="phone">Telefonnummer</label>
            <input id="phone" type="tel" placeholder="Telefonnummer" name="contact[phone]" />

            <p>Wählen Sie bitte das Datum und die Uhrzeit für die Kontaktaufnahme aus.</p>

            <label for="date">Datum:</label>
            <input id="date" type="date" name="contact[date]" />

            <label for="hour">Uhrzeit:</label>
            <input id="hour" type="time" min="08:00" max="16:30" name="contact[hour]" />
        `;
        const today = new Date().toISOString().split('T')[0];
        const dateInput = document.querySelector('#date');
        dateInput.setAttribute('min', today);
    } else {
        contactDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input id="email" type="email" placeholder="E-mail"  name="contact[email]" required />
        `;
    }
    
}