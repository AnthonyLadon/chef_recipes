<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class RecipesController extends AbstractController
{
    #[Route('/recipes', name: 'app_recipes')]
    public function AllRecipes(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Recipe::class);
        $recipes = $repository->findAll();

        return $this->render('recipes/listRecipes.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    #[Route('/recipes/{id}', name: 'recipe_show')]
    public function Recipe($id, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Recipe::class);
        $recipe = $repository->find($id);

        return $this->render('recipes/detailRecipe.html.twig', [
            'recipe' => $recipe,
        ]);
    }
}
