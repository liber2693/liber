<?php 
//include '../config/conexion.php';
/***invoices_services_temp***/
class invoicesServicesTemp{

	protected $id;
	protected $codigo_documento;
	protected $id_servico;
	protected $pago_us;
	protected $pago_can;
	protected $nota;
	protected $usuario;
	protected $fecha_registro;
	
	


	public function __construct($codigo_documento,$id_servico,$pago_us,$pago_can,$nota,$usuario,$fecha_registro,$id = ''){
		
		$db = new Conexion();
		$this->id = $id;
		$this->codigo_documento = $codigo_documento;
		$this->id_servico = $id_servico;
		$this->pago_us = $pago_us;
		$this->pago_can = $pago_can;
		$this->nota = $nota;
		$this->usuario = $usuario;
		$this->fecha_registro = $fecha_registro;
		
	}

	static function ningunServicio(){
		return new self('','','','','','','','');
	} 

	public function InsertTablaTempServi(){
		$db = new Conexion();
		$sql="INSERT INTO invoices_services_temp(codigo_documento,id_servico,pago_us,pago_can,nota, usuario,fecha_registro)
			VALUES ('$this->codigo_documento','$this->id_servico','$this->pago_us','$this->pago_can','$this->nota','$this->usuario','$this->fecha_registro')";
		$db->query($sql);
	}

	public function SelectServicosTablaTemp(){
		$db = new Conexion();
		$sql="SELECT b.id as codigo_ser, a.id as id,a.id_servico,a.pago_us,a.pago_can,a.nota,b.descripcion,a.fecha_registro FROM invoices_services_temp a JOIN servicios_catalogo b ON b.id=a.id_servico WHERE a.codigo_documento='$this->codigo_documento' AND a.usuario='$this->usuario'";
		$result = $db->query($sql);
		return $result;
	}
	public function EliminarServicioTablaTemp(){
		$db = new Conexion();
		$sql="DELETE FROM invoices_services_temp WHERE id=$this->id";
		$result = $db->query($sql);
	}
}
?>