<?php

namespace App\Controller;

class Controller
{
    public function route(): void
    {
        try {
            if (isset($_GET['controller'])) {
                switch ($_GET['controller']) {
                    case 'page':
                        //charger controleur page
                        $controller = new PageController();
                        $controller->route();
                        break;
                    case 'auth':
                        //charger controleur auth
                        $controller = new AuthController();
                        $controller->route();
                        break;
                    case 'administrator':
                        $controller = new AdministratorController();
                        $controller->route();
                        break;
                    case 'mission':
                        $controller = new MissionController();
                        $controller->route();
                        break;
                    // case 'detail':
                    //     $controller = new DetailController();
                    //     $controller->route();
                    //     break;
                    default:
                        throw new \Exception("Le controleur n'existe pas");
                        break;
                }
            } else {
                //Chargement la page d'accueil si pas de controleur dans l'url
                $controller = new PageController();
                $controller->home();
            }
        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function render(string $path, array $params = []): void
    {
        $filePath = _TEMPLATEPATH_ . $path . '.php';

        try {
            if (!file_exists($filePath)) {
                throw new \Exception("Fichier non trouvé : " . $filePath);
            } else {
                // Extrait chaque ligne du tableau et crée des variables pour chacune
                extract($params);
                require_once $filePath;
            }
        } catch (\Exception $e) {
            $this->render('/errors/default', [
                'error' => $e->getMessage()
            ]);
        }
    }
}