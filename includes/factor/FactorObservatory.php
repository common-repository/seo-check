<?php

class FactorObservatory
    extends eRankerBase 
    implements FactorDisplay 
{
    public static function getDisplay($endModel, $data, $report, $factor){

        $out = '<div class="row">';
        
        if(!empty($data) && !is_null($data)){
            
             $color = '';
            if((int)$data['score'] < 50){
               $color = 'red';    
            }elseif((int)$data['score'] < 70){
                $color = 'orange';
            }elseif((int)$data['score'] > 70){
                $color = 'green';
            }
        
            $exclude = [
                "end_time",
                "tests_passed",
                "grade",
                "scan_id",
                "state",
                "tests_failed",
                "response_headers",
                "score",
                "start_time",
                "tests_quantity",
                "likelihood_indicator"
            ];
            
            $grade = $data['grade'];
            $true = $data["tests_passed"];
            $false = $data["tests_failed"];
            $pdf_charts ='';
            $charts = array();
            $out .='<p id="chart-info" class="hidden" passed-data="'.$true.'" failed-data="'.$false.'"></p>';
            $out .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 div-right nopaddingleft">'
                    .'<div class="row grade-container">'
                    .'<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 nopaddingleft">'
                    .'<div class="grade-title">'
                    .'</div>';
            $out  .= '<div id="http-highcharts-container" class="http-highcharts-container">';
            
            if (isset($_GET["pdf"])) {
                
                    $total = $true + $false;
                    $charts['Passed'] = array("id" => "Passed", "title" => "Passed","value" => "$true");
                    $charts['Failed'] = array("id" => "Failed", "title" => "Failed","value" => "$false");
                    
                    $plots = array(
                        $charts['Passed']['title'] => (100*$true) / $total,
                        $charts['Failed']['title'] => (100*$false) / $total
                    );
                    
                   $pdf_charts .= sprintf('<h3>%s vs %s<br><small>Total: %d</small></h3>',
                        $charts['Passed']["title"], $charts['Failed']["title"], $total);
                    $pdf_charts .= self::__draw_pie_chart($plots, 50);
                    $out .= $pdf_charts;
            }
            
            $out .= '</div>';
            $out .= '</div>'
                   .'</div>';                   
            $out .= '<div class="row scores-container">';
            $out .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 data-table '
                    . 'nopaddingleft">';
            $out .= '<table>'
                    .'<thead>'
                    .'<th>'.__("Score Expectations","er").'</th>'
                    .'</thead>'
                    .'<tbody>'
                    .'<tr><td><h1>'.__("Final Grade: ","er").'<span  '
                    . 'style="color:'.$color.'">'.$grade.'</span></h1></td></tr>';
            foreach ($data as $key => $value){
                
                if(in_array($key, $exclude)){
                    
                    continue;
                    
                }else{
                    
                    if (isset($value['pass']) && !is_null($value['pass']) && 
                        isset($value["expectation"]) && !is_null($value["expectation"])) {
                        
                        $font = $value['pass'] === false ? 'times red' : 'check green';
                        if(isset($value["id"]) && !is_null($value["id"]) && !empty($value["id"])){
                            $text = self::getObservatoryExpectation($value["id"]);
                        }else{
                            $text = $value["score_description"];
                        }
                        
                        $out .='<tr><td><span><i class="fa fa-'.$font.' aria-hidden="true"></i></span> '
                                .$text.'</td></tr>';
                    } else {
                        
                        continue;
                         
                    }
                    
                }    
            }
            
            $out .='</tbody>';
            $out .='</table>';            
            $out .='</div>';
            $out .='</div>';
            $out .='</div>';
            
        }else{
            $out .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12'
                    . ' nopaddingleft">'.self::translate("model_red", $factor)
                    .'</div>';
        }
        $out .= '</div>';
        return $out;
    }
    
}