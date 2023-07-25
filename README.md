
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


## Mettre des slugs partouz

## Réservation 

Créer système de mailing :
    -   mail de confirmation lorsque confirmation auto
    -   mail de mise en attente si confirmation auto mais dépassement nombre limite

    -   mail de mise en attente si pas de confirmation auto
    -   mail informatif de confirmation lorsque manuel et accepté
    -   mail informatif de refus lorsque manuel et refusé

    -   possibilité d'éditer et de refuser ou accepter après coups

    - Mail pour informer l'admin qu'une réservation est reçue.

    - Mail contact form directement à l'admin


Créer l'espace de gestion de réservation

Ajouter un encart pour calculer le nb de réservations depuis le début

Quand tout le système admin sera opérationnel, changer le design de pagination : liste des dates à venir / liste des resa en attente / byDate / index


## Le nombre de couverts c'est pour un service complet ou c'est juste pour un créneaux?


## revoir le routing : je vais séparér réservations validées/en attente/annulées/réalisées



##Dans le design : ajouter les accompagnements en admin / en controller et en appel api pour la carte
Revoir aussi l'histoire des formules


Modales
il me reste le bouton de soumission
nettoyer le code 
Retirer la possibilité de réserver si le resto est fermé
