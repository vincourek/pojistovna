<?php
class DetailpojistkyKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {

        $this->hlavicka = array(
            'titulek' => 'Zákaznici',
            'klicova_slova' => 'pojištění, pojištovna, zabespečení, zdraví,',
            'popis' => 'Pojišťovna s nejlepším pojištěním za bezkonkurenční ceny, které oceníte na cestách, ve zdraví i v nemoci, nebo třeba i při péči o mazlíčka.'
        );

        $id = isset($parametry[0]) ? intval($parametry[0]) : null;
        $spravcePojisteni = new SpravcePojisteni();
        
        $this->data['pojistka'] = $spravcePojisteni->najdiPojistku($id);
        // Nastavení šablony
        $this->pohled = 'detailpojistky';
    }
}
