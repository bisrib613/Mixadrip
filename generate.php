<?php
//==============================================//
//				FILE GENERATE.PHP				//
//		BUAT NGEGENERATE FILE XML KE JSON		//
//		DIBUAT TANGGAL 21 FEBRUARI 2021			//
//==============================================//

include("config.php");
include("lib/parser.php");
$tgl = date("Ymd");
$dino = date("Ymd");
$filename = readline("Nama file: ");
$loc = "json/".$argv[2]."/";
echo "=> Bismillah kita mulai\n";
echo "=> Mengecek keberadaan file ".$filename."\n";
if(file_exists(dirname($_SERVER['PHP_SELF'])."/".$config['xml_loc'].$filename)){
	echo "=> File ditemukan\n";
	$isiberkas = file_get_contents(dirname($_SERVER['PHP_SELF'])."/".$config['xml_loc'].$filename);
	echo "=> Melakukan Parsing\n";
	$parser = new parser;
	
	$tipe = explode(".",$filename);
	
	if($tipe[1] == "xml" || $tipe[1] == "XML"){
		$hasil = $parser->parsexml($isiberkas);
	}elseif($tipe[1] == "csv" || $tipe[1] == "CSV"){
		$file = fopen(dirname($_SERVER['PHP_SELF'])."/".$config['xml_loc'].$filename,"r");
		$hasil = $parser->parsecsv($file);
	}
	$no = 0;
	
	foreach($hasil as $data){
		if($no == $argv[1]){
			echo "=> Menyimpan file\n";
			if(is_dir(dirname($_SERVER['PHP_SELF'])."/".$loc)){
				file_put_contents(dirname($_SERVER['PHP_SELF'])."/".$loc."/".$tgl.".json",json_encode($isi,JSON_UNESCAPED_UNICODE));
			}else{
				mkdir(dirname($_SERVER['PHP_SELF'])."/".$loc);
				
				file_put_contents(dirname($_SERVER['PHP_SELF'])."/".$loc."/".$tgl.".json",json_encode($isi,JSON_UNESCAPED_UNICODE));
			}
			
			$no = 0;
			$tgl = date('Ymd', strtotime('+1 days', strtotime($tgl)));
			unset($isi);
		}
		
		$mail['tujuan'] = "imele";
		$mail['subjek'] = $data['title'];
		$mail['body'] = $data['content'];
		$mail['status'] = "ready";
		
		$isi[] = $mail;
		unset($mail);
		
		$no++;
	}
}else{
	print_r("=> File ".$filename." gak ada coy!");
}

echo "=> Alhamdulillah selesai!\n";