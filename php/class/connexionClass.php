<?php
    class Connexion {

        private $text_erreur;
        private $class_erreur;
        private $erreur_identifiant;
        private $erreur_password;

        private $valid;

        public function connexion_utilisateur($identifiant, $password) {

            global $DB;

            $identifiant = (String) htmlspecialchars(trim($identifiant));
            $password = (String) htmlspecialchars(trim($password));

            $this->text_erreur = (String) '';
            $this->class_erreur = (String) '';
            $this->erreur_identifiant = (String) '';
            $this->erreur_password = (String) '';

            $this->valid = (Boolean) true;

            if(empty($identifiant)) {
                $this->text_erreur = 'Le champ identifiant est vide.';
                $this->erreur_identifiant = 'erreur';
                $this->class_erreur = 'erreur';

                $this->valid = false;

            }
            
            if(empty($password)) {
                $this->text_erreur = 'Le champ du mot de passe est vide.';
                $this->erreur_password = 'erreur';
                $this->class_erreur = 'erreur';

                $this->valid = false;
            }


            if($this->valid) {

                $searchPassword = $DB->prepare('SELECT password FROM utilisateurs WHERE identifiant = ?');
                $searchPassword->execute([$identifiant]);
                $searchPassword = $searchPassword->fetch();

                if(isset($searchPassword['password'])) {
                    if(!password_verify($password, $searchPassword['password'])) {
                        $this->text_erreur = 'Le mot de passe est incorrect.';
                        $this->erreur_password = 'erreur';
                        $this->class_erreur = 'erreur';

                        $this->valid = false;
                    }
                } else {
                    $this->text_erreur = 'Aucun utilisateur inscrit avec ce pseudo.';
                    $this->class_erreur = 'erreur';

                    $this->valid = false;
                }

                if($this->valid) {
                    $connexionUser = $DB->prepare("SELECT * FROM utilisateurs WHERE identifiant = ?");
                    $connexionUser->execute([$identifiant]);
                    $connexionUser = $connexionUser->fetch();
    
                    if(isset($connexionUser['idUser'])) {

                        $_SESSION['utilisateur'] = array(
                            $connexionUser['idUser'], //0
                            $connexionUser['identifiant'],  //1
                            $connexionUser['nom'], //4
                            $connexionUser['prenom'], //5
                            $connexionUser['email'], //6
                            $connexionUser['avatar'], //7
                            $connexionUser['banniere'] //8
                        );
    
                        $nomLog = "Connexion d'un utilisateur";
                        $dateLog = date('Y-m-d H:i:s');
    
                        $insertLog = $DB->prepare("INSERT INTO logs (idUser, utilisateur, nomLog, dateLog) VALUES(?, ?, ?, ?)");
                        $insertLog->execute([$_SESSION['utilisateur'][0], $_SESSION['utilisateur'][1], $nomLog, $dateLog]);

                        $nbrConnexion = $connexionUser['nbrConnexion'] + 1;

                        $updateConnexion = $DB->prepare("UPDATE utilisateurs SET nbrConnexion = ? WHERE idUser = ?");
                        $updateConnexion->execute([$nbrConnexion, $_SESSION['utilisateur'][0]]);
    
                        header('Location: pages/panel');
                        exit;
                    }
                }
            }
            return [$this->text_erreur, $this->erreur_password, $this->erreur_identifiant, $this->class_erreur];
        }
    }
?>