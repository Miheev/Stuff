<?
require_once("dompdf/dompdf_config.inc.php");

$html =
'<html><meta http-equiv="content-type" content="text/html; charset=utf-8" /><body>'.
'<p>Теперь решим проблему с шрифтами в domPDF!</p>'.
'</body></html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('bto_to.pdf'); // Выводим результат (скачивание)
$output = $dompdf->output();
?>