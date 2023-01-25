var url_base = window.location.origin + "/" + window.location.pathname.split("/")[1];
window.onload = () => {
    $("#curso").change(() => {
        let idcurso = $("#curso").val();
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
                        <td><input type="checkbox" ${alumno.Matriculado?'checked':''}></td>
                    </tr>
                    `;
                    listaAlumnos+=thAlumno;
                });
                $("#listadoAlumnos").html(listaAlumnos);
                $('#tblAlumnos').DataTable();
            },
            error: (err) => {
                console.log(err);
            }
        })
    })
}