<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Form\TaskType;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use AppBundle\Repository\ProductRepository;

class DefaultController extends Controller
{
    
    public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults(array(
        'data_class' => Task::class,
    ));
}
    
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        $var= "ooo";
        
        echo "jj";
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/new", name="new_task")
     */
     public function newAction(Request $request)
    {
        // create a task and give it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(TaskType::class, $task, array(
    'action' => $this->generateUrl('lucky'),
    'method' => 'POST',));
        
         $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // $form->getData() holds the submitted values
        // but, the original `$task` variable has also been updated
        $task = $form->getData();

        // ... perform some action, such as saving the task to the database
        // for example, if Task is a Doctrine entity, save it!
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($task);
        // $em->flush();

        return $this->redirectToRoute('task_success');
    }
        
        
        return $this->render('AppBundle:default:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    /**
     * @Route("/createproduct", name="create_product")
     */
    public function createproductAction()
    {
      $category = new Category();
        $category->setName('Computer Peripherals');

        $product = new Product();
        $product->setName('Keyboard');
        $product->setPrice(19.99);
        $product->setDescription('Ergonomic and stylish!');

        // relate this product to the category
        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Saved new product with id: '.$product->getId()
            .' and new category with id: '.$category->getId()
        );
    }
    
    
    /**
     * @Route("/showproduct/{productId}", name="show_product")
     */
    public function showAction($productId)
{
//    $product = $this->getDoctrine()
//        ->getRepository('AppBundle:Product')
//        ->find($productId);
//    
    //$repository = $this->getDoctrine()->getRepository('AppBundle:Product');
    // dynamic method names to find a single product based on a column value
    //$product = $repository->findOneById($productId);
    //$product = $repository->findOneByName('Keyboard');

    // dynamic method names to find a group of products based on a column value
    //$products = $repository->findByPrice(19.99);
    $product = $this->getDoctrine()
        ->getRepository('AppBundle:Product')
        ->findOneByIdJoinedToCategory($productId);

    $category = $product->getCategory();

    // find *all* products
  //  $products = $repository->findAll();
   // $product = $repository->findOneById($productId);
    if (!$product) {
        throw $this->createNotFoundException(
            'No product found for id '.$productId
        );
    }
   $categoryName = $product->getCategory()->getName();
   
     return new Response(' product with id '.$product->getName()." Price".$product->getPrice()." Category ".$categoryName);
    // ... do something, like pass the $product object into a template
}
    /**
     * @Route("/updateproduct/{productId}", name="upate_product")
     */
    public function updateAction($productId)
{
    $em = $this->getDoctrine()->getManager();
    $product = $em->getRepository('AppBundle:Product')->find($productId);

    if (!$product) {
        throw $this->createNotFoundException(
            'No product found for id '.$productId
        );
    }

    $product->setName('New product name!'.  date('l jS \of F Y h:i:s A'));
    $em->flush();

    return $this->redirectToRoute('homepage');
}
    
/**
* @Route("/showproducts/{categoryId}", name="show_products")
*/
public function showProductsAction($categoryId)
{
    $category = $this->getDoctrine()
        ->getRepository('AppBundle:Category')
        ->find($categoryId);

    $products = $category->getProducts();
    dump(get_class($category));
    //die();
      return new Response('<body> product with id '.dump($products).'</body>');
    
    // ...
}

/**
* @Route("/sendmail/{name}", name="sendmail_to_nom")
*/
public function sendemail($name)
{
     $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('send@example.com')
        ->setTo('luc_vallet@hotmail.com')
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'AppBundle:default:registration.html.twig',
                array('name' => $name)
            ),
            'text/html'
        );
        $this->get('mailer')->send($message);

     return new Response('<body> email sent with id </body>');
    
}


    }
