
    let countdown = 8;
    const countdownEl = document.getElementById("countdown");
    const buttons = document.querySelectorAll("button[type='submit']");
    const form = document.querySelector("form");

    const timer = setInterval(() => {
        countdown--;
        countdownEl.textContent = countdown;

        if (countdown <= 0) {
            clearInterval(timer);
            // Se non è stata ancora selezionata una risposta, invia il form
            if (!form.querySelector("button:disabled")) {
                // Simula una risposta vuota o automatica
                const hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "answer";
                hiddenInput.value = ""; // Risposta vuota
                form.appendChild(hiddenInput);
                form.submit();
            }
        }
    }, 1000);

    // Disattiva il timer quando l’utente clicca una risposta
    buttons.forEach(button => {
        button.addEventListener("click", () => {
            clearInterval(timer);

            // Nasconde il timer alla risposta
            document.getElementById("timer").style.display = "none";
        });
    });
