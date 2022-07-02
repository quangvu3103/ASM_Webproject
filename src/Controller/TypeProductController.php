<?php

namespace App\Controller;
use App\Entity\TypeProduct;
use App\Form\TypeProductType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TypeProductController extends AbstractController
{
    // /**
    //  * @Route("/type/product", name="app_type_product")
    //  */
    // public function index(): Response
    // {
    //     return $this->render('type_product/index.html.twig', [
    //         'controller_name' => 'TypeProductController',
    //     ]);
    // }
/**
     * @Route("/typeproduct",name="typeproducts_user")
     */
    public function indexActionUser()
    {
        
        $em = $this->getDoctrine()->getManager();
 
        $TypeProducts = $em->getRepository(TypeProduct::class)->findAll();
       
        return $this->render('type_product/index.html.twig', array(
            'TypeProducts' => $TypeProducts,
        ));
    }
    /**
 * @Route("/typeproducts/details/{id}", name="typeproducts_details")
 */
public
function detailsAction($id)
{
    $em = $this->getDoctrine()->getManager();
 
    $TypeProduct = $em->getRepository(TypeProduct::class)->find($id);

    return $this->render('type_product/details.html.twig', [
        'TypeProduct' => $TypeProduct
    ]);
}
/**
 * @Route("/typeproducts/delete/{id}", name="typeproducts_delete")
 */
public function deleteAction($id)
{
    $em = $this->getDoctrine()->getManager();
    $TypeProduct = $em->getRepository(TypeProduct::class)->find($id);
        $em->remove($TypeProduct);
    $em->flush();
    
    $this->addFlash(
        'error',
        'Deleted'
    );
    
    return $this->redirectToRoute('products_user');
}
/**
 * @Route("/typeproducts/create", name="typeproducts_create", methods={"GET","POST"})
 */
public function createAction(Request $request)
{
    $TypeProduct = new TypeProduct();
    $form = $this->createForm(TypeProductType::class, $TypeProduct);
    
    if ($this->saveChanges($form, $request, $TypeProduct)) {
        $this->addFlash(
            'notice',
            'Added'
        );
        
        return $this->redirectToRoute('products_user');
    }
    
    return $this->render('type_product/create.html.twig', [
        'form' => $form->createView()
    ]);
}

public function saveChanges($form, $request, $TypeProduct)
{
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        $TypeProduct = $form->getdata();
        $em = $this->getDoctrine()->getManager();
        $em->persist($TypeProduct);
        $em->flush();
        
        return true;
    }
    return false;
}
/**
 * @Route("/typeproducts/edit/{id}", name="typeproducts_edit")
 */
public function editAction($id, Request $request)
{
    
    $em = $this->getDoctrine()->getManager();
    $TypeProduct = $em->getRepository(TypeProduct::class)->find($id);
    
    $form = $this->createForm(TypeProductType::class, $TypeProduct);
    
    if ($this->saveChanges($form, $request, $TypeProduct)) {
        $this->addFlash(
            'notice',
            'Edited'
        );
        return $this->redirectToRoute('products_user');
    }
    
    return $this->render('type_product/edit.html.twig', [
        'form' => $form->createView()
    ]);
}

}