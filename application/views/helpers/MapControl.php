<?php

class Zend_View_Helper_MapControl extends Zend_View_Helper_Abstract {
    public function mapControl() {
        $html = 
        '<div class="map-control" id="toogle-panel">
			<a class="control-position-show" onclick="MapTool.showPanel(\'left\')"></a>
		</div>
		<div class="map-control type1" id="map-control-panel" style="display:none">
			<a class="control-position-hide" onclick="MapTool.hidePanel(\'left\')" ></a>
			<a href="" onclick="MapTool.move(\'left\')" class="left">Left</a>
			<a href="" onclick="MapTool.move(\'right\')" class="right">Right</a>
			<a href="" onclick="MapTool.move(\'up\')" class="up">Up</a>
			<a href="" onclick="MapTool.move(\'down\')" class="down">Down</a>
			<a href="" onclick="MapTool.zoom(\'in\')" class="zoom-in">Zoom</a>
			<a href="" onclick="MapTool.zoom(\'out\')" class="zoom-out">Back</a>
		</div>
		';
        return $html;
    }
}