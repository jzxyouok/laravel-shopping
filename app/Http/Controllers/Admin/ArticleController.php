<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Article\Create;
use App\Http\Requests\Admin\Article\Update;

use App\Models\BaseModel;
use App\Services\Article as sArticle;
use App\Services\Channel as sChannel;

use Request;

class ArticleController extends BaseController
{
    /**
     * 文章主页面
     */
    public function index()
    {
    	return view(self::BASE_ROUTE.'articles.index');
    }

    /**
     * 新增文章页面展示
     */
    public function create()
    {
        if(!Request::has('id') || !Request::has('type')) {
            return false;
        }

        $target_id = Request::input('id');
        $type      = Request::input('type');

        // 查询对应的文章，如果文章已存在，跳转到相应的编辑页面
        $cond              = array();
        $cond['type']      = $type;
        $cond['target_id'] = $target_id;
        $cond['get_first'] = 0;
        $article           = sArticle::searchArticles($cond);

        if(!empty($article)) {
            return redirect()->route('admin.article.edit', [$target_id, 'type' => $type]);
        }

        $target_parents = array();

        if($type == BaseModel::TYPE_ARTICLE_NORMAL) {
            // 取出文章关联栏目的基本信息，便于页面层次的清晰            
            $cond            = array();
            $cond['no_page'] = 0;
            $all_channels    = sChannel::searchChannels($cond);

            $parent_channels = get_parents($all_channels, $target_id);

            $target_parents  = $parent_channels;
        }

    	return view(self::BASE_ROUTE.'articles.create', compact('target_parents', 'type'));
    }

    /**
     * 新增文章写入
     */
    public function store(Create $request)
    {
    	try {
    		$data = $request->all();

    		sArticle::addNewArticle($data);

    		return redirect()->route('admin.home');
    	} catch (\Exception $e) {
    		return redirect()->route('admin.home')->with('flash_message', '写入失败，请重新操作')->with('flash_type', 'danger');
    	}
    }

    /**
     * 编辑文章页面展示
     */
    public function edit($id)
    {
        if(!Request::has('type')) {
            return false;
        }

        $type           = Request::input('type');        

        $target_parents = array();
        $article        = null;
        if($type == BaseModel::TYPE_ARTICLE_NORMAL) {
            // 取出文章关联栏目的基本信息，便于页面层次的清晰
            $cond            = array();
            $cond['no_page'] = 0;
            $all_channels    = sChannel::searchChannels($cond);

            $parent_channels = get_parents($all_channels, $id);

            $target_parents  = $parent_channels;

            // 取出文章信息
            $cond              = array();
            $cond['type']      = BaseModel::TYPE_ARTICLE_NORMAL;
            $cond['target_id'] = $id;
            $cond['get_first'] = 0;
            $article           = sArticle::searchArticles($cond);
        }

    	return view(self::BASE_ROUTE.'articles.edit', compact('article', 'target_parents'));
    }

    /**
     * 编辑文章写入
     */
    public function update(Update $request, $id)
    {
    	try {
    		$data    = $request->all();

    		$article = sArticle::getArticleById($id);

    		sArticle::updateArticle($data, $id);

    		return redirect()->route('admin.home');
    	} catch (\Exception $e) {
    		return redirect()->route('admin.home')->with('flash_message', '编辑失败，请重新操作')->with('flash_type', 'danger');
    	}
    }

    /**
     * 删除文章
     */
    public function destroy($id)
    {
    	try {
    		sArticle::deleteArticle($id);

    		return redirect()->route('admin.home');
    	} catch (\Exception $e) {
    		return redirect()->route('admin.home')->with('flash_message', '删除失败，请重新操作')->with('flash_type', 'danger');
    	}
    }
}