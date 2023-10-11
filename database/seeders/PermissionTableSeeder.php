<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$permissions = [
    'Factures',
        'liste de facturation',
        'factures payées',
        'Factures partiellement payées',
        'factures impayées',
        'archive de facture',

    'rapports',
        'Rapport de facturation',
        'rapport client',

    'utilisateurs',
        'liste d utilisateur',
        'Autorisations d utilisateur',

    'Réglages',
        'des produits',
        'Les catégories',
     
    // factuer
        'ajouter une facture',
        'Supprimer la facture',
        'Exporter EXCEL',
        'Modifier le statut de paiement',
        'Modifier la facture',
        'archiver la facture',
        'la facture d impression ',
        'ajouter une pièce jointe',
        'supprimer la pièce jointe',
    
    //utilisateurs
        'ajouter un utilisateur',
        'modifier l utilisateur',
        'Supprimer l utilisateur',

    // permission
        'montrer la permission',
        'ajouter de la permission',
        'modifier la permission',
        'supprimer la permission',

    // produit 
        'ajouter un produit',
        ' Modification du produit ',
        'Supprimer un produit',
    
    //section
        'ajouter  un section',
         'modifier un section ',
         'supprimer  un section',
         'notifications',

];
foreach ($permissions as $permission) {
Permission::create(['name' => $permission]);
}
}
}