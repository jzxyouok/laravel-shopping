<?php

namespace App\Services;

use App\Models\Article as mArticle;

class Article extends BaseService
{
	/**
	 * 通过ID获取信息
	 */
	public static function getArticleById($id)
	{
		return (new mArticle)->get_article_by_id($id);
	}

	/**
	 * 通过$cond条件获取信息
	 */
	public static function searchArticles($cond = array(), $page = 1, $size = 15)
	{
		$articles = new mArticle();

		$articles = $articles->search_articles();

		if(isset($cond['type'])) {
			$articles = $articles->where('type', $cond['type']);
		}

		if(isset($cond['target_id'])) {
			$articles = $articles->where('target_id', $cond['target_id']);
		}

		if(isset($cond['get_first'])) {
			return $articles->first();
		}

		if(isset($cond['no_page'])) {
			return $articles->get();
		}

		return $articles->paginate($size, ['*'], $page);
	}

	/**
	 * 写入文章
	 */
	public static function addNewArticle($data = array())
	{
		$article = mArticle::create($data);

		return $article;
	}

	/**
	 * 编辑文章
	 */
	public static function updateArticle($data = array(), $id)
	{
		$article = self::getArticleById($id);

		$article->update($data);

		return $article;
	}

	/**
	 * 删除文章
	 */
	public static function deleteArticle($id)
	{
		$article = mArticle::destroy($id);

		return $article;
	}
}