var url_base = window.location.origin + "/" + window.location.pathname.split("/")[1];
window.onload = () => {
    $("#curso").change(() => {
        let idcurso = $("#curso").val();
        if (idcurso == "") {
            $("#listadoAlumnos").html('');
            $('#tblAlumnos').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                }
            });
        } else {


            $.ajax({
                url: url_base + "/api/alumnoscurso/" + idcurso,
                success: (datos) => {
                    let alumnos = JSON.parse(datos);
                    let listaAlumnos = "";
                    alumnos.forEach(alumno => {
                        let thAlumno = `
                    <tr>
                        <th scope="row">${alumno.expediente}</th>
                        <td>${alumno.nombre}</td>
                        <td>${alumno.apellidos}</td>
                        <td><input type="checkbox" ${alumno.Matriculado ? 'checked' : ''}></td>
                    </tr>
                    `;
                        listaAlumnos += thAlumno;
                    });
                    $("#listadoAlumnos").html(listaAlumnos);
                    $('#tblAlumnos').DataTable({
                        "language": {
                            "url": url_base+"/Assets/i18n/Spanish.json"
                        }
                    });
                },
                error: (err) => {
                    console.log(err);
                }
            })
        }
        
    })
}