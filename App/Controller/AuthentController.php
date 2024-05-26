<?php

namespace App\Controller;

use App\Repository\AdministratorRepository;

class AuthentController extends Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'login':
                        $this->login();
                        break;
                    case 'logout':
                        $this->logout();
                        break;
                    default:
                        throw new \Exception("Cette action n'existe pas : " . $_GET['action']);
                        break;
                }
            } else {
                throw new \Exception("Aucune action détectée");
            }
        } catch (\Exception $e) {
            $this->render('errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }


    protected function login()
    {
        $errors = [];

        if (isset($_POST['loginUser'])) {

            $administratorRepository = new AdministratorRepository();
            $administrator = $administratorRepository->findOneByEmail($_POST['email']);    
            if ($administrator && $administratorRepository->verifyPassword($_POST['password'], $administrator->getPassword())) {
                // Regénère l'id session pour éviter la fixation de session
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'email' => $administrator->getEmail(),
                    'first_name' => $administrator->getFirstName(),
                    'last_name' => $administrator->getName()
                ];
                header('location: index.php?controller=admin&action=list');
            } else {
                $errors[] = 'Email ou mot de passe incorrect';
            }
        }

        $this->render('/authent/login', [
            'errors' => $errors,
        ]);
    }


    protected function logout()
    {
        //Prévient les attaques de fixation de session
        session_regenerate_id(true);
        //Supprime les données de session du serveur
        session_destroy();
        //Supprime les données du tableau $_SESSION
        unset($_SESSION);
        header ('location: index.php?controller=authent&action=login');
    }
}