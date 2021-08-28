<?php

namespace App\Controller;
use App\Form\LaptopFormType;
use App\Entity\Laptop;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use function PHPUnit\Framework\throwException;

class LaptopController extends AbstractController
{
    /**
     * @Route("/laptop", name="laptop")
     */
    public function index(): Response
    {
        $laptop = $this-> getDoctrine() -> getRepository(Laptop:: class)->findAll();
        return $this->render(
            'laptop/indexLaptop.html.twig',
            [
                'Laptops' => $laptop,
            ]
            );
    }
    /**
     * @Route("/laptopCreate", name="createLaptop")
     */
    public function createLaptop(Request $request)
    {
        $laptop = new Laptop();
        $form = $this -> createForm(LaptopFormType::class, $laptop);
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form -> isValid())
        {
            $image = $laptop -> getImage();
            $fileName = md5(uniqid());
            $fileExtension = $image->guessExtension();
            $imageName = $fileName . '.' . $fileExtension;
            try {
                $image->move(
                    $this->getParameter('laptop_image'), $imageName
                );
            } catch (FileException $e) {
                throwException($e);
            }
            $laptop->setImage($imageName);
            $manager = $this -> getDoctrine()-> getManager();
            $manager -> persist($laptop);
            $manager -> flush();
            $this -> addFlash("succsess","A new laptop already be added to DB_Shopson");
            return $this->redirectToRoute('laptop');
        }
        return $this->render('laptop/createLaptop.html.twig',[
            'form' =>$form ->createView(),
        ]);
    }

      /**
     * @Route("/laptop/update/{id}", name="updateLaptop")
     */
    public function updateLaptop(Request $request,$id)
    {
        $laptop = $this -> getDoctrine() -> getRepository(Laptop::class)->find($id);
        $form = $this -> createForm(LaptopFormType::class, $laptop);
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form -> isValid())
        {
            $manager = $this -> getDoctrine()-> getManager();
            $manager -> persist($laptop);
            $manager -> flush();
            $this -> addFlash("succsess","A new laptop already be updated to DB_Shopson");
            return $this->redirectToRoute('laptop');;
        }
        return $this->render('laptop/updateLaptop.html.twig',[
            'form' =>$form ->createView(),
        ]);
    }
    /**
     * @Route("/laptop/delete/{id}", name="deleteLaptop")
     */
    public function deleteLaptop(Request $request,$id):Response{
        $laptop = $this -> getDoctrine() -> getRepository(Laptop::class) -> find($id);
        if($laptop == null){
            $this -> addFlash("error!", "ID is invalid");
        return $this->redirectToRoute('(laptop)');
        }
        $manager = $this -> getDoctrine()-> getManager();
        $manager ->remove($laptop);
        $manager ->flush();
        $this -> addFlash("delete successful !!!"," A Laptop already be delete out of Database");
        return $this->redirectToRoute('laptop');
    }

        /**
     * @Route("/laptop/detail/{id}", name="detailLaptop")
     */
    public function detailLaptop(Request $request,$id)
    {
        $laptop = $this->getDoctrine()->getRepository(Laptop::class)->find($id);
        return $this->render(
            'laptop/detailLaptop.html.twig', 
            [
            'Laptops' => $laptop,
            ]
        );
    }
}
