<?php

use Innaco\Entities\Template;

class TemplateTableSeeder extends Seeder {

	public function run()
	{

		$name = 'Solicitud de Transferencia';
		Template::create([
			'name'	=> $name,
			'body'	=> '<h3 style="text-align:center">Por medio de la presente, solicito transferencia especial por la cantidad de:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3><p> </p><h3 style="text-align:center">POR CONCEPTO DE:</h3><p> </p><h2 style="text-align:center">Correspondiente:</h2><h3 style="text-align:center">Sin mas por el momento,</h3>',
			'typedocuments_id' => 3,
			'available' => 1
		]);

		$name = 'Solicitud de Cheques';
		Template::create([
			'name'	=> $name,
			'body'	=> '<h1 style="text-align: center;">SOLICITUD EMISION DE CHEQUE</h1><h3 style="text-align: right;">FECHA:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3><h3>POR BSF:</h3><h3>SOLICITANTE:</h3><h3>A NOMBRE DE:</h3><h3>BENEFICIARIO:</h3><p> </p><h3>RELACION CON ORDEN DE COMPRA N°:</h3><h3>FACTURA N°:</h3><h3>CONCEPTO:</h3><p> </p><h3>CARGAR A CENTRO DE COSTO:</h3><h3>FIRMA:</h3><h3>ENTREGAR CHEQUE A:</h3><h3>OBSERVACIONES:</h3><p> </p><h3>ANEXOS:</h3><h3>APROBADO POR:</h3>',
		    'typedocuments_id' => 3,
			'available' => 1
		]);

		$name = 'Memorandum de Horas Extras';
		Template::create([
			'name'	=> $name,
			'body'	=> '<h1 style="text-align: center;">AUTORIZACION</h1><h3 style="text-align: center;">Trabajos de horas extraordinarias en el departamento.</h3><h3>Desde:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3><h3>Hasta:</h3><h3>Fecha:</h3><ol><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li></ol><p> </p><h3>Observaciones sobre las tareas realizadas:</h3><p> </p><p> </p><p> </p><h3>Supervisor responsable del grupo arriba mencionado</h3><p>Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Firma:</p><p>Recibido por:</p><p>Autorizado por:</p><p>Revisado por:</p><p> </p><p> </p><p> </p><h3> </h3>',
			'typedocuments_id' => 2,
			'available' => 1
		]);

		$name = 'Solicitud de Permisos';
		Template::create([
			'name'	=> $name,
			'body'	=> '<table border="1" cellpadding="1" cellspacing="1" style="height:93px; width:500px"><tbody><tr><td style="text-align: center;"><h3>AUTORIZACION DEL PERMISO</h3></td></tr><tr><td>CIUDAD Y FECHA:</td></tr><tr><td>EL TRABAJADOR:</td></tr></tbody></table><table border="1" cellpadding="1" cellspacing="1" style="height:31px; width:500px"><tbody><tr><td style="width: 242px;">C.I:</td><td style="width: 244px;">CARNET N°:</td></tr></tbody></table><p style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Esta autorizado para ausentarse del trabajo</p><table border="1" cellpadding="1" cellspacing="1" style="height:37px; width:498px"><tbody><tr><td><h3 style="text-align: center;">TIEMPO CONCENDIDO Y CONDICIONES</h3></td></tr></tbody></table><table border="1" cellpadding="1" cellspacing="1" style="height:79px; width:497px"><tbody><tr><td style="width: 55px; text-align: center;">Tiempo</td><td style="width: 77px; text-align: center;">Cant</td><td style="width: 77px; text-align: center;">Desde</td><td style="width: 100px; text-align: center;">Hasta</td><td style="width: 160px;"><p style="text-align: center;">Descontable sueldo/salario</p></td></tr><tr><td style="width: 55px;">Horas</td><td style="width: 77px;"> </td><td style="width: 77px;"> </td><td style="width: 100px;"> </td><td style="width: 160px;">SI ( )</td></tr><tr><td style="width: 55px;">Dias</td><td style="width: 77px;"> </td><td style="width: 77px;"> </td><td style="width: 100px;"> </td><td style="width: 160px;">NO( )</td></tr></tbody></table><table border="1" cellpadding="1" cellspacing="1" style="width:500px"><tbody><tr><td><h3 style="text-align: center;">MOTIVO DEL PERMISO Y OBSERVACIONES</h3></td></tr><tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr></tbody></table><table border="1" cellpadding="1" cellspacing="1" style="width:500px"><tbody><tr><td><h3 style="text-align: center;">CONTROL DEL TIEMPO DEL PERMISO</h3></td></tr></tbody></table><table border="1" cellpadding="1" cellspacing="1" style="width:500px"><tbody><tr><td style="text-align: center; width: 163px;">SALIDA</td><td style="text-align: center; width: 161px;">ENTRADA</td><td style="text-align: center; width: 158px;">FIRMA SUPERVISOR</td></tr></tbody></table><table border="1" cellpadding="1" cellspacing="1" style="width:500px"><tbody><tr><td style="width: 89px; text-align: center;">FECHA</td><td style="width: 69px; text-align: center;">HORA</td><td style="width: 84px; text-align: center;">FECHA</td><td style="width: 72px; text-align: center;">HORA</td><td style="width: 158px;" rowspan="5"> </td></tr><tr><td style="width: 89px;"> </td><td style="width: 69px;"> </td><td style="width: 84px;"> </td><td style="width: 72px;"> </td></tr><tr><td style="width: 89px;"> </td><td style="width: 69px;"> </td><td style="width: 84px;"> </td><td style="width: 72px;"> </td></tr><tr><td style="width: 89px;"> </td><td style="width: 69px;"> </td><td style="width: 84px;"> </td><td style="width: 72px;"> </td></tr><tr><td style="width: 89px;"> </td><td style="width: 69px;"> </td><td style="width: 84px;"> </td><td style="width: 72px;"> </td></tr></tbody></table><table border="1" cellpadding="1" cellspacing="1" style="width:500px"><tbody><tr><td colspan="4"><h3 style="text-align: center;">PARA USO DE NOMINA (PARA DESCONTAR)</h3></td></tr><tr><td style="text-align: center;">TIEMPO</td><td style="text-align: center; width: 113px;">CANTIDAD</td><td style="text-align: center; width: 130px;">BOLIVARES</td><td style="text-align: center; width: 115px;">TOTAL</td></tr><tr><td style="text-align: center;">DIAS</td><td style="width: 113px;"> </td><td style="width: 130px;"> </td><td style="width: 115px;"> </td></tr><tr><td style="text-align: center;">HORAS</td><td style="width: 113px;"> </td><td style="width: 130px;"> </td><td style="width: 115px;"> </td></tr><tr><td style="text-align: center;">MINUTOS</td><td style="width: 113px;"> </td><td style="width: 130px;"> </td><td style="width: 115px;"> </td></tr><tr><td colspan="3" rowspan="1" style="text-align: center; width: 371px;">TOTAL:</td><td style="width: 115px;"> </td></tr></tbody></table><table border="1" cellpadding="1" cellspacing="1" style="width:500px"><tbody><tr><td style="text-align: center;">Autorizado</td><td style="text-align: center; width: 100px;">Nomina</td><td style="text-align: center; width: 120px;">Contabilizado</td><td style="text-align: center; width: 157px;">Firma del trabajador</td></tr><tr><td><h3> </h3></td><td style="width: 100px;"> </td><td style="width: 120px;"> </td><td style="width: 157px;"><p> </p><p><span style="font-size:9px">C.I</span></p></td></tr></tbody></table><p> </p>',
			'typedocuments_id' => 3,
			'available' => 1
		]);

		$name = 'Constancia de Trabajo';
		Template::create([
			'name'	=> $name,
			'body'	=> '<p style="text-align:center"><span style="font-size:14px"><strong>CONSTANCIA</strong></span></p><p style="text-align:center"> </p><p style="text-align:justify"><span style="font-size:14px">&nbsp; &nbsp;Por medio de la presente se hace constar que el(la) ciudadano(a): _____________________________, portador de la cedula de identidad N°: V- _______________, realiza trabajos en nuestra empresa en el area de _______________________________, devengando un promedio mensual de _________________________________________________________________________________________ BsF.</span></p><p style="text-align:justify"> </p><p style="text-align:justify"> </p><p style="text-align:justify"><span style="font-size:14px">&nbsp; &nbsp;Constancia que se expide a solicitud de parte interesada y para los fines que estime convenientes, en Barquisimeto a los ___________ dias del mes de _______________________ del año __________. &nbsp;</span></p><p> </p><p style="text-align:justify"><span style="font-size:14px">&nbsp; &nbsp;</span></p><p> </p><p> </p><p> </p><p style="text-align:center"><span style="font-size:14px">Atentamente</span></p><p style="text-align:center"><span style="font-size:14px">______________________________</span></p><p style="text-align:center"> </p><p style="text-align:center"><span style="font-size:14px">Gerente de Recursos Humanos</span></p>',
			'typedocuments_id' => 1,
			'available' => 1
		]);

	}

}