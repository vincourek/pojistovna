<?php
class PojistovnaKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = array(
            'titulek' => 'Rodinná pojišťovna',
            'klicova_slova' => 'pojištění, pojištovna, zabespečení, zdraví,',
            'popis' => 'Pojišťovna s nejlepším pojištěním za bezkonkurenční ceny, které oceníte na cestách, ve zdraví i v nemoci, nebo třeba i při péči o mazlíčka.'
        );

        

        $spravceUzivatelu = new SpravceUzivatelu();
        if (!empty($parametry[0]) && $parametry[0] == 'odhlasit') {
            $spravceUzivatelu->odhlas();
            $this->presmeruj('prihlaseni');
        } else {
            $jmeno = isset($parametry[0]) ? intval($parametry[0]) : null;
        }

      
        $this->data['uzivatel'] = $spravceUzivatelu->vratUzivatele($jmeno);
        
        $this->pohled = 'pojistovna';
    }
}