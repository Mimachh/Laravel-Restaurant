
## Revoir la page d'accueil un peu plus belle 

## Créer un espace de profil pour tous les utilisateurs sur le site "normal" afin edition du profil mdp etc
- page user.profile
- prend le layout général de l'app
- simple formulaire pour changer : 
    - nom
    - prénom
    - changer le mdp
    - mail
    - photo de profil?


## Pour plus tard :
- Verification mail
- Reset password
- MDP oublié
- Auth 2 facteurs



## Ajouter le champs couverts sur chaque jours
 - pour la logique si un champs couverts n'est pas renseigné faire en sorte que la réservation soit manuelle
## Mettre des slugs partouz


## MAILING



## Réservation : les jours sont bien désactivés. Maintenant il faut créer une logique inverse : quand l'utilisateur va sélectionner un jour il faut récupérer l'index du jour.
Puis on lui propose midi ou soir (s'ils sont ouverts). puis après sélection requêter la base de données pour vérifier le jour et le moment de la journée.

- Jour à transformer en index pour le traiter, mais il faut le sauvegarder quelque part  = écran 1 = obligatoire
- Midi ou Soir (en affichant les couverts restants si pas d'informations alors rien affiché) = écran 2 = obligatoire
- Creneau par demi heure = écran 2
- Nombre de couverts = écran 2 = obligatoire = calcul si encore dispo = si pas d'information pour ce service, aucune limite
- Nom / prenom / numéro / mail = écran 3
- Validation = écran 3
- En fonction de l'option de résa auto et validation manuelle à partir de : soit c'est validé = résa status = 1 soit c'est en attente et il est prévenu qu'il recevra un mail


## Ajouter dans les options la possibilité de définir la durée des créneaux? 
## Le nombre de couverts c'est pour un service complet ou c'est juste pour un créneaux?
