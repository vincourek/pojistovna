<?php 
class SpravcePojisteni 
{

    public function vratPojisteni($pojisteni): array
    {
        return Db::dotazVsechny('
            SELECT `id_pojisteni`, `id_uzivatele`, `id_produktu`, `id_zakaznika`, `od`, `do`, `cena`,
            FROM `pojisteni`
            WHERE `id_` = ?
            ORDER BY `id_pojisteni` DESC
        ', array($pojisteni));
    }

    public function ulozPojisteni(int $id_uzivatele , int $id_produktu, int $id_zakaznika, string $od, string $do, int $cena): void
    {
        $pojisteni = array(
            'id_uzivatele' => $id_uzivatele,
            'id_produktu' => $id_produktu,
            'id_zakaznika' => $id_zakaznika,
            'od' => $od,
            'do' => $do,
            'cena' => $cena,            
        );
       
            Db::vloz('pojisteni', $pojisteni);
       
    }

    public function najdiPojistku(int $id_pojistky): array
    {
        return Db::dotazJeden(
            'SELECT * 
            FROM pojisteni z
            JOIN pojistenci po ON z.id_zakaznika = po.id_zakaznika
            JOIN produkty pr ON z.id_produktu = pr.id_produktu
            JOIN uzivatele uz ON z.id_uzivatele = uz.id_uzivatele 
            WHERE z.id_pojisteni = ?',
            array($id_pojistky)
        );
    }

    public function editPojistky(int|bool $id, array $pojistka)
    {
        Db::zmen('pojisteni', $pojistka, 'WHERE id_pojisteni = ?', array($id));
    }

    public function odstranPojistku(string $id): void
    {
        Db::dotaz('
        DELETE FROM pojisteni
        WHERE id_pojisteni = ?
    ',
            array($id)
        );
    }

    
}