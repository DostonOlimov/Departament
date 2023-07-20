

<?php

use common\models\Company;
use common\models\RiskAnalisysCriteria;
use common\models\User;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\SimpleType\TextAlignment;
use PhpOffice\PhpWord\Style\Tab;
use common\models\UserPosition;
use common\models\LocalActiveRecord;
// variables

// debug($searchModel->start_date);
$user_position = UserPosition::findOne(['id' => $user->position_id])->alias;
$user_name = $user->name.' '.$user->surname;
$date_uz = date('Y') . ' yil '. intval(date('d')) .' '.LocalActiveRecord::getDate_uz(intval(date('m')));

$arr = 
[
    'rightHeader' => [
        'O‘zbekiston texnik jihatdan tartibga solish agentligi va uning Texnik jihatdan tartibga solish, standartlashtirish, 
    sertifikatlashtirish va metrologiya sohasida davlat nazorati Departamenti tomonidan texnik jihatdan tartibga solish, standartlashtirish, sertifikatlashtirish, metrologiya 
    va muvofiqlikni baholash sohalarida xavfini taxlil etish tizimini joriy etish tartibi to‘g‘risidagi Nizomga Tuzilma nomi va lavozimi',
    '1-ilova'
    ],
    'header' => 'Texnik jihatdan tartibga solish, standartlashtirish, 
    sertifikatlashtirish, metrologiya va muvofiqlikni baholash sohalariga oid huquqbuzarlik sodir 
    etish xavfi mavjud bo‘lgan tadbirkorlik sub’yektlari ro‘yxatini shakllantirish Jadvali*',
    
    'tblHeader' => [
        0 =>'№',
        1 => 'Texnik jihatdan tartibga solish, standartlashtirish, sertifikatlashtirish, metrologiya va muvofiqlikni baholash 
        sohalari yuzasidan tahlil o‘tkaziladigan tadbirkorlik sub’yektining nomi', 
        2 => 'Tadbirkorlik sub’yekti faoliyatida huquqbuzarlik alomatlari haqida xabar beruvchi baholash mezonlari asosiy ko‘rsatkichlari **',
        3 => 'Tahlil natijasi bo‘yicha jami ballar yig‘indisi',
        
        4 => [  'Texnik jihatdan tartibga solish va standartlashtirish sohasida qonun buzilish bo‘yicha (ball)',
                'Sertifikatlashtirish sohasidagi qonun buzilish bo‘yicha (ball)',
                'Metrologiya sohasidagi qonun buzilish bo‘yicha (ball)',
                'Muvofiqlikni baholashda qonun buzilish bo‘yicha (ball)',
                'Ommaviy axborot vositalari va ijtimoiy tarmoqlarda mahsulot va xizmatlar yuzasidan qonun buzilish holatlari bo‘yicha (ball)',
        ],
        5 => [  'I',
                'II',
                'III',
                'IV',
                'V',
        ],
    ],

];



$phpWord = new PhpWord();
// Ads styles
$phpWord->addParagraphStyle('multipleTab',['tabs' => [new Tab('left', 1550),new Tab('center', 3200),new Tab('right', 5300)]]);
$phpWord->addParagraphStyle('rightTab',['tabs' => [new Tab('right', 9090)]]);
$phpWord->addParagraphStyle('centerTab',['tabs' => [new Tab('center', 4680)]]);

$phpWord->setDefaultFontName('Times New Roman');
$phpWord->setDefaultFontSize(10);
$phpWord->setDefaultParagraphStyle(['indentation' =>[
            // 'firstLine' => Converter::cmToTwip(1),
            'valign' => 'center', 
            'alignment' => 'center',
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
    
    $sectionStyle = [
        'orientation' => 'landscape',
        // 'marginTop' => Converter::pixelToTwip(150),
        // 'marginLeft' => 600,
        // 'margitnRight' => 600,
        // 'ColsNum' => 1,
        // 'pageNumberingStart' => 1,
        // 'borderBottomSize' => 100,
        // 'boredBottomColor' => '000000',
    ];

    // variables

    // Add section to document
$section = $phpWord->addSection($sectionStyle);
$header2 = $section->addTextRun(['align' => 'center', ]);
$header2->addText( htmlspecialchars($arr['header']), ['bold' => true]);

$TblHeaderFStyle = ['size' => 12, 'bold' => true, 'alignment' => 'center'];

$TableStyleName = ' Table';
$TableStyle = [
    'borderSize' => 0, 
    'borderColor' => '000000', 
    'cellMargin' => 20, 
    'alignment' => 'center', 
    // 'cellSpacing' => 50
];

$cellRowSpan = ['vMerge' => 'restart', 'valign' => 'center'];
$cellRowContinue = ['vMerge' => 'continue'];
// $cellColSpan = ['gridSpan' => 5, 'valign' => 'center'];

$TableFirstRowStyle = [
    'borderBottomSize' => 18, 
    'borderBottomColor' => '0000FF', 
    // 'bgColor' => '66BBFF'
];
$TableCellStyle = [
    'valign' => 'center', 
    'alignment' => 'center'
];
$TableFontStyle = [
    // 'valign' => 'center',  
    'bold' => true
];

$phpWord->addTableStyle(
    $TableStyleName, 
    $TableStyle, 
    $TableFirstRowStyle
);

$table = $section->addTable($TableStyleName);


// HEADER

// 1st layer
$row = $table->addRow();
// $cell->setAlignment('center');
$row->addCell(Converter::cmToTwip(1.08), $cellRowSpan)->addText($arr['tblHeader'][0], $TblHeaderFStyle, $TableCellStyle);
$row->addCell(Converter::cmToTwip(7.83), $cellRowSpan)->addText($arr['tblHeader'][1], $TableFontStyle, $TableCellStyle);
$row->addCell(null, ['gridSpan' => 5, 'valign' => 'center'])->addText($arr['tblHeader'][2],$TableFontStyle, $TableCellStyle);
$row->addCell(Converter::cmToTwip(1.98), $cellRowSpan )->addText($arr['tblHeader'][3], $TableFontStyle, $TableCellStyle);

// 2st layer
$row = $table->addRow();
$row->addCell(null, $cellRowContinue);
$row->addCell(null, $cellRowContinue);
$row->addCell(Converter::cmToTwip(3.33), $TableCellStyle)->addText($arr['tblHeader'][4][0], $TableFontStyle, $TableCellStyle);
$row->addCell(Converter::cmToTwip(3.01), $TableCellStyle)->addText($arr['tblHeader'][4][1], $TableFontStyle, $TableCellStyle);
$row->addCell(Converter::cmToTwip(3.01), $TableCellStyle)->addText($arr['tblHeader'][4][2], $TableFontStyle, $TableCellStyle);
$row->addCell(Converter::cmToTwip(3.01), $TableCellStyle)->addText($arr['tblHeader'][4][3], $TableFontStyle, $TableCellStyle);
$row->addCell(Converter::cmToTwip(4.63), $TableCellStyle)->addText($arr['tblHeader'][4][4], $TableFontStyle, $TableCellStyle);
$row->addCell(null, $cellRowContinue);
// 3st layer
$thirdLayer = [
                null,
                'I',
                'II',
];
$row = $table->addRow();
$row->addCell(null, $cellRowContinue);
$row->addCell(null, $cellRowContinue);
$row->addCell(null, )->addText($arr['tblHeader'][5][0], $TableFontStyle, $TableCellStyle);
$row->addCell(null, )->addText($arr['tblHeader'][5][1], $TableFontStyle, $TableCellStyle);
$row->addCell(null, )->addText($arr['tblHeader'][5][2], $TableFontStyle, $TableCellStyle);
$row->addCell(null, )->addText($arr['tblHeader'][5][3], $TableFontStyle, $TableCellStyle);
$row->addCell(null, )->addText($arr['tblHeader'][5][4], $TableFontStyle, $TableCellStyle);

$row->addCell(null, $cellRowContinue);

// 4st layer
$row = $table->addRow();
for ($i = 1; $i <= 8; $i++) {
    $row->addCell(null)->addText($i, $TableFontStyle, $TableCellStyle);
}

foreach($models as $key => $model){
    
    $company = Company::findOne($model->company_id);
    $row = $table->addRow();
    $key = $key+1;
    $table->addCell()->addText("{$key}.", null, $TableCellStyle);
    $table->addCell(null, $TableCellStyle)->addText($company->company_name, null, $TableCellStyle);
    $table->addCell(null, $TableCellStyle)->addText($model->getCriteriaBall($model->id,$model::TECHNIC_AND_STANDARD_FIELD), null, $TableCellStyle);
    $table->addCell(null, $TableCellStyle)->addText($model->getCriteriaBall($model->id,$model::SERTIFICATION_FIELD), null, $TableCellStyle);
    $table->addCell(null, $TableCellStyle)->addText($model->getCriteriaBall($model->id,$model::METROLOGY_FIELD), null, $TableCellStyle);
    $table->addCell(null, $TableCellStyle)->addText($model->getCriteriaBall($model->id,$model::ACCREDITATION_FIELD), null, $TableCellStyle);
    $table->addCell(null, $TableCellStyle)->addText($model->getCriteriaBall($model->id,$model::MASS_MEDIA_FIELD), null, $TableCellStyle);
    $table->addCell(null, $TableCellStyle)->addText($model->getCriteriaBall($model->id), null, $TableCellStyle);
    }

    $body4 = $section->addTextRun(['align' => 'both']);
    $section->addTextBreak(1);
    $section->addText(htmlspecialchars($user_position."\t".$user_name), null, 'rightTab');
    $section->addText(htmlspecialchars($date_uz));

    $file = 'Xavf tahlili nizomiga 1-ilova '.$searchModel->start_date.' - '.$searchModel->end_date.'.docx';
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