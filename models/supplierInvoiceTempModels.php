<?php
//include '../config/conexion.php';
/***supplier_invoice_temp***/
class supplierInvoiceTemp{

	protected $id;
	protected $codigo_documento;
	protected $supplier;
	protected $dinero;
	protected $id_servicio;
	protected $nota;
	protected $usuario;
	protected $fecha_creacion;
	protected $estatus;




	public function __construct($codigo_documento,$supplier,$dinero,$id_servicio,$nota,$usuario,$fecha_creacion,$estatus,$id = ''){

		$db = new Conexion();
		$this->id = $id;
		$this->codigo_documento = $codigo_documento;
		$this->supplier = $supplier;
		$this->dinero = $dinero;
		$this->id_servicio = $id_servicio;
		$this->nota = $nota;
		$this->usuario = $usuario;
		$this->fecha_creacion = $fecha_creacion;
		$this->estatus = $estatus;
		$db->close();
	}

	static function ningunSupplierTemp(){
		return new self('','','','','','','','','');
	}

	public function InsertTablaTempSupplier(){
		$db = new Conexion();
		$sql="INSERT INTO supplier_invoice_temp(codigo_documento, supplier, dinero, id_servicio, nota, usuario, fecha_creacion, estatus) VALUES ('$this->codigo_documento','$this->supplier','$this->dinero','$this->id_servicio','$this->nota','$this->usuario','$this->fecha_creacion',1)";
		$db->query($sql);

		$db->close();

	}

	public function SelectSupplierTablaTemp(){
		$db = new Conexion();
		$sql="SELECT b.id as codigo_ser, a.id as id, a.id_servicio,a.supplier,a.dinero,a.nota,b.descripcion
			  FROM supplier_invoice_temp a 
			  JOIN servicios_catalogo b ON b.id=a.id_servicio 
			  WHERE a.codigo_documento='$this->codigo_documento'
			  AND a.usuario='$this->usuario'";
		
		$result = $db->query($sql);

		$db->close();

		return $result;
	}
	public function EliminarSupplierTablaTemp(){
		$db = new Conexion();
		$sql="DELETE FROM supplier_invoice_temp WHERE id=$this->id";
		$result = $db->query($sql);

		$db->close();
		
	}
}
?>