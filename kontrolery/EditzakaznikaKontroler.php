<?php

class EditzakaznikaKontroler extends Kontroler
{   
    public function zpracuj(array $parametry): void
    {

        $this->hlavicka = array(
            'titulek' => 'Edit zákazníka',
            'klicova_slova' => 'pojištění, pojištovna, zabespečení, zdraví,',
            'popis' => 'Pojišťovna s nejlepším pojištěním za bezkonkurenční ceny, které oceníte na cestách, ve zdraví i v nemoci, nebo třeba i při péči o mazlíčka.'
        );


        $zakaznik = array(
            'id_zakaznika' => "",
            'jmeno_zakaznika' => "",
            'prijmeni_zakaznika' => "",
            'email_zakaznika' => "",
            'mesto' => "",
            'ulice' => "",
            'cp' => "",
            'psc' => "",
            'narozeni' => "",
        );        
        $spravceZakazniku = new SpravceZakazniku();
        $this->data['zakaznik'] = $spravceZakazniku->vratZakaznika($parametry[0]);


        if ($_POST) {
            $klice = array('id_zakaznika', 'jmeno_zakaznika', 'prijmeni_zakaznika', 'email_zakaznika', 'mesto', 'ulice', 'cp', 'psc', 'narozeni');
            $zakaznik = array_intersect_key($_POST, array_flip($klice));
        $spravceZakazniku->editZakaznika($_POST['id_zakaznika'], $zakaznik);
        $this->pridejZpravu('Data zákazníka byly úspěšně změněny');
        $this->presmeruj('zakaznik/' . $zakaznik['id_zakaznika']);
        }
        
        

        // Nastavení šablony
        $this->pohled = 'editzakaznika';
    }
}
