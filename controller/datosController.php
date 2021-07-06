<?php

	class Escrituras
	{
		private $dataEscritura;

		function DatosEscrituras($numero)
	    {
	        require_once '../model/EscrituraClass.php';
	        $recojo = new EscrituraClass();
	        $data = $recojo->Escrituras($numero);

		    return $data;
	    }

	    function Notario(){
	    	require_once '../model/NotariosClass.php';
	    	$notario = new NotariosClass();
	    	$nombreNotario = $notario->VerNotario($this->dataEscritura[0]);
	    	return $nombreNotario;
	    }

	    function otros(){


	        require_once '../model/DistritoClass.php';
	          require_once '../model/SubserieClass.php';
	          require_once '../model/NombresClass.php';
	          require_once '../model/TrabajadorClass.php';
	          require_once '../model/NombreJuridicosClass.php';


	          $distritos = new DistritoClass();
	          $subserie = new SubserieClass();
	          $nombre = new NombresClass();
	          $trabajador = new TrabajadorClass();
	          $nombreJuridico = new NombreJuridicosClass();

	          $this->dataEscritura = $dataEscrituras->fetch_array();

	          return $this->dataEscritura;
	    }
    }


 ?>