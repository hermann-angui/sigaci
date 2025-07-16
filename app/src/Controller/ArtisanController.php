<?php

namespace App\Controller;

use App\Entity\Artisan;
use App\Form\ArtisanCompagnonType;
use App\Helper\DataTableHelper;
use App\Repository\ArtisanRepository;
use Doctrine\DBAL\Connection;
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
    #[Route('/', name: 'app_artisan_index', methods: ['GET', 'POST'])]
    public function index(Request $request, DataTableFactory $dataTableFactory): Response
    {
        $table = $dataTableFactory->create()
            ->add('Artisan', TextColumn::class, ['label' => 'Photo', 'field' => 'photo.filePath', 'render' => function($value, $context) {
                    if($context->getPhoto()) {
                        $photoUrl = '/artisans/' . $context->getPhoto()->getFilePath();
                        $photo = "<img src='$photoUrl' alt='Avatar' class='rounded-circle'>";
                    }else {
                        $first_character_nom = strtoupper(substr($context->getNom(), 0, 1));
                        $first_character_prenom = strtoupper(substr($context->getPrenoms(), 0, 1));
                        $photo = "<span class='avatar-initial rounded-circle bg-label-primary'>$first_character_nom . '' . $first_character_prenom</span>";
                    }
                    $fullname = $context->getNom() . ' ' . $context->getPrenoms();
                    $metier = $context->getActivitePrincipale()?: '';
                    $id = $context->getId();
                    $content = "<div class='d-flex justify-content-start align-items-center user-name'><div class='avatar-wrapper'><div class='avatar avatar-sm me-4'>$photo</div></div><div class='d-flex flex-column'><a href='/artisan/$id' class='text-heading text-truncate'><span class='fw-medium'>$fullname</span></a><small>$metier</small></div></div>";
                    $view = sprintf( $content, $photo, $context->getId(), $fullname, $metier );
                    return $view;
            }])
            ->add('nom', TextColumn::class, ['label' => 'Nom'])
            ->add('prenoms', TextColumn::class, ['label' => 'Prénoms'])
            ->add('category', TextColumn::class, ['label' => 'Type'])
            ->add('numero_rm', TextColumn::class, ['label' => 'N° RM'])
            ->add('numero_carte_professionnelle', TextColumn::class, ['label' => 'N° Carte Pro.'])
            ->add('crm', TextColumn::class, ['label' => 'CRM', 'field' => 'crm.name'])
            ->add('email', TextColumn::class, ['label' => 'action', 'render' => function($value, $context) {
                $artisan_id = $context->getId();
                $content = "<div class='d-inline-block text-nowrap'>
                                <button class='btn btn-icon btn-text-secondary rounded-pill waves-effect'><i class='icon-base ri ri-edit-box-line icon-22px'></i></button>
                                <button class='btn btn-icon btn-text-secondary rounded-pill waves-effect dropdown-toggle hide-arrow' data-bs-toggle='dropdown'>
                                  <i class='icon-base ri ri-more-2-line icon-22px'></i>
                                </button>
                                <div class='dropdown-menu dropdown-menu-end m-0''>
                                  <a href='/artisans/$artisan_id' class='dropdown-item'>Voir</a>
                                  <a href='javascript:void(0);' class='dropdown-item'>Renouvellement</a>
                                  <a href='javascript:void(0);' class='dropdown-item'>Télécharger carte</a>
                                  <a href='javascript:void(0);' class='dropdown-item'>Télécharger registre</a>
                                </div>
                              </div>";
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

        return $this->render('artisan/index.html.twig', ['datatable' => $table]);
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

        return $this->render('artisan/new.html.twig', [
            'artisan' => $artisan,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_artisan_show', methods: ['GET'])]
    public function show(Artisan $artisan): Response
    {
        return $this->render('artisan/show.html.twig', [
            'artisan' => $artisan,
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
