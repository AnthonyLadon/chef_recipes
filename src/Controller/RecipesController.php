<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class RecipesController extends AbstractController
{
    #[Route('/recipes/{direction}/{categName}', name: 'app_recipes')]
    public function AllRecipes(EntityManagerInterface $entityManager, $direction, $categName): Response
    {
        isset($direction) ? $direction : $direction = 'desc';
        isset($categName) ? $categName : $categName = 'all';

        // Get the category by name
        if ($categName != 'all') {
            try {
                $repositorycateg = $entityManager->getRepository(Category::class);
                $categ = $repositorycateg->findBy(['name' => $categName]);
                $category = $categ[0]->getId();
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            $category = $categName;
        }

        // if category is 'all', get all recipes
        try {
            $repository = $entityManager->getRepository(Recipe::class);
            $recipes = $repository->findByDirectionAndCategory($direction, $category);
        } catch (\Exception $e) {
            $recipes = [];
            throw $e;
        }

        return $this->render('recipes/listRecipes.html.twig', [
            'recipes' => $recipes,
            'direction' => $direction,
            'categName' => $categName,
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
