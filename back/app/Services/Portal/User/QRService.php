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

    public function generateQR(Collection $profiles): string
    {
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'ANSCI', false);
        $pdf_width = 210;
        $pdf_height = 297;

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
            /** @var $profile Profile */
            if ($i % 3 === 0) {
                $pdf->AddPage();
                $pdf->Line($pdf_width / 2, 0, $pdf_width / 2, $pdf_height); // vertical
                $pdf->Line(0, $pdf_height / 3, $pdf_width, $pdf_height / 3); // vertical
                $pdf->Line(0, $pdf_height / 3 * 2, $pdf_width, $pdf_height / 3 * 2);
            }


            $pdf->SetFont('freesans', '', 12);
            $pdf->MultiCell(
                0,
                0,
                "Password:\n" . $profile->password,
                0,
                'C',
                false,
                1,
                110,
                40 + ($i % 3 * $pdf_height / 3),
                true,
                0,
                false,
                true,
                0,
                'T',
                false
            );

            $style = array(
                'border' => 0,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );
            $code = 'https://auto.kxxo.ru/show/' . $profile->id;
            $pdf->write2DBarcode($code, 'QRCODE,M', 13, 5 + ($i % 3 * ($pdf_height / 3)), 80, 80, $style, 'N');
            $pdf->SetFont('freesans', '', 15);
            $pdf->MultiCell(
                $pdf_width / 2,
                1,
                "МЕШАЕТ АВТОМОБИЛЬ?",
                0,
                'C',
                false,
                1,
                0,
                85 + ($i % 3 * ($pdf_height / 3)),
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
