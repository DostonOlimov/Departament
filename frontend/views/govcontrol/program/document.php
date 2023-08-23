

<?php

use common\models\govcontrol\ProgramData;
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
$arr = 
[
    'rightHeader' => [
        '“TASDIQLAYMAN”',
        'O‘zbekiston Texnik jihatdan tartibga solish agentligining Davlat nazorati departament boshlig‘i v.v.b',
        '__________________K.Bekmirzayev',
        '«_____»______________'.date('d.m.Y').' yil'
    ],
    'header1' => 'O‘zbekiston texnik jihatdan tartibga solish agentligining davlat nazorati departamenti tomonidan '.
    $company->address.'da joylashgan '.$company->company_name.'(STIR: '.$company->stir.', '.'IFUT: '.$company->ifut.') da texnik jihatdan tartibga solish, 
    standartlashtirish, sertifikatlashtirish va metrologiya qoida va me\'yorlariga rioya etilishi yuzasidan tekshirish',
    'header2' => 'DASTURI'
];
$phpWord = new PhpWord();
// Ads styles
$phpWord->addParagraphStyle('multipleTab',['tabs' => [new Tab('left', 1550),new Tab('center', 3200),new Tab('right', 5300)]]);
$phpWord->addParagraphStyle('rightTab',['tabs' => [new Tab('right', 9090)]]);
$phpWord->addParagraphStyle('centerTab',['tabs' => [new Tab('center', 4680)]]);
$phpWord->setDefaultFontName('Times New Roman');
$phpWord->setDefaultFontSize(13);
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
    

    $section = $phpWord->addSection();
    $rightHeader = $section->addTextRun(['align' => 'center', 'indentation' =>['firstLine' => Converter::cmToTwip(0), 'left' => Converter::cmToTwip(7)]]);
        foreach ($arr['rightHeader'] as $key => $element){
            $rightHeader->addText(htmlspecialchars($element), ['bold' => true]);
            $rightHeader->addText('<w:br />');
            }
    $header1 = $section->addTextRun(['align' => 'both']);
    $header2 = $section->addTextRun(['align' => 'center', 'indentation' =>['firstLine' => Converter::cmToTwip(0)]]);

    // $body1 = $section->addTextRun(['align' => 'both']);
    // $body2 = $section->addTextRun(['align' => 'both']);
            
            
            $header1->addText(htmlspecialchars('O‘zbekiston texnik jihatdan tartibga solish agentligining davlat nazorati departamenti tomonidan '.
            $company->address.'da joylashgan '.$company->company_name.'(STIR: '.$company->stir.', '.'IFUT: '.$company->ifut.') da texnik jihatdan tartibga solish, '.
            'standartlashtirish, sertifikatlashtirish va metrologiya qoida va me\'yorlariga rioya etilishi yuzasidan tekshirish'));
            $header2->addText(htmlspecialchars("DASTURI"), ['bold' => true], ['align' => 'both']);
            foreach(ProgramData::getCategory() as $key => $value){
                $section->addText(htmlspecialchars($key.'. '.$value.':'), ['bold' => true], ['align' => 'both']);
                // debug($dataProviders[$key]->getModels());
                foreach($allmodels = $dataProviders[$key]->getModels() as $model){
                    if(end($allmodels)->id == $model->id){
                        $section->addText(htmlspecialchars('- '.$model->programData->content.'.'), null, ['align' => 'both']);
                    }
                    else{
                        $section->addText(htmlspecialchars('- '.$model->programData->content.';'), null, ['align' => 'both', 'spaceAfter' => Converter::cmToTwip(0)]);
                    }
                    // debug('- '.$model->programData->content);

                }
                
    
            }
            // $body3 = $section->addTextRun();
            $section->addTextBreak(1);
            $section->addText(htmlspecialchars('Davlat inspektori'."\t".$user->name.' '.$user->surname), null, 'rightTab');
    


    // Saving the document as OOXML file...
    
    $file = 'Tekshiruv dasturi'.'.docx';
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