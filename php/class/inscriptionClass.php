<?php
    class Inscription {
        private $text_erreur;
        private $class_erreur;
        private $erreur_identifiant;
        private $erreur_password;

        private $banner;

        private $valid;



        public function inscription_utilisateur($identifiant, $email, $new_password, $conf_password) {

            global $DB;

            $identifiant = (String) htmlspecialchars(trim($identifiant));
            $email = (String) htmlspecialchars(trim($email));
            $new_password = (String) htmlspecialchars(trim($new_password));
            $conf_password = (String) htmlspecialchars(trim($conf_password));

            $this->text_erreur = (String) '';
            $this->class_erreur = (String) '';
            $this->erreur_identifiant = (String) '';
            $this->erreur_password = (String) '';

            $this->banner = (String) '';

            $this->valid = (Boolean) true;



            if(empty($identifiant)) {
                $this->text_erreur = 'Le champ identifiant est vide';
                $this->erreur_identifiant = 'erreur';
                $this->class_erreur = 'erreur';
                $this->valid = false;

            } else {
                $searchUser = $DB->prepare("SELECT idUser FROM utilisateurs WHERE identifiant = ?");
                $searchUser->execute([$identifiant]);
                $searchUser = $searchUser->fetch();

                if(isset($searchUser['idUser'])) {
                    $this->text_erreur = "Le nom d'utilisateur est déjà pris.";
                    $this->erreur_identifiant = 'erreur';
                    $this->class_erreur = 'erreur';
                    $this->valid = false;
                }
            }

            if(empty($new_password) || empty($conf_password)) {
                $this->text_erreur = "Les champs des mots de passe sont vides.";
                $this->erreur_password = 'erreur';
                $this->class_erreur = 'erreur';
                $this->valid = false;

            } elseif ($new_password <> $conf_password) {
                $this->text_erreur = "Les mots de passe ne sont pas identique.";
                $this->erreur_password = 'erreur';
                $this->class_erreur = 'erreur';
                $this->valid = false;
            }


            if($this->valid) {

                switch(random_int(1, 4)) {
                    case 1:
                        $banner = 'default_banner_1.jpg';
                        break;
                    
                    case 2:
                        $banner = 'default_banner_2.jpg';
                        break;

                    case 3:
                        $banner = 'default_banner_3.jpg';
                        break;

                    case 4:
                        $banner = 'default_banner_4.jpg';
                        break;
                }

                $password_crypt = password_hash($new_password, PASSWORD_ARGON2ID);

                $dateCreation = date('Y-m-d H:i:s');
                $dateConnexion = date('Y-m-d H:i:s');

                $insertUser = $DB->prepare("INSERT INTO utilisateurs (identifiant, password, email, banniere, dateCreation, derniereConnexion) VALUES(?, ?, ?, ?, ?, ?);");
                $insertUser->execute([$identifiant, $password_crypt, $email, $banner, $dateCreation, $dateConnexion,]);

                $connexionUser = $DB->prepare("SELECT * FROM utilisateurs WHERE identifiant = ?");
                $connexionUser->execute([$identifiant]);
                $connexionUser = $connexionUser->fetch();

                $_SESSION['utilisateur'] = array(
                    $connexionUser['idUser'], //0
                    $connexionUser['identifiant'],  //1
                    $connexionUser['nom'], //4
                    $connexionUser['prenom'], //5
                    $connexionUser['email'], //6
                    $connexionUser['avatar'], //7
                    $connexionUser['banniere'] //8
                );

                $nomLog = "Inscription d'un nouvel utilisateur";
                $dateLog = date('Y-m-d H:i:s');

                $insertLog = $DB->prepare("INSERT INTO logs (idUser, utilisateur, nomLog, dateLog) VALUES(?, ?, ?, ?)");
                $insertLog->execute([$_SESSION['utilisateur'][0], $_SESSION['utilisateur'][1], $nomLog, $dateLog]);

                header('Location: pages/panel');
                exit;
            }

            return [$this->text_erreur, $this->erreur_password, $this->erreur_identifiant, $this->class_erreur];
        }
    }
?>