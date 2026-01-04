<?php
class Donnes {
    private $con;

    public function __construct() {
        try {
            $this->con = new PDO("mysql:host=localhost;dbname=ecommercedb", "root", "");
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getPrix($idArticle) {
        $req = $this->con->prepare("
            SELECT 
                a.prix AS oldPrice,
                p.taux,
                p.datePromo,
                p.duree
            FROM article a
            LEFT JOIN promotions p 
                ON a.idArticle = p.idArticle
            WHERE a.idArticle = ?
        ");
        $req->execute([$idArticle]);
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if (!$data || !$data['taux']) {
            return [
                "prix" => floatval($data['oldPrice']),
                "oldPrice" => null
            ];
        }

        $req2 = $this->con->prepare("
            SELECT CURRENT_DATE() BETWEEN ? 
                   AND DATE_ADD(?, INTERVAL ? DAY)
        ");
        $req2->execute([
            $data['datePromo'],
            $data['datePromo'],
            intval($data['duree'])
        ]);
        $isActive = $req2->fetchColumn();

        if (!$isActive) {
            return [
                "prix" => floatval($data['oldPrice']),
                "oldPrice" => null
            ];
        }

        $taux = floatval(str_replace("%", "", $data['taux']));
        $oldPrice = floatval($data['oldPrice']);
        $newPrice = $oldPrice - ($oldPrice * ($taux / 100));

        return [
            "prix" => round($newPrice, 2),
            "oldPrice" => $oldPrice
        ];
    }

    public function getCategories() {
        $req = $this->con->prepare("SELECT * FROM categorie");
        $req->execute();
        return $req;
    }

    public function getNouveauxProduits() {
        $req = $this->con->prepare("
            SELECT article.*, images.urlImage
            FROM article
            LEFT JOIN images 
                ON article.idArticle = images.idArticle
                AND images.principal = 'oui'
            ORDER BY dateMiseVente DESC
            LIMIT 5
        ");
        $req->execute();
        return $req;
    }

    public function getPromotions() {
        $req = $this->con->prepare("
            SELECT 
                promotions.*,
                article.*,
                images.urlImage
            FROM promotions
            INNER JOIN article 
                ON promotions.idArticle = article.idArticle
            LEFT JOIN images 
                ON article.idArticle = images.idArticle
                AND images.principal = 'oui'
            WHERE CURRENT_DATE() BETWEEN datePromo 
            AND DATE_ADD(datePromo, INTERVAL duree DAY)
        ");
        $req->execute();
        return $req;
    }

    public function getPublicites() {
        $req = $this->con->prepare("
            SELECT * FROM publicites 
            WHERE CURRENT_DATE() BETWEEN datePub 
            AND DATE_ADD(datePub, INTERVAL duree DAY)
        ");
        $req->execute();
        return $req;
    }

    public function getProduitsByCategorie($idCat) {
        $req = $this->con->prepare("
            SELECT 
                article.*,
                images.urlImage
            FROM article
            LEFT JOIN images 
                ON article.idArticle = images.idArticle
                AND images.principal = 'oui'
            WHERE article.idCategorie = ?
        ");
        $req->execute([$idCat]);

        return $req;
    }

    public function getProduit($idArticle) {
        $req = $this->con->prepare("SELECT * FROM article WHERE idArticle = ?");
        $req->execute([$idArticle]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getImages($idArticle) {
        $req = $this->con->prepare("SELECT * FROM images WHERE idArticle = ?");
        $req->execute([$idArticle]);
        return $req;
    }

    public function getCaracteristiques($idArticle) {
        $req = $this->con->prepare("SELECT champ, definition FROM caracteristiques WHERE idArticle = ?");
        $req->execute([$idArticle]);
        return $req;
    }
}
?>
