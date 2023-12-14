<?php
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;

class GenPdf
{
    public function __construct()
    {
    }
    public function genPdf()
    {
        $html = '<!DOCTYPE html
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
        
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>file_1702322513683</title>
            <style type="text/css">
                * {
                    margin: 0;
                    padding: 0;
                    text-indent: 0;
                }
                .s1 {
                    color: black;
                    font-family: Arial, sans-serif;
                    font-style: normal;
                    font-weight: normal;
                    text-decoration: none;
                    font-size: 12pt;
                }
        
                h1 {
                    color: black;
                    font-family: Arial, sans-serif;
                    font-style: normal;
                    font-weight: bold;
                    text-decoration: none;
                    font-size: 12pt;
                }
        
                .p,
                p {
                    color: black;
                    font-family: Arial, sans-serif;
                    font-style: normal;
                    font-weight: normal;
                    text-decoration: none;
                    font-size: 12pt;
                    margin: 0pt;
                }
        
                .s2 {
                    color: black;
                    font-family: "Times New Roman", serif;
                    font-style: normal;
                    font-weight: bold;
                    
                    font-size: 12pt;
                }
        
                .s3 {
                    color: black;
                    font-family: Arial, sans-serif;
                    font-style: normal;
                    font-weight: normal;
                    text-decoration: none;
                    font-size: 14pt;
                }
        
                .s4 {
                    color: #212121;
                    font-family: Arial, sans-serif;
                    font-style: normal;
                    font-weight: bold;
                    text-decoration: none;
                    font-size: 12pt;
                }
        
                .s5 {
                    color: black;
                    font-family: Arial, sans-serif;
                    font-style: italic;
                    font-weight: normal;
                    text-decoration: none;
                    font-size: 9pt;
                }
        
                .s6 {
                    color: black;
                    font-family: Arial, sans-serif;
                    font-style: normal;
                    font-weight: normal;
                    text-decoration: none;
                    font-size: 10pt;
                }
        
                li {
                    display: block;
                }
        
                #l1 {
                    padding-left: 0pt;
                }
        
                #l1>li>*:first-child:before {
                    content: "- ";
                    color: black;
                    font-family: Arial, sans-serif;
                    font-style: normal;
                    font-weight: normal;
                    text-decoration: none;
                    font-size: 10pt;
                }
        
                table,
                tbody {
                    vertical-align: top;
                    overflow: visible;
                }
            </style>
        </head>
        
        <body>
            <table style="width: 98%;border-collapse:collapse;margin-left: 6.375pt;" cellspacing="0">
                <tr style="height:33pt">
                    <td style="width:63pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                        rowspan="4">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                        <p style="padding-left: 4pt;text-indent: 0pt;text-align: left;"><span>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><img width="74" height="76"
                                                src="data:image/jpg;base64,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" />
                                        </td>
                                    </tr>
                                </table>
                            </span></p>
                    </td>
                    <td
                        style="width:193pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s1" style="padding-top: 9pt;padding-left: 24pt;text-indent: 0pt;text-align: left;">IES LAS
                            FUENTEZUELAS</p>
                    </td>
                    <td
                        style="width:144pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s1" style="padding-top: 9pt;padding-left: 28pt;text-indent: 0pt;text-align: left;">Fecha:
                            12-11-23</p>
                    </td>
                    <td
                        style="width:90pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                        <p style="padding-left: 10pt;text-indent: 0pt;text-align: left;"><span>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><img width="93" height="38"
                                                src="data:image/jpg;base64,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" />
                                        </td>
                                    </tr>
                                </table>
                            </span></p>
                    </td>
                </tr>
                <tr style="height:18pt">
                    <td style="width:337pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt"
                        colspan="2" rowspan="3">
                        <p style="text-indent: 0pt;text-align: left;"><br /></p>
                        <p class="s1" style="padding-left: 84pt;text-indent: 0pt;text-align: left;">INSTANCIA A LA DIRECCIÓN</p>
                    </td>
                    <td
                        style="width:90pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s1"
                            style="padding-top: 2pt;padding-left: 5pt;padding-right: 5pt;text-indent: 0pt;text-align: center;">
                            MD740112RG</p>
                    </td>
                </tr>
                <tr style="height:15pt">
                    <td
                        style="width:90pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s1"
                            style="padding-left: 5pt;padding-right: 5pt;text-indent: 0pt;line-height: 13pt;text-align: center;">
                            Versión 0</p>
                    </td>
                </tr>
                <tr style="height:14pt">
                    <td
                        style="width:90pt;border-top-style:solid;border-top-width:1pt;border-left-style:solid;border-left-width:1pt;border-bottom-style:solid;border-bottom-width:1pt;border-right-style:solid;border-right-width:1pt">
                        <p class="s1"
                            style="padding-left: 5pt;padding-right: 5pt;text-indent: 0pt;line-height: 12pt;text-align: center;">
                            Página 1 de 1</p>
                    </td>
                </tr>
            </table>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <h1 style="padding-top: 4pt;padding-left: 74pt;text-indent: 0pt;text-align: center;">SOLICITUD DE INSCRIPCIÓN EN EL
                PROYECTO ERASMUS+</h1>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-left: 3pt;text-indent: 0pt;text-align: left;">El/La solicitante, D./Dª <span
                    class="s2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>, con DNI <span
                    class="s2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>, domiciliado en <span
                    class="s2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
            <p style="padding-left: 3pt;text-indent: 0pt;text-align: left;">,</p>
            <p style="padding-left: 3pt;text-indent: 0pt;text-align: left;">teléfono de contacto <span
                    class="s2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-left: 3pt;text-indent: 0pt;text-align: left;">,correo electrónico <span
                    class="s2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span></p>
            <p class="s3" style="padding-top: 4pt;padding-left: 74pt;text-indent: 0pt;text-align: center;">EXPONE/N:</p>
            <p style="padding-left: 36pt;text-indent: 0pt;text-align: left;">Que está matriculado/a en el IES Las Fuentezuelas
                en 2º del ciclo formativo de</p>
            <p style="text-indent: 0pt;text-align: left;" />
            <p style="padding-left: 9pt;text-indent: 0pt;text-align: left;">Grado de <span class="s3"></span>,</p>
            <p style="padding-left: 9pt;text-indent: 0pt;text-align: justify;">que son ciertos los datos que figuran en esta
                instancia, que cumple los requisitos para obtener la condición de beneficiario establecidos en las bases de la
                convocatoria del programa de movilidad de prácticas Erasmus+ del IES Las Fuentezuelas del curso académico
                2021/22 y que la documentación presentada es copia fiel del original.</p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-left: 41pt;text-indent: 0pt;text-align: left;">Por lo expuesto,</p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p class="s3" style="padding-left: 74pt;text-indent: 0pt;text-align: center;">SOLICITA/N:</p>
            <p style="padding-left: 9pt;text-indent: 0pt;text-align: justify;">Participar en la selección de alumnado de ciclos
                formativos de Grado Medio en el</p>
            <h1 style="padding-left: 9pt;text-indent: 0pt;text-align: justify;">programa de movilidad de prácticas Erasmus+ del
                IES Las Fuentezuelas<span class="p">,</span></h1>
            <p style="padding-left: 9pt;text-indent: 0pt;text-align: justify;">con número de proyecto: <span
                    class="s4">2023-1-ES01-KA121-VET-000118437, </span>y que le sea concedida una ayuda para la realización de
                prácticas en empresas de otros países de la Unión Europea.</p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-left: 41pt;text-indent: 0pt;text-align: left;">En Jaén, a <span
                    class="s2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>de <span
                    class="s2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </span>de <span class="s2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-top: 11pt;padding-left: 5pt;text-indent: 0pt;text-align: left;">Fdo. El/La solicitante Fdo.: R.
                legal <span class="s5">Si es menor de edad</span></p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p class="s6" style="padding-left: 5pt;text-indent: 0pt;text-align: left;">Documentación que se adjunta:</p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <ul id="l1">
                <li data-list-text="-">
                    <p class="s6" style="padding-left: 42pt;text-indent: -18pt;text-align: left;">Fotocopia del DNI del
                        solicitante y de los padres si es menor de edad.</p>
                </li>
                <li data-list-text="-">
                    <p class="s6" style="padding-left: 42pt;text-indent: -18pt;text-align: left;">El certificado de idiomas, en
                        caso de poseerlo.</p>
                </li>
                <li data-list-text="-">
                    <p class="s6" style="padding-left: 42pt;text-indent: -18pt;text-align: left;">El documento de autorización
                        de representación si es menor.</p>
                </li>
            </ul>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-left: 74pt;text-indent: 0pt;text-align: center;">SRA. DIRECTORA DEL IES LAS FUENTEZUELAS</p>
            <p style="text-indent: 0pt;text-align: left;"><br /></p>
            <p style="padding-left: 3pt;text-indent: 0pt;line-height: 11pt;text-align: left;"><span
                    style=" color: #BFBFBF; font-family:Arial, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 10pt;">Entregar
                    en Secretaría</span></p>
            <p style="padding-left: 3pt;text-indent: 0pt;line-height: 11pt;text-align: left;"><span
                    style=" color: #BFBFBF; font-family:Arial, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 10pt;">Destino
                    del documento</span></p>
            <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;" />
        </body>
        
        </html>
            ';

        $mipdf = new Dompdf();
        # Definimos el tamaño y orientación del papel que queremos.
        # O por defecto cogerá el que está en el fichero de configuración.
        $mipdf->setpaper("A4", "portrait");
        # Cargamos el contenido HTML.
        $mipdf->loadhtml($html);

        # Renderizamos el documento PDF.
        $mipdf->render();

        # Creamos un fichero
        $pdf = $mipdf->output();
        $filename = "Solicitud.pdf";
        file_put_contents($filename, $pdf);

        return $pdf;
    }
}

?>