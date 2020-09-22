<?php 
  namespace App\Helpers;
  use Config;
  use Route;
  class Form {
    public static function show($elements){
      $xhtml = null;
      foreach ($elements as $key => $value) {
        $xhtml .= self::showFormGroup($value);
      }
      return $xhtml;
    }
    public static function showFormGroup($value){
      $type = ($value['type']??'' && $value['type'] == 'btn-submit') ? $value['type'] : 'input';
      $xhtml = null;
      switch ($type) {
        case 'input':
          $xhtml .= '<div class="form-group">'.$value['label'].'
                      <div class="col-md-6 col-sm-6 col-xs-12">'.$value['element'].'</div>
                    </div>';
          break;
        case 'btn-submit':
          $xhtml .= '<div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          '.$value['element'].'
                        </div>
                      </div>';
          break;
        case 'thumb':
          $xhtml .= '<div class="form-group">
                      '.$value['label'].'
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        '.$value['element'].'
                        <p style="margin-top: 50px;">'.$value['thumb'].'</p>
                      </div>
                    </div>';
          break;
      }
      return $xhtml;
    }
    
  }
?>