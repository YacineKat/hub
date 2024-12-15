<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef Personnel</title>
</head>
<body>
    <div class="contien">
    <div class="right">
    <h1>Gestion du Personnel</h1>

    <!-- Formulaire pour ajouter un employé -->
    <h2>Ajouter un employé</h2>
    <form method="POST">
        <input type="hidden" name="add_employee" value="1">
        <label>Nom :</label>
        <input type="text" name="nom" required>
        <label>Prénom :</label>
        <input type="text" name="prenom" required>
        <label>Date de naissance :</label>
        <input type="date" name="date_naissance" required>
        <label>Adresse :</label>
        <input type="text" name="adresse">
        <label>Grade :</label>
        <input type="text" name="grade">
        
        <label>Service :</label>
        <input type="text" name="service">
        
        <label>Corps :</label>
        <select name="corps" required>
            <option value="médecin_spécialiste">Médecin Spécialiste</option>
            <option value="médecin_travail">Médecin du Travail</option>
            <option value="pharmacien">Pharmacien</option>
            <option value="chirurgien_dentiste">Chirurgien Dentiste</option>
            <option value="paramédical">Paramédical</option>
        </select>
        <button type="submit">Ajouter</button>
    </form>
    </div>
    <!-- Formulaire pour filtrer les employés -->
    <div class="left">
    <h2>Filtrer les employés</h2>
    <form method="POST">
        <input type="hidden" name="filter" value="1">
        <label>Nom :</label>
        <input type="text" name="filter_nom">
        <label>Grade :</label>
        <label>Service :</label>
        <select name="filter_service">
            <option value="">Tous</option>
            
        </select>
        <button type="submit">Filtrer</button>
    </form>

    <!-- Affichage des employés filtrés -->
    <h2>Liste des employés</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Adresse</th>
                    <th>Grade</th>
                    <th>Service</th>
                    <th>Corps</th>
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                
            </tbody>
        </table>
        </div>
        </div>
</body>
</html>
