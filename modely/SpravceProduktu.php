<?php 

class SpravceProduktu
{

    /**
     * Vrátí produkt z databáze podle jeho URL
     */
    public function vratProdukt(string $id): array
    {
    
        return Db::dotazJeden('
            SELECT `id_produktu`, `nazev`, `popis`, `obrazek`
            FROM `produkty`
            WHERE `id_produktu` = ?
        ', array($id));
    }

    /**
     * Vrátí seznam produktu v databázi
     */
    public function vratProdukty(): array
    {
        return Db::dotazVsechny('
            SELECT `id_produktu`, `nazev`, `popis`, `obrazek`
            FROM `produkty`
            ORDER BY `id_produktu` DESC
        ');
    }

    public function ulozProdukt(int|bool $id, array $produkt): void
    {
        if (!$id)
            Db::vloz('produkty', $produkt);
        else
            Db::zmen('produkty', $produkt, 'WHERE id_produktu = ?', array($id));
    }

    public function odstranProdukt(string $id): void
    {
        Db::dotaz('
        DELETE FROM produkty
        WHERE nazev = ?
    ', array($id));
    }

}