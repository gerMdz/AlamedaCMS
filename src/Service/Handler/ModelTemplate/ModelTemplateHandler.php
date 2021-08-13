<?php

namespace App\Service\Handler\ModelTemplate;

use App\Entity\ModelTemplate;
use App\Entity\TypeBlock;
use App\Repository\EntradaRepository;
use App\Repository\ModelTemplateRepository;
use App\Repository\PrincipalRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\QueryBuilder;

class ModelTemplateHandler
{

    private $principalRepository;
    private $sectionRepository;
    private $entradaRepository;
    private $modelTemplate;
    private $modelTemplateRepository;

    /**
     * @param PrincipalRepository $principalRepository
     * @param SectionRepository $sectionRepository
     * @param EntradaRepository $entradaRepository
     * @param ModelTemplate $modelTemplate
     * @param ModelTemplateRepository $modelTemplateRepository
     */
    public function __construct(PrincipalRepository $principalRepository, SectionRepository $sectionRepository, EntradaRepository $entradaRepository, ModelTemplate $modelTemplate, ModelTemplateRepository $modelTemplateRepository)
    {
        $this->principalRepository = $principalRepository;
        $this->sectionRepository = $sectionRepository;
        $this->entradaRepository = $entradaRepository;
        $this->modelTemplate = $modelTemplate;
        $this->modelTemplateRepository = $modelTemplateRepository;
    }

    public function managerBlock(TypeBlock $block)
    {
        switch ($block) {
            case 'page':
                return $this->principalRepository;
            case 'section':
                return $this->sectionRepository;
            case 'entrada':
                return $this->entradaRepository;
        }
    }

    /**
     * @param ModelTemplate $modelTemplate
     * @return QueryBuilder
     */
    public function getBlockByModelTemplate(ModelTemplate $modelTemplate): QueryBuilder
    {
        $repo = $this->managerBlock($modelTemplate->getBlock());
        return $repo->findByModelTemplate($modelTemplate->getId());
    }


}