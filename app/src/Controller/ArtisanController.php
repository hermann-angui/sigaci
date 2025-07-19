<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Form\ArtisanCompagnonType;
use App\Helper\DataTableHelper;
use App\Repository\ArtisanRepository;
use App\Repository\IdentificationRepository;
use App\Repository\ImmatriculationRepository;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Omines\DataTablesBundle\Adapter\Doctrine\ORM\SearchCriteriaProvider;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/artisan')]
class ArtisanController extends AbstractController
{
    #[Route('', name: 'app_artisan_index', methods: ['GET', 'POST'])]
    public function index(Request $request, DataTableFactory $dataTableFactory, EntityManagerInterface $em): Response
    {
        $table = $dataTableFactory->create()
            ->add('artisan', TextColumn::class, ['label' => 'Photo', 'field' => 'photo.filePath', 'render' => function($value, $context) {
                    if($context->getPhoto()) {
                        $photoUrl = '/media/' . $context->getPhoto()->getFilePath();
                        $photo = "<img src='$photoUrl' alt='Avatar' class='rounded-circle'>";
                    }else {
                        $first_character_nom = strtoupper(substr($context->getNom(), 0, 1));
                        $first_character_prenom = strtoupper(substr($context->getPrenoms(), 0, 1));
                        $photo = "<span class='avatar-initial rounded-circle bg-label-primary'>$first_character_nom . '' . $first_character_prenom</span>";
                    }
                    $fullname = $context->getNom() . ' ' . $context->getPrenoms();
                    $metier = $context->getActivitePrincipale()?$context->getActivitePrincipale()->getName(): '';
                    $id = $context->getId();
                    $content = "<div class='d-flex justify-content-start align-items-center user-name'><div class='avatar-wrapper'><div class='avatar avatar-sm me-4'>$photo</div></div><div class='d-flex flex-column'><a href='/artisan/$id' class='text-heading text-truncate'><span class='fw-medium'>$fullname</span></a><small>$metier</small></div></div>";
                    $view = sprintf( $content, $photo, $context->getId(), $fullname, $metier );
                    return $view;
            }])
            ->add('crm', TextColumn::class, ['label' => 'CRM', 'field' => 'crm.name'])
            ->add('etablissement', TextColumn::class, ['label' => 'Etablissemnt', 'render' => function($value, $context) {
                $content = $context->getEtablissement()?$context->getEtablissement()->getSigle(): '';
                return $content;
            }])
            ->add('statut', TextColumn::class, ['label' => 'Patron', 'render' => function($value, $context) {
                $patron = $context->getPatron();
                $view = "";
                if($patron) {
                    if($patron->getPhoto()) {
                        $photoUrl = '/media/' . $patron->getPhoto()->getFilePath();
                        $photo = "<img src='$photoUrl' alt='Avatar' class='rounded-circle'>";
                    }else {
                        $first_character_nom = strtoupper(substr($patron->getNom(), 0, 1));
                        $first_character_prenom = strtoupper(substr($patron->getPrenoms(), 0, 1));
                        $photo = "<span class='avatar-initial rounded-circle bg-label-primary'>$first_character_nom . '' . $first_character_prenom</span>";
                    }
                    $id = $patron->getId();
                    $fullname = $patron->getNom() . ' ' . $patron->getPrenoms();
                    $metier = $patron->getActivitePrincipale()? $patron->getActivitePrincipale()->getName(): '';
                    $content = "<div class='d-flex justify-content-start align-items-center user-name'><div class='avatar-wrapper'><div class='avatar avatar-sm me-4'>$photo</div></div><div class='d-flex flex-column'><a href='/artisan/$id' class='text-heading text-truncate'><span class='fw-medium'>$fullname</span></a><small>$metier</small></div></div>";
                    $view = sprintf( $content, $photo, $context->getId(), $fullname, $metier );
                    return $view;
                }
                return $view;
            }])
            ->add('activites', TextColumn::class, ['label' => 'Activités', 'render' => function($value, $context) {
                $principale = $context->getActivitePrincipale() ? $context->getActivitePrincipale()->getName(): "";
                $secondaire = $context->getActiviteSecondaire() ? $context->getActiviteSecondaire()->getName(): "";
                $content = "<div><p class='mb-0 fs-13'>principale : <span class='badge badge-outline-secondary'>$principale</span></p><p class='mb-0 fs-13'>secondaire : <span class='badge badge-outline-warning'>$secondaire</span></p></div>";
                return $content;
            } ])
            ->add('category_artisan_id', TextColumn::class, ['label' => 'Type', 'render' => function($value, $context) {
                $content = $context->getCategoryArtisan() ? $context->getCategoryArtisan()->getName(): "";
                return strtolower($content);
            } ])
            ->add('numero_rm', TextColumn::class, ['label' => 'N° RM'])
            ->add('numero_carte_professionnelle', TextColumn::class, ['label' => 'N° Carte Pro.'])

            ->add('email', TextColumn::class, ['label' => 'Actions', 'render' => function($value, $context) {
                $artisan_id = $context->getId();

                $content = <<<EOT
                            <div class='d-flex align-items-center gap-1'>
                                <a href='/artisan/$artisan_id' class='shadow-sm fs-14 d-inline-flex border rounded-2 p-1 me-1'>
                                    <i class='ti ti-eye'></i>
                                </a>
                                <a href='/artisan/$artisan_id/edit' class='shadow-sm fs-14 d-inline-flex border rounded-2 p-1 me-1'>
                                    <i class='ti ti-edit'></i>
                                </a>
                                <a href='/artisan/$artisan_id/delete' class='shadow-sm fs-14 d-inline-flex border rounded-2 p-1 me-1'>
                                    <i class='ti ti-trash'></i>
                                </a>
                                <a href='javascript:void(0);' class='shadow-sm fs-14 d-inline-flex border rounded-2 p-1 me-1'>
                                    <i class='ti ti-dots-vertical'></i>
                                </a>
                                <ul class='dropdown-menu p-2' style=''>
                                    <li>
                                        <a href='/artisan/$artisan_id/edit' class='dropdown-item d-flex align-items-center'>Editer</a>
                                    </li>
                                    <li>
                                        <a href='/artisan/$artisan_id' class='dropdown-item d-flex align-items-center'>Voir</a>
                                    </li>
                                    <li>
                                        <a href='/artisan/$artisan_id/delete' class='dropdown-item d-flex align-items-center' data-bs-toggle='modal'
                                            data-bs-target='#delete_modal'>Supprimer</a>
                                    </li>
                                </ul>
                            </div>
                           EOT;


                return $content;
            }]
        )
            ->createAdapter(ORMAdapter::class, [
                'entity' => Artisan::class,
//                'query' => function (QueryBuilder $builder) {
//                    $builder
//                        ->select('e')
//                        ->addSelect('c')
//                        ->from(Employee::class, 'e')
//                        ->leftJoin('e.company', 'c')
//                    ;
//                },
            ])
            ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        $stats = $em->getRepository(Artisan::class)->getTotalForEachArtisanCategory();

        $viewData = [
            'datatable' => $table,
            "total_entreprise_artisanale" => 0,
            "total_maitre_artisan" => 0,
            "total_compagnons" => 0,
            "total_apprentis" => 0,
        ];

        foreach($stats as $stat) {
            switch ($stat['name']) {
                case "MAÎTRE ARTISAN":
                    $viewData['total_maitre_artisan'] = $stat['total'];
                    break;
                case "COMPAGNON":
                    $viewData['total_compagnons'] = $stat['total'];
                    break;
                case "APPRENTI":
                    $viewData['total_apprentis'] = $stat['total'];
                    break;
                case "ENTREPRISE ARTISANALE":
                    $viewData['total_entreprise_artisanale'] = $stat['total'];
                    break;
            }
        }
        $viewData['total'] = $viewData['total_entreprise_artisanale'] + $viewData['total_maitre_artisan'] + $viewData['total_compagnons'] + $viewData['total_apprentis'];
        return $this->render('theme_b/artisan/index.html.twig', $viewData);
    }

    #[Route('/dt', name: 'app_artisan_dt', methods: ['GET'])]
    public function datatable(Request $request, Connection $connection): JsonResponse
    {
        date_default_timezone_set("Africa/Abidjan");
        $params = $request->query->all();
        $paramDB = $connection->getParams();
        $table = 'artisan';
        $primaryKey = 'id';
        $columns = [
            [
                'db' => 'id',
                'dt' => 'id',
            ],
            [
                'db' => 'photo_id',
                'dt' => 'photo_id',
            ],
            [
                'db' => 'nom',
                'dt' => 'nom',
            ],
            [
                'db' => 'category',
                'dt' => 'category',
            ],
            [
                'db' => 'activite_exercee',
                'dt' => 'activite_exercee',
            ],
            [
                'db' => 'numero_rm',
                'dt' => 'numero_rm',
            ],
//            [
//                'db' => 'etablissement_id',
//                'dt' => 'etablissement_id',
//            ],
//            [
//                'db' => 'crm_id',
//                'dt' => 'crm_id',
//            ],
            [
                'db' => 'numero_carte_professionnelle',
                'dt' => 'numero_carte_professionnelle',
            ],
            [
                'db' => 'numero_piece_identite',
                'dt' => 'numero_piece_identite',
            ],
            [
                'db' => 'id',
                'dt' => '',
                'formatter' => function($d, $row){
                    $artisan_id = $row['id'];
                    $content = "<div class='d-inline-block text-nowrap'>
                                <button class='btn btn-icon btn-text-secondary rounded-pill waves-effect'><i class='icon-base ri ri-edit-box-line icon-22px'></i></button>
                                <button class='btn btn-icon btn-text-secondary rounded-pill waves-effect dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                  <i class='icon-base ri ri-more-2-line icon-22px'></i>
                                </button>
                                <div class='dropdown-menu dropdown-menu-end m-0''>
                                  <a href='javascript:void(0);' class='dropdown-item'>Voir</a>
                                  <a href='javascript:void(0);' class='dropdown-item'>Renouvellement</a>
                                  <a href='javascript:void(0);' class='dropdown-item'>Télécharger carte</a>
                                  <a href='javascript:void(0);' class='dropdown-item'>Télécharger registre</a>
                                </div>
                              </div>";
                    $content = sprintf($content ,$artisan_id,$artisan_id, $artisan_id, $artisan_id);
                    return $content;
                }
            ],
            [
                'db' => 'prenoms',
                'dt' => 'prenoms'
            ],
            [
                'db' => 'sexe',
                'dt' => 'sexe'
            ],
            [
                'db' => 'telephone',
                'dt' => 'telephone'
            ],
            [
                'db' => 'domicile',
                'dt' => 'domicile'
            ],
            [
                'db' => 'activite_principale',
                'dt' => 'activite_principale',
            ],
            [
                'db' => 'activite_secondaire',
                'dt' => 'activite_secondaire',
            ],
            [
                'db' => 'type_piece_identite',
                'dt' => 'type_piece_identite',
            ],
        ];

        $sql_details = array(
            'user' => $paramDB['user'],
            'pass' => $paramDB['password'],
            'db'   => $paramDB['dbname'],
            'host' => $paramDB['host']
        );

        $whereResult = '';
//        if(!empty($params['commune_filter'])){
//            $whereResult .= " commune_id ='". $params['commune_filter'] . "' AND";
//        }
//        if(!empty($params['region_filter'])){
//            $whereResult .= " region_id ='". $params['region_filter'] . "' AND";
//        }
//        if(!empty($params['dren_filter'])){
//            $whereResult .= " dren_id ='". $params['dren_filter'] . "' AND";
//        }
//        if(!empty($params['iepp_filter'])){
//            $whereResult .= " iepp_id = '". $params['iepp_filter'] . "' AND";
//        }

        // $whereResult = substr_replace($whereResult,'',-strlen(' AND'));
        $response = DataTableHelper::complex($_GET, $sql_details, $table, $primaryKey, $columns, $whereResult);

        return new JsonResponse($response);
    }

    #[Route('/new', name: 'app_artisan_new', methods: ['GET', 'POST'])]
    public function create(Request $request, Artisan $artisan, ArtisanRepository $artisanRepository): Response
    {
        $form = $this->createForm(ArtisanCompagnonType::class, $artisan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artisanRepository->add($artisan, true);

            return $this->redirectToRoute('app_artisan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('theme_b/artisan/new.html.twig', [
            'artisan' => $artisan,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_artisan_show', methods: ['GET'])]
    public function show(Artisan $artisan,
                         IdentificationRepository $identificationRepository,
                         ImmatriculationRepository $immatriculationRepository): Response
    {
        $identification = $identificationRepository->findOneBy(['artisan' => $artisan]);
        $immatriculation = $immatriculationRepository->findOneBy(['artisan' => $artisan]);
        return $this->render('theme_b/artisan/show.html.twig', [
            'artisan' => $artisan,
            "identification" => $identification,
            "immatriculation" => $immatriculation,
        ]);
    }


    #[Route('/{id}/edit', name: 'app_artisan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artisan $artisan, ArtisanRepository $artisanRepository): Response
    {
        $form = $this->createForm(ArtisanType::class, $artisan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artisanRepository->add($artisan, true);

            return $this->redirectToRoute('app_artisan_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artisan/edit.html.twig', [
            'artisan' => $artisan,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_artisan_delete', methods: ['POST'])]
    public function delete(Request $request, Artisan $artisan, ArtisanRepository $artisanRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artisan->getId(), $request->request->get('_token'))) {
            $artisanRepository->remove($artisan, true);
        }

        return $this->redirectToRoute('app_artisan_index', [], Response::HTTP_SEE_OTHER);
    }

}
