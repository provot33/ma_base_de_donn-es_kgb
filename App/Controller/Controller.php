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
                    case 'authent':
                        //charger controleur authent
                        $controller = new AuthentController();
                        $controller->route();
                        break;
                    case 'mission':
                        //charger controleur mission
                        $controller = new MissionController();
                        $controller->route();
                        break;
                    case 'admin':
                        //charger controleur administrateur
                        $controller = new AdminController();
                        $controller->route();
                        break;    
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