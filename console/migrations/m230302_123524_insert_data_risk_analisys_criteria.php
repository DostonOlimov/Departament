<?php

use yii\db\Migration;

/**
 * Class m230302_123524_insert_data_risk_analisys_criteria
 */
class m230302_123524_insert_data_risk_analisys_criteria extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('risk_analisys_criteria', 'criteria',$this->text());
        $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.1',
            'criteria_category' => '1',
            'criteria' => 'Texnik reglamentlar va standartlashtirishga doir normativ hujjatlarning majburiy (Qonunlar, farmonlar, qarorlar, farmoyishlar, adliya vazirligidan ro\'yxatdan o\'tgan tartiblar) talablariga rioya etmaslik ',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.2',
            'criteria_category' => '1',
            'criteria' => 'Texnik jihatdan tartibga solish sohasidagi normativ hujjat talablariga javob bermaydigan mahsulot va xizmatlarni realizatsiya qilish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.3',
            'criteria_category' => '1',
            'criteria' => 'Texnik jihatdan tartibga solish sohasidagi tegishli me\'yoriy hujjatlarsiz mahsulotni (jumladan, ta\'mirlashdan so\'ng), yetkazib berish (realizatsiya) yoki ulardan foydalanish (ishlatish), ishlarni va xizmatlarni bajarish.',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.4',
            'criteria_category' => '1',
            'criteria' => 'Mahsulotlarni ishlab chiqarishda va undan foydalanishda texnik reglamentlar va standartlarning majburiy talablari bo\'yicha sinovlar to\'liq o\'tkazilmasdan realizatsiya qilish',
            'company_field_category'=> '0',
            'criteria_score' => '15',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.5',
            'criteria_category' => '1',
            'criteria' => 'Normativ hujjatlar talablariga muvofiqligini tasdiqlovchi mahsulotni realizatsiya qilish uchun qabul qilish va realizatsiya qilishni davom ettirish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.6',
            'criteria_category' => '1',
            'criteria' => 'Texnik jihatdan tartibga solish sohasidagi me\'yoriy hujjatlar talablariga muvofiqligini tasdiqlash to\'g\'risidagi ma\'lumotlarni o\'z ichiga oladigan hujjatlarga ega bo\'lmagan oziq-ovqat va nooziq ovqat mahsulotlarini sotish (realizatsiya qilish)',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.7',
            'criteria_category' => '1',
            'criteria' => 'Qadoqlash, tamg\'alash (etiketkalash) va ularning to\'g\'ri qo\'llanilishi talablariga javob bermaydigan mahsulotlarni realizatsiya qilish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.8',
            'criteria_category' => '1',
            'criteria' => 'import mahsulotlarni (tovar) qadog\'ida davlat tilidagi matn yo\'qligi, texnik jihatdan tartibga solish sohasidagi normativ hujjat talablariga javob bermasligi. ',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
           
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.9',
            'criteria_category' => '1',
            'criteria' => 'iste\'molchiga mahsulot tarkibini, xususiyatlarini, ozuqaviy qiymatini (oziq-ovqat mahsulotlari uchun), kelib chiqish tabiati, ishlab chiqarish (ishlab chiqarish) uslubi va ulardan foydalanish (qo\'llash) usuli, shuningdek bevosita boshqa axborotni iste\'molchilarga tushunarli, yoki mahsulotlar (tovarlar)ning sifatini va xavfsizligini, yaroqlilik muddati, saqlash sharoitlari bilvosita ifodalanmasligi',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '1.10',
            'criteria_category' => '1',
            'criteria' => 'O\'zbekiston texnik jihatdan tartibga solish agentligi yoki agentlik huzuridagi departament tomonidan qonunchilik buzilishlarini bartaraf etish bo\'yicha berilgan ko\'rsatmalarini, tahlil qilish vaqtida aniqlangan buzilish (kamchiliklar)ni bartaraf etish bo\'yicha tavsiyalarni bajarmaslik',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
             
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '2.1',
            'criteria_category' => '2',
            'criteria' => 'Sertifikatlashtirish sohasidagi normativ huquqiy hujjatlar (Qonunlar, farmonlar, qarorlar, farmoyishlar, Adliya vazirligidan ro\'yxatdan o\'tgan tartiblar) talablariga rioya etmaslik',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '2.2',
            'criteria_category' => '2',
            'criteria' => 'Muvofiqlik sertifikati (deklaratsiya) bo\'lmagan va (yoki) sohta muvofiqlik sertifikati bilan mahsulotni olib kirish (import qilish) va (yoki) realizatsiya qilish',
            'company_field_category'=> '0',
            'criteria_score' => '15',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '2.3',
            'criteria_category' => '2',
            'criteria' => 'Amal qilish muddati tugagan muvofiqlik sertifikati (deklaratsiya) bilan mahsulotni olib kirish (import qilish) va (yoki) realizatsiya qilish',
            'company_field_category'=> '0',
            'criteria_score' => '15',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '2.4',
            'criteria_category' => '2',
            'criteria' => 'Ishlab chiqarilayotgan va import bo\'yicha olib kirilayotgan sertifikatlanishi majburiy bo\'lgan mahsulotlarga texnik reglament va standartlarda belgilangan majburiy ko\'rsatkichlari bo\'yicha to\'liq sinovlar o\'tkazilib xavfsizligi aniqlanmasdan muvofiqlik sertifikatini olish va undan foydalanish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '2.5',
            'criteria_category' => '2',
            'criteria' => 'Muvofiqlik belgisi bilan noto\'g\'ri (noqonuniy) tamg\'alangan (etiketkalangan) mahsulotni realizatsiya qilish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '2.6',
            'criteria_category' => '2',
            'criteria' => 'Import bo\'yicha olib kelingan xamda ishlab chiqarilayotgan mahsulotlarni texnik reglamentlar va standartlarning majburiy talablariga muvofiqligini to\'liq baxolamasdan muvofiqlik sertifikatlari rasmiylashtirish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '2.7',
            'criteria_category' => '2',
            'criteria' => 'O\'zbekiston texnik jihatdan tartibga solish agentligi yoki agentlik huzuridagi departamenti tomonidan qonunchilik buzilishlarini bartaraf etish bo\'yicha berilgan ko\'rsatmalarini, tahlil qilish vaqtida aniqlangan buzilish (kamchiliklar)ni bartaraf etish bo\'yicha tavsiyalarni bajarmaslik',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.1',
            'criteria_category' => '3',
            'criteria' => 'Metrologiya sohasidagi normativ huquqiy hujjatlar (Qonunlar, farmonlar, qarorlar, farmoyishlar, farmoyishlar, adliya vazirligidan ro\'yxatdan o\'tgan tartiblar) talablariga rioya etmaslik',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.2',
            'criteria_category' => '3',
            'criteria' => 'Davlat metrologiya tekshiruvi va nazorati doirasida bo\'lgan metrologik attestatsiyadan o\'tmagan o\'lchashlarni bajarish uslubiyotlaridan foydalanish',
            'company_field_category'=> '0',
            'criteria_score' => '5',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.3',
            'criteria_category' => '3',
            'criteria' => 'Qiyoslanmagan (kalibrovkalanmagan) va (yoki) nosoz va (yoki) attestatlanmagan o\'lchash va sinov vositalarini, o\'lchash birlik etalonlarini, axborot o\'lchash tizimlarini, moddalar va materiallar tarkibi hamda xossalarining standart namunalarini metrologiya normalari va qoidalarida nazarda tutilgan o\'zga obyektlarni qo\'llash ulardan foydalanish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.4',
            'criteria_category' => '3',
            'criteria' => 'Turini tasdiqlash yoki metrologik attestatsiyadan (sinovdan) o\'tkazilmagan, o\'lchashlarning birliligini ta\'minlash davlat tizimining reestrlariga kiritilmagan, o\'lchash vositalarini, o\'lchash birlik etalonlarini ishlab chiqarish, realizatsiya qilish, ulardan foydalanish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.5',
            'criteria_category' => '3',
            'criteria' => 'Texnik jihatdan tartibga solish sohasidagi normativ hujjatlarsiz, o\'lchash vositalarini, moddalar va materiallar tarkibi hamda xossalarining standart namunalari ishlab chiqarish, ulardan foydalanish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.6',
            'criteria_category' => '3',
            'criteria' => 'O\'lchashlarning birliligini ta\'minlash uchun yangilanmagan, o\'zgartirishlar kiritilmagan (aktuallashtirilmagan) me\'yoriy hujjatlarni qo\'llash (mavjud MX ko\'rsatkichiga muvofiq)',
            'company_field_category'=> '0',
            'criteria_score' => '5',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.7',
            'criteria_category' => '3',
            'criteria' => 'Qadoqda ko\'rsatilgan mahsulot miqdoriga mos kelmagan miqdordagi mahsulotni realizatsiya qilish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.8',
            'criteria_category' => '3',
            'criteria' => 'Tijoriy operatsiyalarda begonalashtirilgan tovarlar sonini tavsiflovchi noto\'g\'ri massa, hajm, xarajat yoki boshqa miqdorda mahsulotlarni realizatsiya qilish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.9',
            'criteria_category' => '3',
            'criteria' => 'Texnik reglamentlar va standartlashtirishga doir normativ hujjatlarning majburiy talablarida belgilangan xomashyo, tarkibiy qismlar va iste\'molchiga yetkazib beriladigan mahsulotlarning sifatini to\'liq nazorat qilmaslik, ishlab chiqarilgan o\'lchash vositalarini sinovdan o\'tkazish (ishlab chiqarish uchun) hajmini nazorat qilishni ta\'minlash uchun zarur bo\'lgan, o\'rnatilgan tartibda metrologik tekshiruvdan o\'tkazilmagan o\'lchash vasinov vositalari bilan ta\'minlanmaganligi',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.10',
            'criteria_category' => '3',
            'criteria' => 'O\'lchashlarning birliligini ta\'minlash davlat reestiriga kiritilmagan o\'lchash vositalari turini ishlab chiqarishda qo\'llash',
            'company_field_category'=> '0',
            'criteria_score' => '5',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.11',
            'criteria_category' => '3',
            'criteria' => 'mahsulot sifati, xavfsizligini baxolash va tasdiqlash jarayonida, qo\'llanilayotgan, metrologik tekshiruvdan o\'tmagan qiyoslashga taqdim etilmagan (qiyoslash muddati o\'tgan) o\'lchash vositalari va sinov vositalari uskunalaridan foydalanilayotganligi, jumladan kalibrovkaga qilinmagan.',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.12',
            'criteria_category' => '3',
            'criteria' => 'O\'zbekiston respublikasida qonunlashtirilgan o\'lchash birliklardan foydalanish va qo\'llash',
            'company_field_category'=> '0',
            'criteria_score' => '5',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '3.13',
            'criteria_category' => '3',
            'criteria' => '"O\'zbekiston texnik jihatdan tartibga solish agentligi" yoki agentlik huzuridagi departamenti tomonidan qonunchilik buzilishlarini bartaraf etish bo\'yicha berilgan ko\'rsatmalarini, tahlil qilish vaqtida aniqlangan buzilish (kamchiliklar)ni bartaraf etish bo\'yicha tavsiyalarni bajarmaslik',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.1',
            'criteria_category' => '4',
            'criteria' => 'Muvofiqlikni baholash sohasidagi normativ huquqiy hujjatlar (Qonunlar, farmonlar, qarorlar, farmoyishlar, adliya vazirligidan ro\'yxatdan o\'tgan  tartiblar) talablariga rioya etmaslik',
            'company_field_category'=> '0',
            'criteria_score' => '20',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.2',
            'criteria_category' => '4',
            'criteria' => 'Muvofiqlikni baholash sohasida sertifikatlar, sinov va kalibrlash (qiyoslash) bayonnomalari (sinov natijalarini) berish muddatlarini buzish',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.3',
            'criteria_category' => '4',
            'criteria' => 'Amalda bo\'lmagan texnik jihatdan tartibga solish sohasidagi normativ hujjatlar asosida sinov va kalibrlash (qiyoslash) metrologik attestatlash, o\'lchash vositalari turini tasdiqlash bayonnomalari (sinov natijalarini) berish',
            'company_field_category'=> '0',
            'criteria_score' => '20',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.4',
            'criteria_category' => '4',
            'criteria' => 'Muvofiqlikni baholash sohasida texnik reglamentlar va standartlarning majburiy talablariga to\'liq amal qilinmagan holda sertifikatlarni berish (sinovlarni to\'liq o\'tkazmaslik)',
            'company_field_category'=> '0',
            'criteria_score' => '20',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.5',
            'criteria_category' => '4',
            'criteria' => 'Texnik jihatdan tartibga solish sohasidagi normativ hujjatlar asosida, muvofiqlikni baholash idorasi tomonidan belgilangan faoliyat doirasiga kiritilmagan sinovlar va mahsulotlarga sertifikatlar, sinov va kalibrlash (qiyoslash) bayonnomalari (sinov natijalarini) berish',
            'company_field_category'=> '0',
            'criteria_score' => '20',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.6',
            'criteria_category' => '4',
            'criteria' => 'Muvofiqlik sertifikatlarini berish uchun asos bo\'lgan hujjatlar (gigiena xulosalari, sinov bayonnomalari va boshqalar), muvofiqlikni baxolash sohasidagi sertifikatda ko\'rsatilgan mahsulotga mos kelmasligi, (xizmatlarning) nomlarining nomuvofiqligi',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.7',
            'criteria_category' => '4',
            'criteria' => 'Himoya darajasiga ega bo\'lgan blankalarda muvofiqlik sertifikatini rasmiylashtirish talablarini buzish, jumladan: idora rahbari va yoki ekspert auditorning imzolari yo\'qligi; muvofiqlik sertifikatlar blankalarini rasmiylashtirishda buzilishlar (xatolar)',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.8',
            'criteria_category' => '4',
            'criteria' => 'Muvofiqlikni baholash sohasida sinov va kalibrlash (qiyoslash, metrologik  attestatsiyadan o\'tkazish, davlat sinovlarini o\'tkazish) metrologik tekshiruvdan o\'tkazmasdan ulardan foydalanish bayonnomalarini rasmiylashtirish talablarni buzish, jumladan: Muvofiqlikni baholash organi rahbari va/yoki ijrochilarining imzosi yo\'qligi; muvofiqlikni baholash sohasida sinov va kalibrlash (qiyoslash, metrologik attestatsiyadan o\'tkazish, davlat sinovlarini o\'tkazish) bayonnomalarini rasmiylashtirishda me\'yoriy hujjatlarda belgilangan tartiblari buzilishlar (xatolar)',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.9',
            'criteria_category' => '4',
            'criteria' => 'O\'zbekiston texnik jihatdan tartibga solish agentligi yoki agentlik huzuridagi departamenti tomonidan qonunchilik buzilishlarini bartaraf etish bo\'yicha berilgan ko\'rsatmalarini, tahlil qilish vaqtida aniqlangan buzilish (kamchiliklar)ni bartaraf etish bo\'yicha tavsiyalarni bajarmaslik',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.10',
            'criteria_category' => '4',
            'criteria' => 'Mahsulotni sinash talablarini buzish jumladan: mahsulot sinovlari to\'liq amalga oshirmaslik (sinov dasturidan chetga chiqish, mahsulotlarda sinov o\'tkazish uchun zarur shart-sharoitlar, mutaxassislar, yordamchi qurilmalar mavjud emas)',
            'company_field_category'=> '0',
            'criteria_score' => '15',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '4.11',
            'criteria_category' => '4',
            'criteria' => 'O\'zbekiston texnik jihatdan tartibga solish agentligi yoki agentlik huzuridagi departamenti tomonidan qonunchilik buzilishlarini bartaraf etish bo\'yicha berilgan ko\'rsatmalarini, tahlil qilish vaqtida aniqlangan buzilish (kamchiliklar)ni bartaraf etish bo\'yicha tavsiyalarni bajarmaslik. Shu jumladan, texnik jihatdan tartibga solish sohasidagi normativ hujjatlarga, shuningdek qonunchilikda ko\'zda tutilgan tegishli ruxsat beruvchi hujjatlarga ega bo\'lmagan mahsulotlarni (xizmatlarni) ishlab chiqarishni taqiqlash to\'g\'risida qarorni bajarmaslik.',
            'company_field_category'=> '0',
            'criteria_score' => '15',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '5.1',
            'criteria_category' => '5',
            'criteria' => 'Ommaviy axborot vositalari orqali ariza va shikoyatlar kelib tushganda',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '5.2',
            'criteria_category' => '5',
            'criteria' => 'Ijtimoiy tarmoqlarda mahsulot sifati ustidan shikoyatlar kelib tushganda',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '5.3',
            'criteria_category' => '5',
            'criteria' => 'Mahsulot Yevropa Ittifoqi (YeI) va Yevroosiyo iqtisodiy ittifoqida (EOII)ning xavfli mahsulotlar haqida tezkor xabar berish axborot tizimlariga kiritilgan holatda',
            'company_field_category'=> '0',
            'criteria_score' => '5',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '5.4',
            'criteria_category' => '5',
            'criteria' => 'Nazorat xaridi orqali mahsulot tekshirilganda texnik jihatdan tartibga solish sohasidagi normativ hujjat talablariga javob bermasligi',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '5.5',
            'criteria_category' => '5',
            'criteria' => 'Savdo rastalaridagi mahsulot (tovar)larning texnik jihatdan tartibga solish sohasidagi normativ hujjatlar talablariga muvofiqligini tashqi ko\'rinishi, qadoqlanishi va yorliqlanishi jihatidan o\'rganish natijalarida nomuvofiqliklar aniqlanganda.',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);
            
            $this->insert('{{%risk_analisys_criteria}}', [
            'document_paragraph'=> '5.6',
            'criteria_category' => '5',
            'criteria' => 'Jismoniy va yuridik shaxslarning qonunchilik buzilishi yuzasidan murojaatlari kelib tushganda',
            'company_field_category'=> '0',
            'criteria_score' => '10',
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => time(),
            'updated_at' => time(),
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230302_123524_insert_data_risk_analisys_criteria cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230302_123524_insert_data_risk_analisys_criteria cannot be reverted.\n";

        return false;
    }
    */
}
