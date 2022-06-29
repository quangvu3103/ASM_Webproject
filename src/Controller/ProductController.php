<?php

namespace App\Controller;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Product;
class ProductController extends AbstractController
{
    /**
     * @Route("/product", name="app_product")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    /**
     * @Route("/home/product",name="products_user")
     */
    public function indexActionUser()
    {
        
        $em = $this->getDoctrine()->getManager();
 
        $Products = $em->getRepository(Product::class)->findAll();
       
        return $this->render('product/index.html.twig', array(
            'Products' => $Products,
        ));
    }
    /**
 * @Route("/product/details/{id}", name="product_details")
 */
public
function detailsAction($id)
{
    $em = $this->getDoctrine()->getManager();
 
    $Product = $em->getRepository(Product::class)->find($id);

    return $this->render('product/details.html.twig', [
        'Product' => $Product
    ]);
}
/**
 * @Route("/product/delete/{id}", name="product_delete")
 */
public function deleteAction($id)
{
    $em = $this->getDoctrine()->getManager();
    $Product = $em->getRepository(Product::class)->find($id);
        $em->remove($Product);
    $em->flush();
    
    $this->addFlash(
        'error',
        'Todo deleted'
    );
    
    return $this->redirectToRoute('products_user');
}
/**
 * @Route("/product/create", name="product_create", methods={"GET","POST"})
 */
public function createAction(Request $request)
{
    $Product = new Product();
    $form = $this->createForm(ProductType::class, $Product);
    
    if ($this->saveChanges($form, $request, $Product)) {
        $this->addFlash(
            'notice',
            'Todo Added'
        );
        
        return $this->redirectToRoute('products_user');
    }
    
    return $this->render('product/create.html.twig', [
        'form' => $form->createView()
    ]);
}

public function saveChanges($form, $request, $Product)
{
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        $Product = $form->getdata();
        $em = $this->getDoctrine()->getManager();
        $em->persist($Product);
        $em->flush();
        
        return true;
    }
    return false;
}
/**
 * @Route("/product/edit/{id}", name="product_edit")
 */
public function editAction($id, Request $request)
{
    
    $em = $this->getDoctrine()->getManager();   
    $Product = $em->getRepository(Product::class)->find($id);
    
    $form = $this->createForm(ProductType::class, $Product);
    
    if ($this->saveChanges($form, $request, $Product)) {
        $this->addFlash(
            'notice',
            'Todo Edited'
        );
        return $this->redirectToRoute('products_user');
    }
    
    return $this->render('product/edit.html.twig', [
        'form' => $form->createView()
    ]);
}

}
