<?php 
//include '../config/conexion.php';
/***docket_invoice_delete***/
class DocketInvoiceDelete{
	
	protected $id;
	protected $codigo_docket;
	protected $codigo_invoice;
	protected $codigo_usuario;
	protected $tipo;
	protected $detalle;
	protected $usuario;
	protected $fecha_creacion;
	protected $estatus;
	
	
	public function __construct($codigo_docket,$codigo_invoice,$codigo_usuario,$tipo,$detalle,$usuario,$fecha_creacion,$estatus,$id = ''){
		
		$db = new Conexion();

		$this->id = $id;
		$this->codigo_docket = $codigo_docket;
		$this->codigo_invoice = $codigo_invoice;
		$this->codigo_usuario = $codigo_usuario;
		$this->tipo = $tipo;
		$this->detalle = $detalle;
		$this->usuario = $usuario;
		$this->fecha_creacion = $fecha_creacion;
		$this->estatus = $estatus;
		
	}

	static function solo(){
		return new self('','','','','','','','','','');
	} 

	static function soloCodigo($codigo){
		return new self($codigo,'','','','','','','','','');
	}
	public function InsertDocketInvoice()
	{
		$db = new Conexion();
		$sql="INSERT INTO docket_invoice_delete (codigo_docket, codigo_invoice, codigo_usuario, tipo, detalle, usuario, fecha_creacion, estatus) VALUES ('$this->codigo_docket','$this->codigo_invoice', '$this->codigo_usuario','$this->tipo','$this->detalle','$this->usuario','$this->fecha_creacion','5')";
		$db->query($sql) or trigger_error("ERROR insertando en la tabla eliminados");
	}
	//lista de los archos eleiminados entre (documentos y facturas del documento)
	public function ListDocketInvoice(){
		$db = new Conexion();
		$sql="SELECT * FROM docket_invoice_delete a JOIN usuarios b ON b.id_usuario=a.usuario WHERE estatus = '5'";
		$result = $db->query($sql) or trigger_error("ERROR Selecionando docuemntos y facturas eliminadas");
		return $result;
	}
}
?>