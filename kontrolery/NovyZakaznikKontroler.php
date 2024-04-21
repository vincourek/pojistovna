<?php 
class NovyZakaznikKontroler extends Kontroler{

    public function zpracuj(array $parametry): void
    {
        
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Nový Zákazník';

        $this->overUzivatele();

        if ($_POST) {
            try {
                $spravceZakazniku = new SpravceZakazniku();
                $spravceZakazniku->ulozZakaznika($_POST['jmeno_zakaznika'], $_POST['prijmeni_zakaznika'], $_POST['email_zakaznika'], $_POST['mesto'], $_POST['ulice'], $_POST['cp'], $_POST['psc'], $_POST['narozeni']);
                $this->pridejZpravu('Zákazník byl úspěšně uložen.');
                $this->presmeruj('zakaznici');
            } catch (ChybaUzivatele $chyba) {
                $this->pridejZpravu($chyba->getMessage());
            }
        }
        
        // Nastavení šablony
        $this->pohled = 'novyZakaznik';
        
    }
}