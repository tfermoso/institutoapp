<section class="content">
    <h2>Matricular Alumn@s</h2>
    <div class="row">
        <div class="col-4">
            <div class="form-group">
                <label for="cursos">Selecciona un curso</label>
                <select class="form-control" id="curso" placeholder="Selecciona un curso">
                    <?= $optionsCursos ?>
                </select>
            </div>
        </div>
        <div class="col-8">
            <h4>Listado alumn@s</h4>
            <table class="table" id="tblAlumnos">
                <thead>
                    <tr>
                        <th scope="col">Expediente</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Matrículado</th>
                    </tr>
                </thead>
                <tbody id="listadoAlumnos">
                  
                </tbody>
            </table>
            <button class="btn btn-success btn-large">Guardar</button>
        </div>
    </div>
</section>