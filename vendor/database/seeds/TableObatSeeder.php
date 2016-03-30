<?php

use Illuminate\Database\Seeder;

class TableObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $obat = ['Asparaginase','Azatrioprin','Bleomisin','Cisplatin','Dakarbasin','Doksorubisin','Etoposid','Fluoro urasil','Hidroksil urea','Medroksiprogesteronasetat','Metotreksat','Siklofosfamid','Siklosforin','Sitarabin','Tamoksifen','Testosteron','Vinblastin','Vinkristin','Levodopa','Karbidopa','Triheksifenidil','Fe Sulfat','Fitomenadion', 'Heparin','Warfarin','Traneksamat','Povidon iodin','Diuretik','Furosemida','HCT','Manitol','Psikofarmaka','Acarbose','Etinil','Estradiol','Glibenklamid','Gliklazid','Glikuidon','Glimepirid','Glipizid','Hidrokortison','Insulin','Levonorgestrel','Metformin','Metil Prednisolon','Pioglitazon','Prednison','Repaglinid','Rosiglitazon','Amlodipin','Atropin','Carvedilol','Digoksin','Dobutamin','Dopamin','ISDN','KCL','Klonidin','Lisinopril','Metildopa','Nifedipin','Nitrogliserin','Propanolol','Ramipril','Simvastatin','Streptokinase','Terazosin','Valsartan','Verapamil','Asam Retinoat','Basitrasin–Polimiksin B','Betametason','Mikonazol','Na Fusidat','Asetazolamid','Pilokarpin','Sulfacetamid','Timolol','Isoksuprin','Metil Ergometrin','Oksitosin','Alprazolam','Amitriptilin','CPZ','Flufenasin','Fluoksetin','Haloperidol','Quetiapin','Risperidon','Pankuronium','Neostigmin','Piridostigmin','Suksametonium','Vekuronium','Antasida','Bisakodil','Cimetidin','Dimenhidrinat','Domperidon','Lansoprazol','Loperamid','Metoklopramid','Neomisin','Omeprazol','Ranitidin','Sukralfat','Ambroksol','Aminophilin','Asetil Sistein','Bromheksin','Budesonid','DMP','GG','Ipatropium','Ketotifen','Salbutamol','Terbutalin','Hepatitis B rekombinan','Serum Antibisa ular','Serum Antidifteri','Serum Antirabies','Serum Antitetanus','Serum Imunoglobulin','Vaksin BCG','Vaksin Campak','Vaksin DTP','Vaksin Tetanus','Vaksin Polio','Vaksin Rabies','Oksimetazolin','Vitamin B6','Vitamin C','As Valproat','Diazepam','Fenitoin','Karbamazepin','Phenobarbital','Anti Infeksi','Asiklovir','Amikasin','Amoksisilin','Ampisilin','Benzipenisilin','Ciprofloksasin','Dapson','Dikloksasilin','Doksisiklin','Efavirens','Eritromisin','Ethambutol','Fenoksimetil','Flukonazol','Gentamisin','Griseofulvin','INH','Ketokonazol','Klindamisin','Kloramfenikol','Klorokuin','Kotrimoksazol','Kuinin','Lamivudin','Levofloksasin','Metronidazol','Nevirapine','Nistatin','Pirantel','Pirazinamid','Primakuin','Rifampisin','Sefadroksil','Sefiksim','Sefotaksim','Seftazidim','Seftriakson','Stavudin','Streptomisin','Sulfasalazin','Tetrasiklin','Antimigrain','Ergotamin','Cetrizin','Deksametason','Dipenhidramin','Epinefrin','Klorpheniramin','Loratadin','Kalsium Glukonat','Mg Sulfat','Na Bikarbonat','Nalokson','Protamin', 'Sulfat','Acetosal','Allopurinol','Asam Mefenamat','Fentanil','Ibuprofen','Ketoprofen','Ketorolak','Kolkisin','Meloksikam','Morfin','Tramadol','Piroksikam','Pethidin','Parasetamol','Na Diklofenak'];
        for ($i=0; $i < count($obat); $i++) {
            \App\Obat::create([
                'kode' => $obat[$i],
                'nama' => $obat[$i]
        ]);
        }
    }
}
