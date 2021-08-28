<?php

namespace App\Controller;
use App\Entity\Brand;
use App\Form\BrandFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    /**
     * @Route("/brand", name="brand")
     */
    public function index()
    {
        $brand = $this-> getDoctrine() -> getRepository(Brand:: class)->findAll();
        return $this->render(
            'brand/indexBrand.html.twig',
            [
                'Brands' => $brand,
            ]
            );
    }

    /**
     * @Route("/brandCreate", name="createBrand")
     */
    public function createBrand(Request $request)
    {
        $brand = new Brand();
        $form = $this -> createForm(BrandFormType::class, $brand);
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form -> isValid())
        {
            $manager = $this -> getDoctrine()-> getManager();
            $manager -> persist($brand);
            $manager -> flush();
            $this -> addFlash("succsess","A new brand already be added to DB_Shopson");
            return $this->redirectToRoute('brand');;
        }
        return $this->render('brand/createBrand.html.twig',[
            'form' =>$form ->createView(),
        ]);
    }

      /**
     * @Route("/brand/Update/{id}", name="updateBrand")
     */
    public function updateBrand(Request $request,$id)
    {
        $brand = $this -> getDoctrine() -> getRepository(Brand::class)->find($id);
        $form = $this -> createForm(BrandFormType::class, $brand);
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form -> isValid())
        {
            $manager = $this -> getDoctrine()-> getManager();
            $manager -> persist($brand);
            $manager -> flush();
            $this -> addFlash("succsess","A new brand already be updated to DB_Shopson");
            return $this->redirectToRoute('brand');;
        }
        return $this->render('brand/updateBrand.html.twig',[
            'form' =>$form ->createView(),
        ]);
    }
     /**
     * @Route("/brand/delete/{id}", name="deleteBrand")
     */
    public function deleteBrand(Request $request,$id)
    {
        try{
            $brand = $this -> getDoctrine() -> getRepository(Brand::class)->find($id);
            if($brand == null){
                $this -> addFlash("Error!","ID is invalid");
                return $this->redirectToRoute('brand');
            }
            $manager = $this -> getDoctrine()-> getManager();
                $manager -> remove($brand);
                $manager -> flush();
                $this -> addFlash("delete succsessful !!!","A brand already be deleted out of DB_Shopson");
                return $this->redirectToRoute('brand');;
        }catch (\Exception $e) {
            return new Response(
                json_encode(["error"=> $e ->getMessage()]),
                Response::HTTP_BAD_REQUEST,    
                [
                    "content-type" => "application/json"
                ]
            );
        }

    }
    /**
     * @Route("/brand/detail/{id}", name="detailBrand")
     */
    public function detailBrand(Request $request,$id)
    {
        $brand = $this->getDoctrine()->getRepository(Brand::class)->find($id);
        return $this->render(
            'brand/detailBrand.html.twig', 
            [
            'Brands' => $brand,
            ]
        );
    }
}
