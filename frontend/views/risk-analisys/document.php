

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

// print_r($_GET);
// print_r($model);die;

    $phpWord = new PhpWord();
    
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
    $properties->setCreated(mktime(0, 0, 0, 3, 12, 2014));
    $properties->setModified(mktime(0, 0, 0, 3, 14, 2014));
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
    $section = $phpWord->addSection($sectionStyle);
    
    // variables
    $stir = $company->stir;

    $company_name = $company->company_name;
    $user = User::findOne(['id' => $model->created_by]);
    
    $user_position = UserPosition::findOne(['id' => $user->position_id])->position;
    
    $user_name = $user->name.' '.$user->surname;
    // $user_position = 'Bosh mutaxassis';
    
    // sample text
    $header_elements = ['O‘zbekiston texnik jihatdan tartibga solish agentligi va uning Texnik jihatdan tartibga solish, '
    .'standartlashtirish, sertifikatlashtirish va metrologiya sohasida davlat nazorati departamenti  xodimlari tomonidan '
    .'qonunbuzilish xavfini tahlil etish tizimiga kiritilgan tadbirkorlik subyektlari xavf darajalari to‘g‘risidagi',
    'MA’LUMOTNOMA'];
    $body_elements = [
        '“Texnik jihatdan tartibga solish, standartlashtirish, sertifikatlashtirish, metrologiya va muvofiqlikni '
        .'baholashga oid qonunbuzilish xavfini tahlil etish tizimini joriy etish tartibi to‘g‘risidagi”gi Nizomga asosan '
        .$company_name.'  STIR: '.$stir.' tadbirkorlik subyektida qonun buzilish xavfi tahlili o‘tkazildi.',
    
        'Mazkur Nizomning 2-bobiga muvofiq tadbirkorlik subyekti faoliyatida huquqbuzarlik alomatlari haqida xabar '
        .'beruvchi baholash mezonlari bo‘yicha o‘tkazilgan tahlil natijasiga ko‘ra tadbirkorlik subyekti '.$sumscore.' ballik ko‘rsatkichiga ega bo‘ldi.',
        $company_name . '  STIR: ' . $stir . ' tadbirkorlik subyektida profilaktika tadbirlari o‘tkazilgandan so‘ng huquqbuzarlik'
        .' alomatlari 10 kun ichida bartaraf etilmaganligini inobatga olgan holda mazkur tadbirkorlik subyektida tekshirish o‘tkazilishi maqsadga muvofiq deb hisoblayman.',
        'O‘tkazilgan tahlil natijasida Nizomning'
        
    ];
    $body_elements2;
    foreach ($score as $key => $value){
        $criteria = RiskAnalisysCriteria::findone(['id' => $value]);

        $body_elements2[$key] = $criteria->document_paragraph . '-bandi, '.$criteria->criteria. " (".$criteria->criteria_score. " ball)";
    }
    
    foreach ($header_elements as $element){
        $section->addText(
            htmlspecialchars($element),
            ['bold' => TRUE],
            ['align' => 'center',
            'indentation' => 
                        [
                            'firstLine' => Converter::cmToTwip(0)
                        ]
            ]
        );
    
    }
    foreach ($body_elements as $element){
        $section->addText(
            htmlspecialchars($element),
            array(),
            array('alignment' => 'both' )
        );
    
    }

    foreach ($body_elements2 as $element){
        $section->addText(
            htmlspecialchars($element),
            array(),
            array('alignment' => 'both' )
        );
    
    }
    $section->addTextBreak(1);
    $section->addText(htmlspecialchars($user_position.'                    '.$user_name),array(),array('alignment' => 'both' )
    );



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