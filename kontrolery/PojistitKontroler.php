<?php

class PojistitKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        
        $this->hlavicka = array(
            'titulek' => 'Rodinná pojišťovna',
            'klicova_slova' => 'pojištění, pojištovna, zabespečení, zdraví,',
            'popis' => 'Pojišťovna s nejlepším pojištěním za bezkonkurenční ceny, které oceníte na cestách, ve zdraví i v nemoci, nebo třeba i při péči o mazlíčka.'
        );

        $this->overUzivatele();
        
        // Získání dat o přihlášeném uživateli
        $spravceUzivatelu = new SpravceUzivatelu();
        if (!empty($parametry[0]) && $parametry[0] == 'odhlasit') {
            $spravceUzivatelu->odhlas();
            $this->presmeruj('prihlaseni');
        } else {
            $jmeno = isset($parametry[0]) ? intval($parametry[0]) : null;
        }
        $this->data['uzivatel'] = $spravceUzivatelu->vratUzivatele($jmeno);

        $spravceProduktu = new SpravceProduktu;
        $this->data['produkty'] = $spravceProduktu->vratProdukty();

        $id = isset($parametry[0]) ? intval($parametry[0]) : null;

        if (isset($_POST['id_zakaznika'])) {
            $id = $_POST['id_zakaznika'];
        }

        $spravceZakazniku = new Spravcezakazniku();

        $this->data['zakaznik'] = $spravceZakazniku->vratZakaznika($id);
        // Nastavení šablony
        $this->pohled = 'pojistit';

        $spravcePojisteni = new SpravcePojisteni();
        // Příprava prázdného pole
        $pojisteni = array(
            'id_pojisteni' => "",
            'id_uzivatele' => "",
            'id_produktu' => "",
            'id_zakaznika' => "",
            'od' => "",
            'do' => "",
            'cena' => "",
        );

        
        if ($_POST){
            try {
                $spravcePojisteni->ulozPojisteni($_POST['id_uzivatele'], $_POST['id_produktu'], $_POST['id_zakaznika'], $_POST['od'],$_POST['do'], $_POST['cena']);
                
                $this->pridejZpravu('Pojištění bylo úspěšné!');
                $this->presmeruj('zakaznik/'.$id);
            } catch (ChybaUzivatele $chyba) {
                $this->pridejZpravu($chyba->getMessage());
            }
        }
               
    }
}
        
