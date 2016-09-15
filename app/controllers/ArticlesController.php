<?php

namespace app\controllers;

use yii\easyii\modules\article\api\Article;

class ArticlesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCat($slug, $tag = null)
    {
        $cat = Article::cat($slug);
        if(!$cat){
            throw new \yii\web\NotFoundHttpException('Article category not found.');
        }

        $cats = Article::cats();
        $children = [];
        foreach ($cats as $cata) {
          if ($cat->tree == $cata->tree && $cat->slug != $cata->slug && $cat->depth != $cata->depth && $cata->depth != 0) {
            $children[] = [
              'title' => $cata->title,
              'slug' => $cata->slug,
              'short' => $cata->short,
              'image' => $cata->image,
            ];
          }
        }

        return $this->render('cat', [
            'cat' => $cat,
            'children' => $children,
            'items' => $cat->items(['tags' => $tag])
        ]);
    }

    public function actionView($slug)
    {
        $article = Article::get($slug);
        if(!$article){
            throw new \yii\web\NotFoundHttpException('Article not found.');
        }

        $items = Article::items();
        $projects = [];
        $cousins = [];
        $right = [];
        $left = [];
        $k = 1;
        foreach ($items as $item) if ($item->category_id == $article->category_id) $projects[] = $item;
        foreach ($projects as $key => $project) if ($project->id == $article->id) $k = $key;
        foreach ($projects as $key => $project) {
          if ($project->id != $article->id) {
            if ($key == ($k + 1)) $right = $project;
            if ($key == ($k - 1)) $left = $project;
            if (count($projects) > 2) :
              if (end($projects)->id == $article->id) $right = $projects[0];
              if ($projects[0]->id == $article->id) $left = end($projects);
            endif;
            $cousins = [
              'left' => $left,
              'right' => $right,
            ];
          }
        }

        return $this->render('view', [
          'article' => $article,
          'cousins' => $cousins,
        ]);
    }

}
