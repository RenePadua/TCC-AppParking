<?php
session_start();
require 'dbcon.php';
?>



<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fatec Parking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	
  </head>
  <body> 
  
  <?php include('header.php'); ?>
  
	<div class="container-fluid text-center">
  <h1>Entrada de Veículos</h1>


  <button
    type="button"
    class="btn btn-primary"
    data-bs-toggle="modal"
    data-bs-target="#exampleModal"
  >
    Cadastrar veículo
  </button>
</div>

<div
  class="modal fade"	
  id="exampleModal"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cadastro de veículos</h5>
        <button
          type="button"
          class="btn-close btn-close-white"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <form [formGroup]="form">
        <div class="modal-body">
          <div class="form-group col-md-6">
            <label for="placa" id="placa" name="placa"> Placa </label>
            <input
              type="text"
              placeholder="XXX-0000"
              class="form-control"
              id="placa"
              formControlName="placa"
            />
			
           <label for="tipo" class="form-label"> Tipo de Veículo </label>
		   <select class="form-control" name="verRelTipo">
			  <option value='' disabled selected>Selecione o tipo</option>
			<datalist id="opcTipo">
              <option value="Carro">Carro</option>
              <option value="Moto">Moto</option>
            </datalist>
			</select>
			
			
			
			

<?php



$query = $conexao->prepare("SELECT * FROM `marca` ORDER BY cd_Marca ASC");

$query->execute();

echo "<form method='POST' action='paraondevai.php'>";

echo "<label for='marca' class='form-label' id='marca'> Marca </label>";
echo "<select class='form-control' name='verRelMarca'>";

echo "<option value='' disabled selected>Selecione a marca</option>";
echo "<datalist>";




while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {

		echo "<option>" . $linha['nm_Marca'] . "</option>";

	}

echo "</datalist>";

?>

</select>

            <label for="modelo" class="form-label"> Modelo </label>
            <input
              type="text"
              placeholder="Inserir modelo do carro"
              class="form-control"
              id="modelo"
              formControlName="modelo"
            />

            <label for="cor" class="form-label"> Cor </label>
            <input
              class="form-control"
              list="opcCor"
              id="cor"
              placeholder="Cor do veículo"
              formControlName="cor"
            />
            <datalist id="opcCor">
              <option value="..Outros"></option>
              <option value="Amarelo"></option>
              <option value="Azul"></option>
              <option value="Branco"></option>
              <option value="Cinza"></option>
              <option value="Marrom"></option>
              <option value="Prata"></option>
              <option value="Preto"></option>
              <option value="Verde"></option>
              <option value="Vermelho"></option>
            </datalist>


          </div>
        </div>

        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-success"
            data-bs-dismiss="modal"
            (click)="criarEntrada()"
          >
            Salvar
          </button>
          <button
            type="button"
            class="btn btn-danger"
            data-bs-dismiss="modal"
            aria-label="Close"
          >
            Cancelar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


	</div>
	
	
  </body>
</html>