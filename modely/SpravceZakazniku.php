<?php 
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

    