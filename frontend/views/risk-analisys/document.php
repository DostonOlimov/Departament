

<?php

use common\models\RiskAnalisysCriteria;
use common\models\User;
use frontend\controllers\RiskAnalisysController;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\TextAlignment;
use PhpOffice\PhpWord\Style\Tab;
use common\models\UserPosition;
use common\models\LocalActiveRecord;






// print_r($_GET);
// print_r($model);die;
// debug($comment[0]['comment']);
$phpWord = new PhpWord();
// Ads styles
$phpWord->addParagraphStyle('multipleTab',['tabs' => [new Tab('left', 1550),new Tab('center', 3200),new Tab('right', 5300)]]);
$phpWord->addParagraphStyle('rightTab',['tabs' => [new Tab('right', 9090)]]);
$phpWord->addParagraphStyle('centerTab',['tabs' => [new Tab('center', 4680)]]);

    $phpWord->setDefaultFontName('Times New Roman');
    $phpWord->setDefaultFontSize(14);
    $phpWord->setDefaultParagraphStyle([
        'indentation' => 
        [
            'firstLine' => Converter::cmToTwip(1)
            ]
        ],
    );
    
    
    
    $properties = $phpWord->getDocInfo();
    
    $properties->setCreator('My name');
    $properties->setCompany('My factory');
    $properties->setTitle('My title');
    $properties->setDescription('My description');
    $properties->setCategory('My category');
    $properties->setLastModifiedBy('My name');
    // $properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
    // $properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
    $properties->setSubject('My subject');
    $properties->setKeywords('my, key, word');
    
    $sectionStyle = array(
        // 'orientation' => 'landscape',
        // 'marginTop' => Converter::pixelToTwip(150),
        // 'marginLeft' => 600,
        // 'margitnRight' => 600,
        // 'ColsNum' => 1,
        // 'pageNumberingStart' => 1,
        // 'borderBottomSize' => 100,
        // 'boredBottomColor' => 'C0C0C0',
    );

    // variables
    $stir = $company->stir;
    $company_name = $company->company_name;
    $user_position = UserPosition::findOne(['id' => $user->position_id])->alias;
    $user_name = $user->name.' '.$user->surname;
    $date_uz = date('Y') . ' yil '. intval(date('d')) .' '.$model->getDate_uz(intval(date('m')));
    // $body_elements2;
    foreach ($score as $key => $value){
        $criteria = RiskAnalisysCriteria::findone(['id' => $value]);

        $body_elements2[$key] = $criteria->document_paragraph . '-bandi, '.$criteria->criteria. " (".$criteria->criteria_score. " ball)";
    }

    $section = $phpWord->addSection($sectionStyle);
    $header1 = $section->addTextRun(['align' => 'center', 'indentation' =>['firstLine' => Converter::cmToTwip(0)]]);
    // $header2 = $section->addTextRun(['align' => 'center']);
    $body1 = $section->addTextRun(['align' => 'both']);
    $body2 = $section->addTextRun(['align' => 'both']);
    $body3 = $section->addTextRun();
    foreach ($body_elements2 as $key => $element){
        $section->addText(htmlspecialchars($element),[],['alignment' => 'both']);
        if (strlen($comment[$key]['comment'])>2){
        $section->addText(htmlspecialchars('Izoh: ' . $comment[$key]['comment']),['italic' => TRUE],['alignment' => 'both']);
        }
    }
    // $footer1 = $section->addTextRun(['alignment' => 'both']);
    $body4 = $section->addTextRun(['align' => 'both']);
    $section->addTextBreak(1);
    $section->addText(htmlspecialchars($user_position."\t".$user_name), null, 'rightTab');
    $section->addText(htmlspecialchars($date_uz));
    
    
    
    $header1->addText( htmlspecialchars('O‘zbekiston texnik jihatdan tartibga solish agentligi va uning Texnik jihatdan tartibga solish, '
    .'standartlashtirish, sertifikatlashtirish va metrologiya sohasida davlat nazorati departamenti  xodimlari tomonidan '
    .'qonunbuzilish xavfini tahlil etish tizimiga kiritilgan tadbirkorlik subyektlari xavf darajalari to‘g‘risidagi'),['bold' => TRUE]);
    $header1->addText('<w:br />');
    $header1->addText( htmlspecialchars("MA’LUMOTNOMA"),
    ['bold' => TRUE]);
    
    $body1->addText( htmlspecialchars('“Texnik jihatdan tartibga solish, standartlashtirish, sertifikatlashtirish, metrologiya va muvofiqlikni '
    .'baholashga oid qonunbuzilish xavfini tahlil etish tizimini joriy etish tartibi to‘g‘risidagi”gi Nizomga asosan '));
    $body1->addText( htmlspecialchars($company_name.'  STIR: '.$stir),['bold' => TRUE]);
    $body1->addText( htmlspecialchars(' tadbirkorlik subyektida qonun buzilish xavfi tahlili o‘tkazildi.'));
    
    $body2->addText( htmlspecialchars('Mazkur Nizomning 2-bobiga muvofiq tadbirkorlik subyekti faoliyatida huquqbuzarlik alomatlari haqida xabar '
    .'beruvchi baholash mezonlari bo‘yicha o‘tkazilgan tahlil natijasiga ko‘ra tadbirkorlik subyekti '));
    $body2->addText( htmlspecialchars($sumscore.' ballik'),['bold' => TRUE]);
    $body2->addText( htmlspecialchars(' ko‘rsatkichiga ega bo‘ldi.'));
    
    $body3->addText( htmlspecialchars('O‘tkazilgan tahlil natijasida Nizomning'));
    $body4->addText( htmlspecialchars($company_name.'  STIR: '.$stir));
    $body4->addText( htmlspecialchars('da profilaktika tadbirlari o‘tkazilgandan so‘ng huquqbuzarlik alomatlari 10 kun ichida bartaraf etilmaganligini'.
    ' inobatga olgan holda mazkur tadbirkorlik subyektida tekshirish o‘tkazilishi maqsadga muvofiq deb hisoblayman.'));
    


    // Saving the document as OOXML file...
    
    $file = 'Xavf tahlili '.$model->risk_analisys_date.' №-'.$model->risk_analisys_number.'.docx';
    header("Content-Description: File Transfer");
    header('Content-Disposition: attachment; filename="' . $file . '"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Expires: 0');
    $xmlWriter = IOFactory::createWriter($phpWord, 'Word2007');
    ob_clean();
    $xmlWriter->save("php://output");
    exit;
?>