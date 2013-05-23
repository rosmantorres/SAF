<h1>Nueva agenda convocatoria</h1>

<?php include_partial('form', array('form' => $form)) ?>

<label>Fecha de inicio</label>
<input type="date" value="">
<label>Fecha de fin</label>
<input type="date" value="">
<button class="btn btn-small btn-primary" type="button">Filtrar</button>

<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        Eventos filtrados segun criterios
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse">
      <div class="accordion-inner">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>NUM_F328</th>
              <th>...</th>
              <th>check</th>
            </tr>
          </thead>
          <tbody>
            <tr class="success">
              <td>PROGRAMADA</td>
              <td>...</td>
              <td>...</td>
            </tr>
            <tr class="error">
              <td>IMPREVISTA</td>
              <td>...</td>
              <td>...</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        Eventos restantes
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner">
        Anim pariatur cliche...
      </div>
    </div>
  </div>
</div>