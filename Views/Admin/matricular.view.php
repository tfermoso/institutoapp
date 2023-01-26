<section class="content">
    <h2>Matricular Alumn@s</h2>
    <div class="row">
        <div class="col-md-4 col-sm-12">
            <div class="form-group">
                <label for="cursos">Selecciona un curso</label>
                <select class="form-control" id="curso" placeholder="Selecciona un curso">
                    <?= $optionsCursos ?>
                </select>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
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
            <button class="btn btn-success col-12">Guardar</button>
        </div>
    </div>
</section>