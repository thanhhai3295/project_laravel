<?php 
  namespace App\Helpers;
  use Illuminate\Support\Str;
  class URL {
    public static function linkCategory($name,$id) {
      return route('category/index',['category_id' => $id,'category_name' => Str::slug($name)]);
    }
    public static function linkArticle($name,$id) {
      return route('article/index',['article_id' => $id,'article_name' => Str::slug($name)]);
    }
  }
?>