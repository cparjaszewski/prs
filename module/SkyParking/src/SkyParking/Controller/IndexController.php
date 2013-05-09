<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace SkyParking\Controller;

use SkyParking\Entity\ParkingPlace;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * Sets Entity Manager
     * @param EntityManager $em
     */
    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Get Entity Manager
     * @return EntityManager Entity Manager
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }

        return $this->em;
    }

    public function indexAction()
    {
        $places = $this->getEntityManager()
            ->getRepository('SkyParking\Entity\ParkingPlace')
            ->findAll();

        $reserved = array();

        foreach ($places as $place) {
            $reserved[] = $place->reserved;
        }

        $rows = 180/10;
        $columns = 10;

        $viewModel = new ViewModel();

        $viewModel->setVariable('columns', $columns);
        $viewModel->setVariable('rows', $rows);
        $viewModel->setVariable('reserved', $reserved);

        return $viewModel;
    }

    public function resetDBAction()
    {
        $oldData = $this->getEntityManager()
            ->getRepository('SkyParking\Entity\ParkingPlace')
            ->findAll();

        foreach ($oldData as $data) {
            $this->getEntityManager()->remove($data);
        }

        $this->getEntityManager()->flush();

        for ($i = 0; $i < 180; $i++) {
            $parkingPlace = new ParkingPlace;
            $parkingPlace->id = $i+1;
            $parkingPlace->reserved = false;
            $parkingPlace->image = 'imgs/default.jpg';
            $this->getEntityManager()->persist($parkingPlace);
        }

        $this->getEntityManager()->flush();
        $message = 'Zresetowano bazę danych';

        $viewModel = new ViewModel();
        $viewModel->setVariable('message', $message);

        return $viewModel;
    }
}
