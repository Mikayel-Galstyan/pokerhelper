<?php

/**
 * This class used for course analizing. There sets filter enities
 *
 * Class Filter_Info
 */
class Filter_Info extends Filter_Order {
    /**
     *
     * @var datetime
     */
    protected $userId = null;
	/**
     *
     * @var datetime
     */
    protected $turnamentId = null;
	/**
     *
     * @var int
     */
    protected $name = null;
	/**
     *
     * @var int
     */
    protected $websiteId = null;

    /**
     * Return option dateFrom
     *
     * @return datetime
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Sets option datefFrom
     *
     * @param $val
     * @return $this
     */
    public function &setUserId($val) {
        $this->userId = $val;
        return $this;
    }

    /**
     * Return option dateTo
     *
     * @return datetime
     */
    public function getTurnamentId() {
        return $this->turnamentId;
    }

    /**
     * Sets option dateTo
     *
     * @param $val
     * @return $this
     */
    public function &setTurnamentId($val) {
        $this->turnamentId = $val;
        return $this;
    }

    /**
     * Return option courseId
     *
     * @return datetime
     */
	public function getName() {
        return $this->name;
    }

    /**
     * Sets option courseId
     *
     * @param $val
     * @return $this
     */
    public function &setName($val) {
        $this->name = $val;
        return $this;
    }

    /**
     * Return option polygonId
     *
     * @return datetime
     */
	public function getWebsiteId() {
        return $this->websiteId;
    }

    /**
     * Sets option polygonId
     *
     * @param $val
     * @return $this
     */
    public function &setWebsiteId($val) {
        $this->websiteId = $val;
        return $this;
    }
}