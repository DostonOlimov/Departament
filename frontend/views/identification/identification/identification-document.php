

<?php

use common\models\actselection\SelectedProduct;
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
use common\models\normativedocument\NormativeDocumentContent;
use common\models\normativedocument\NormativeDocumentSection;
use yii\web;

// variables
    // debug($dataProvider->getModels());
    $key = NULL;


    $user_position = UserPosition::findOne(['id' => $user->position_id])->alias;
    $user_name = $user->name.' '.$user->surname;
    $date_uz = date('Y') . ' yil '. intval(date('d')) .' '.LocalActiveRecord::getDate_uz(intval(date('m')));
    $company = $dataProvider->getModels()[0]->company;
    $product = $dataProvider->getModels()[0]->selectedProduct;
    // debug($product);
    $arr = 
    [
        'rightHeader' => [
            'Ilova №__'
        ],
        'header' => 
        [
            $company->company_name.'dan sinash uchun olingan  na`munalarni sezgi a\'zolari orqali (tashqi ko‘rikdan o‘tkazish, tamg‘alash,  qadoqlash va saqlash) tekshirish',
            'B A Y O N N O M A S I'
        ],
        'leftHeader' => 
        [
            'Mahsulot nomlanishi: ' => $product->name,
            'ishlab chiqaruvchi davlat: ' => $product->ctry_ogn_code,
            'ishlab chiqaruvchi: ' => $product->mfr_name,
        ],
        
        'tblHeader' => [
            1 =>'№',
            // 2 => 'Mahsulotning nomlanishi', 
            2 => 'Normativ hujjat bandlarining talablari',
            3 => 'Normativ hujjat talablari',
            4 => 'Amalda',
            5 => 'Muvofiqligi',
        ],
        'tblHeaderColSize' => [
            1 => 0.89,
            // 2 => 3.12, 
            2 => 3,
            3 => 10,
            4 => 8,
            5 => 2.75,
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
                'left' => Converter::cmToTwip(0.2),
                'right' => Converter::cmToTwip(0.2),
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
    $header2->addText( htmlspecialchars($arr['header'][0]), ['bold' => true]);
    $header2->addText('<w:br />');
    $header2->addText( htmlspecialchars($arr['header'][1]), ['bold' => true]);
    $result = null;
    foreach($arr['leftHeader'] as $key => $value){
        // debug($key.$value);
        if($result == null && $value !== null){
            $result = $key.$value;
        }
        else{
            $result .=($result == null && $value !== null)?? ', '.$key.$value;
        }
    }
    $header3 = $section->addTextRun(['align' => 'left', ]);
    $header3->addText(htmlspecialchars($result),
    // ['bold' => true]
);

    $TblHeaderFStyle = ['size' => 12, 'bold' => true, 'alignment' => 'center'];

    $TableStyleName = ' Table';
    $TableStyle = [
        'borderSize' => 0, 
        'borderColor' => '000000', 
        'cellMargin' => 20, 
        'alignment' => 'center', 
        // 'cellSpacing' => 50
        'leftFromText' => 50,
    ];

    $cellRowSpan = ['vMerge' => 'restart', 'valign' => 'center'];
    $cellRowContinue = ['vMerge' => 'continue'];
    // $cellColSpan = ['gridSpan' => 5, 'valign' => 'center'];

    $TableFirstRowStyle = [
        // 'borderBottomSize' => 18, 
        // 'borderBottomColor' => '0000FF', 
        // 'bgColor' => '66BBFF',
        'valign' => 'center', 
        'alignment' => 'center'
    ];
    $fStyle1 = ['valign' => 'center',];
    $pStyle1 = ['alignment' => 'center'];

    $fStyle2 = ['valign' => 'center',];
    $pStyle2 = ['alignment' => 'center'];

    $fStyle3 = ['valign' => 'center'];
    $pStyle3 = ['alignment' => 'center'];

    $fStyle4 = [
        'valign' => 'center',
    ];
    $pStyle4 = [
        // 'alignment' => 'center',
        'alignment' => 'both'
    ];
    
    $fStyle5 = ['valign' => 'center',];
    $pStyle5 = [
        // 'alignment' => 'center',
        'alignment' => 'both'

];
    $fStyle51 = [
        'valign' => 'center',
        'bold' => true,
    ];
    $pStyle51 = ['alignment' => 'center'];
    
    $fStyle6 = ['valign' => 'center',];
    $pStyle6 = ['alignment' => 'center'];

    $fStyle61 = [
        'valign' => 'center',
        'bold' => true,
    ];
    $pStyle61 = ['alignment' => 'center'];
    
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

    $row = $table->addRow();
    for ($i = 1; $i <= 5; $i++){
        $row->addCell(Converter::cmToTwip($arr['tblHeaderColSize'][$i]), $cellRowSpan)
        ->addText($arr['tblHeader'][$i], $TblHeaderFStyle, $TableFirstRowStyle);
    }

    // CONTENTS

    foreach($dataProvider->getModels() as $key => $oneModel){
        $product = SelectedProduct::findOne($oneModel->identification->selected_product_id);
        // debug($oneModel);
        $ndContentModel = $oneModel->normativeDocumentContent;
        $ndSectionModel = $oneModel->normativeDocumentSection;
        $ndModel = $oneModel->normativeDocument;
        // debug($ndModel->determination);
        
        if ($key==0){
            $row = $table->addRow();
            // col 1 №
            $table->addCell(null,$fStyle1, $pStyle1)->addText(join([$key + 1,'.']), $fStyle1, $pStyle1);
            // col 3 Normativ hujjat bandlarining talablari
            $table->addCell(null, $cellRowSpan)->addText($ndModel->determination. ' ' .$ndSectionModel->section_number.'. '.$ndSectionModel->section_name, $fStyle3, $pStyle3);
            // col 4 Normativ hujjat talablari
            $nd_content = $table->addCell();
                $nd_content->addText($ndContentModel->content, $fStyle4, $pStyle4);
            // col 5 Amalda
            $comment = $table->addCell();
                $textrun5 = $comment->addTextRun();
                    $textrun5->addText($oneModel->comment, $fStyle5, $pStyle5);
            // col 6 Muvofiqligi
            $conformity = $table->addCell(null, $fStyle6, $pStyle6);
            if($oneModel->conformity == 0){
                $conformity->addText($oneModel->getConformity($oneModel->conformity), $fStyle6, $pStyle6);
            }
            else{
                $conformity->addText($oneModel->getConformity($oneModel->conformity), $fStyle61, $pStyle61);
            }
        }

        else{
            if($ndContentModel->parent_id == $dataProvider->getModels()[$key-1]->normativeDocumentContent->id or
                ($ndContentModel->parent_id == $dataProvider->getModels()[$key-1]->normativeDocumentContent->parent_id && $ndContentModel->parent_id <> null)){
                // col 4
                $nd_content->addText($ndContentModel->content, $fStyle4, $pStyle4);
                // col 5
                $textrun5 = $comment->addTextRun();
                    $textrun5->addText($oneModel->comment, $fStyle5, $pStyle5);
                    if($oneModel->conformity == 0){
                    $textrun5->addText(' ('. $oneModel->getConformity($oneModel->conformity). ')', $fStyle5, $pStyle5);
                    }
                    else{
                    $textrun5->addText(' ('. $oneModel->getConformity($oneModel->conformity). ')', $fStyle51, $pStyle51);
                    }
                // $comment->addText('<w:br />');
            }
            else if($ndContentModel->document_section_id == $dataProvider->getModels()[$key-1]->normativeDocumentContent->document_section_id){
                $row = $table->addRow();
                // col 1
                $row->addCell(null,$fStyle1, $pStyle1)->addText(join([$key + 1,'.']), $fStyle1, $pStyle1);
                // col 3
                $row->addCell(null, $cellRowContinue);
                // col 4
                $nd_content = $table->addCell();
                    $nd_content->addText($ndContentModel->content, $fStyle4, $pStyle4);
                // col 5
                $comment = $table->addCell();
                    $comment->addText($oneModel->comment, $fStyle5, $pStyle5);
                // col 6
                $conformity = $table->addCell(null, $fStyle6, $pStyle6);
                if($oneModel->conformity == 0){
                    $conformity->addText($oneModel->getConformity($oneModel->conformity), $fStyle6, $pStyle6);
                }
                else{
                    $conformity->addText($oneModel->getConformity($oneModel->conformity), $fStyle61, $pStyle61);
                }
            }
            else{
                $row = $table->addRow();
                // col 1
                $table->addCell(null,$fStyle1, $pStyle1)->addText(join([$key + 1,'.']), $fStyle1, $pStyle1);
                // col 3
                $table->addCell(null, $cellRowSpan)->addText($ndModel->determination. ' ' .$ndSectionModel->section_number.'. '.$ndSectionModel->section_name, $fStyle3, $pStyle3);
                // col 4
                $nd_content = $table->addCell();
                    $nd_content->addText($ndContentModel->content, $fStyle4, $pStyle4);
                // col 5
                $comment = $table->addCell();
                    $comment->addText($oneModel->comment, $fStyle5, $pStyle5);
                // col 6
                $conformity = $table->addCell();
                if($oneModel->conformity == 0){
                    $conformity->addText($oneModel->getConformity($oneModel->conformity), $fStyle6, $pStyle6);
                }
                else{
                    $conformity->addText($oneModel->getConformity($oneModel->conformity), $fStyle61, $pStyle61);
                }
            }
        }
        }

        $body4 = $section->addTextRun(['align' => 'both']);
        $section->addTextBreak(1);
        $section->addText(htmlspecialchars($user_position."\t".$user_name), null, 'rightTab');
        $section->addText(htmlspecialchars($date_uz));

        $file = $company->company_name.' identifikatsiya('.date('d.m.y').').docx';
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