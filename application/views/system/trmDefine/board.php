<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						P�gina Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

?>


<!-- BEGIN PAGE JQUERY ROUTINES -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-body">
				<h5 class="card-title"> Definici&oacute;n de TRM
					<small class="font-gray">Identifique el valor en pesos (COP) que aplica a ka TRM de acuerdo con el cambio actual</small>
				</h5>

				<div class="form-group">
					<label class="col-md-12" for="valor">Valor *</label>
					<div class="col-md-12">
						<input type="number" class="form-control" id="valor" name="valor" value="<?= $valor ?>" placeholder="Ejemplo. 3000" min="2500" max="6000">
						<div class="form-control-feedback"> </div>
					</div>
				</div>

				<form class=" form-horizontal" role="form" action="<?= base_url() ?>SystemTRMDefine/consultatrm" id="form_sample_3" method="post" autocomplete="off">
					<h5 style="color: navy;">TRM de hoy <?= $valor ?></h5>
					<div class="col-md-12">
						<input class="form-control input-limit-datepicker" type="date" name="date" id="date" />
						<div class="form-control-feedback"> </div>
						<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Consultar TRM</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Bot�n de envio de formulario -->
<form class=" form-horizontal" role="form" action="<?= base_url() ?>SystemTRMDefine/saveParameters" id="form_sample_3" method="post" autocomplete="off">

	<div class="row">
		<div class="col-sm-12">
			<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
		</div>
		<div class="col-sm-12">
			<br>
		</div>
	</div>
</form>
<!-- FIN Bot�n de envio de formulario -->

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
