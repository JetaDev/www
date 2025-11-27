
    function guardarCookie() {
      let nombre = document.getElementById("nombre").value;
      let fechaExpiracion = new Date("2099-01-01").toUTCString();
      document.cookie = `nombre=${nombre};expires=${fechaExpiracion};path=/`;
    }

    function leerCookie() {
      let cookies = document.cookie.split("; ");
      for (const cookie of cookies) {
        let [clave, valor] = cookie.split("=");
        if (clave === "nombre") return valor;
      }
      return "";
    }

    function guardarDatos() {
      guardarCookie();
      localStorage.setItem("edad", document.getElementById("edad").value);
      localStorage.setItem("nacionalidad", document.getElementById("nacionalidad").value);
      localStorage.setItem("tel", document.getElementById("tel").value);
      localStorage.setItem("correo", document.getElementById("correo").value);
      document.getElementById("mensaje").textContent = "Datos guardados correctamente";
      actualizarOpcionesLocalStorage();
    }

    function leerDatos() {
      document.getElementById("nombre").value = leerCookie();
      document.getElementById("edad").value = localStorage.getItem("edad") || "";
      document.getElementById("nacionalidad").value = localStorage.getItem("nacionalidad") || "";
      document.getElementById("tel").value = localStorage.getItem("tel") || "";
      document.getElementById("correo").value = localStorage.getItem("correo") || "";
      actualizarOpcionesLocalStorage();
    }

    function borrarCookie() {
      document.cookie = "nombre=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
      document.getElementById("mensaje").textContent = "Cookie borrada";
    }

    function borrarLocalStorage() {
      localStorage.clear();
      document.getElementById("mensaje").textContent = "localStorage borrado";
      actualizarOpcionesLocalStorage();
      document.getElementById("valorCampo").textContent = "";
    }

    function actualizarOpcionesLocalStorage() {
      const select = document.getElementById("claveEliminar");
      select.innerHTML = "";
      for (let i = 0; i < localStorage.length; i++) {
        const clave = localStorage.key(i);
        const option = document.createElement("option");
        option.value = clave;
        option.textContent = clave;
        select.appendChild(option);
      }
      mostrarValorCampo();
    }

    function mostrarValorCampo() {
      const clave = document.getElementById("claveEliminar").value;
      const valor = localStorage.getItem(clave);
      document.getElementById("valorCampo").textContent = valor ? `Valor actual: ${valor}` : "";
    }

    function eliminarCampo() {
      const clave = document.getElementById("claveEliminar").value;
      if (clave) {
        localStorage.removeItem(clave);
        document.getElementById("mensaje").textContent = `Campo "${clave}" eliminado de localStorage`;
        actualizarOpcionesLocalStorage();
        document.getElementById("valorCampo").textContent = "";
      } else {
        document.getElementById("mensaje").textContent = "Selecciona una clave válida";
      }
    }

    window.onload = leerDatos;