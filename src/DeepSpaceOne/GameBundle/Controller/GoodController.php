<?php

namespace DeepSpaceOne\GameBundle\Controller;

use DeepSpaceOne\GameBundle\Entity\Good;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\GreaterThan;

/**
 * Good controller.
 *
 * @Route("/goods")
 */
class GoodController extends Controller
{
    /**
     * Lists all Good entities.
     *
     * @Route("/", name="goods")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $goods = $em->getRepository('DeepSpaceOneGameBundle:Good')->findAll();

        return array(
            'goods' => $goods,
        );
    }
    /**
     * Displays a form to create a new Good entity.
     *
     * @Route("/new", name="goods_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        // TASK 1: create form
        $form = $this ->createCreateForm();
        //$form =$this->createForm('game_good');

        return array(
            // TASK 1: pass form to view
            'form' => $form->createView()
        );
    }
    /**
     * Creates a new Good entity.
     *
     * @Route("/", name="goods_create")
     * @Method("POST")
     * @Template("DeepSpaceOneGameBundle:Good:new.html.twig")
     */
    public function createAction(Request $request)
    {
        // TASK 1: create form and handle the request
        $form = $this ->createCreateForm();
       // $form = $this->createForm('game_good');

        $form->handleRequest($request);

        // TASK 1: update if condition
        if ($form->isValid()) {
            // TASK 1: create good
            /*$name = $form->get('name')->getData();
            $pricePerTon = $form->get('pricePerTon')->getData();
            $good->setName($name);
            $good->setPricePerTon($pricePerTon);*/
            //TASK 2:
            $good = $form->getData();

            $em = $this->getDoctrine()->getManager();
            // TASK 1: persist good
            $em->persist($good);
            $em->flush();

            return $this->redirect($this->generateUrl('goods'));
        }
        return array(
          'form' => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Good entity.
     *
     * @Route("/{id}/edit", name="goods_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction(Good $good)
    {
        $deleteForm = $this->createDeleteForm($good);

        // TASK 1: create edit form for $good
        $editForm = $this->createEditForm($good);

        return array(
            'good' => $good,
            'delete_form' => $deleteForm->createView(),
            // TASK 1: pass form to view
            'edit_form' => $editForm ->createView()
        );
    }

    /**
     * Edits an existing Good entity.
     *
     * @Route("/{id}", name="goods_update")
     * @Method("PUT")
     * @Template("DeepSpaceOneGameBundle:Good:edit.html.twig")
     */
    public function updateAction(Request $request, Good $good)
    {
        $deleteForm = $this->createDeleteForm($good);

        // TASK 1: create edit form and handle the request
        $editForm = $this->createEditForm($good);;

        $editForm->handleRequest($request);

        // TASK 1: update if condition
        if ($editForm->isValid()) {
            // TASK 1: update $good entity
            /*$name = $editForm->get('name')->getData();
            $pricePerTon = $editForm->get('pricePerTon')->getData();
            $good->setName($name);
            $good->setPricePerTon($pricePerTon);*/
            //TASK 2:
            $good = $editForm->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($good);
            $em->flush();

            return $this->redirect($this->generateUrl('goods'));
        }

        return array(
            'good' => $good,
            'delete_form' => $deleteForm->createView(),
            // TASK 1: pass form to view
            'edit_form' => $editForm->createView()
        );
    }

    /**
     * Deletes a Good entity.
     *
     * @Route("/{id}", name="goods_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Good $good)
    {
        $form = $this->createDeleteForm($good);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($good);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('goods'));
    }
    /* Creates a form for create a Good entity*/
    /**
     * @param Good $good
     * @return \Symfony\Component\Form\Form
     */
    private function createCreateForm()
    {
        return $this->createGoodFormBuilder(new Good())
                ->add('create','submit',array('attr' => array('class' => 'btn-info')))
                ->setAction($this->generateUrl('goods_create'))
                ->getForm();
    }

    /* Creates a form for edit a Good entity*/
    /**
     * @param Good $good
     * @return \Symfony\Component\Form\Form
     */
    private function createEditForm(Good $good)
    {
        return $this->createGoodFormBuilder($good)
            ->setAction($this->generateUrl('goods_update',array('id' => $good->getId())))
            ->setMethod('PUT')
            ->add('update','submit',array('attr' => array('class' => 'btn-info')))
            ->getForm();
    }
    /**
     * Creates a form to delete a Good entity.
     *
     * @param Good $good The good
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    private function createDeleteForm(Good $good)
    {
        return $this->createFormBuilder(null, array('style' => 'none'))
            ->setAction($this->generateUrl('goods_delete', array('id' => $good->getId())))
            ->setMethod('DELETE')
            ->add('delete', 'submit', array('attr' => array('class' => 'btn-danger')))
            ->getForm()
        ;
    }

    /**
     * @param Good $good
     * @return $this|\Symfony\Component\Form\FormBuilderInterface
     */
    private function createGoodFormBuilder(Good $good)
    {
        //TASK 2:
        $options = array(
            'data_class' =>
            '\\DeepSpaceOne\\GameBundle\\Entity\\Good'
        );

        return $this->createFormBuilder($good,$options)
                ->add('name','text')
                ->add('pricePerTon','integer',array(
                    'property_path' => 'pricePerTonEuro'
                ));
    }
}
