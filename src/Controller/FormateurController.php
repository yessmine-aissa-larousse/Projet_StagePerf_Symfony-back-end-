<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Required;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Entity\Formateur;
use App\Entity\Emlpoitemps;
use App\Entity\Admin;
use Symfony\Component\HttpFoundation\JsonResponse;

/*#[Route('/api', name: 'api_')]*/
class FormateurController extends AbstractController
{
    
    #[Route('/create', name: 'formateur_create', methods:['POST'])]
    public function addFormateur(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $data = json_decode($request->getContent(), true);
        $entityManager = $doctrine->getManager();

        $formateur = new Formateur();
        $formateur->setNom($data['nom']);
        $formateur->setPrenom($data['prenom']);
        $formateur->setMail($data['mail']);
        $formateur->setTel($data['tel']);
        $formateur->setAdresse($data['adresse']);
        /*$formateur->setNom($request->request->get('nom'));
        $formateur->setPrénom($request->request->get('prénom'));
        $formateur->setMail($request->request->get('mail'));
        $formateur->setTel($request->request->get('tel'));
        $formateur->setAdresse($request->request->get('adresse'));*/
        
        
        

        $entityManager->persist($formateur);
        $entityManager->flush();

        return $this->json( $formateur);
    }
    #[Route('/lister/{id}', name: 'formateur_id' , methods:['get'])]
    public function show(int $id, PersistenceManagerRegistry $doctrine): Response
    {
        $formateur = $doctrine->getRepository(Formateur::class)->find($id);

        if (!$formateur) {
            return $this->json('No formateur found for id' . $id, 404);
        }

        $data = [
            'codef' => $formateur->getId(),
            'nom' => $formateur->getNom(),
            'prenom' => $formateur->getPrenom(),
            'mail' => $formateur->getMail(),
            'tel' => $formateur->getTel(),
            'adresse' => $formateur->getAdresse(),
        ];

        return $this->json($data);
    }
    #[Route('/delete/{id}', name: 'formateur_delete', methods:['delete'] )]
    public function delete(int $id, PersistenceManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $formateur = $entityManager->getRepository(Formateur::class)->find($id);

        if (!$formateur) {
            return $this->json('No formateur found for id ' . $id, 404);
        }

        $entityManager->remove($formateur);
        $entityManager->flush();

        return $this->json('Deleted a formateur successfully with id ' . $id);
    }

    #[Route('/edit/{id}', name:'formateur_edit', methods:['PUT'])]
    public function edit(Request $request, int $id,PersistenceManagerRegistry $doctrine): Response
    {
        $data = json_decode($request->getContent(), true);
        $entityManager=$doctrine->getManager();
        $formateur = $entityManager->getRepository(Formateur::class)->find($id);
 
        if (!$formateur) {
            return $this->json('No project found for id' . $id, 404);
        }
        $formateur->setNom($data['nom']);
        $formateur->setPrenom($data['prenom']);
        $formateur->setMail($data['mail']);
        $formateur->setTel($data['tel']);
        $formateur->setAdresse($data['adresse']);
        
        /*$formateur->setNom($request->request->get('nom'));
        $formateur->setPrénom($request->request->get('prénom'));
        $formateur->setMail($request->request->get('mail'));
        $formateur->setTel($request->request->get('tel'));
        $formateur->setAdresse($request->request->get('adresse'));*/

        $entityManager->flush();
 
        $data =  [
            'codef' => $formateur->getId(),
            'nom' => $formateur->getNom(),
            'prenom' => $formateur->getPrenom(),
            'mail' => $formateur->getMail(),
            'tel' => $formateur->getTel(),
        ];
         
        return $this->json($data);
    }
    #[Route('/nombre', name: 'app_formateur_nombre' , methods:['get'])]
    public function countFormateurs(PersistenceManagerRegistry $doctrine): JsonResponse
    {
        $nombreFormateurs =$doctrine->getRepository(Formateur::class)->count([]);

        return $this->json(['nombreFormateurs' => $nombreFormateurs]);
    }
    #[Route('/lister', name: 'app_formateur', methods: ['GET'])]                     
    public function index(Request $request, PersistenceManagerRegistry $doctrine): Response
    {
        $formateurs = $doctrine->getRepository(Formateur::class)->findAll();
        return $this->json($formateurs);
    }



/*J'utilise le QueryBuilder de Doctrine dans ce code pour construire la requête SQL de manière plus lisible */

    #[Route('/emploisformateur/{id}', name: 'get_emploi_temps_by_formateur', methods: ['GET'])]
    public function getEmploiTempsByFormateur(Request $request, $id, PersistenceManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $emploiTempsRepository = $entityManager->getRepository(Emlpoitemps::class);

        $startDate = $request->query->get('start_date');
        $endDate = $request->query->get('end_date');

        $startDate = $startDate ? new \DateTime($startDate) : null;
        $endDate = $endDate ? new \DateTime($endDate) : null;

        $emploisDuTemps = $emploiTempsRepository->createQueryBuilder('e')
            ->where('e.idform = :id AND e.date_jour BETWEEN :startDate AND :endDate')
            ->setParameter('id', $id)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->orderBy('e.date_jour', 'ASC')
            ->getQuery()
            ->getResult();

        $response = [];
        foreach ($emploisDuTemps as $emploiDuTemps) {
            $response[] = [
                'id' => $emploiDuTemps->getId(),
                'date_jour' => $emploiDuTemps->getDateJour()->format('Y-m-d'),
                'debut' => $emploiDuTemps->getDebut(),
                'fin' => $emploiDuTemps->getFin(),
                'idcl' => $emploiDuTemps->getClasse() ? $emploiDuTemps->getClasse()->getId() : null,
                'idsl' => $emploiDuTemps->getSalle() ? $emploiDuTemps->getSalle()->getId() : null,
                'idform' => $emploiDuTemps->getFormateur() ? $emploiDuTemps->getFormateur()->getId() : null,
            ];
        }

        return new JsonResponse($response);
    }

    #[Route("/login", name:"login", methods:("POST"))]
    public function login(Request $request,PersistenceManagerRegistry $doctrine): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        $mdp = $data['mdp'];

        $admin = $doctrine->getRepository(Admin::class)->findOneBy(['email' => $email, 'mdp' => $mdp]);

        if ($admin) {
            return new JsonResponse(['success' => true]);
        }

        return new JsonResponse(['success' => false, 'message' => 'Invalid credentials']);
    }
    #[Route('/nombre-admins', name: 'app_admin_nombre', methods: ['GET'])]
    public function countAdmins(PersistenceManagerRegistry $doctrine): JsonResponse
    {
        $nombreAdmins = $doctrine->getRepository(Admin::class)->count([]);

        return $this->json(['nombreAdmins' => $nombreAdmins]);
    }

    
}