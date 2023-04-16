<?php
require_once("../backend/cls_select.php");

$value='lor1';
$obj1 = new Get();
$obj1->user_id = 161260107043;
$obj1->dp_id = '23';
$result_sDocINFO  = $obj1->documentProcessStudentById();


if ($result_sDocINFO->num_rows > 0) {
    foreach ($result_sDocINFO as $row) {
        $student_name=$row['student_name'];
        $document_process_id=$row['dp_id'];
        $doc_desc=$row['doc_desc'];
    }
}

    $header_info='<html>
    <head>
    </head>
    <body>
        <img src="../images/SETIDOCHEADER.png" height="175px" width="100%"/>
    </body>
    </html>
    ';

    $pre_date=date('Y')-4;

    $data = '<html>
            <head>
                <style>
                    body{
                        font-family: sans-serif;
                        font-size:16px;
                        text-align: justify;
                        text-justify: inter-word; 
                        letter-spacing: 0;   
                        line-height: 1.7;                    
                    }
                    .container{
                        display:flex;
                        justify-content:center;
                    }
                    body{
                        background-image: url("../images/DOCSAL.png");
                        background-repeat:no-repeat;
                        background-position: center;
                        background-image-opacity:0.1;
                    }
                </style>
            </head>
            <body>

            <table width="100%" style="margin: 100px 0px 50px 0px;">
                <tr>
                    <td class="contentDetails">
                    <th align="left"><strong>SETI/LOR/1019/'.date("Y").'</strong></th>
                    <th align="center"></th>
                    <th align="right"><strong>Date: '.date("d-m-Y").'</strong></th>
                    </td>
                </tr>
            </table><div align="center"><u><strong>COLLEGE LEAVING CERTIFICATE</strong></u></div>


            
            <br>
            <p style="font-size:13px;">
            '.$doc_desc.'

            </p>
            <br>
            <br>
            <br>
            <br>
            <p style="font-size:13px;">
            <b>Dr. Ajay Upadhyaya<br>
            In-Charge Principal<br>
            SAL Engineering &amp; Technical Institute</b><br>
            E-Mail ID: ajay.upadhyaya@sal.edu.in<br>
            Contact No. +91-9909715620<br>
            </p>

            </body>
            
        </html>';
    require_once("../vendor/autoload.php");
	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);

    
		
		$mpdf->defaultheaderline = 0;
		$mpdf->setAutoTopMargin='stretch';
        
	
		$mpdf->defaultfooterline = 0;

		$date = date("d-m-Y");
		$mpdf->SetHeader($header_info);
		
		$mpdf->WriteHTML($data);
		$mpdf->SetFooter(' | | ');

        $file_name = date("d-m-y") . ".pdf";

		$mpdf->output();

        

