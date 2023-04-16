<?php 

	if (isset($_GET['file'])) {

		$fileName= basename($_GET['file']).'.xlsx';

		$filePath= 'Samples/'.$fileName;
			
		if (!empty($fileName) && file_exists($filePath)) {
			// Headers

			header('Cache-Control: public');
			header('Content-Description: File Transfer');
			header('Content-disposition: attachment; filename='.$fileName);
			header('Content-Type: application/zip');
			header('Content-Transfer-Encoding: binary');

			readfile($filePath);
			exit;
		}
		else{
			echo "File not available"; 
		}
	}

?>