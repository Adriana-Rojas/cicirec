<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Página Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2018 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

?>

        		<!-- ============================================================== -->
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                <script type="text/javascript">
		         
			            
			 	</script>
                               
                
                <!-- ============================================================== -->
                <!-- FIn JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
        	
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" action="<?= base_url()?><?= $pagina ?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Relaci&oacute;n de estados </h4>
	                                <h6 class="card-subtitle">Identifique la relaci&oacute;n que tienen los estados</h6>
	                            </div>
	                            <div class="row">
                               		<!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?>  text-center">
                                                <h3 class="font-light text-white">Proceso</h3>
                                                <h6 class="text-white"><?= $proceso;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Tipo de orden</h3>
                                                <h6 class="text-white"><?= $tipo;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    <div class="col-md-2 col-lg-2 col-xlg-2">
                                        <div class="card">
                                            <div class="box <?= BG_BOX_INTERFACE;?> text-center">
                                                <h3 class="font-light text-white">Estado</h3>
                                                <h6 class="text-white"><?= $estado;?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                    
                                    <div class="col-md-3 col-lg-3 col-xlg-3">
                                        
                                    </div>
                                    <!-- Column -->
                                   
                                </div>
                               	<center>
                               	<div class="table-responsive col-8" >
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-active">
                                            <tr align="center" >
                                                <th width="55%">Estado</th>
                                                <th width="15%">Proceso normal</th>
                                                <th width="15%">Reproceso</th>
                                                <th width="15%">No aplica</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                        	if ($listEstado!=null){
                                        		foreach ($listEstado as $value) { 
                                        			//Verifico si esta en el la relación de estados
                                        			//Verifico si el estado es inicial y por tal razón no puede ser proceso normal
                                        			$tempoId=$this->FunctionsGeneral->getFieldFromTable("ORD_TORDPROEST","ID_ESTADO",$value->ID);
                                        			$tipoEstado=$this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS","TIPOESTADO",$tempoId);
                                        			if ($tipoEstado==1){
                                        				//Estado inicial no se puede llevar a proceso normal
                                        				$disabled1=true;
                                        			}else{
                                        				$disabled1=false;
                                        			}
                                        			if ($tipoEstado==3 || $tipoEstado==4){
                                        				//Estado inicial no se puede llevar a proceso normal
                                        				$disabled2=true;
                                        			}else{
                                        				$disabled2=false;
                                        			}
                                        			if($this->FunctionsGeneral->
                                        					getQuantityFieldFromTable(
                                        							"ORD_RELESTADO",
                                        							"ID_INICIO",
                                        							$idTordProEst,
                                        							"ID_FIN",
                                        							$value->ID,
                                        							"ORDEN",
                                        							CTE_PROCESO_NORMAL,
                                        							"ESTADO",
                                        							ACTIVO_ESTADO
                                        					)>0){
                                        				$selected1='checked="checked"';
                                        				$selected2='';
                                        				$selected3='';
                                        				
                                        			}else if($this->FunctionsGeneral->
                                        					getQuantityFieldFromTable(
                                        							"ORD_RELESTADO",
                                        							"ID_INICIO",
                                        							$idTordProEst,
                                        							"ID_FIN",
                                        							$value->ID,
                                        							"ORDEN",
                                        							CTE_PROCESO_REPROCESO,
                                        							"ESTADO",
                                        							ACTIVO_ESTADO
                                        					)>0){
                                        				$selected1='';
                                        				$selected2='checked="checked"';
                                        				$selected3='';
                                        			}else{
                                        				$selected1='';
                                        				$selected2='';
                                        				$selected3='checked="checked"';
                                        			}
                                            ?>
                                            
                                           
                                            <tr align="center">
                                                <td><?= $value->NOMBRE  ?></td>
                                                <td>
                                                	<?php 
                                                		if (! $disabled1){
                                                			
                                                	?>
                                                	<input type="radio"  name="estado<?= $value->ID;?>" value='1' <?= $selected1;?>  class="check" data-radio="iradio_square-blue" <?= $disabled1;?>>
                                                	<?php 
                                                		}?>
                                                </td>
                                                <td>
                                                	<?php 
                                                		if (! $disabled2){
                                                			
                                                	?>
                                                	<input type="radio"  name="estado<?= $value->ID;?>" value='-1' <?= $selected2;?> class="check" data-radio="iradio_square-blue" <?= $disabled2;?>>
                                                	<?php 
                                                		}?> 
                                                </td>
                                                <td>
                                                	<input type="radio"  name="estado<?= $value->ID;?>" value='0' <?= $selected3;?> class="check" data-radio="iradio_square-blue"> 
                                                </td>
                                            </tr>
                                           
                                            <?php
                                        		}
                                            }?>
                                        </tbody>
                                    </table>
                                </div>
                                </center>
	                        </div>
	                    </div>
	                    
	                    
	                </div>
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?>OrdersConfigurationStatesOrdersType/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
                            <input type="hidden" name="valida" id="valida" value="<?= $valida;?>">
	                	</div>   
	                	<div class="col-sm-12">
	                	<br>
	                	</div> 
	                </div>
	                <!-- FIN Botón de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
