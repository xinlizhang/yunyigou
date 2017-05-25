
<?php

    if (!defined('IN_ECS'))
        die('Hacking attempt');

    // 返回的分类类型 0(默认)：全部分类 1：首页显示的分类
    $cate_type = _POST('cate_type', 0);

    $categoryList = array();
    $category = array();

    if ( $cate_type == 0 )
    {
        $category = get_categories_tree();
    }
    else
    {
        $sql = 'SELECT cat_id,cat_name ,parent_id,is_show,category_icon,category_img,category_thumb ' .
            'FROM ' . $GLOBALS['ecs']->table('category') .
            "WHERE parent_id = 0 AND is_show = 1 AND show_in_index = 1 ORDER BY sort_order_index ASC, cat_id ASC";

        $res = $GLOBALS['db']->getAll($sql);

        foreach ($res AS $row)
        {
            $category[$row['cat_id']]['id'] = $row['cat_id'];
            $category[$row['cat_id']]['name'] = $row['cat_name'];
            $category[$row['cat_id']]['url'] = build_uri('category', array('cid' => $row['cat_id']), $row['cat_name']);

            $category[$row['cat_id']]['category_icon'] = $row['category_icon'];
            $category[$row['cat_id']]['category_img'] = $row['category_img'];
            $category[$row['cat_id']]['category_thumb'] = $row['category_thumb'];
        }
    }

    $category = array_merge($category);

    if (!empty($category)) {

        foreach($category as $key=>$val) {

            $categoryList[$key]['id'] = $val['id'];
            $categoryList[$key]['name'] = $val['name'];
            $categoryList[$key]['category_icon'] = API_DATA('PHOTO', $val['category_icon']);
            $categoryList[$key]['category_img'] = API_DATA('PHOTO', $val['category_img']);
            $categoryList[$key]['category_thumb'] = API_DATA('PHOTO', $val['category_thumb']);

            if(!empty($val['cat_id']))
            {
                foreach($val['cat_id'] as $k=>$v){

                    $categoryList[$key]['children'][] = array(
                        'id'=>$v['id'],
                        'name'=>$v['name'],
                        'category_icon'=>API_DATA('PHOTO', $v['category_icon']),
                        'category_img'=>API_DATA('PHOTO', $v['category_img']),
                        'category_thumb'=>API_DATA('PHOTO', $v['category_thumb']),
                    );
                }
            }
        }
    }

    GZ_Api::outPut($categoryList);

