<?php
    require_once "connexion.php";
    $stmtArticles = $con->prepare("SELECT * FROM article ");
    $stmtArticles->execute();

   // Ajouter la logique pour enregistrer une facture (déjà implémentée dans la classe)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="row justify-content-center mt-4">
        <div class="col-12 col-xl-10">
            <form action="#" method="POST">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="card shadow-sm p-4 mt-3">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="fw-semibold">Articles de la Facture</h5>
                                <button type="button" id="add_item" class="btn btn-sm btn-dark text-white">
                                    <i class="fa-solid fa-plus"></i> Ajouter
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="items-table" class="table table-sm align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Article</th>
                                            <th>Prix (DH)</th>
                                            <th>Quantité</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-2 text-center">
                                                <select name="id_articles[]" class="form-select">
                                                    <option value="">-- Liste des Articles --</option>
                                                    <?php while ($article = $stmtArticles->fetch(PDO::FETCH_OBJ)):?>
                                                        <option value="<?= $article->idArticle; ?>"><?= $article->libelle; ?></option>
                                                    <?php endwhile; ?>
                                                </select>
                                            </td>
                                            <td class="py-2 text-center">
                                                <input type="number" class="form-control" name="prix[]" value="0" min="0" step="0.01" required>
                                            </td>
                                            <td class="py-2 text-center">
                                                <input type="number" class="form-control" name="quantites[]" value="1" min="1" required>
                                            </td>
                                            <td class="py-2 text-center">
                                                <button type="button" class="btn btn-danger text-dark btn-sm remove-item">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card shadow-sm p-4">
                            <h5 class="fw-semibold mb-3">Informations de la Facture</h5>

                            <div class="mb-3">
                                <label class="form-label fw-medium">Numéro de Facture</label>
                                <input type="text" name="numeroFacture" class="form-control" value="FAC-2025-001" readonly>
                            </div>
                            <div class="mb-3">
                            <label class="form-label fw-medium">Date de la Facture</label>
                                <input type="date" id="dateFacture" name="dateFacture" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                
                            <div class="mb-3">
                                <label class="form-label fw-medium">Statut</label>
                                <select name="statut" class="form-select" required>
                                    <option value="">-- Statut --</option>
                                    <option value="réglée">Réglée</option>
                                    <option value="non réglée">Non réglée</option>
                                </select>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-dark fw-semibold">
                                    <i class="fa-solid fa-floppy-disk"></i> Enregistrer la Facture
                                </button>
                                <button type="reset" class="btn btn-outline-secondary fw-semibold">Annuler</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addButton = document.getElementById('add_item');
        const itemsTable = document.querySelector('#items-table tbody');

        addButton.addEventListener('click', () => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="py-2 text-center">
                    <select name="id_articles[]" class="form-select" required>
                        <option value="">-- Liste des Articles --</option>
                        <?php $stmtArticles->execute(); ?>
                        <?php while ($article = $stmtArticles->fetch(PDO::FETCH_OBJ)):?>
                            <option value="<?= $article->idArticle; ?>"><?= $article->libelle; ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
                <td class="py-2 text-center">
                    <input type="number" class="form-control" name="prix[]" value="0" min="0" step="0.01" required>
                </td>
                <td class="py-2 text-center">
                    <input type="number" class="form-control" name="quantites[]" value="1" min="1" required>
                </td>
                <td class="py-2 text-center">
                    <button type="button" class="btn btn-danger text-dark btn-sm remove-item">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            `;
            itemsTable.appendChild(tr);
        });

        itemsTable.addEventListener("click", (e)=>{
            if(e.target.closest('.remove-item')){
                e.target.closest('tr').remove();
            }
        });
    </script>
</body>
</html>