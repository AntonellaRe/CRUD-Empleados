function getEmpleadoByid(id) {
    fetch(`./search/get_empleado_by_id.php?id=${id}`)
      .then(response => response.json())
      .then(data => {
        if (data.status_code === 200) {
          const empleado = data.empleado;
          document.getElementById('edit-id').value = empleado.id;
          document.getElementById('edit-name').value = empleado.name;
          if (empleado.active === "0") {
            document.getElementById('edit-active').checked = false;
          } else {
            document.getElementById('edit-active').checked = empleado.active;
          }

          document.getElementById('modal-id').textContent = empleado.id;

        } else {
          console.error('Empleado not found');
        }
      })
      .catch(error => console.error('Error fetching empleado:', error));
  }