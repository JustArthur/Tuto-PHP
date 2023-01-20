<?php
    class Inscription {
        private $erreur;
        private $banner;
        private $valid;
        private $log;

        public function inscription_utilisateur($identifiant, $email, $new_password, $conf_password) {

            global $DB;

            $identifiant = (String) htmlspecialchars(trim($identifiant));
            $email = (String) htmlspecialchars(trim($email));
            $new_password = (String) htmlspecialchars(trim($new_password));
            $conf_password = (String) htmlspecialchars(trim($conf_password));

            $this->erreur = (Array) array();
            $this->banner = (String) '';
            $this->valid = (Boolean) true;
            $this->log = (Array) array();

            if(!empty($identifiant) && !empty($email) && !empty($new_password) && !empty($conf_password)) {
                $idSearch = $DB->prepare("SELECT idUser FROM utilisateur WHERE identifiant = ?");
                $idSearch->execute([$identifiant]);
                $idSearch = $idSearch->fetch();
            } else {
                array_push($this->erreur, 'erreur', 'Certain champs sont vide.');
            }
        }
    }
?>