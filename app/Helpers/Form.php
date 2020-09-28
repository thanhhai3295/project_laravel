<?php 
  namespace App\Helpers;
  use Config;
  use Route;
  class Form {
    public static function show($elements,$errors){
      $xhtml = null;
      $arrErrors = $errors->messages();
      foreach ($elements as $key => $value) {
        $xhtml .= self::showFormGroup($value,$arrErrors);
      }
      return $xhtml;
    }
    public static function showFormGroup($value,$error){
      $fieldError = isset($value['error']) ? $value['error'] : '';
      $messageError = '';
      if(!empty($error)) {
        if($fieldError != '' && isset($error[$fieldError])) {
          $messageError = !empty($error[$fieldError]) ? $error[$fieldError][0] : '';
        }
      }
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
        case 'avatar':
          $xhtml .= '<div class="form-group">
                      '.$value['label'].'
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        '.$value['element'].'
                        <p style="margin-top: 50px;">'.$value['avatar'].'</p>
                      </div>
                    </div>';
          break;
      }
      $xhtml .= '<div class="row" style="margin:0px 0px 10px 1px">
                  <div class="col-md-3"></div><div class="text-danger col-md-6">'.$messageError.'</div>
                </div>';
      return $xhtml;
    }
    
  }
?>