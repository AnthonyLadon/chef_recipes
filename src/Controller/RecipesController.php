<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class RecipesController extends AbstractController
{
    #[Route('/recipes/{direction}', name: 'app_recipes')]
    public function AllRecipes(EntityManagerInterface $entityManager, $direction): Response
    {
        $repository = $entityManager->getRepository(Recipe::class);
        $recipes = $repository->findAll();
        isset($direction) ? $direction : $direction = 'desc';

        if ($direction == 'desc') {
            usort($recipes, function ($a, $b) {
                return $a->getEstimatedTime() > $b->getEstimatedTime();
            });
        } else if ($direction == 'asc') {
            usort($recipes, function ($a, $b) {
                return $a->getEstimatedTime() < $b->getEstimatedTime();
            });
        }

        return $this->render('recipes/listRecipes.html.twig', [
            'recipes' => $recipes,
            'direction' => $direction,
        ]);
    }

    #[Route('/recipe-detail/{id}', name: 'recipe_show')]
    public function Recipe(EntityManagerInterface $entityManager, $id): Response
    {
        $repository = $entityManager->getRepository(Recipe::class);
        $recipe = $repository->find($id);

        return $this->render('recipes/detailRecipe.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
