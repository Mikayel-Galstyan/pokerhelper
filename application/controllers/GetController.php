<?php
/**
 * Include required for Controller
 */
require_once ('ControllerActionSupport.php');
/**
 * Controller class for Get
 *
 * This controller is responsible for Get UI pages
 */
class GetController extends ControllerActionSupport {
    /**
     * Controller name
     *
     * @var string
     */
    const CONTROLLER_NAME = 'Get';
    /**
     * Club id value from filter form
     *
     * @var int
     */
    private $id = null;
    /**
     * Club lat value from filter form
     *
     * @var string
     */
    private $lat = null;
    /**
     * Club lng value from filter form
     *
     * @var string
     */
    private $lng = null;

    /**
     * Prepare course page data
     */
    public function courseAction() {
        $this->disableLayout();
        $this->setNoRender();
        $lat = $this->lat;
        $lng = $this->lng;               
        if ($lat != null && $lng != null) {
            $courseService = new Service_Course();
            $course = $courseService->getByLocation($lat, $lng);            
            if ($course) {
                $polygonService = new Service_Polygon();
                $items = $polygonService->getByCourseId($course->getId());                
                if ($items) {
                    foreach ($items as $item){
                        $tops = array();
                        $pois = array();
                        foreach (json_decode($item->getTops()) as $top){
                            $tops[] = (array)$top;
                        }
                        foreach (json_decode($item->getPois()) as $poi){
                            $pois[] = (array)$poi;
                        }
                        if (sizeof($pois) == 0) {
                            $pois = null;
                        }
                        $hole = null;
                        if (sizeof(json_decode($item->getHole())) > 0) {
                            $hole = json_decode($item->getHole());
                        }
                        $imageDetails = $item->getImageDetails();
                        if ($imageDetails) {
                            $imageDetails = json_decode($imageDetails, true);                                                                                   
                            if (sizeof($imageDetails) == 2) {
                                $image = $imageDetails;                                
                                $path = $this->baseUrl() . 'image/cropped/course_'.$item->getCourseId().'/'. $item->getId(). '.png';
                                $image['path'] = urlencode($path);
                            } else {
                                $image = null;
                            }
                        }
                        $json['polygons'][] = array (
                                'name'      => $item->getName(),
                                'image'     => $image,
                                'hole'      => $hole,
                                'hole_id'   => $item->getHoleId(),
                                'course_id' => $course->getId(),
                                'tops'      => $tops,
                                'pois'      => $pois
                        );
                    }	
                } else {
                    $msg = 'Polygongs for mentioned Course location does not exists - Lat:' . $lat . ' Lng:' . $lng;
                    $this->LOG->info(self::CONTROLLER_NAME . ' Controller : course Action '. $msg);
                    $json = array('type' => 'error', 'msg' => $msg);
                }                                              
            } else {
                $msg = 'Course by mentioned location does not exists - Lat:' . $lat . ' Lng:' . $lng;
                $this->LOG->info(self::CONTROLLER_NAME . ' Controller : course Action '. $msg);                
                $json = array('type' => 'error', 'msg' => $msg);                
            }            
        } else {
            $msg = 'Please provide correct url schema - "' .$this->baseUrl(). '/get/course/lat/{:lat}/lng/{:lng}/"';
            $this->LOG->info(self::CONTROLLER_NAME . ' Controller : course Action '. $msg);                
            $json = array('type' => 'error', 'msg' => $msg);            
        }
        $this->setJSONContentType();
        $this->printJson($json);        
    }

    /**
     * Sets the id value from request
     *
     * This method is magically called by the controller during pre-dispatch
     *
     * @param $val
     * @return mixed
     */
    public function &setId($val) {
        $this->id = $val;
        return $this;
    }

    /**
     * Sets the lat value from request
     *
     * This method is magically called by the controller during pre-dispatch
     *
     * @param $val
     * @return mixed
     */
    public function &setLat($val) {
        $this->lat = $val;
        return $this;
    }

    /**
     * Sets the lng value from request
     *
     * This method is magically called by the controller during pre-dispatch
     *
     * @param $val
     * @return mixed
     */
    public function &setLng($val) {
        $this->lng = $val;
        return $this;
    }    
}