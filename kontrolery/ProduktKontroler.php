<?php

class ProduktKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        
        $this->hlavicka = array(
            'titulek' => 'Rodinná pojišťovna',
            'klicova_slova' => 'pojištění, pojištovna, zabespečení, zdraví,',
            'popis' => 'Pojišťovna s nejlepším pojištěním za bezkonkurenční ceny, které oceníte na cestách, ve zdraví i v nemoci, nebo třeba i při péči o mazlíčka.'
        );
        $id = isset($parametry[0]) ? intval($parametry[0]) : null;
        $spravceProduktu = new SpravceProduktu();

        

        $this->data['produkt'] = $spravceProduktu->vratProdukt($id);
       
        // Nastavení šablony
        $this->pohled = 'produkt';


    }
}