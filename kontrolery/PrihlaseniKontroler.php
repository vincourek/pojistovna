<?php
class PrihlaseniKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {
        $spravceUzivatelu = new SpravceUzivatelu();
        if ($spravceUzivatelu->vratUzivatele())
            $this->presmeruj('pojistovna');
        // Hlavička stránky
        $this->hlavicka['titulek'] = 'Přihlášení';
        if ($_POST) {
            try {
                $spravceUzivatelu->prihlas($_POST['email'], $_POST['heslo']);
                $this->pridejZpravu('Byl jste úspěšně přihlášen.');
                $this->presmeruj('pojistovna');
            } catch (ChybaUzivatele $chyba) {
                $this->pridejZpravu($chyba->getMessage());
            }
        }
        // Nastavení šablony
        $this->pohled = 'prihlaseni';
        
    }
}