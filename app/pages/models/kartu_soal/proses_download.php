<?php
    /**
     * Created by PhpStorm.
     * User: Muhammad Yasmin
     * Date: 9/26/2016
     * Time: 8:56 PM
     */
    require_once('../../../../plugins/phpexcel/PHPExcel.php');
    $mapel = $_POST['mapel'];
    $jumlah = $_POST['soal'];
    $opsi = $_POST['opsi'];
    $objPHPExcel = new PHPExcel;
    $objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri');
    $objPHPExcel->getDefaultStyle()->getFont()->setSize(12);
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007");
    $numberFormat = '#,#0.##;[Red]- #,#0.##';
    $objSheet = $objPHPExcel->getActiveSheet();
    $objSheet->setTitle('Sheet Soal Ujian');
    $objSheet->getStyle('A1:L1')->getFont()->setBold(true)->setSize(9);
    $objSheet->getCell('A1')->setValue('No');
    $objSheet->getCell('B1')->setValue('ID Mata Pelajaran');
    $objSheet->getCell('C1')->setValue('Semester');
    $objSheet->getCell('D1')->setValue('Isi Soal');
    $objSheet->getCell('E1')->setValue('Jumlah Opsi (isi 2 sampai 5)');
    $objSheet->getCell('F1')->setValue('Opsi A');
    $objSheet->getCell('G1')->setValue('Opsi B');
    $objSheet->getCell('H1')->setValue('Opsi C');
    $objSheet->getCell('I1')->setValue('Opsi D');
    $objSheet->getCell('J1')->setValue('Opsi E');
    $objSheet->getCell('K1')->setValue('Jawaban');
    $objSheet->getCell('L1')->setValue('Pembahasan');
    $urut = 1;
    for ($no = 2; $no <= ($jumlah+1); $no++) {
        $objSheet->getCell('A'.$no)->setValue($urut);
        $objSheet->getCell('B'.$no)->setValue($mapel);
        $objSheet->getCell('D'.$no)->setValue(5);
        $urut++;
    }
    $objWriter->save('import_soal.xlsx');