<?php

class ZakazniciKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        
        $this->hlavicka = array(
            'titulek' => 'Zákaznici',
            'klicova_slova' => 'pojištění, pojištovna, zabespečení, zdraví,',
            'popis' => 'Pojišťovna s nejlepším pojištěním za bezkonkurenční ceny, které oceníte na cestách, ve zdraví i v nemoci, nebo třeba i při péči o mazlíčka.'
        );
        
        $this->overUzivatele();

        $spravceUzivatelu = new SpravceUzivatelu();
        if (!empty($parametry[0]) && $parametry[0] == 'odhlasit') {
            $spravceUzivatelu->odhlas();
            $this->presmeruj('prihlaseni');
        } else {
            $jmeno = isset($parametry[0]) ? intval($parametry[0]) : null;
        }
      
        $this->data['uzivatel'] = $spravceUzivatelu->vratUzivatele($jmeno);

        $spravceZakazniku = new SpravceZakazniku(); 
        $this->data['zakaznici'] = $spravceZakazniku->vratZakazniky();

        // Nastavení šablony
      
            $this->pohled = 'zakaznici';
    }

}