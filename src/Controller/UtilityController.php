<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Lists;

class UtilityController extends AbstractController {

	public function addList(Request $request) {
		$user = $this->getUser();
		$list = new Lists();
		$list->setUserid($user);
		$list->setName($request->request->get('title'));
		$list->setDescription($request->request->get('message'));
		$list->setCreated(time());
		$list->setModified(time());
		$entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($list);
    $entityManager->flush();
		return new JsonResponse($_REQUEST);
	}
	
	public function deleteList(Request $request) {
		$data = json_decode($request->getContent(), true);
		dump($data['id']);
		$user = $this->getUser();
		$list = $this->getDoctrine()->getRepository(Lists::class)->find($data['id']);
		$entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($list);
    $entityManager->flush();
		return new JsonResponse($_REQUEST);
	}


}