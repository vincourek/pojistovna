<?php

class SmerovacKontroler extends Kontroler
{

    protected Kontroler $kontroler;

    public function zpracuj(array $parametry): void
    {
        $naparsovanaURL = $this->parsujURL($parametry[0]);

        if (empty($naparsovanaURL[0]))
            $this->presmeruj('pojistovna');
        $tridaKontroleru = $this->pomlckyDoVelbloudiNotace(array_shift($naparsovanaURL)) . 'Kontroler';

        if (file_exists('kontrolery/' . $tridaKontroleru . '.php'))
            $this->kontroler = new $tridaKontroleru;
        else
            $this->presmeruj('chyba');

        $this->kontroler->zpracuj($naparsovanaURL);

        $this->data['titulek'] = $this->kontroler->hlavicka['titulek'];
        $this->data['popis'] = $this->kontroler->hlavicka['popis'];
        $this->data['klicova_slova'] = $this->kontroler->hlavicka['klicova_slova'];
        // Získání jména uživatele

      

        $jmeno = isset($_SESSION['uzivatel']['jmeno']) && $_SESSION['uzivatel']['jmeno'] !== '' ? $_SESSION['uzivatel']['jmeno'] : null;
        // Uložení jména uživatele do $jmeno
        $this->data['uzivatel'] = $jmeno;
        // Nastavení hlavní šablony
//zavolá se pouze v hlavním kontroleru ve směrovači musí být opět jinak se z hlavního kontroleru nenačte
        extract($this->data, EXTR_PREFIX_ALL, ""); 
        $this->pohled = 'rozlozeni';

        $this->data['zpravy'] = $this->vratZpravy();
    }

    private function parsujURL(string $url): array
    {
        $naparsovanaURL = parse_url($url);
        $naparsovanaURL["path"] = ltrim($naparsovanaURL["path"], "/");
        $naparsovanaURL["path"] = trim($naparsovanaURL["path"]);

        $rozdelenaCesta = explode("/", $naparsovanaURL["path"]);

        return $rozdelenaCesta;

    }

    private function pomlckyDoVelbloudiNotace(string $text): string
    {
        $veta = str_replace('-', ' ', $text);
        $veta = ucwords($veta);
        $veta = str_replace(' ', '', $veta);

        return $veta;
    }

}