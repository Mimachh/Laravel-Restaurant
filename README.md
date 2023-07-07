
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



## Réservation 
EN CAS DE MANUEL IL FAUT BIEN PENSER A INTEGRER LE CALCUL DANS LA TABLE COUVERTS RESTANTS
EN CAS DE REFUS D'UNE INVIT DEJA ACCEPTE EN AUTO OU MANUEL IL FAUT DECREMENTER LE COUVERTSRESTANTS
Créer système de mailing :
    -   mail de confirmation lorsque confirmation auto
    -   mail de mise en attente si confirmation auto mais dépassement nombre limite
    -   mail de mise en attente si pas de confirmation auto
    -   mail informatif de confirmation lorsque manuel et accepté
    -   mail informatif de refus lorsque manuel et refusé
    -   possibilité d'éditer et de refuser ou accepter après coups

    - Mail pour informer l'admin qu'une réservation est reçue.

Créer l'espace de gestion de réservation
    - La liste est sous forme de date à partir d'aujourd'hui? Trié par date puis on déroule pour voir midi ou soir, puis on clique pour accéder à la liste complète.
    - Cette nouvelle liste avec la date, le créneau, le nombre de couvert, le status + possibilité d'éditer le status + possibilité de voir en détail

    - Même système pour l'historique 

    Total des pages :
    -   Liste a venir par date 
    -   Liste à venir sur une date précise + midi (infos à mettre, le nombre de couverts de base, le nombre restant)
    -   Liste à venir sur une date précise + soir
    -   Show d'une réservation
    -   Edit d'une réservation

    -   Pareil pour l'historique


## Ajouter dans les options la possibilité de définir la durée des créneaux? 
## Le nombre de couverts c'est pour un service complet ou c'est juste pour un créneaux?
