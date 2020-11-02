# Projet Web A2
Git du projet web Année 2 IUT

# 1.Sujet

Vous devrez réaliser un site de e-commerce. Les produits que vous devez vendre sont laissés à votre entière appréciation (y compris humoristique). Il n’y a pas de restriction particulière. Pensez néanmoins que ce projet Web fait partie de vos réalisations qui pourraient être mises en avant lors d’un entretien pour un stage, par exemple.

À la fin de cette séance vous devrez donner à votre encadrant la liste des membres de votre groupe ainsi que le thème de votre site (quels produits votre site vend-il ? ).

# 2.Modalités

Le projet est dimensionné pour des groupes de 3 étudiants. Ponctuellement les groupes de 2 sont autorisés (mais ils seront notés comme un groupe de 3). Les groupes de 4 sont aussi ponctuellement autorisés, mais seront évalués de manière plus stricte et l’on attendra 1/3 de boulot en plus.

Les soutenances de projet auront lieu entre le jeudi 10 et le mercredi 16 Décembre, à votre créneau de TD habituel. La note de ce projet Web interviendra pour moitié, l’autre moitié sera donnée par l’examen final sur papier (pas de code à écrire, questions de compréhension).

Le jour de la soutenance, le site devra être déployé sur webinfo sous l’un de vos comptes. Les sources du site devront être accessible dans un fichier sources.zip à la racine de votre site. Il n’y a pas de date de rendu : votre site Web et ses sources devront juste être disponibles au moment de la soutenance.

Emploi du temps prévisionnel :

Semaine du 19 Octobre 2020 – Début projet
Semaine du 02 Novembre 2020 – Projet
Semaines du 09 Novembre 2020 – TD 7 – Cookies & Sessions
Semaine du 16 Novembre 2020 – TD 8 – Authentification & Validation par email puis projet
Semaine du 23 Novembre 2020 – 3h projet
Semaine du 30 Novembre 2020 – 3h projet
Semaine du 07 Décembre 2020 – soutenances du projet
17 ou 18 décembre – examen


Le but pédagogique de ce projet est de mettre en application toutes les techniques que vous avez apprises lors des TDs. Important : Voici donc les critères sur lesquels vous serez notés.

Il n’y a pas de rapport à écrire, ni de présentation à préparer. Vous devrez juste répondre à une série de questions sur votre code qui nous permettra d’évaluer ce qui a été implémenté.

# 3. Par où commencer ?

**Définir les produits que vous souhaitez vendre.**

**Créer la table SQL correspondante.**

**Conseil: Préfixez vos noms de tables de projet, e.g. p_utilisateur, p_produit, pour vous y retrouver dans PHPMyAdmin.**

**La première séance doit vous permettre d’implémenter quelques actions du MVC Produit.**

Ce que ce projet n’est pas :
Un site vitrine joli avec beaucoup d’images par exemple. Vous n’aurez pas de point sur cet aspect. Par contre, vous êtes autorisés à repartir de votre projet de HTML/CSS de l’an dernier.
Un site réaliste qui implémente X fois la même fonctionnalité. Le but est de réaliser correctement un maximum de fonctionnalités différentes des critères de notation (cf. plus bas).

Que garder pour plus tard ?
Dans la suite de ce cours, plusieurs séances seront consacrées à:

la gestion des utilisateurs,
la gestion des paniers,
la sécurisation de votre site Web
En conséquence, ne pas attaquer ces parties pour le moment.

Où héberger ce site? Comment partager votre code PHP ? Comment travailler à distance de l’IUT ?
Pour travailler à distance, vous pouvez soit installer un serveur Web sur votre ordinateur (cf. la fin du TD1) ou envoyer vos fichiers à l’IUT en FTP avec FileZilla par exemple (cf. instructions sur l’intranet Côté Technique > Accès au Réseau > Depuis chez vous).

Lors de la soutenance, le site devra être hébergé dans le répertoire de l’un des membres de votre groupe. Par exemple http://webinfo.iutmontp.univ-montp2.fr/~mon_login/eCommerce/

En attendant, vous avez 2 solutions pour partager votre code PHP :

Git (recommandé)
Créez un projet Git commun sur le Gitlab de l’IUT (ou sur Github). Puis chacun clone le projet pour avoir une copie du dépôt sur son compte. Établissez clairement qui écrit dans quel fichier : si 2 personnes modifient la même partie de code, ils risquent d’avoir des conflits lors du git pull. Pour plus d’informations sur Git, la création d’une clé SSH, les commandes git pull/add/commit/push et autres git log/status, la gestion des conflits, je vous renvoie sur le tutoriel d’introdution à Git.

Répertoire partagé à l’IUT
L’étudiant 1 doit donc créer le répertoire eCommerce dans son dossier public_html puis donner les droits aux autres étudiants de son groupe sur ce répertoire:

setfacl -m u:loginetudiant2:x /home/ann2/loginetudiant1 (droit de lister le repertoire personnel)
setfacl -m u:loginetudiant2:x /home/ann2/loginetudiant1/public_html (droit de lister le repertoire public_html)
setfacl -R -m u:loginetudiant2:rwx eCommerce (donne récursivement les droits à tout les fichiers inclus dans eCommerce)
setfacl -R -m d:u:loginetudiant2:rwx eCommerce (défini des droits par défaut : les nouveaux fichiers créés prendront ces droits)
Rappel du TD 1 : Les ACL permettent d’avoir des droits spécifiques à plusieurs utilisateurs et à plusieurs groupes quand les droits classiques sont limités à un utilisateur et un groupe. Pour lire les droits ACL d’un fichier ou dossier, on tape getfacl nom_du_fichier.

**lien critere de notation :** https://docs.google.com/spreadsheets/d/1oUd7fe0K8WZhI2TPRRvgZ2xPZf5H22CUvlpcXEMD3Ao/edit#gid=0
