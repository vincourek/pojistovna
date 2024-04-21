<?php

class EditorKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Editor Produktů';
        
        // Vytvoření instance modelu
        $spravceProduktu = new SpravceProduktu();
        // Příprava prázdného článku
        $produkt = array(
            'id_produktu' => "",
            'nazev' => "",
            'popis' => "",
            'obrazek' => "",
            'cena' => "",
        );
        // Je odeslán formulář
        if ($_POST) {
            // Získání produktu z $_POST
            $klice = array('nazev', 'popis', 'obrazek', 'cena');
            $produkt = array_intersect_key($_POST, array_flip($klice));
            // Uložení produktu do DB
            $spravceProduktu->ulozProdukt($_POST['id_produktu'], $produkt);
            $this->pridejZpravu('Produkt byl úspěšně uložen.');
            $this->presmeruj('produkt/' . $produkt['id_produktu']);
        } else if (!empty($parametry[0])) {
            // Je zadané URL článku k editaci
            $nactenyProdukt = $spravceProduktu->vratProdukt($parametry[0]);
            if ($nactenyProdukt)
                $produkt = $nactenyProdukt;
            else
                $this->pridejZpravu('Produkt nebyl nalezen');
        }

        $this->data['produkt'] = $produkt;
        $this->pohled = 'editor';
    }
}