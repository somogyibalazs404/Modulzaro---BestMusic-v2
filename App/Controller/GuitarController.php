<?php
namespace App\Controller;



use App\Model\GuitarDao;
use App\Model\GuitarCategoryDao;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class GuitarController implements ICrudController
{
    public function home()
    {
        $twig = (new GuitarController())->setTwigEnvironment();
        echo $twig->render('home.html.twig');
        // if (isset($_POST['enter'])) {
        //     header('Location: /guitars');
        // }

    }
    public function list()
    {
        $data = GuitarDao::all();
        $twig = (new GuitarController())->setTwigEnvironment();
        echo $twig->render('guitars/guitars.html.twig', ['guitars' => $data]);
    }

    public function add()
    {
        $twig = (new GuitarController())->setTwigEnvironment();
        $guitarCategories = GuitarCategoryDao::all();
        echo $twig->render('guitars/guitarAdd.html.twig', ['guitarCategories' => $guitarCategories]);
    }

    public function save()
    {
        if (isset($_POST['save'])) {
            GuitarDao::save();
            header('Location: /guitars');
        }
    }

    public function editById(int $id)
    {
        $twig = (new GuitarController())->setTwigEnvironment();
        $guitarData = GuitarDao::getById($id);
        $guitarCategories = GuitarCategoryDao::all();
        if ($guitarData) {
            echo $twig->render('guitars/guitarEdit.html.twig', ['guitar' => $guitarData, 'guitarCategories' => $guitarCategories]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function update()
    {
        if (isset($_POST['update'])) {
            GuitarDao::update();
            header('Location: /guitars');
        }
    }


    public function deleteById(int $id)
    {
        $twig = (new GuitarController())->setTwigEnvironment();
        $guitarData = GuitarDao::getById($id);
        if ($guitarData) {
            echo $twig->render('guitars/guitarDelete.html.twig', ['guitar' => $guitarData]);
        } else {
            echo $twig->render('404.html.twig');
        }
    }

    public function delete()
    {
        if (isset($_POST['delete'])) {
            GuitarDao::delete();
            header('Location: /guitars');
        }
    }

    public function setTwigEnvironment()
    {
        $loader = new FilesystemLoader(__DIR__ . '\..\View');
        $twig = new \Twig\Environment($loader, [
            'debug' => true, //var_dumphoz hasonló mukodés megvalosuljon

        ]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        return $twig;
    }

}