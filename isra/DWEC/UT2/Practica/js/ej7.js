function adivinador() {
      const secreto = parseInt(prompt("Usuario 1: Introduce el número secreto (entre 1 y 100):"), 10);
      if (secreto < 1 || secreto > 100) {
        document.getElementById("mensaje").textContent = "Número inválido. Debe estar entre 1 y 100.";
        return;
      }

      let intentos = 6;
      let adivinanza;

      while (intentos > 0) {
        adivinanza = parseInt(prompt(`Usuario 2: Adivina el número secreto. Te quedan ${intentos} intento(s):`), 10);

        if (adivinanza === secreto) {
          document.getElementById("mensaje").textContent = `¡Correcto! El número secreto era ${secreto}.`;
          return;
        } else if (adivinanza < secreto) {
          alert("El número secreto es mayor.");
        } else {
          alert("El número secreto es menor.");
        }

        intentos--;
      }

      document.getElementById("mensaje").textContent = `¡Oh no! Se acabaron los intentos. El número secreto era ${secreto}.`;
    }