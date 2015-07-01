<?php

class Zend_View_Helper_MapContainer extends Zend_View_Helper_Abstract {
    public function mapcontainer($forPage) {
		if($forPage == 'provider'){
			$html = 
			'<div id="contextMenu">
				<ul>
					<li class="active poi" onclick="Polygon.add(\'poi\');"><span class="ico_add_16"></span><span class="ml5">' . $this->view->translate('add.polygon.poi') .'</span></li>
					<li class="active hole" onclick="Polygon.add(\'hole\');"><span class="ico_add_16"></span><span class="ml5">' . $this->view->translate('add.polygon.hole') .'</span></li>
					<li class="active clean" onclick="Polygon.clean()"><span class="ico_clean_16"></span><span class="ml5">'. $this->view->translate('clean.points') .'</span></li>
				</ul>
				<div class="split"></div>
				<ul>
					<li><span class="ico_rul_16"></span><span class="ml5 coord_lat">'. $this->view->translate('lat') .' : <i></i></span></li>
					<li><span class="ico_rul_16"></span><span class="ml5 coord_lng">'. $this->view->translate('lng') .' : <i></i></span></li>
				</ul>
			</div>';
		}else if($forPage == 'polygonDraw'){
			$html = 
			'<div id="contextMenu">
				<ul>
					<li class="active point" onclick="Polygon.add(\'point\');"><span class="ico_add_16"></span><span class="ml5">' . $this->view->translate('add.polygon.point') .'</span></li>
                    <li class="active point" onclick="Polygon.add(\'cneterPoint\');"><span class="ico_add_16"></span><span class="ml5">' . $this->view->translate('add.center.point') .'</span></li>
					<li class="active clean" onclick="Polygon.clean()"><span class="ico_clean_16"></span><span class="ml5">'. $this->view->translate('clean.points') .'</span></li>
				</ul>
				<div class="split"></div>
				<ul>
					<li><span class="ico_rul_16"></span><span class="ml5 coord_lat">'. $this->view->translate('lat') .' : <i></i></span></li>
					<li><span class="ico_rul_16"></span><span class="ml5 coord_lng">'. $this->view->translate('lng') .' : <i></i></span></li>
				</ul>
			</div>';
		}else if($forPage == 'holeRoute'){
			$html = 
			'<div id="contextMenu">
				<ul>
					<li class="active route" onclick="Polygon.add(\'route\');"><span class="ico_add_16"></span><span class="ml5">' . $this->view->translate('add.route.point') .'</span></li>
					<li class="active clean" onclick="Polygon.clean()"><span class="ico_clean_16"></span><span class="ml5">'. $this->view->translate('clean.points') .'</span></li>
				</ul>
				<div class="split"></div>
				<ul>
					<li><span class="ico_rul_16"></span><span class="ml5 coord_lat">'. $this->view->translate('lat') .' : <i></i></span></li>
					<li><span class="ico_rul_16"></span><span class="ml5 coord_lng">'. $this->view->translate('lng') .' : <i></i></span></li>
				</ul>
			</div>';
		}else{
			$html = 
			'<div id="contextMenu">
				<ul>
					<li class="active point" onclick="Polygon.add(\'point\');"><span class="ico_add_16"></span><span class="ml5">' . $this->view->translate('add.sector.point') .'</span></li>
					<li class="active clean" onclick="Polygon.clean()"><span class="ico_clean_16"></span><span class="ml5">'. $this->view->translate('clean.points') .'</span></li>
				</ul>
				<div class="split"></div>
				<ul>
					<li><span class="ico_rul_16"></span><span class="ml5 coord_lat">'. $this->view->translate('lat') .' : <i></i></span></li>
					<li><span class="ico_rul_16"></span><span class="ml5 coord_lng">'. $this->view->translate('lng') .' : <i></i></span></li>
				</ul>
			</div>';
		}
        return $html;
    }
}

