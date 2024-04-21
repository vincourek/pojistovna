<?php
/**
 * Správce uživatelů redakčního systému
 */
class SpravceUzivatelu
{

    /**
     * Vrátí otisk hesla
     */
    public function vratOtisk(string $heslo): string
    {
        return password_hash($heslo, PASSWORD_DEFAULT);
    }

    /**
     * Registruje nového uživatele do systému
     */
    public function registruj(string $jmeno,string $prijmeni, string $email, string $heslo, string $hesloZnovu, string $rok): void
    {
        if ($rok != date('Y'))
            throw new ChybaUzivatele('Chybně vyplněný antispam.');
        if ($heslo != $hesloZnovu)
            throw new ChybaUzivatele('Hesla nesouhlasí.');
        $uzivatel = array(
            'jmeno' => $jmeno,
            'prijmeni' => $prijmeni,
            'email' => $email,
            'heslo' => $this->vratOtisk($heslo),
        );
        try {
            Db::vloz('uzivatele', $uzivatel);
        } catch (PDOException $chyba) {
            throw new ChybaUzivatele('Uživatel s tímto emailem je již zaregistrovaný.');
        }
    }

    /**
     * Přihlásí uživatele do systému
     */
    public function prihlas(string $email, string $heslo): void
    {
        $uzivatel = Db::dotazJeden('
            SELECT id_uzivatele, jmeno, prijmeni, email, heslo, admin
            FROM uzivatele
            WHERE email = ?
        ', array($email));   
        if (!$uzivatel || !password_verify($heslo, $uzivatel['heslo']))
            throw new ChybaUzivatele('Neplatný email nebo heslo.');    
        
        $_SESSION['uzivatel'] = $uzivatel;
    }

    /**
     * Odhlásí uživatele
     */
    public function odhlas(): void
    {
        unset($_SESSION['uzivatel']);
    }

    /**
     * Vrátí aktuálně přihlášeného uživatele
     */
    public function vratUzivatele(): ?array
    {
        if (isset($_SESSION['uzivatel']))
            return $_SESSION['uzivatel'];
        return null;
    }

}