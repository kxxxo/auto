<?php

namespace App\Services\Portal\User;

use App\Models\Profile;
use App\Models\ProfileMail;
use App\Models\ProfileTelegram;
use App\Models\ProfileTelephone;
use App\Models\ProfileVk;
use App\Models\ProfileWhatsapp;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class QRService
{

    public function generateSticky(Collection $profiles): string
    {
        // L \ P
        $pdf = new \TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'ANSCI', false);
        $pdf_width = 285;
        $pdf_height = 210;
        $rows_num = 2;
        $colums_num = 4;
        $qr_size = 70;


        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('kxxo.ru');
        $pdf->SetTitle('Profile QR Code');
        $pdf->SetSubject('Your QR Code');
        $pdf->SetKeywords('QR, kxxo.ru, auto.kxxo.ru');

//        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 050', PDF_HEADER_STRING);
//        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->setCellMargins(0, 0, 0, 0);
        $pdf->SetFooterMargin(0);
        $pdf->SetAutoPageBreak(true, 0);

        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
//        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
//            require_once(dirname(__FILE__) . '/lang/eng.php');
//            $pdf->setLanguageArray($l);
//        }
        $pdf->setFontSubsetting(true);

        foreach ($profiles as $i => $profile) {
            $row = $i % $rows_num;
            $column = ( $i / $rows_num ) % $colums_num;

            /**
             * Check add page
             */
            /** @var $profile Profile */
            if ($i % ($colums_num * $rows_num) === 0) {
                $pdf->AddPage();
                for($j = 1;$j<$colums_num;$j++) {
                    $pdf->Line($pdf_width / $colums_num * $j, 0, $pdf_width / $colums_num * $j, $pdf_height); // vertical
                }
                for($j = 1;$j<$rows_num;$j++) {
                    $pdf->Line(0, $pdf_height / $rows_num * $j, $pdf_width, $pdf_height / $rows_num * $j); // horizontal
                }
                $pdf->Line($pdf_width, 0, $pdf_width, $pdf_height); // vertical

            }


//            $pdf->SetFont('freesans', '', 12);
//            $pdf->MultiCell(
//                0,
//                0,
//                "Password:\n" . $profile->password,
//                0,
//                'C',
//                false,
//                1,
//                110,
//                40 + ($i % $rows_num * $pdf_height / $rows_num),
//                true,
//                0,
//                false,
//                true,
//                0,
//                'T',
//                false
//            );



            $style = array(
                'border' => 0,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );
            $code = getenv('FRONTEND_APP_URL') . '/show/' . $profile->id;

            $pdf->write2DBarcode($code, 'QRCODE,M',
                1 + (($column) * ($pdf_width / $colums_num)),
//                2,
                //2 + ($i % $rows_num * ($pdf_height / $rows_num)),
                15 + (($row) * ($pdf_height / $rows_num)),
                $qr_size, $qr_size, $style, 'N');



            $pdf->SetFont('freesans', '', 4);
            $pdf->MultiCell(
                15,
                15,
                $profile->id,
                0,
                'C',
                false,
                1,
                $pdf_width-6 + $column*3,
                10 + (($row) * ($pdf_height / $rows_num)),
                true,
                0,
                false,
                true,
                0,
                'T',
                false
            );
        }

        return $pdf->Output('Profiles_' . date('U') . '.pdf', 'I');
    }
}
