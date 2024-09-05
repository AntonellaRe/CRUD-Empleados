function getEmpleados() {
fetch('./search/get_empleados.php')
.then(response => response.json())
.then(data => {
  if (data.data && data.data.status_code === 200) {
    const empleados = data.data.empleados;
    const tableBody = document.getElementById('empleado-table-body');
    tableBody.innerHTML = '';

    empleados.forEach((empleado, index) => {
      const row = document.createElement('tr');
      var active = false
      if (empleado.active === "0") {
        active = false
      } else {
        active = true
      }
      row.innerHTML = `
          <th scope="row">${index + 1}</th>
          <td>${empleado.name}</td>
          <td><img src="${empleado.avatar}" alt="Avatar of ${empleado.name}" width="50"></td>
          <td>${active ? 'Activo' : 'Inactivo'}</td>
          <td><i class="material-icons btn-edit" data-id="${empleado.id}" style="color:#000;cursor:pointer;font-size:30px;margin-left:35px;" data-bs-toggle="modal" data-bs-target="#editModal" onclick="getEmpleadoByid('${empleado.id}')">edit</i></a> </td>
           <td><i class="material-icons btn-delete" data-id="${empleado.id}" style="color:#000;cursor:pointer;font-size:30px;margin-left:35px;" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="confirmDelete('${empleado.id}')">delete</i></a> </td>
          
          `;

      tableBody.appendChild(row);
    });
  } else {
    console.error('Error al cargar los datos');
  }
})
.catch(error => console.log('Error en la solicitud:', error));
//console.log(error)
}
//});