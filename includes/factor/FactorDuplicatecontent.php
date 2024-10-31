<?php

class FactorDuplicatecontent
    extends eRankerBase 
    implements FactorDisplay 
{

    public static function getDisplay($endModel, $data, $report, $factor) {
        $out = '';
        
        if(isset($data) && !empty($data)){
            $out .= '' . self::translate("wefound", $factor) . ' <strong>' . count($data) . ' </strong> ' . self::translate("websitecontent", $factor) . '<hr></hr>';
            
            $out .= '<div class="row container_duplicatecontent duplicatecontentdown">';
            
            $count = 0;
            
            foreach($data as $data_link){
                if(!empty($data_link['description'])  && !empty($data_link['title']) && !empty($data_link['url'])){
                    $out .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 element_duplicatecontent '. ($count > 3 ? 'duplicatedonotshow' : '') .'">';
                    
                        $out .= '<h3 class="title_duplicatecontent"><a rel="nofollow" href="'. (self::fixURL($data_link['url']) !== false ? self::fixURL($data_link['url']) : $data_link['url']) .'" target="_blank">'. $data_link['title'] .'</a></h3>';
                    
                        $out .= '<a href="'. (self::fixURL($data_link['url']) !== false ? self::fixURL($data_link['url']) : $data_link['url']) .'"  class="link_duplicatecontent" target="_blank">'. (self::fixURL($data_link['url']) !== false ? self::fixURL($data_link['url']) : $data_link['url']) .'</a>';
                    
                        $out .= '<div class="description_duplicatecontent">'. $data_link['description'] .'</div>';
                    
                    $out .= '</div>';
                    
                    $count ++;
                }
            }
            
            $out .= '</div>';
            
            if(count($data) > 3){
                $out .= '<a class="showmoreduplicatecontent" href="javascript:void(0);" onclick="if(jQuery(\'.container_duplicatecontent\').hasClass(\'duplicatecontentdown\')){duplicateContentToggle(\' '. html_entity_decode(self::translate("show-less", $factor)) .'\');}else if(jQuery(\'.container_duplicatecontent\').hasClass(\'duplicatecontentup\')){duplicateContentToggle(\' '. html_entity_decode(self::translate("show-more", $factor)) .'\')}"><i class="fa fa-angle-down"></i>'
                        . html_entity_decode(self::translate("show-more", $factor)) .'</a>';
            }
        }else{
            $out .= '<div class="row">';
            
                $out .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'. self::translate('notfindcontent',$factor) .'</div>';
            
            $out .= '</div>';
        }
        
        return $out;        
    }
}