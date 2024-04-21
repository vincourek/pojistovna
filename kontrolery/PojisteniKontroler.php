<?php 

class PojisteniKontroler extends Kontroler
{
    public function zpracuj(array $parametry): void
    {

        $this->hlavicka = array(
            'titulek' => 'Kontaktní formulář',
            'klicova_slova' => 'kontakt, email, formulář',
            'popis' => 'Kontaktní formulář našeho webu.'
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
        
        $spravcePojisteni = new SpravcePojisteni;

        $this->data['pojisteni'] = $spravcePojisteni->vratPojisteni($this->data['uzivatel']);
        $this->pohled = 'pojisteni';

        
    }
}