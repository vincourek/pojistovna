<?php 

/**
 * třída pro spravce zákazníků
 */
class SpravceZakazniku {

    public function vratZakaznika(string $id): array
    {
    
        return Db::dotazJeden('
            SELECT `id_zakaznika`, `jmeno_zakaznika`, `prijmeni_zakaznika`, `email_zakaznika`, `mesto`, `ulice`, `cp`, `psc`, `narozeni`
            FROM `pojistenci`
            WHERE `id_zakaznika` = ?
        ', array($id));
    }

    public function vratZakazniky(): array
    {
        return Db::dotazVsechny('
            SELECT `id_zakaznika`, `jmeno_zakaznika`, `prijmeni_zakaznika`, `email_zakaznika`, `mesto`, `ulice`, `cp`, `psc`, `narozeni`
            FROM `pojistenci`
            ORDER BY `id_zakaznika` DESC
        ');
    }

    public function ulozZakaznika(string $jmeno,string $prijmeni, string $email, string $mesto, string $ulice, string $cp, int $psc, string $narozeni): void
    {   
        if (empty($_POST['jmeno_zakaznika']) || trim($_POST['jmeno_zakaznika']) === '')
            throw new ChybaUzivatele('Musíte vyplnit jméno');
        if (empty($_POST['prijmeni_zakaznika']) || trim($_POST['prijmeni_zakaznika']) === '')
            throw new ChybaUzivatele('Musíte vyplnit příjmení');
        if (empty($_POST['email_zakaznika']) || trim($_POST['email_zakaznika']) === '')
            throw new ChybaUzivatele('Nemáte  vyplněný email');
        if (empty($_POST['mesto']) || trim($_POST['mesto']) === '')
            throw new ChybaUzivatele('Musíte vyplnit město');
        if (empty($_POST['ulice']) || trim($_POST['ulice']) === '')
            throw new ChybaUzivatele('Musíte vyplnit ulici');
        if (empty($_POST['cp']) || trim($_POST['cp']) === '')
            throw new ChybaUzivatele('Musíte vyplnit číslo popisné');
        if (empty($_POST['psc']) || trim($_POST['psc']) === '')
            throw new ChybaUzivatele('Musíte vyplnit směrovací číslo');
        if (strlen($_POST['psc']) != 5)
            throw new ChybaUzivatele('Směrovací číslo musí mít 5 znaků');
        if ((date('Y') - $narozeni) < 18)
            throw new ChybaUzivatele('Zákazník ještě není plnoletý');
        $zakaznik = array(
            'jmeno_zakaznika' => $jmeno,
            'prijmeni_zakaznika' => $prijmeni,
            'email_zakaznika' => $email,
            'mesto' => $mesto,
            'ulice' => $ulice,
            'cp' => $cp,
            'psc' => $psc,
            'narozeni' => $narozeni
        );
        try {
            Db::vloz('pojistenci', $zakaznik);
        } catch (PDOException $chyba) {
            throw new ChybaUzivatele('Uživatel s tímto emailem je již zaregistrovaný.');
        }
    }

    public function najdiPojistky(int $id_zakaznik) : array {
            return Db::dotazVsechny('SELECT * 
            FROM pojistenci z
            JOIN pojisteni po ON z.id_zakaznika = po.id_zakaznika
            JOIN produkty pr ON pr.id_produktu = po.id_produktu
            JOIN uzivatele uz ON po.id_uzivatele = uz.id_uzivatele 
            WHERE z.id_zakaznika = ?',
            array ($id_zakaznik));
    }

    public function editZakaznika(int|bool $id, array $zakaznik) {
        Db::zmen('pojistenci', $zakaznik, 'WHERE id_zakaznika = ?', array($id));
    }
    


}

    