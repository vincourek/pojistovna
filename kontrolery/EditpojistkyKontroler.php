<?php

class EditpojistkyKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {

        $this->hlavicka = array(
            'titulek' => 'Edit pojistky',
            'klicova_slova' => 'pojištění, pojištovna, zabespečení, zdraví,',
            'popis' => 'Pojišťovna s nejlepším pojištěním za bezkonkurenční ceny, které oceníte na cestách, ve zdraví i v nemoci, nebo třeba i při péči o mazlíčka.'
        );
        $pojistky = new SpravceProduktu();
        $this->data['produkty'] = $pojistky->vratProdukty();

        $spravcepojisteni = new SpravcePojisteni();

        $this->data['pojistka'] = $spravcepojisteni->najdiPojistku($parametry[0]);        
        
        $pojistka = array(
            'id_pojisteni' => "",
            'id_uzivatele' => "",
            'id_produktu' => "",
            'id_zakaznika' => "",
            'od' => "",
            'do' => "",
            'cena' => "",
        );        

        if ($_POST) {
            $klice = array('id_pojisteni', 'id_uzivatele', 'id_produktu', 'id_zakaznika', 'od', 'do', 'cena');
            $pojistka = array_intersect_key($_POST, array_flip($klice));
            $spravcepojisteni->editPojistky($parametry[0], $pojistka);
            $this->pridejZpravu('Data pojistky byly úspěšně změněny');
            $this->presmeruj('zakaznik/' . $pojistka['id_zakaznika']);
        }



        // Nastavení šablony
        $this->pohled = 'editpojistky';
    }
}
