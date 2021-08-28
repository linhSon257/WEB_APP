<?php

namespace App\Controller;
use App\Form\TabletFormType;
use App\Entity\Tablet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use function PHPUnit\Framework\throwException;

class TabletController extends AbstractController
{
    /**
     * @Route("/tablet", name="tablet")
     */
    public function index(): Response
    {
        $tablet = $this-> getDoctrine() -> getRepository(Tablet:: class)->findAll();
        return $this->render(
            'tablet/indexTablet.html.twig',
            [
                'Tablets' => $tablet,
            ]
            );
    }

    /**
     * @Route("/tabletCreate", name="createTablet")
     */
    public function createTablet(Request $request)
    {
        $tablet = new Tablet();
        $form = $this -> createForm(TabletFormType::class, $tablet);
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form -> isValid())
        {
            $image = $tablet -> getImage();
            $fileName = md5(uniqid());
            $fileExtension = $image->guessExtension();
            $imageName = $fileName . '.' . $fileExtension;
            try {
                $image->move(
                    $this->getParameter('tablet_image'), $imageName
                );
            } catch (FileException $e) {
                throwException($e);
            }
            $tablet->setImage($imageName);
            $manager = $this -> getDoctrine()-> getManager();
            $manager -> persist($tablet);
            $manager -> flush();
            $this -> addFlash("succsess","A new tablet already be added to DB_Shopson");
            return $this->redirectToRoute('tablet');
        }
        return $this->render('tablet/createTablet.html.twig',[
            'form' =>$form ->createView(),
        ]);
    }

      /**
     * @Route("/tablet/update/{id}", name="updateTablet")
     */
    public function updateTablet(Request $request,$id)
    {
        $tablet = $this -> getDoctrine() -> getRepository(Tablet::class)->find($id);
        $form = $this -> createForm(TabletFormType::class, $tablet);
        $form -> handleRequest($request);
        if($form-> isSubmitted() && $form -> isValid())
        {
            $manager = $this -> getDoctrine()-> getManager();
            $manager -> persist($tablet);
            $manager -> flush();
            $this -> addFlash("succsess","A new tablet already be updated to DB_Shopson");
            return $this->redirectToRoute('tablet');;
        }
        return $this->render('tablet/updateTablet.html.twig',[
            'form' =>$form ->createView(),
        ]);
    }
    /**
     * @Route("/tablet/delete/{id}", name="deleteTablet")
     */
    public function deleteTablet(Request $request,$id):Response{
        $tablet = $this -> getDoctrine() -> getRepository(Tablet::class) -> find($id);
        if($tablet == null){
            $this -> addFlash("error!", "ID is invalid");
        return $this->redirectToRoute('(tablet)');
        }
        $manager = $this -> getDoctrine()-> getManager();
        $manager ->remove($tablet);
        $manager ->flush();
        $this -> addFlash("delete successful !!!"," A Tablet already be delete out of Database");
        return $this->redirectToRoute('tablet');
    }

    /**
     * @Route("/tablet/detail/{id}", name="detailTablet")
     */
    public function detailTablet(Request $request,$id)
    {
        $tablet = $this->getDoctrine()->getRepository(Tablet::class)->find($id);
        return $this->render(
            'tablet/detailTablet.html.twig', 
            [
            'Tablets' => $tablet,
            ]
        );
    }
}
