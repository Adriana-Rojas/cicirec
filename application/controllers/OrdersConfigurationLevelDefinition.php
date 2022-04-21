<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para definir los diferentes tipos de árboles (clases de ordenes).
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class OrdersConfigurationLevelDefinition extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		// Cargo modelos, librerias y helpers
		$this->load->model ( 'OrdersModel' ); // Libreria principal de las funciones referentes a órdenes
	}
	
	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA PINTAR FORMULARIOS
	 * ****************************************************************************************************** *
	 */
	public function board() {
		/**
		 * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
		 */
		
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationLevelDefinition/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
			$mainPage = "OrdersConfigurationLevelDefinition/board";
			$data = null;
			// Pinto la cabecera principal de las páginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			// Pinto la información de los parametros de la aplicación
			
			/**
			 * Información relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data ['mainPage'] = $mainPage;
			$data ['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId ( "ADM_MODULO", "ID", "PAGINA", $mainPage );
			$data ['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard ( $this->session->userdata ( 'usuario' ), 'board', $idModule, VIEW_LIST_PERMISSION );
			$data ['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard ( $this->session->userdata ( 'usuario' ), 'board', $idModule, VIEW_BUTTON_PERMISSION );
			
			// Lista de listas
			$data ['listaLista'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_DATOSNIV" );
			
			// Pinto plantilla principal
			// Pinto la lista genérica de parametros que se debe tener en cuenta dentro del sistema de parámetros
			$this->load->view ( 'common/boards/board', $data );
			
			/**
			 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
			 */
			
			// Pinto el final de la página (páginas internas)
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	public function newRegister() {
		/**
		 * Formulario para crear un nuevo registro del parametro
		 */
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationLevelDefinition/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Cargo la página principal
			$mainPage = "OrdersConfigurationLevelDefinition/board";
			$data = null;
			// Pinto la cabecera principal de las páginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			
			/**
			 * Información relacionada con la plantilla principal Pinto la pantalla *
			 */
			
			// Inicializo variables de la vista
			$data ['valida'] = $this->encryption->encrypt ( 'newRegister' );
			$data ['id'] = null;
			$data ['nombre'] = null;
			$data ['detLista'] = null;
			$data ['mainPage'] = $mainPage;
			
			// Listado de miembros
			$data ['listaMiembros'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_MIEMBROS", 'DESC' );
			$data ['valorMiembros'] = null;
			
			// Lista de valida códigos
			$data ['listaValida'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_VALIDA", 'DESC' );
			$data ['valorValida'] = null;
			
			// Lista de valida códigos
			$data ['listaSubnivel'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'LISTA_SUBNIVELES', '1' );
			$data ['valorSubnivel'] = null;
			
			// Cargo vista
			$this->load->view ( 'orders/configuration/formLevelDefinition', $data );
			// Cargo validación de formulario
			$this->load->view ( 'validation/orders/configuration/ordersConfigurationLevelDefinitionValidation' );
			
			/**
			 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
			 */
			
			// Pinto el final de la página (páginas internas)
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	public function edit($id) {
		/**
		 * Formulario para editar la información previamente creada para el parametro de la aplicación
		 */
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationLevelDefinition/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_DATOSNIV", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				// Pinto las vistas adicionales a través de la función showCommon del helper
				$mainPage = "OrdersConfigurationLevelDefinition/board";
				$data = null;
				// Pinto la cabecera principal de las páginas internas
				showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
				
				/**
				 * Información relacionada con la plantilla principal Pinto la pantalla *
				 */
				
				// Inicializo variables de la vista
				$data ['valida'] = $this->encryption->encrypt ( 'edit' );
				$data ['id'] = $this->encryption->encrypt ( $id );
				$data ['nombre'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_DATOSNIV", "NOMBRE", $id );
				// Verifico la cantidad de registros que fueron creados anteriormente
				$data ['detLista'] = $this->OrdersModel->getListValueLevelDefinitionDetail ( $id );
				$data ['mainPage'] = $mainPage;
				
				// Listado de miembros
				$data ['listaMiembros'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_MIEMBROS", 'DESC' );
				$data ['valorMiembros'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_DATOSNIV", "ID_MIEMBROS", $id );
				
				// Lista de valida códigos
				$data ['listaValida'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_VALIDA", 'DESC' );
				$data ['valorValida'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_DATOSNIV", "ID_VALIDA", $id );
				
				// Lista de valida códigos
				$data ['listaSubnivel'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'LISTA_SUBNIVELES', '1' );
				$data ['valorSubnivel'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_DATOSNIV", "NIVEL", $id );
				
				// Cargo vista
				$this->load->view ( 'orders/configuration/formLevelDefinition', $data );
				// Cargo validación de formulario
				$this->load->view ( 'validation/orders/configuration/ordersConfigurationLevelDefinitionValidation' );
				
				/**
				 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
				 */
				
				// Pinto el final de la página (páginas internas)
				showCommonEnds ( $this, null, null );
			} else {
				// Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la página
				redirect ( base_url () . "OrdersConfigurationLevelDefinition/board" );
			}
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	
	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA GUARDAR INFORMACIÒN
	 * ****************************************************************************************************** *
	 */
	public function saveRegister() {
		/**
		 * Guardo la información del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
		 */
		$mainPage = "OrdersConfigurationLevelDefinition/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Página principal a donde debo retornar
			$mainPage = "OrdersConfigurationLevelDefinition/board";
			$nombre = $this->security->xss_clean ( $this->input->post ( 'nombre' ) );
			
			if ($this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'valida' ) ) ) == 'newRegister') {
				if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_DATOSNIV", "NOMBRE", $nombre ) == 0) {
					// Creo el registro general
					$encLevel = $this->OrdersModel->insertLevelHead ( $this->security->xss_clean ( $this->input->post ( 'miembros' ) ), $this->security->xss_clean ( $this->input->post ( 'valorValida' ) ), $nombre, $this->security->xss_clean ( $this->input->post ( 'subnivel' ) ), $this->session->userdata ( 'usuario' ) );
					// Relaciono el mensaje respectivo
					$mensaje = "configUpdate";
				} else {
					// Creo mensaje de creaciòn de usuario
					$mensaje = "ConfigExist";
				}
			} else {
				$encLevel = $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) );
				// Actualizo cabeza de la definición del nivel
				$this->OrdersModel->updateLevelHead ( $encLevel, $this->security->xss_clean ( $this->input->post ( 'miembros' ) ), $this->security->xss_clean ( $this->input->post ( 'valorValida' ) ), $nombre, $this->security->xss_clean ( $this->input->post ( 'subnivel' ) ), $this->session->userdata ( 'usuario' ) );
				// Relaciono el mensaje respectivo
				$mensaje = "configUpdate";
			}
			// Inserto el detalle de la información del nivel
			if ($mensaje != 'ConfigExist') {
				// Elimino relaciones si existen
				// $this->OrdersModel->deleteLevelDetail($encLevel);
				$this->FunctionsGeneral->updateByField ( "ORD_DATOSNIVVAL", "ESTADO", INACTIVO_ESTADO, 'ID_DATOSNIV', $encLevel, $this->session->userdata ( 'usuario' ) );
				// Creo el detalle de la lista asociada a la relación
				$registros = $this->security->xss_clean ( $this->input->post ( 'registros' ) );
				for($i = 1; $i <= $registros; $i ++) {
					// Verifico si el registro ya existe, en caso que exista se actualiza el valor del mismo pasando el estado a activo
					if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_DATOSNIVVAL", 'ID_DATOSNIV', $encLevel, "NOMBRE", $this->security->xss_clean ( $this->input->post ( 'valor' . $i ) ) ) == 0) {
						// Realizó el insert
						$id = $this->OrdersModel->insertLevelBody ( $encLevel, $this->security->xss_clean ( $this->input->post ( 'valor' . $i ) ), $this->session->userdata ( 'usuario' ) );
					} else {
						// Actualizo
						$this->FunctionsGeneral->updateByField ( "ORD_DATOSNIVVAL", "ESTADO", ACTIVO_ESTADO, 'ID_DATOSNIV', $encLevel, $this->session->userdata ( 'usuario' ), "NOMBRE", $this->security->xss_clean ( $this->input->post ( 'valor' . $i ) ) );
					}
				}
			}
			// Creo los valores asociados a la relación
			// Pinto mensaje para retornar a la aplicación
			$this->session->set_userdata ( 'id', $nombre );
			$this->session->set_userdata ( 'auxiliar', $mensaje );
			// Redirecciono la página
			redirect ( base_url () . $mainPage );
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	public function inactive($id) {
		/**
		 * Inactivo el registro para el cual se tiene asociado el valor $id
		 */
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationLevelDefinition/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Página principal a donde debo retornar
			$mainPage = "OrdersConfigurationLevelDefinition/board";
			
			// Cargo información de la lista teniendo en cuenta el id dado
			// Obtengo el id del contacto
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_DATOSNIV", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				$estado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_DATOSNIV", "ESTADO", $id );
				if ($estado == 'S') {
					$estado = 'N';
				} else if ($estado == 'N') {
					$estado = 'S';
				}
				$message = 'changeStateGeneral';
				$this->FunctionsGeneral->updateByID ( "ORD_DATOSNIV", "ESTADO", $estado, $id, $this->session->userdata ( 'usuario' ) );
				// Pinto mensaje para retornar a la aplicación
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', $message );
				// Redirecciono la página
				redirect ( base_url () . $mainPage );
			} else {
				// Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la página
				redirect ( base_url () . $mainPage );
			}
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
}

?>