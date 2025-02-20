<?php
// Connexion à la base de données
include('connexion_db.php');

// Vérification de la soumission du formulaire
if (isset($_POST['payer'])) {
    // Récupérer les informations du formulaire
    $montant = $_POST['montant'];
    $mode_paiement = $_POST['mode_paiement'];
    $id_utilisateur = 1; // ID de l'utilisateur (ici, il est codé en dur, mais il peut être récupéré dynamiquement par la session)

    // Insérer le paiement dans la base de données
    $sql = "INSERT INTO Paiement (Mont, Statut, IDUtil) 
            VALUES ('$montant', 'en attente', '$id_utilisateur')";

    if ($conn->query($sql) === TRUE) {
        echo "Paiement enregistré avec succès.<br>";
        
        // Mettre à jour le statut du paiement (par exemple, 'payé' après traitement)
        $paiement_id = $conn->insert_id;  // ID du paiement nouvellement créé
        $update_sql = "UPDATE Paiement SET Statut = 'payé' WHERE IDPaiement = $paiement_id";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "Le paiement a été traité avec succès.<br>";
        } else {
            echo "Erreur lors de la mise à jour du statut du paiement: " . $conn->error . "<br>";
        }

    } else {
        echo "Erreur : " . $conn->error . "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
</head>
<body>
    <h2>Effectuer un Paiement</h2>
    <form method="POST" action="paiement.php">
        Montant: <input type="number" name="montant" required><br>
        Mode de paiement:
        <select name="mode_paiement">
            <option value="carte_bancaire">Carte Bancaire</option>
            <option value="mobile_money">Mobile Money</option>
        </select><br>
        <input type="submit" name="payer" value="Payer">
    </form>

    <h2>Mes Paiements</h2>
    <?php
    // Afficher les paiements de l'utilisateur
    $sql = "SELECT * FROM Paiement WHERE IDUtil = 1";  // Remplacer 1 par l'ID de l'utilisateur connecté
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Afficher les paiements
        while ($row = $result->fetch_assoc()) {
            echo "ID Paiement: " . $row['IDPaiement'] . " - Montant: " . $row['Mont'] . " - Statut: " . $row['Statut'] . "<br>";
        }
    } else {
        echo "Aucun paiement trouvé.<br>";
    }
    ?>
</body>
</html>