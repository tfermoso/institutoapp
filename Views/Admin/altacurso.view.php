 <!-- Main content -->
 <section class="content">
          <h2>Gestión Cursos</h2>
          <hr>
          <h4>Nuevo Curso</h4>
          <form class="row" method="post">
              <div class="form-group col-6">
                  <label for="codigo">Codigo </label>
                  <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del Curso">
              </div>
              <div class="form-group col-6">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de Curso">
              </div>
              <div class="form-group col-6">
                  <label for="profesor">Profesor del curso</label>
                  <select class="form-control" id="profesor" name="idprofesores" placeholder="Profesor de Curso">
                  <?= $optionsProfesores ?>  
                </select>
              </div>
              <div class="form-group col-6">
                  <label for="delegado">Delegado del curso</label>
                  <select class="form-control" id="delegado" name="idalumnos" placeholder="Delegado del Curso">
                  <?= $optionsAlumnos ?>  
                </select>
              </div>
              
              <button type="submit" class="btn btn-primary col-12">Guardar</button>
          </form>

      </section>
      <!-- /.content -->