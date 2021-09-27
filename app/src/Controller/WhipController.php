<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class WhipController extends AbstractController
{
    const BASE_HTML_TWIG = "base.html.twig";
    const ADMIN_HTML_TWIG = "admin.html.twig";

    /**
     * @Route("/", name="homewhip")
     */
    public function index(): Response
    {
        $view =  $this->renderView(self::BASE_HTML_TWIG, ['user' => $this->getUser()]);
            return new Response($view,200);
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(UserRepository $user): Response
    {
        $res = $user->findAll();

            $select_roles = [['value'=>User::ROLE_SUPERADMIN, 'text'=>'superadmin'],
                ['value'=>User::ROLE_ADMIN,'text'=>'admin'],
                ['value'=> User::ROLE_CUSTOMER, 'text'=>'customer']];


            $view =  $this->renderView(self::ADMIN_HTML_TWIG, ['users' => $res,
                                                                    'select_roles'=>$select_roles]);
            return new Response($view,200);
    }
    /**
     * @Route("/user/update_status", name="user_update_status")
     */

    public function updateStatus (Request $request, UserRepository $userRepo): Response
    {
         $data = json_decode($request->getContent());

         $userRepo->updateRole($data->id,$data->value);

         return $this->json (['ok']);
    }

    /**
     * @Route("/user/update", name="user_update")
     */

    public function updateUser (Request $request, UserRepository $userRepo): Response
    {
        $id = $request->query->get('id');

        $user = $userRepo->findOneBy([ 'id'=> $id]);

        $form = $this->createForm(RegistrationFormType::class, $user);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password,
            // since Password encoder is deprecated, we encode password directly in User Entity class
            $user->setPassword($form->get('plainPassword')->getData());
            $user->setName($form->get('name')->getData());
            $user->setLastname($form->get('lastname')->getData());
            $user->setStatus(User::VALIDATED);
            $user->setRoles ([ User::ROLE_CUSTOMER ]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('user_update');
        }

        return $this->render('update.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

}
