<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Post;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/default/{id}", name="default")
     */
    public function index(Video $post)
    {

        return $this->json($post->getComments(), 200, [], [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
    }
     /**
     * @Route("/ajoutv", name="ajoutv")
     */
    public function ajoutvideo()
    {
       $video = new Video();
       $video->setTitle("tiltle 1111");
       $video->setVideoPath("v1.mpeg4");
       $this->entityManager->persist($video);
       $this->entityManager->flush();
       dd($video);
       /* return $this->json($post->getComments(), 200, [], [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);*/
    }
     /**
     * @Route("/ajoutp", name="ajoutp")
     */
    public function ajoutpost()
    {
       $post = new Post();
       $post->setTitle("tiltle post");
       $post->setContent("content post");
      // $video->setVideoPath("v1.mpeg4");
       $this->entityManager->persist($post);
       $this->entityManager->flush();
       dd($post);
       /* return $this->json($post->getComments(), 200, [], [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);*/
    }
}
