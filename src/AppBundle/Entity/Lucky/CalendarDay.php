<?php

namespace AppBundle\Entity\Lucky;

use Doctrine\ORM\Mapping as ORM;

/**
 * CalendarDay
 *
 * @ORM\Table(name="lucky_calendar_day")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Lucky\CalendarDayRepository")
 */
class CalendarDay
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="user", type="integer")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="day", type="datetime")
     */
    private $day;

    /**
     * @var int
     *
     * @ORM\Column(name="mood", type="integer")
     */
    private $mood;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param integer $user
     *
     * @return CalendarDay
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set day
     *
     * @param \DateTime $day
     *
     * @return CalendarDay
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return \DateTime
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set mood
     *
     * @param integer $mood
     *
     * @return CalendarDay
     */
    public function setMood($mood)
    {
        $this->mood = $mood;

        return $this;
    }

    /**
     * Get mood
     *
     * @return int
     */
    public function getMood()
    {
        return $this->mood;
    }
}

