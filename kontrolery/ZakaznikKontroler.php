<?php
class ZakaznikKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        
        $this->hlavicka = array(
            'titulek' => 'Zákaznici',
            'klicova_slova' => 'pojištění, pojištovna, zabespečení, zdraví,',
            'popis' => 'Pojišťovna s nejlepším pojištěním za bezkonkurenční ceny, které oceníte na cestách, ve zdraví i v nemoci, nebo třeba i při péči o mazlíčka.'
        );
        $this->overUzivatele();
        $id = isset($parametry[0]) ? intval($parametry[0]) : null;
        
        $spravceZakazniku = new SpravceZakazniku();
        $spravceUzivatelu = new SpravceUzivatelu();
        $spravcePojisteni = new SpravcePojisteni();
        
        
        $this->data['uzivatel'] = $spravceUzivatelu->vratUzivatele();
        $this->data['zakaznik'] = $spravceZakazniku->vratZakaznika($id);
        $this->data['pojistky'] = $spravceZakazniku->najdiPojistky($id);

        if (!empty($parametry[2]) && $parametry[2] == 'odstranit') {
            $spravcePojisteni->odstranPojistku($parametry[1]);
            $this->pridejZpravu('Pojistky byla úspěšně odstraněna');
            $this->presmeruj('zakaznik/' . $id);
        } else if (!empty($parametry[0])) {
            $this->data['zakaznik'] = $spravceZakazniku->vratZakaznika($parametry[0]);
        }
       
        // Nastavení šablony
        $this->pohled = 'zakaznik';
    }

}