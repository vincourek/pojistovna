<?php

class ProduktyKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $this->hlavicka = array(
            'titulek' => 'Rodinná pojišťovna',
            'klicova_slova' => 'pojištění, pojištovna, zabespečení, zdraví,',
            'popis' => 'Pojišťovna s nejlepším pojištěním za bezkonkurenční ceny, které oceníte na cestách, ve zdraví i v nemoci, nebo třeba i při péči o mazlíčka.'
        );

        $this->overUzivatele();

        $spravceUzivatelu = new SpravceUzivatelu();
        if (!empty($parametry[0]) && $parametry[0] == 'odhlasit') {
            $spravceUzivatelu->odhlas();
            $this->presmeruj('prihlaseni');
        }
        
        $this->data['uzivatel'] = $spravceUzivatelu->vratUzivatele();

        // Vytvoření instance modelu, který nám umožní pracovat s články
        $spravceProduktu = new SpravceProduktu();        
          
        // Není zadáno URL článku, vypíšeme všechny 
        $this->data['produkty'] = $spravceProduktu->vratProdukty();
        $this->pohled = 'produkty';
        
        
    }
}