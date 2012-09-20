<?php

namespace Heartsentwined\Cron\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Job
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Job extends EntityRepository
{
    const STATUS_PENDING = 'pending';
    const STATUS_RUNNING = 'running';
    const STATUS_MISSED  = 'missed';
    const STATUS_ERROR   = 'error';

    /**
     * get pending cron jobs
     *
     * @return array of \Heartsentwined\Cron\Entity\Job
     */
    public function getPending()
    {
        $dqb = $this->_em->createQueryBuilder();
        $dqb->select(array('j'))
            ->from('Heartsentwined\Cron\Entity\Job', 'j')
            ->where($dqb->expr()->in('j.status', array(self::STATUS_PENDING)));
        return $dqb->getQuery()->getResult();
    }

    /**
     * get running cron jobs
     *
     * @return array of \Heartsentwined\Cron\Entity\Job
     */
    public function getRunning()
    {
        $dqb = $this->_em->createQueryBuilder();
        $dqb->select(array('j'))
            ->from('Heartsentwined\Cron\Entity\Job', 'j')
            ->where($dqb->expr()->in('j.status', array(self::STATUS_RUNNING)));
        return $dqb->getQuery()->getResult();
    }

    /**
     * get completed cron jobs
     *
     * @return array of \Heartsentwined\Cron\Entity\Job
     */
    public function getHistory()
    {
        $dqb = $this->_em->createQueryBuilder();
        $dqb->select(array('j'))
            ->from('Heartsentwined\Cron\Entity\Job', 'j')
            ->where($dqb->expr()->in('j.status', array(
                self::STATUS_SUCCESS, self::STATUS_MISSED, self::STATUS_ERROR,
            )));
        return $dqb->getQuery()->getResult();
    }
}
